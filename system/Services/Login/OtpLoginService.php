<?php namespace App\Services\Login;

use App\Models\OtpModel;
use App\Models\UserModel;

class OtpLoginService extends BaseLoginService{

    protected $otpModel;
    protected $userModel;
    public function __construct(){
        $this->otpModel = new OtpModel();
        $this->userModel = new UserModel();
    }
    
    public function authenticate(array $credentials){
        $phone = $credentials['phone'];
        $otp = $credentials['otp'];
        $result = $this->otpModel->verifyOtp($otp, $phone);
        if($result){
            $check = $this->userModel->getuserByPhone($phone);
            if($check){
                return $check;
            }
            else{
                $insertUser = $this->userModel->addOnlyPhone($phone);
                $data = $this->getUser($phone);
                return $data;
            }
        }
        return false;
    }

    public function getUser($phone){
        $user = $this->userModel->getuserByPhone($phone);
        return $user;
    }
}