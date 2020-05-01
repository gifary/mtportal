<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadAttachment extends Model
{   
	public $table='lead_attachments';

    protected $fillable = [
		'lead_id',
		'attachment_title',
		'attachment',
		'comment'
	];
}
