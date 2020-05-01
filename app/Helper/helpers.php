<?php

function get_user_role($user_id){
    $user_role = DB::table('roles')->where('id',$user_id)->first();

    if($user_role){
        return $user_role->name;
    }else{
        return false;
    }
}
