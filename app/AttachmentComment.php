<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttachmentComment extends Model
{
    protected $fillable = [
		'ticket_id',
		'user_id',
		'comment_body'
	];
}
