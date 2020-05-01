<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadAttachmentComment extends Model
{public $table='lead_attachment_comments';
    protected $fillable = [
		'lead_id',
		'user_id',
		'lead_attachment_id',
		'comment',
	];
}
