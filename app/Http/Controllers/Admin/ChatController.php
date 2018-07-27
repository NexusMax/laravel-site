<?php

namespace App\Http\Controllers\Admin;

use App\ChatHistory;
use App\ItemsEvents;
use App\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ItemsEvents::select(
            'sp_items_events.*', 'h.chat_id')
            ->rightjoin('chat_history as h', 'sp_items_events.id', '=', 'h.chat_id')
            ->groupby('chat_id')
            ->get();



        return view('admin.chat.index')
            ->with('name', 'История чатов')
            ->with('response', json_encode($response));;

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = ChatHistory::select('*')->where('chat_id',$id)->get();




        /*
        $response = Settings::find($id);

        if (is_null($response)) {
            abort(404);
        }*/

        return view('admin.chat.item')
            ->with('name', 'История чата')
            ->with('response', $response);

    }

}
