<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = [
		'title',
		'description',
		'ticket_type',
		'start_date',
		'status',
		'priority',
		'parent_task_id'
	];

	public function ticket_attachments()
	{
		return $this->hasMany('App\TicketAttachment','ticket_id','id');
	}

	public function ticket_comments()
	{
		return $this->hasMany('App\TicketComment','ticket_id','id');
	}
}
