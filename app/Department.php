<?php
/**
 * Created by gifary
 * Email gifary.upwork@gmail.com
 * Copyright (c) 2020.
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "department";
    protected $primaryKey='dept_id';
    public $timestamps =false;
}
