<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $guarded = [];
    /* public function stacks(){
 
             return  $this->hasMany('App\Stack', 'foreign_key');
     
         }*/
 
         public function contacts(){
 
                    return $this->hasMany(Contact::class);
         }   
         public function stacks(){
 
                    return $this->hasMany(Stack::class);
         }//
}
