<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Images;
use Illuminate\Support\Facades\Validator;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $rules = array(
            'album_id' => 'required|numeric|exists:photo_galleries,id',
            'image'=>'required|mimes:jpeg,bmp,png'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('add_image', array('id' =>Input::get('album_id')))
                ->withErrors($validator)
                ->withInput();
        }

        $file = Input::file('image');
        $destinationPath = 'albums/';
        $extension = $file->getClientOriginalExtension();
        $filename=time().'_album_image.'.$extension;
        $uploadSuccess = Input::file('image')
            ->move($destinationPath, $filename);
        if (!$destination = Input::get('description'))
            $destination = '';
        Images::create(array(
            'description' => $destination,
            'image' => $filename,
            'album_id'=> Input::get('album_id')
        ));

        return Redirect::route('show_album', array('id'=>Input::get('album_id')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $album = Album::find($id);
//        return View::make('addimage')
//            ->with('album',$album);

        $album = Album::find($id);
        return view('admin.galleries.add')
            ->with('name', 'Добавить изображение')
            ->with('album', $album)
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
    public function destroy($id)
    {
        $image = Images::find($id);
        $image->delete();
        return Redirect::route('show_album', array('id'=>$image->album_id));
    }

    public function move() {
        $rules = array(
            'new_album' => 'required|numeric|exists:photo_galleries,id',
            'photo'=>'required|numeric|exists:photo_images,id'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('admin/galleries');
        }
        $image = Images::find(Input::get('photo'));
        $image->album_id = Input::get('new_album');
        $image->save();
        return Redirect::route('show_album', array('id'=>Input::get('new_album')));
    }
}
