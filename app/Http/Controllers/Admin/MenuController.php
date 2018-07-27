<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Menu::all();
        return view('admin.menu.index')
            ->with('name', 'Меню')
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
        return view('admin.menu.item')
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
        if ($request->isMethod('post')) {
            $store = new Menu;
            $this->validate($request, [
                'name' => 'required|max:255'
            ]);
            $response = 'Изменения успешно добавлены';
            $id = $request->input('id');
            if (!empty($id)) {
                $store = Menu::find($request->input('id'));
                $response = 'Изменения успешно внесены';
            }
            $store->name = $request->input('name');

            $store->save();

            return redirect('admin/menu/')->with('result', $response);
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Menu::find($id);
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.menu.item')
            ->with('name', 'Редактирование')
            ->with('response', $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
