<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stack extends Model
{
    protected $guarded = [];

    public function business()
   {
       return $this->belongsTo(Business::class);
   }
}
