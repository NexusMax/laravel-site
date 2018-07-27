<?php

namespace App\Http\Controllers\Admin;

use App\Experts;
use App\ExpertsGroup;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ExpertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Experts::select('experts.*', 'experts_group.name as group_name', 'users.name', 'users.lastname')
            ->leftjoin('experts_group', 'experts_group.id', '=', 'experts.group_id')
            ->leftjoin('users', 'experts.user_id', '=', 'users.id')
            ->get();
        return view('admin.experts.index')
            ->with('name', 'Эксперты')
            ->with('response', json_encode($response));
    }

    public function index_group()
    {
        $response = ExpertsGroup::all();
        return view('admin.experts.index_group')
            ->with('name', 'Группы экспертов')
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
        $response['groups'] = ExpertsGroup::all();
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.experts.item')
            ->with('name', 'Добавление эксперта')
            ->with('response', $response);
    }

    public function create_group()
    {
        $response['item'] = [];
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.experts.item_group')
            ->with('name', 'Добавление группі экспертов')
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
            'body' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            if (Input::get('id')) {
                return Redirect::route('edit_expert', array('id' =>Input::get('id')))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                return Redirect::route('admin/experts/create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $input = $request->all();
        unset($input['_token']);

        if (!$request->input('active')) $input['active'] = 0;
        if (!$request->input('position')) $input['position'] = 0;
        if (!$request->input('meta_title')) $input['meta_title'] = '';
        if (!$request->input('meta_desc')) $input['meta_desc'] = '';

        $id = $request->input('id');

        $input['user_id'] = intval($request->input('user_id'));

        if (!empty($id)) {
            $response = 'Изменения успешно добавлены';
            $task = Experts::find($id);
            $task->fill($input)->save();
        } else {
            $response = 'Изменения успешно внесены';
            $item = Experts::create($input);
            $id = $item->id;
        }

        return Redirect::route('edit_expert', array('id' =>$id))->with('status', $response);
    }

    public function store_group(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            if (Input::get('id')) {
                return Redirect::route('edit_expert_group', array('id' =>Input::get('id')))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                return Redirect::route('admin/experts/groups/create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $input = $request->all();
        unset($input['_token']);

        if (!$request->input('active')) $input['active'] = 0;
        if (!$request->input('meta_title')) $input['meta_title'] = '';
        if (!$request->input('meta_desc')) $input['meta_desc'] = '';

        $id = $request->input('id');

        if (empty($input['alias']))
            $input['alias'] = $this->translit($input['name']);

        if (!empty($id)) {
            $response = 'Изменения успешно добавлены';
            $task = ExpertsGroup::find($id);
            $item = $task->fill($input)->save();
        } else {
            $response = 'Изменения успешно внесены';
            $item = ExpertsGroup::create($input);
        }

        return Redirect::route('admin/experts/groups')->with('status', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response['item'] = Experts::find($id);
        $response['user'] = Users::find(intval($response['item']->user_id));
        $response['groups'] = ExpertsGroup::all();
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.experts.item')
            ->with('name', 'Редактирование эксперта')
            ->with('response', $response);
    }

    public function show_group($id)
    {
        $response['item'] = ExpertsGroup::find($id);
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.experts.item_group')
            ->with('name', 'Редактирование экспертной группы')
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
        Experts::where('id', $id)->delete();
        print "200";
    }

    public function destroy_group(Request $request)
    {
        $id = intval($request->input('id'));
        ExpertsGroup::where('id', $id)->delete();
        print "200";
    }
}
