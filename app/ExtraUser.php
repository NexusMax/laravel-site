<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int user_id
 * @property string nickname
 * @property string growth
 * @property string weight
 * @property string goal
 * @property int physical_level
 * @property string physical_days
 * @property string physical_exp_years
 * @property int health_level
 * @property string health_musculoskeletal
 * @property string health_cardio
 * @property string health_cardio_custom
 * @property string health_metabolism
 * @property string health_nervous
 * @property string health_nervous_custom
 * @property int health_pregnancy
 * @property int body_type
 * @property int wrist_size
 */
class ExtraUser extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'extra_user';

    protected $fillable = [
        'nickname',
        'growth',
        'weight',
        'gender'
    ];
    
    
    public function initNewUser($userId){
        $this->user_id = $userId;
        $this->nickname = '';
        $this->growth = '';
        $this->weight = '';
        $this->goal = '';
        $this->physical_level = 1;
        $this->physical_days = '';
        $this->physical_exp_years = '';
        $this->health_level = 1;
        $this->health_musculoskeletal = '';
        $this->health_cardio = '';
        $this->health_cardio_custom = '';
        $this->health_metabolism = '';
        $this->health_nervous = '';
        $this->health_nervous_custom = '';
        $this->health_pregnancy = 0;
        $this->body_type = 1;
        $this->wrist_size = 1;
    }

    /**
     * @return array|mixed
     */
    public function getPhysicalDays(){
        if ($this->physical_days)
            return json_decode($this->physical_days);

        return [];
    }

    public function getCardio(){
        if ($this->health_cardio)
            return json_decode($this->health_cardio);

        return [];
    }

    public function getMusculoskeletal(){
        if ($this->health_musculoskeletal)
            return json_decode($this->health_musculoskeletal);

        return [];
    }

    public function getMetabolism(){
        if ($this->health_metabolism)
            return json_decode($this->health_metabolism);

        return [];
    }

    public function getNervous(){
        if ($this->health_nervous)
            return json_decode($this->health_nervous);

        return [];
    }


    public function setPhysicalDays($data){
        $this->physical_days = json_encode($data);
    }

    public function setCardio($data){
        $this->health_cardio = json_encode($data);
    }

    public function setMusculoskeletal($data){
        $this->health_musculoskeletal = json_encode($data);
    }

    public function setMetabolism($data){
        $this->health_metabolism = json_encode($data);
    }

    public function setNervous($data){
        $this->health_nervous = json_encode($data);
    }


   





}
