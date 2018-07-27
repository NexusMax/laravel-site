<?php

namespace App\Http\Controllers\Admin;

use App\Mailchimp;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MailchimpController extends Controller
{
    public function index() {
        $response = Mailchimp::get();
        return view('admin.mailchimp.index')
            ->with('name', 'Группы рассылок')
            ->with('response', json_encode($response));
    }

    public function index_users() {
        $user = new User();
        $groups = new Mailchimp();
        $response = [];
        $subscribe_groups = [];
        foreach ($groups->get() as $group) {
            $subscribe_groups[$group->id] = $group;
        }
        foreach ($groups->users->all() as $i=>$user) {
            $response[$i] = [
                'id' => $user['id'],
                'user' => trim($user['name'] . ' ' . $user['lastname']),
                'email' => $user['email'],
                'group' => $subscribe_groups[$user['pivot']->subscribe_id],
            ];
        }
        return view('admin.mailchimp.index_users')
            ->with('name', 'Пользователи MailChimp')
            ->with('response', json_encode($response));
    }

    public function get() {
        $json = json_encode(array());

        $data = Mailchimp::curl('GET', 'lists', $json);

        print_r($data);
        die;

        return response()->json($data, 200);
    }

    public function store(Request $request) {
        $data = $request->all();

        $item = json_decode($data['item']);

        $group = [];
        $group['name'] = $item->name;
        $group['list_id'] = $item->id;
        $group['web_id'] = $item->web_id;
        $group['visibility'] = $item->visibility;
        $group['json'] = $data['item'];

        if (!$exists_group = Mailchimp::where('web_id', $group['web_id'])->first()) {
            if (!$exists_group_list = Mailchimp::where('list_id', $group['list_id'])->first()) {
                Mailchimp::create($group);
            } else {
                $exists_group_list->fill($group)->save();
            }
        } else {
            $exists_group->fill($group)->save();
        }

        if(intval($data['id']) < intval($data['total'])) {
            $data = array('end'=>false, 'id'=>$data['id'], 'total'=>$data['total']);
        } else {
            $data = array('end'=>true, 'id'=>$data['id'], 'total'=>$data['total']);
        }

        return response()->json($data, 200);
    }

    public function get_groups(Request $request) {
        $keyword = $request->input('term');
        $groups = Mailchimp::select('*')
            ->where('name', 'like', '%'.$keyword.'%')
            ->get();

        $suggestions = array();
        foreach($groups as $group) {
            $suggestion = [];
            $suggestion['value'] = $group->name . ' (' . $group->list_id . ')';
            $suggestion['data'] = $group;
            $suggestion['data']['id'] = $group->id;
            $suggestions[] = $suggestion;
        }

        header("Content-type: application/json; charset=UTF-8");
        header("Cache-Control: must-revalidate");
        header("Pragma: no-cache");
        header("Expires: -1");
        print json_encode($suggestions);
    }

    public function store_user(Request $request) {
        $input = $request->all();
        if (!$input['group'] || !$input['user']) return false;

        $group_id = intval($input['group']);
        $user_id = intval($input['user']);

        $mail = new Mailchimp();
        $res = $mail->add_user_group($user_id, $group_id);

        header("Content-type: application/json; charset=UTF-8");
        header("Cache-Control: must-revalidate");
        header("Pragma: no-cache");
        header("Expires: -1");
        print json_encode($res);
        exit();
    }



    public function destroy_user(Request $request) {
        $input = $request->all();
        if (!$input['group'] || !$input['user']) return false;

        $user_id = intval($input['user']);
        $group_id = intval($input['group']);

        $user_group = DB::table('subscriber_user as su')
            ->select('su.id', 'su.json')
            ->where('su.user_id', $user_id)
            ->where('su.subscribe_id', $group_id)
            ->first();
        $links = json_decode($user_group->json)->_links;
        $url = $links[4]->href;
        $e = Mailchimp::curl('DELETE', '', '', $url);
        Mailchimp::find($group_id)->detachMailUser($user_id);

        header("Content-type: application/json; charset=UTF-8");
        header("Cache-Control: must-revalidate");
        header("Pragma: no-cache");
        header("Expires: -1");
        print json_encode($e);
        exit();
    }

    public function update(Request $request) {
        $mail = new Mailchimp();
        $data = $request->all();
        $experience = $data['item']['data']['experience'];
        $user_id = $data['item']['data']['id'];

        $mail->for_cron_update($user_id, $experience);

        if(intval($data['id']) < intval($data['total'])) {
            $data = array('end'=>false, 'id'=>$data['id'], 'total'=>$data['total']);
        } else {
            $data = array('end'=>true, 'id'=>$data['id'], 'total'=>$data['total']);
        }

        return response()->json($data, 200);
    }

    public function emails(Request $request) {
        $limit = 10000;
        $input = $request->all();
        $result = [];
        if (!empty($input['list_id'])) {
            $group = Mailchimp::where('list_id', $input['list_id'])->first();
            if (!empty($group)) {
                $action = 'lists/'.$group['list_id'].'/members?count='.$limit;
                $emails = Mailchimp::curl('GET', $action);
                $emails = json_decode($emails);
                foreach ($emails->members as $m) {
                    $result[] = [
                        'email' => $m->email_address,
                        'list_id' => $group['id'],
                    ];
                }
            }
        }
        return response()->json($result, 200);
    }

    public function update_email(Request $request) {
        $user = new User();
        $mail = new Mailchimp();
        $input = $request->all();

        $user = User::where('email', $input['email'])->first();
        if (!empty($user)) {
            $action = 'lists/' . $input['list_id'] . '/members/' . md5($input['email']);
            Mailchimp::curl('DELETE', $action);
            Mailchimp::find($input['list_id'])->detachMailUser($user['id']);
            $mail->for_cron_update($user['id'], $user['experience']);
        }

        if(intval($input['id']) < intval($input['total'])) {
            $data = array('end'=>false, 'email'=>$input['email'], 'id'=>$input['id'], 'total'=>$input['total']);
        } else {
            $data = array('end'=>true, 'email'=>$input['email'], 'id'=>$input['id'], 'total'=>$input['total']);
        }

        return response()->json($data, 200);
    }
}
