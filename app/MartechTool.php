<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MartechTool extends Model
{   
	public $table='martech_tools';

    protected $fillable = [
		'lead_id',
		'purpose',
		'name',
	];
}
