<?php

namespace App\Http\Controllers\Admin;

use App\Components;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComponentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Components::all();
        return view('admin.components.index')
            ->with('name', 'Компоненты')
            ->with('response', json_encode($response));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Components  $components
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Items::find($id);
        if (is_null($response)) {
            abort(404);
        }
        return json_encode($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Components  $components
     * @return \Illuminate\Http\Response
     */
    public function edit(Components $components)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Components  $components
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Components $components)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Components  $components
     * @return \Illuminate\Http\Response
     */
    public function destroy(Components $components)
    {
        //
    }
}
