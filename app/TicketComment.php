<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    protected $fillable = [
		'ticket_id',
		'user_id',
		'comment_body'
	];

}
