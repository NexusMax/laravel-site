<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Categories::all();
        return view('admin.categories.index')
            ->with('name', 'Категории')
            ->with('response', json_encode($response));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = [];
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.categories.item')
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
                return Redirect::route('edit_category', array('id' =>Input::get('id')))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                return Redirect::route('admin/categories/create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $input = $request->all();
        unset($input['_token']);

        if (!isset($input['published'])) $input['published'] = 0;
        if (!isset($input['featured'])) $input['featured'] = 0;
        if (!isset($input['is_video'])) $input['is_video'] = 0;

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

        // Icon 1
        $file = $request->file('icon');
        unset($input['icon']);
        if ($file) {
            $file_name = $this->get_filename($request->file('icon')->getClientOriginalName().'_1_');
            $request->file('icon')->move('img/icons', $file_name);
            $data = $request->except(['icon']);
            $input['icon'] = $file_name;
        }
        if ($request->input('icon_r')) {
            $input['icon'] = null;
        }

        // Icon 2
        $file = $request->file('icon_hover');
        unset($input['icon_hover']);
        if ($file) {
            $file_name = $this->get_filename($request->file('icon_hover')->getClientOriginalName().'_2_');
            $request->file('icon_hover')->move('img/icons', $file_name);
            $data = $request->except(['icon_hover']);
            $input['icon_hover'] = $file_name;
        }
        if ($request->input('icon_hover_r')) {
            $input['icon_hover'] = null;
        }

        // Icon 3
        $file = $request->file('icon_3');
        unset($input['icon_3']);
        if ($file) {
            $file_name = $this->get_filename($request->file('icon_3')->getClientOriginalName().'_3_');
            $request->file('icon_3')->move('img/icons', $file_name);
            $data = $request->except(['icon_3']);
            $input['icon_3'] = $file_name;
        }
        if ($request->input('icon_3_r')) {
            $input['icon_3'] = null;
        }

        // Icon mini
        $file = $request->file('icon_mini');
        unset($input['icon_mini']);
        if ($file) {
            $file_name = $this->get_filename($request->file('icon_mini')->getClientOriginalName().'_4_');
            $request->file('icon_mini')->move('img/icons', $file_name);
            $data = $request->except(['icon_mini']);
            $input['icon_mini'] = $file_name;
        }
        if ($request->input('icon_mini_r')) {
            $input['icon_mini'] = null;
        }

        // Icon mini 2
        $file = $request->file('icon_mini_2');
        unset($input['icon_mini_2']);
        if ($file) {
            $file_name = $this->get_filename($request->file('icon_mini_2')->getClientOriginalName().'_5_');
            $request->file('icon_mini_2')->move('img/icons', $file_name);
            $data = $request->except(['icon_mini_2']);
            $input['icon_3'] = $file_name;
        }
        if ($request->input('icon_mini_2_r')) {
            $input['icon_mini_2'] = null;
        }

        $id = $request->input('id');
        if (!empty($id)) {
            $response = 'Изменения успешно добавлены';
            $task = Categories::find($id);
            $task->fill($input)->save();
        } else {
            $response = 'Изменения успешно внесены';
            $item = Categories::create($input);
            $id = $item->id;
        }

        return Redirect::route('edit_category', array('id' =>$id))->with('status', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Categories::find($id);
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.categories.item')
            ->with('name', 'Редактирование')
            ->with('response', $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->input('id'));
        Categories::where('id', $id)->delete();
        print "200";
    }
}
