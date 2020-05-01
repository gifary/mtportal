<?php
/**
 * Created by gifary
 * Email gifary.upwork@gmail.com
 * Copyright (c) 2020.
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "country";

    protected $fillable = ['country_code','country_name'];
}
