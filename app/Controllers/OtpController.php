<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OtpModel;

class OtpController extends BaseController{

    protected $otpModel;

    public function __construct(){
        $this->otpModel = new OtpModel();
        
    }

    public function generateOtp(){

        $json = $this->request->getJSON();
        $phone = $json->phone;
        $randomNumber = random_int(100000, 999999);
        $otp = $this->otpModel->addOtp($randomNumber,$phone);

        return $this->response->setJSON(['status'=> true]);
    }

    public function verifyenterOtp(){
        
        $json = $this->request->getJSON();
        $phone = $json->phone;
        $otp = $json->otp;
        $result = $this->otpModel->verifyOtp($otp, $phone);
        if($result){
            return $this->response->setJSON(['status'=> true]);
        }
        else{
            return $this->response->setJSON(['status'=> false]);
        }
    }
}
