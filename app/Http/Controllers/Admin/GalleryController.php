<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::with('Photos')->get();
        return view('admin.galleries.index')
            ->with('name', 'Галлерея')
            ->with('albums', $albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.galleries.create')
            ->with('name', 'Галлерея');
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
            return Redirect::route('admin/galleries/create')
                ->withErrors($validator)
                ->withInput();
        }

        $name = Input::get('name');
        $alias = Input::get('alias');
        if (empty($alias))
            $alias = $this->translit($name);

        $filename = '';
        $file = Input::file('cover_image');
        if (!empty($file)) {
            $destinationPath = 'albums/';
            $extension = $file->getClientOriginalExtension();
            $filename=time().'_cover.'.$extension;
            $uploadSuccess = Input::file('cover_image')
                ->move($destinationPath, $filename);
        }
        $description = Input::get('description');
        $album = Album::create(array(
            'name' => $name,
            'alias' => $alias,
            'description' => $description,
            'cover_image' => $filename
        ));

        return Redirect::route('admin/galleries', array('id'=>$album->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $albums = Album::with('Photos')->get();
        $album = Album::with('Photos')->find($id);
        return view('admin.galleries.show')
            ->with('name', 'Галлерея')
            ->with('album',$album)
            ->with('albums',$albums)
            ;
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
        $album = Album::find($request->input('id'));

        $album->delete();

        return Redirect::route('admin/galleries');
    }
}
