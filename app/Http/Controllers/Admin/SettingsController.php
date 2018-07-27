<?php

namespace App\Http\Controllers\Admin;

use App\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Settings::all();
        return view('admin.settings.index')
            ->with('name', 'Настройки')
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
        return view('admin.settings.item')
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
        $rules = array(
            'param' => 'required',
            'value' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('edit_setting', array('id' =>Input::get('id')))
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        $id = $request->input('id');
        if (!empty($id)) {
            $response = 'Изменения успешно внесены';
            $task = Settings::find($id);
            $task->fill($input)->save();
        } else {
            $response = 'Изменения успешно добавлены';
            $item = Settings::create($input);
            $id = $item->id;
        }
        unset($input['_token']);

        return Redirect::route('edit_setting', array('id' =>$id))->with('status', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Settings::find($id);
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.settings.item')
            ->with('name', 'Редактирование')
            ->with('response', $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->input('id'));
        Settings::where('id', $id)->delete();
        print "200";
    }
}
