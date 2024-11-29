<?php
namespace App\Services\Login;

use App\Services\Login\UserLoginService;
use App\Services\Login\GoogleLoginService;

class AuthServiceFactory{

    public static function create($type){
        switch($type){
            case 'email':
                return new UserLoginService();
            case 'google':
                return new GoogleLoginService();
            default:
                throw new \Exception("Unsupported authentication type");
        }
    }
}
