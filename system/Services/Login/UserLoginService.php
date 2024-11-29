<?php namespace App\Services\Login;

use App\Models\UserModel;

class UserLoginService extends BaseLoginService{
    
    public function authenticate(array $credentials){
        
        $email = $credentials['email'];
        $password = $credentials['password'];

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if($user && ($password ==$user['password'])){
            return $user;
        }

        return null;
    }
}