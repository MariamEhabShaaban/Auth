<?php

namespace App\Models;

use App\Models\User;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'sessions';

    public $incrementing = false;
    
    public $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload' ,
        'last_activity'
    ];

    public function getLastActivityAttribute($value){
        return Carbon::createFromTimestamp($value)->diffForHumans();
    }

    public function getUserAgentAttribute($value){
       $agent = new Agent();
       $agent->setUserAgent($value); 
       return [
        'platform'=>$agent->platform(),
        'browser' => $agent->browser(),
        'is_desktop' => $agent->isDesktop()
       ];
    }

      public function getIsThisDeviceAttribute(){
        return $this->id == request()->session()->getId();
    }

    public $hidden = ['payload'];
    public $append =['is_this_device'];


    public function user(){
        return $this->belongsTo(User::class);
        }

}
