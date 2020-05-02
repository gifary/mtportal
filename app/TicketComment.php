<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TicketComment extends Model
{
    protected $fillable = [
		'ticket_id',
		'user_id',
		'comment_body'
	];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class,'ticket_id','id');
    }

    public function getUpdatedAtAttribute($value)
    {
        if(Auth::check()){
            if(!empty(Auth::user()->zone_name)){
                $dt = Carbon::parse($value);
                $zone = Zone::find(Auth::user()->zone_name);
                return $dt->setTimezone($zone->zone_name)->toDateTimeString();
            }else{
                return $value;
            }
        }else{
            return $value;
        }

    }

}
