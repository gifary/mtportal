<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SupportTicket extends Model
{
    protected $fillable = [
		'title',
		'description',
		'ticket_type',
		'start_date',
		'status',
		'priority',
		'parent_task_id',
        'ticket_number',
        'user_id'
	];

	public function ticket_attachments()
	{
		return $this->hasMany('App\TicketAttachment','ticket_id','id');
	}

	public function ticket_comments()
	{
		return $this->hasMany('App\TicketComment','ticket_id','id');
	}

	public function user(){
	    return $this->belongsTo(User::class,'user_id','id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $total = SupportTicket::count();
            $model->ticket_number = "#0000".($total+1);
            $model->user_id = Auth::user()->id;
        });
    }

}
