<?php

namespace App\Http\Controllers\Admin;

use App\Orders;
use App\Session;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = User::select('users.*', 'roles.name as role_name')
            ->leftjoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftjoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->get();
        foreach ($response as $item) {
            $item['address'] = $item['country'].($item['city']?', '.$item['city']:'');
            $item['payment'] = Orders::payed($item['id']) ? 'Оплата' : (Orders::trial($item['id']) ? 'Триал' : 'Бесплатный');
        }
        return view('admin.users.index')
            ->with('name', 'Пользователи')
            ->with('response', json_encode($response));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response['user'] = [];
        $response['roles'] = Role::all();

//        $response['permissions'] = Permission::all();
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.users.item')
            ->with('name', 'Добавление')
            ->with('response', $response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ];
        $user_exists = User::where('email', Input::get('email'))
            ->where('id', '<>', Input::get('id'))->first();
        if (!empty($user_exists)) {
            return Redirect::route('admin/users/create')
                ->withErrors(array('email'=>'Существует'))
                ->withInput();
        }

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('edit_user', array('id' =>Input::get('id')))
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();

        $id = $request->input('id');

        if (!isset($input['confirm'])) $input['confirm'] = 0;

        // Выборка роли
        $role_id = $input['role'];
        unset($input['role']);

        $file = $request->file('image');
        unset($input['image']);

        if ($file) {
            $file_name = $this->get_filename($request->file('image')->getClientOriginalName());
            $request->file('image')->move('user', $file_name);
//            $data = $request->except(['image']);
            $input['image'] = $file_name;
        }

        if ($request->input('image_r')) {
            $input['image'] = null;
        }

        if (!empty($password = $request->input('password')))
            $input['password'] = bcrypt($password);

        if (!empty($id)) {
            $response = 'Изменения успешно внесены';
            $task = User::find($id);

            $user = $task->fill($input)->save();
            DB::table('role_user')->where('user_id', '=', $id)->update(['role_id'=>$role_id]);
        } else {
            $response = 'Изменения успешно добавлены';
            $user = User::create($input);
            DB::table('role_user')->insert(['user_id'=>$user->id, 'role_id'=>$role_id]);
        }
        unset($input['_token']);

//        print_r($input);
//        Session::flash('message', 'Saved');

        return Redirect::route('edit_user', array('id' =>$id))->with('status', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response['user'] = User::find($id);
        $response['roles'] = Role::all();
//        $response['permissions'] = Permission::all();
        if (is_null($response)) {
            abort(404);
        }
        $role_id = DB::table('role_user')
            ->where('user_id', '=', $response['user']->id)
            ->value('role_id');
        if ($role_id) {
            $response['user']['role'] = json_decode(json_encode(Role::find($role_id)));
        }

        return view('admin.users.item')
            ->with('name', 'Редактирование')
            ->with('response', $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->input('id'));
        User::where('id', $id)->delete();
        print "200";
    }

    public function get_users(Request $request) {
        $keyword = $request->input('term');
        $users = User::select('*')
            ->where('name', 'like', '%'.$keyword.'%')
            ->orWhere('lastname', 'like', '%'.$keyword.'%')
            ->orWhere('phone', 'like', '%'.$keyword.'%')
            ->orWhere('email', 'like', '%'.$keyword.'%')
            ->get();

        $suggestions = array();
        foreach($users as $user) {
            $suggestion = [];
            $suggestion['value'] = trim($user->name.' '.$user->lastname).' '.$user->phone.' ('.$user->email.')';
            $suggestion['data'] = $user;
            $suggestion['data']['id'] = $user->id;
            $suggestions[] = $suggestion;
        }

        header("Content-type: application/json; charset=UTF-8");
        header("Cache-Control: must-revalidate");
        header("Pragma: no-cache");
        header("Expires: -1");
        print json_encode($suggestions);
    }
}
