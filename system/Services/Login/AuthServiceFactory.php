<?php
namespace App\Services\Login;

use App\Services\Login\UserLoginService;
use App\Services\Login\GoogleLoginService;
use App\Services\Login\OtpLoginService;

class AuthServiceFactory{

    public static function create($type){
        switch($type){
            case 'email':
                return new UserLoginService();
            case 'google':
                return new GoogleLoginService();
            case 'phone':
                return new OtpLoginService();
            default:
                throw new \Exception("Unsupported authentication type");
        }
    }
}
