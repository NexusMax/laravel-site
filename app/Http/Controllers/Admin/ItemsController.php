<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Items;
use App\Album;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Items::select(
            'sp_items.*',
            'a.name as author_name', 'a.lastname as author_lastname',
            'e.name as editor_name', 'e.lastname as editor_lastname',
            'c.name as category_name', 'c.alias as category_alias',
            'r.slug')
            ->leftjoin('users as a', 'sp_items.author_id', '=', 'a.id')
            ->leftjoin('users as e', 'sp_items.edited_user_id', '=', 'e.id')
            ->leftjoin('sp_categories as c', 'sp_items.category_id', '=', 'c.id')
            ->leftjoin('roles as r', 'sp_items.role_id', '=', 'r.id')
            ->get();
        foreach ($response as $item) {
            $item->author_fullname = trim($item->author_name . ' ' . $item->author_lastname);
            $item->editor_fullname = trim($item->editor_name . ' ' . $item->editor_astname);
        }

        return view('admin.items.index')
            ->with('name', 'Материалы')
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
        return view('admin.items.item')
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
        $input = $request->all();
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            if (Input::get('id')) {
                return Redirect::route('edit_item', array('id' => $input['id']))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                return Redirect::route('admin/items/create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        unset($input['_token']);

        if (!isset($input['published'])) $input['published'] = 0;
        if (!isset($input['featured'])) $input['featured'] = 0;

        if (!empty($input['created_at']))
            $input['created_at'] = strtotime($input['created_at']);

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

        if (!$request->input('published')) $input['published'] = 0;
        if (!$request->input('featured')) $input['featured'] = 0;

        $id = $request->input('id');

        if (!$request->input('author_id'))
            $input['author_id'] = Auth::user()->id;
        else
            $input['author_id'] = intval($request->input('author_id'));

        if (!empty($id)) {
            $response = 'Изменения успешно добавлены';
            $task = Items::find($id);
            $input['edited_user_id'] = Auth::user()->id;
            $task->fill($input)->save();
        } else {
            $response = 'Изменения успешно внесены';
            $input['edited_user_id'] = Auth::user()->id;
            $item = Items::create($input);
            $id = $item->id;
        }

        return Redirect::route('edit_item', array('id' =>$id))->with('status', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response['item'] = Items::find($id);
        $response['author'] = Users::find(intval($response['item']->author_id));
        $response['categories'] = Categories::all();
        $response['users'] = Users::all();
        $response['photoalbums'] = Album::all();
        $response['roles'] = Role::all();
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.items.item')
            ->with('name', 'Редактирование')
            ->with('response', $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items $items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->input('id'));
        Items::where('id', $id)->delete();
        print "200";
    }

    public function clone_item($id) {
        $item = Items::find($id);
        $item = $item->replicate();
        $item->published = 0;
        $item->save();

        return Redirect::route('edit_item', array('id' =>$id))->with('status', 'Скопирован');
    }

    public function get() {
        $data = Items::select('i.id', 'i.name', 'c.name as cat_name')
            ->from('sp_items as i')
            ->leftjoin('sp_categories as c', 'i.category_id', '=', 'c.id')
            ->get();
        return response()->json($data, 200);
    }
}
