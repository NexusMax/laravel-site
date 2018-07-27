<?php

namespace App\Http\Controllers\Admin;

use App\EventsOrder;
use App\ItemsEvents;
use App\Orders;
use App\Payments;
use App\User;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Payments::get();
        return view('admin.payments.index')
            ->with('name', 'Бухгалтерия')
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
        return view('admin.payments.item')
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
            'sum'        => 'required',
            'deal'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            if (Input::get('id')) {
                return Redirect::route('edit_payment', array('id' =>Input::get('id')))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                return Redirect::route('admin/payments/create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $input = $request->all();
        unset($input['_token']);

        if (!$input['status']) $input['status'] = 0;

        $id = $request->input('id');
        if (!empty($id)) {
            $response = 'Изменения успешно добавлены';
            $task = Payments::find($id);
            $input['user_id'] = Auth::user()->id;
            $item = $task->fill($input)->save();
        } else {
            $response = 'Изменения успешно внесены';
            $input['user_id'] = Auth::user()->id;
            $item = Payments::create($input);
        }

        return Redirect::route('admin/payments')->with('status', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Payments::find($id);
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.payments.item')
            ->with('name', 'Редактирование')
            ->with('response', $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function edit(Payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->input('id'));
        Payments::where('id', $id)->delete();
        print "200";
    }

    public function get_orders() {
        $response = Orders::select('sp_orders.*', 'u.name', 'u.lastname', 'u.email', 'u.phone')
            ->from('sp_orders')
            ->leftjoin('users as u', 'sp_orders.user_id', '=', 'u.id')
            ->get();
        foreach ($response as $item) {
            $item->fullname = trim($item->name . ' ' . $item->lastname);
        }
        return view('admin.payments.orders')
            ->with('name', 'Заказы')
            ->with('response', json_encode($response));
    }

    public function get_order($id) {
        $response = Orders::find($id);
        $response['user'] = User::find($response['user_id']);
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.payments.order')
            ->with('name', 'Редактирование заказа')
            ->with('response', $response);
    }

    public function create_order(){
        $response = [];
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.payments.order')
            ->with('name', 'Добавление заказа')
            ->with('response', $response);
    }

    public function order(Request $request) {
        $rules = array(
            'sum'        => 'required',
            'deal'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            if (Input::get('id')) {
                return Redirect::route('edit_order', array('id' =>Input::get('id')))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                return Redirect::route('admin/orders/order')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $input = $request->all();
        unset($input['_token']);

        if (!isset($input['status'])) $input['status'] = 0;

        $id = $request->input('id');
        if (!empty($id)) {
            $response = 'Изменения успешно добавлены';
            $task = Orders::find($id);
            $item = $task->fill($input)->save();
        } else {
            $response = 'Изменения успешно внесены';
            $item = Orders::create($input);
        }

        return Redirect::route('admin/orders')->with('status', $response);
    }

    public function destroy_order(Request $request) {
        $id = intval($request->input('id'));
        Orders::where('id', $id)->delete();
        print "200";
    }

    public function get_webinars() {
        $response = EventsOrder::select(
            'events_order.*',
            'e.name as event_name',
            'u.name', 'u.lastname')
            ->leftjoin('users as u', 'events_order.user_id', '=', 'u.id')
            ->leftjoin('sp_items_events as e', 'events_order.event_id', '=', 'e.id')
            ->get();
        foreach ($response as $item) {
            $item->fullname = trim($item->name . ' ' . $item->lastname);
        }
        return view('admin.webinars.index')
            ->with('name', 'Вебинары')
            ->with('response', json_encode($response));
    }

    public function create_webinar() {
        $response = [];
        if (is_null($response)) {
            abort(404);
        }
        $response['events'] = ItemsEvents::all();

        return view('admin.webinars.item')
            ->with('name', 'Добавление к просмотру вебинара')
            ->with('response', $response);
    }

    public function store_webinar(Request $request)
    {
        $rules = array(
            'event_id' => 'required',
            'user_id' => 'required',
            'email' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            if (Input::get('id')) {
                return Redirect::route('edit_webinar', array('id' =>Input::get('id')))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                return Redirect::route('admin/webinars/create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $input = $request->all();
        unset($input['_token']);

        $id = $request->input('id');
        if (!empty($id)) {
            $response = 'Изменения успешно добавлены';
            $task = EventsOrder::find($id);
            $item = $task->fill($input)->save();
        } else {
            $response = 'Изменения успешно внесены';
            $item = EventsOrder::create($input);
        }

        return Redirect::route('admin/webinars')->with('status', $response);
    }

    public function get_webinar($id) {
        $response = [];
        $response['item'] = EventsOrder::find($id);
        $response['events'] = ItemsEvents::all();
        $response['user'] = User::find($response['item']['user_id']);
        if (is_null($response)) {
            abort(404);
        }
        return view('admin.webinars.item')
            ->with('name', 'Редактирование оплаты')
            ->with('response', $response);
    }

    public function destroy_webinar(Request $request) {
        $id = intval($request->input('id'));
        EventsOrder::where('id', $id)->delete();
        print "200";
    }
}
