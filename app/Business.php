<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $guarded = [];

    public function contacts(){

        return $this->hasMany(Contact::class);
    }
    public function stacks(){

        return $this->hasMany(Stack::class);
    }

    public function user()
    {
        return $this->hasOne(User::class,'businesses','id');
    }
}
