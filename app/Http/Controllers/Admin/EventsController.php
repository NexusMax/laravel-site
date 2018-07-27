<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Categories;
use App\ItemsEvents;
use App\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use jeremykenedy\LaravelRoles\Models\Role;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ItemsEvents::select(
            'sp_items_events.*',
            'a.name as author_name', 'a.lastname as author_lastname',
            'e.name as editor_name', 'e.lastname as editor_lastname',
            'c.name as category_name', 'c.alias as category_alias',
            'r.slug')
            ->leftjoin('users as a', 'sp_items_events.author_id', '=', 'a.id')
            ->leftjoin('users as e', 'sp_items_events.edited_user_id', '=', 'e.id')
            ->leftjoin('sp_categories as c', 'sp_items_events.category_id', '=', 'c.id')
            ->leftjoin('roles as r', 'sp_items_events.role_id', '=', 'r.id')
            ->get();
        foreach ($response as $item) {
            $item->author_fullname = trim($item->author_name . ' ' . $item->author_lastname);
            $item->editor_fullname = trim($item->editor_name . ' ' . $item->editor_lastname);
        }

        return view('admin.events.index')
            ->with('name', 'События')
            ->with('response', json_encode($response));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response['item'] = [];
        $response['categories'] = Categories::all();
        $response['users'] = Users::all();
        $response['photoalbums'] = Album::all();
        $response['roles'] = Role::all();
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.events.item')
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
        ];
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            if (Input::get('id')) {
                return Redirect::route('edit_event', array('id' =>Input::get('id')))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                return Redirect::route('admin/event/create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $input = $request->all();
        unset($input['_token']);

        if (!isset($input['published'])) $input['published'] = 0;
        if (!isset($input['featured'])) $input['featured'] = 0;
        if (!isset($input['without_date'])) $input['without_date'] = 0;

        if (empty($input['alias']))
            $input['alias'] = $this->translit($input['name']);

        $file = $request->file('img');
        unset($input['img']);
        if ($file) {
            $file_name = $this->get_filename($request->file('img')->getClientOriginalName());
            $request->file('img')->move('img', $file_name);
            $input['img'] = $file_name;
        }
        if ($request->input('image_r')) {
            $input['img'] = null;
        }

        $file = $request->file('icons');
        unset($input['icons']);
        if ($file) {
            $file_name = $this->get_filename($request->file('icons')->getClientOriginalName());
            $request->file('icons')->move('img/icons', $file_name);
            $data = $request->except(['img']);
            $input['icons'] = $file_name;
        }
        if ($request->input('icons_r')) {
            $input['icons'] = null;
        }
        if (!$request->input('users_id')) {
            $input['users_id'] = 0;
        }

        if (!$request->input('author_id'))
            $input['author_id'] = Auth::user()->id;
        else
            $input['author_id'] = intval($request->input('author_id'));

        if (!$input['vimeo']) $input['vimeo'] = '';
        $input['price'] = (float)$input['price'];
        $input['old_price'] = (float)$input['old_price'];


        if (!empty($input['created_at']))
            $input['created_at'] = strtotime($input['created_at']);
        if (!empty($input['end_at']))
            $input['end_at'] = date('Y-m-d H:i:s', strtotime($input['end_at']));

        $id = $request->input('id');
        if (!empty($id)) {
            $response = 'Изменения успешно добавлены';
            $task = ItemsEvents::find($id);
            $input['edited_user_id'] = Auth::user()->id;
            $task->fill($input)->save();
        } else {
            $response = 'Изменения успешно внесены';
            $input['edited_user_id'] = Auth::user()->id;
            $item = ItemsEvents::create($input);
            $id = $item->id;
        }

        return Redirect::route('edit_event', array('id' =>$id))->with('status', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response['item'] = ItemsEvents::find($id);
        $response['author'] = Users::find(intval($response['item']->author_id));
        $response['categories'] = Categories::all();
        $response['users'] = Users::all();
        $response['photoalbums'] = Album::all();
        $response['roles'] = Role::all();
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.events.item')
            ->with('name', 'Редактирование')
            ->with('response', $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->input('id'));
        ItemsEvents::where('id', $id)->delete();
        print "200";
    }
}
