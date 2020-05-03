<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile_pic','personal_contact','official_contact','birth_date','gender','country','position','department','role','tire','businesses','zone_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUserName($id)
    {
    	$names = User::where('id',$id)->value('name');
    	return $names;
    }

    protected $with =['role_user','business'];

    public function role_user(){
        return $this->belongsTo(Role::class,'role');
    }

    public function business(){
        return $this->belongsTo(Business::class,'businesses','id');
    }
}
