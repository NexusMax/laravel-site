<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property mixed user_id
 * @property int ruffier_p1
 * @property int ruffier_p2
 * @property int ruffier_p3
 * @property double ruffier_index
 * @property mixed flexibility
 * @property mixed pushups
 * @property mixed twisting
 * @property mixed situp
 * @property mixed plank
 * @property mixed swallow
 * @property string result
 */
class PhysicalMetricsHistory extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'physical_metrics_history';

    public function cloneFromLast(PhysicalMetricsHistory $record){
        $this->user_id = $record->user_id;
        $this->ruffier_p1 = $record->ruffier_p1;
        $this->ruffier_p2 = $record->ruffier_p2;
        $this->ruffier_p3 = $record->ruffier_p3;
        $this->ruffier_index = $record->ruffier_index;
        $this->flexibility = $record->flexibility;
        $this->pushups = $record->pushups;
        $this->twisting = $record->twisting;
        $this->situp = $record->situp;
        $this->plank = $record->plank;
        $this->swallow = $record->swallow;

        $this->result = '';

        return $this;

    }

    public function initNewUser($userId){
        $this->user_id = $userId;
        $this->ruffier_p1 = 60;
        $this->ruffier_p2 = 60;
        $this->ruffier_p3 = 60;

        $this->ruffier_index = 1;

        $this->flexibility = 1;
        $this->pushups = 10;
        $this->twisting = 10;
        $this->situp = 11;
        $this->plank = 11;
        $this->swallow = 1;
        $this->result = '';
    }

}
