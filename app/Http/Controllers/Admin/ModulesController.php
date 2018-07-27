<?php

namespace App\Http\Controllers\Admin;

use App\Items;
use App\Modules;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use jeremykenedy\LaravelRoles\Models\Role;

class ModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Modules::all();
        return view('admin.modules.index')
            ->with('name', 'Модули')
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
        $response['role'] = Role::all();
        $response['items'] = Items::all();
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.modules.item')
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
            $store = new Modules;
            $this->validate($request, [
                'name' => 'required|max:255'
            ]);
            $response = 'Изменения успешно добавлены';
            $id = $request->input('id');
            if (!empty($id)) {
                $store = Modules::find($request->input('id'));
                $response = 'Изменения успешно внесены';
            }
            $store->name = $request->input('name');
            $store->content = $request->input('content');
            $store->order = $request->input('order');
            $store->published = $request->input('published');
            $store->type = $request->input('type');
            $store->role_id = ($request->input('role_id'))?$request->input('role_id'):0;
            $store->showname = $request->input('showname');
            $store->item_id = ($request->input('item_id'))?$request->input('item_id'):0;
            $store->settings = $request->input('settings');
            $store->classes = $request->input('classes');

            $store->save();

            return redirect('admin/modules/'.$id)->with('result', $response);
        }

        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules  $modules
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response['module'] = Modules::find($id);
        $response['role'] = Role::all();
        $response['items'] = Items::all();
        if (is_null($response)) {
            abort(404);
        }
//        return $response;
        return view('admin.modules.item')
            ->with('name', 'Редактирование')
            ->with('response', $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modules  $modules
     * @return \Illuminate\Http\Response
     */
    public function edit(Modules $modules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules  $modules
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modules $modules)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules  $modules
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->input('id'));
        Modules::where('id', $id)->delete();
        print "200";
    }
}
