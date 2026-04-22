<?php

use Illuminate\Support\Facades\Auth;

function getCurrectAuthUser($guard){
    $user = Auth::guard($guard)->user() ; 
    if(!$user && $guard == 'admin'){
        return redirect()->route('admin.login') ; 
    }else if(!$user && $guard == 'web'){
        return redirect()->route('user.login') ;
    }else{
        return $user ;
    }
} 