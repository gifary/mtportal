<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TuskAttachment extends Model
{
    protected $fillable = [
		'task_id',
		'attachment_title',
		'attachment'
	];
}
