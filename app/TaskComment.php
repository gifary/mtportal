<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    protected $fillable = [
		'ticket_id',
		'user_id',
		'comment_body'
	];
}
