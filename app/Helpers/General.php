<?php

use App\Models\User;

function authId(){
    //dd(66);
    return  auth()->user()?auth()->user()->id:null;
}
function role($user_id,$roleId){
    $user=User::where(['id'=>$user_id])->first();
    $roleUser=$user->role_id;
    if($roleUser==$roleId){//role is admin
        return true;
    }else{
        return false;
    }

}