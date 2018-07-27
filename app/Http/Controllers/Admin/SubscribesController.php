<?php

namespace App\Http\Controllers\Admin;

use App\Logging;
use App\Mail\Sender;
use App\Subscriber;
use App\Subscribes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SubscribesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Subscribes::get();
        return view('admin.subscribes.index')
            ->with('name', 'Рассылки')
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
        return view('admin.subscribes.item')
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
            'name' => 'required',
            'message' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('edit_subscribe', array('id' =>Input::get('id')))
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        $id = $request->input('id');
        if (!$request->input('active')) {
            $input['active'] = 0;
        }
        if (!empty($id)) {
            $response = 'Изменения успешно внесены';
            $task = Subscribes::find($id);
            $task->fill($input)->save();
        } else {
            $response = 'Изменения успешно добавлены';
            $id = Subscribes::create($input);
        }
        unset($input['_token']);

        return Redirect::route('edit_subscribe', array('id' =>$id))->with('status', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscribes  $subscribes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Subscribes::find($id);
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.subscribes.item')
            ->with('name', 'Редактирование')
            ->with('response', $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscribes  $subscribes
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscribes $subscribes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscribes  $subscribes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscribes $subscribes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscribes  $subscribes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->input('id'));
        Subscribes::where('id', $id)->delete();
        print "200";
    }

    public function get_subscribers() {
        $response = Subscriber::all();
        return view('admin.messages.subscribers')
            ->with('name', 'Подписчики')
            ->with('response', json_encode($response));
    }

    public function destroy_subscriber(Request $request)
    {
        $id = intval($request->input('id'));
        Subscriber::where('id', $id)->delete();
        print "200";
    }

    public function sender(Request $request) {
        $data = $request->all();
        $data['active'] = Subscribes::select('active')->where('id', intval($data['template_id']))->first()->active;
        if ($data['type'] == 'subscribers') {
            if (!$data['active']) {
                $data['subscribers'] = Subscriber::get();
                Subscribes::where('id', intval($data['template_id']))->update(['active' => 1]);
                $data['total'] = count($data['subscribers']);
            }
        }
        if ($data['type'] == 'to_subscribe') {
            if (!$data['template_id']) return false;
            $data['template'] = Subscribes::find(intval($data['template_id']));
            $data['item'] = json_decode($data['item']);
            if (!empty($data['template']) && isset($data['template']['message'])) {
                $name = $data['item']->name;
                $email = $data['item']->email;

                $content = [
                    'message' => $data['template']['message']
                ];

                Mail::to($email)
                    ->send(new Sender($content));

                $data['item'] = json_encode($data['item']);



                Logging::create(array(
                    'action' => 'subscribe',
                    'object_id' => $data['template_id'],
                    'email' => $email
                ));
                Subscribes::where('id', intval($data['template_id']))
                    ->update(['dt' => date('Y-m-d H:i:s')]);
            }

            if(intval($data['id']) < intval($data['total'])) {
                $data = array('end'=>false, 'id'=>$data['id'], 'item'=>$data['item'], 'total'=>$data['total'], 'template'=>$data['template'], 'active'=>$data['active']);
            } else {
                Subscribes::where('id', $data['template_id'])->update(['active' => 0]);
                $data['dt'] = Subscribes::select('dt')->where('id', intval($data['template_id']))->first()->dt;
                $data = array('end'=>true, 'id'=>$data['id'], 'item'=>$data['item'], 'total'=>$data['total'], 'template'=>$data['template'], 'active'=>$data['active'], 'dt'=>$data['dt']);
            }
        }

        print json_encode($data);
    }
}
