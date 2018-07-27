<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int user_id
 * @property string growth
 * @property string height
 * @property int pressure_sys
 * @property string result
 * @property string stamina
 * @property int pulse_regen
 * @property int pulse_rest
 * @property int alcohol
 * @property int smoking
 * @property int pressure_dia
 */
class HealthMetricsHistory extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'health_metrics_history';


    public function initNewUser($user){
        /**
         * @var ExtraUser $extraFields
         */
        $extraFields = $user->extraFields()->first();

        $this->user_id = $user->id;
        $this->growth = $extraFields->growth;
        $this->height = $extraFields->weight;
        $this->pressure_sys = 120;
        $this->pressure_dia = 90;
        $this->smoking = 0;
        $this->alcohol = 0;
        $this->pulse_rest = 90;
        $this->pulse_regen = 110;
        $this->stamina = '1';
        $this->result = '';


    }

}
