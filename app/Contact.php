<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
   //
   protected $guarded = [];


   public function business()
  {
      return $this->belongsTo(Business::class);
  }
}
