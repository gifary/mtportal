<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadComment extends Model
{   
	public $table='lead_comments';

    protected $fillable = [
		'lead_id',
		'user_id',
		
	];
}
