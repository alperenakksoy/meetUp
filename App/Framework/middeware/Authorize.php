<?php

namespace Framework\Middeware;
use Framework\Session;

class Authorize{

/**
 * Check if the user authenticated
 * @return boolean
 */
public function isAuthenticated(){
    return Session::has('user');
}

/**
 * Handle the user's requests
 * @param string $role
 * @return bool
 */
    public function handle($role){
    if($role == 'guest' && $this->isAuthenticated()){
        return redirect('/');
    }elseif($role == 'auth' && !$this->isAuthenticated()){
        return redirect('/login');
    }
    }
}