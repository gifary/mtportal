<?php
/**
 * Created by gifary
 * Email gifary.upwork@gmail.com
 * Copyright (c) 2020.
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $table= "zone";
    protected $primaryKey="zone_id";
    public $timestamps=false;
}
