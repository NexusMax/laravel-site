<?php

namespace App;

use function Couchbase\defaultDecoder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mailchimp extends Model
{
    protected $table = 'subscribers_groups';
    protected $fillable = [
        'name', 'list_id', 'web_id', 'visibility', 'json'
    ];
    public $groups = [
        'all' => [
            'Sport Casta - все подписчики',
            'Подписчики на новости',
        ],
        'free' => [
            'Все бесплатные пользователи',
            'Бесплатные-новички',
            'Бесплатные-опытные',
            'Бесплатные - не определено',
        ],
        'trial' => [
            'Все после trial',
            'После trial-новички',
            'После trial-опытные',
            'После trial-не определено',
        ],
        'payment' => [
            'Все платные подписчики',
            'Платные-новички',
            'Платные-опытные',
            'Платные-не определено',
        ],
    ];

    public static function add_group($user, $id) {
        if ($group = self::where('list_id', $id)->first()) {
            $json = '{
            "email_address": "'.$user->email.'",
            "status": "subscribed",
            "merge_fields": {
                "FNAME": "'.$user->name.'",
                "LNAME": "'.$user->lastname.'"
                }
            }';
            $action = 'lists/' . $group->list_id . '/members';
            $e = self::curl('POST', $action, $json);

            return $e;
        }
        return false;
    }

    public static function add_to_group($user, $group_name) {
        if ($group = self::where('name', $group_name)->first()) {
            $json = '{
            "email_address": "'.$user->email.'",
            "status": "subscribed",
            "merge_fields": {
                "FNAME": "'.$user->name.'",
                "LNAME": "'.$user->lastname.'"
                }
            }';
            $action = 'lists/' . $group->list_id . '/members';
            $e = self::curl('POST', $action, $json);
        }
    }

    public static function add_to_free_group($user) {
        if ($group = self::where('name', 'Все бесплатные пользователи')->first()) {
            $json = '{
            "email_address": "'.$user->email.'",
            "status": "subscribed",
            "merge_fields": {
                "FNAME": "'.$user->name.'",
                "LNAME": "'.$user->lastname.'"
                }
            }';
            $action = 'lists/' . $group->list_id . '/members';
            $e = self::curl('POST', $action, $json);
        }
    }

    public static function add_to_all_group($user) {
        if ($group = self::where('name', 'Sport Casta - все подписчики')->first()) {
            $json = '{
            "email_address": "'.$user->email.'",
            "status": "subscribed",
            "merge_fields": {
                "FNAME": "'.$user->name.'",
                "LNAME": "'.$user->lastname.'"
                }
            }';
            $action = 'lists/' . $group->list_id . '/members';
            $e = self::curl('POST', $action, $json);
        }
    }

    public function add_user_group ($user_id, $group_id, $status = '', $experience = null) {
        $success = 0;
        $group = $this->find($group_id);

        $user_group = DB::table('subscriber_user as su')
            ->select('su.id')
            ->where('su.user_id', $user_id)
            ->where('su.subscribe_id', $group_id)
            ->first();
        if (empty($user_group)) {
            $r = $this->add_group_byid($group_id, $user_id);
            $data = json_decode($r);
            if ($data->status == 'subscribed')
                $group->attachMailUser($user_id, $r, $status, $experience);
            $success = 1;
        }

        return [
            'success' => $success,
        ];
    }

    public static function update_group($user, $experience = '') {
        if (!$user) return false;

        self::add_to_free_group($user);

        $group = '';
        switch ($experience) {
            case '0':
                $group = self::where('name', 'Бесплатные-новички')->first();
                break;
            case '1':
                $group = self::where('name', 'Бесплатные-опытные')->first();
                break;
            case '2':
                $group = self::where('name', 'Бесплатные-опытные')->first();
                break;
            case '3':
                $group = self::where('name', 'Бесплатные-опытные')->first();
                break;
            default:
                $group = self::where('name', 'Бесплатные - не определено')->first();
                break;
        }

        if ($group) {
            $json = '{
            "email_address": "'.$user->email.'",
            "status": "subscribed",
            "merge_fields": {
                "FNAME": "'.$user->name.'",
                "LNAME": "'.$user->lastname.'"
                }
            }';
            $action = 'lists/' . $group->list_id . '/members';
            $e = self::curl('POST', $action, $json);

            return $e;
        }

        return '';
    }

    public static function delete_user($user) {
        $action = '';
        $json = '';
        $e = '';
        $data = json_decode($user->mail_free);
        $method = $data->_links[4]->method;
        if ($method == 'DELETE') {
            $url = $data->_links[4]->href;
            $e = self::curl($method, $action, $json, $url);
        }
        return $e;
    }

    public function add_group_byid($group_id, $user_id) {
        $user = User::find(intval($user_id));
        if ($group = self::find(intval($group_id))) {
            $json = '{
            "email_address": "'.$user['email'].'",
            "status": "subscribed",
            "merge_fields": {
                "FNAME": "'.$user['name'].'",
                "LNAME": "'.$user['lastname'].'"
                }
            }';
            $action = 'lists/' . $group['list_id'] . '/members';
            $e = self::curl('POST', $action, $json);

            return $e;
        }
        return false;
    }

    public function to_expirience($user_id, $experience, $status = '') {
        $r2 = false;
        $group = DB::table('subscriber_user as su')
            ->select('su.id', 'su.experience', 'su.subscribe_id', 'su.json')
            ->where('su.user_id', $user_id)
            ->where('su.status', 'free')
            ->where('experience', '<>', null)
            ->first();
        if (!empty($group) && $experience != $group->experience) {
            $json = json_decode($group->json);
            $links = $json->_links;
            $group_id = $group->subscribe_id;
            $url = $links[4]->href;
            $e = self::curl('DELETE', '', '', $url);
            self::find($group_id)->detachMailUser($user_id);
        }

        if ($experience == 0) {
            if ($group = $this->select('id')->where('name', $this->groups[$status][1])->first())
                $r2 = $this->add_user_group($user_id, $group->id, $status, $experience);
        } elseif ($experience > 0) {
            if ($group = $this->select('id')->where('name', $this->groups[$status][2])->first())
                $r2 = $this->add_user_group($user_id, $group->id, $status, $experience);
        } else {
            if ($group = $this->select('id')->where('name', $this->groups[$status][3])->first())
                $r2 = $this->add_user_group($user_id, $group->id, $status, $experience);
        }
        return $r2;
    }

    public function for_cron_update($uid, $experience = 0) {
        if ($group = $this->where('name', $this->groups['all'][0])->first()) {
            $this->add_user_group($uid, $group['id']);
        }
        if (Orders::payed($uid)) {
            $groups = DB::table('subscriber_user as su')
                ->select('su.id', 'su.subscribe_id', 'su.json')
                ->where('su.user_id', $uid)
                ->where('su.status', '<>', 'payment')
                ->where('su.status', '<>', '')
                ->get();
            foreach ($groups as $g) {
                $json = json_decode($g->json);
                $links = $json->_links;
                $group_id = $g->subscribe_id;
                $url = $links[4]->href;
                $e = self::curl('DELETE', '', '', $url);
                self::find($group_id)->detachMailUser($uid);
            }
            $status = 'payment';
        } else {
            $groups = DB::table('subscriber_user as su')
                ->select('su.id', 'su.subscribe_id', 'su.json')
                ->where('su.user_id', $uid)
                ->where('su.status', '<>', 'free')
                ->where('su.status', '<>', '')
                ->get();
            foreach ($groups as $g) {
                $json = json_decode($g->json);
                $links = $json->_links;
                $group_id = $g->subscribe_id;
                $url = $links[4]->href;
                $e = self::curl('DELETE', '', '', $url);
                self::find($group_id)->detachMailUser($uid);
            }
            $status = 'free';
        }
        if ($group = $this->where('name', $this->groups[$status][0])->first()) {
            $this->add_user_group($uid, $group['id'], $status);
        }
        // С учётом опыта
        $r2 = $this->to_expirience($uid, $experience, $status);
    }

    public function check_landing ($email)
    {
        if (!empty($email) && $group = self::where('name', 'Лендинг')->first()) {
            $action = 'lists/' . $group['list_id'] . '/members/' . md5($email);
            $json = self::curl('GET', $action);
            $data = json_decode($json);
            if ($data->status == 'subscribed')
                return $data;
        }
        return false;
    }

    public static function curl($type, $action = '', $json = '', $url = '') {
        $apiKey = 'a1ec8a544cf9117441610383052ea347-us17';

        preg_match_all('/[\d]+$/', $apiKey, $matches, PREG_SET_ORDER, 0);
        $link_num = (isset($matches[0][0])) ? $matches[0][0] : '';

        if (empty($url))
            $url = 'https://us'.$link_num.'.api.mailchimp.com/3.0/'.$action;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        if ($type != 'GET' || !empty($json))
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $result;
    }

    public function users() {
        return $this
            ->belongsToMany(User::class, 'subscriber_user', 'subscribe_id', 'user_id')
            ->withPivot('subscribe_id', 'id')
            ->orWherePivot('subscribe_id', '<>', null);
    }

    public function attachMailUser($user_id, $json = null, $status = '', $experience = null) {
        $user = $this->belongsToMany(User::class, 'subscriber_user', 'subscribe_id', 'user_id');
        $user->attach($user_id, ['json' => $json, 'status' => $status, 'experience' => $experience]);
    }

    public function detachMailUser($user_id) {
        $user = $this->belongsToMany(User::class, 'subscriber_user', 'subscribe_id', 'user_id');
        $user->detach($user_id);
    }

}
