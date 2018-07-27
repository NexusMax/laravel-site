<?php

namespace App;

use App\Notifications\ResetPassword;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Orders;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'lastname',
        'country',
        'city',
        'uid',
        'birthday',
        'image',
        'referal',
        'gender',
        'experience',
        'confirm',
        'confirm_text',
        'list_id',
        'mail_free',
        'uid_google',
        'updated_at',
        'created_at',
        'lastmod',
        'landing_reg',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function lastOrder()
    {
        return $this->hasOne('App\Orders', 'user_id', 'id')->orderBy('id', 'desc')->limit(1);
    }

    public function role()
    {
        return $this->hasOne('App\RoleUser', 'user_id', 'id');
    }

    public function roleName()
    {
        return $this->hasOne('App\RoleUser', 'user_id', 'id')->with('roleName');
    }

    public function extraFields()
    {
        return $this->hasOne('App\ExtraUser','user_id','id');
    }

    public function healthMetrics()
    {
        return $this->hasMany('App\HealthMetricsHistory','user_id','id');
    }

    public function physicalMetrics()
    {
        return $this->hasMany('App\PhysicalMetricsHistory','user_id','id');
    }

    public function items()
    {
        return $this->hasMany('App\Items','author_id','id')->limit(6);
    }

    public function expert()
    {
        return $this->hasOne('App\Experts','user_id','id');
    }

    public function getNameRole($number = null)
    {
        if ($number === null)
            $number = $this->role()->first()->role_id;

        switch ($number) {
            case 1:
                return 'Администратор';
                break;
            case 2:
                return 'Ученик';
                break;
            case 3:
                return 'Тренер';
                break;
            default:
                return '';
                break;
        }
    }

    public function updatedInfo($user)
    {
        if (empty($this->lastname))
            $this->lastname = !empty($user['last_name']) ? $user['last_name'] : '';
        if (empty($this->country))
            $this->country = !empty($user['country']) ? $user['country'] : '';
        if (empty($this->city))
            $this->city = !empty($user['city']) ? $user['city'] : '';
        if (empty($this->birthday)){
            if(isset($user['bdate'])){
                $this->birthday = !empty(date('Y-m-d H:i:s', strtotime($user['bdate']))) ? date('Y-m-d H:i:s', strtotime($user['bdate'])) : '';
            }
        }
        if (empty($this->uid))
            $this->uid = $user['uid'];

        $this->save();
    }


    public static function getRegisterRules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public static function getRegisterMessages()
    {
        return [
            'name.required' => 'Необходимо заполнить "Имя"',
            'email.unique' => 'Такой Email уже есть',
            'email.required' => 'Необходимо заполнить Email',
            'email.email' => 'Неправильный Email',
            'validation.email' => 'Неправильный Email',
            'max' => 'Email не должен превышать :max символов.',
            'min' => 'Email должен содержать минимум :min символов.',
            'required' => 'Необходимо заполнить :attribute',
            'password.required' => 'Необходимо заполнить пароль',
            'password.confirmed' => 'Пароли не совпадают',
            'password.max' => 'Пароль не должен превышать :max символов.',
            'password.min' => 'Пароль должен содержать минимум :min символов.',
        ];
    }

    public static function getLoginRules()
    {
        return [
            'email' => 'required|string|email|max:255|exists:users',
            'password' => 'required|string|min:6'
        ];
    }

    public function getExpList()
    {
        return [
            "Не определено",
            "0-3 года",
            "3 и больше"
        ];
    }

    public function getCountry()
    {
        return [
            'Украина',
            'Россия',
            'Казахстан',
            'Беларусь',
            'Молдова',
            'Узбекистан',
            'Армения',
            'Азербайджан',
        ];
    }

    public function getNumCode()
    {
        return [
            '+380',
            '+7',
        ];
    }

    public function getGndrList()
    {
        return [
            "Мужской",
            "Женский"
        ];
    }

    public static function checkInf()
    {
        $bonusInf = self::BonusInf();
        $orders = Orders::where('user_id', Auth::user()->id)->pluck('deal')->toArray();

        if(!empty(Auth::user()->name) && !in_array($bonusInf[7], $orders))
            Orders::PlusBonus(Auth::user(), $bonusInf[7], 10);

        if(!empty(Auth::user()->lastname) && !in_array($bonusInf[8], $orders))
            Orders::PlusBonus(Auth::user(), $bonusInf[8], 10);

        if(!empty(Auth::user()->email) && !in_array($bonusInf[9], $orders))
            Orders::PlusBonus(Auth::user(), $bonusInf[9], 10);

        if(!empty(Auth::user()->image) && !in_array($bonusInf[10], $orders))
            Orders::PlusBonus(Auth::user(), $bonusInf[10], 10);

        if(!empty(Auth::user()->phone) && !in_array($bonusInf[11], $orders))
            Orders::PlusBonus(Auth::user(), $bonusInf[11], 10);

        if(!empty(Auth::user()->birthday) && !in_array($bonusInf[12], $orders))
            Orders::PlusBonus(Auth::user(), $bonusInf[12], 10);

        if(!empty(Auth::user()->country) && !in_array($bonusInf[13], $orders))
            Orders::PlusBonus(Auth::user(), $bonusInf[13], 10);

        if(!empty(Auth::user()->city) && !in_array($bonusInf[14], $orders))
            Orders::PlusBonus(Auth::user(), $bonusInf[14], 10);

        if(!empty(Auth::user()->experience) && !in_array($bonusInf[16], $orders))
            Orders::PlusBonus(Auth::user(), $bonusInf[16], 10);

        if(!empty(Auth::user()->gender) && !in_array($bonusInf[17], $orders))
            Orders::PlusBonus(Auth::user(), $bonusInf[17], 10);

    }

    public static function BonusInf()
    {
        return [
            0 => '2 недели',
            1 => '1 месяц',
            2 => '3 месяца',
            3 => '6 месяцев',
            4 => '12 месяцев',
            5 => 'Регистрация по реферальной ссылке',
            6 => 'Автор реферальной ссылки',
            7 => 'Заполнение имени',
            8 => 'Заполнение фамилии',
            9 => 'Заполнение Email`a',
            10 => 'Заполнение изображения',
            11 => 'Заполнение телефона',
            12 => 'Заполнение даты рождения',
            13 => 'Заполнение страны',
            14 => 'Заполнение города',
            15 => 'Поделиться статьей номер: ',
            16 => 'Заполнение опыта',
            17 => 'Заполнение пола', //17
        ];
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token, $this->name));
    }

    public function mailgroups() {
        return $this->belongsToMany(Mailchimp::class, 'subscriber_user', 'user_id', 'subscribe_id');
    }

}
