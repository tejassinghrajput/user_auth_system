<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class RegisterController extends BaseController{

    protected $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function signUpPage(){
        return view('signuppanel');
    }
    
    public function signUp(){

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');
        $username = $this->request->getPost('username');
        $phone = $this->request->getPost('phone');

        $checkEmail = $this->userModel->checkifEmailExists($email);

        if($checkEmail){

            $data =[
                'status' => 'error',
                'message' => lang('messages.email_exists_error')
            ];

            return $this->response->setJSON($data);
        }

        if($password == $confirmPassword){
            $addUser = $this->userModel->addUser($email, $password, $phone, $username, '1');
            if($addUser){
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => lang('messages.user_registration_success')
                ]);
            }
            else{
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => lang('messages.user_registration_failed')
                ]);
            }
        }
        else{
            return $this->response->setJSON([
                'status' => 'error',
                'message' => lang('messages.user_registartion_password_error')
            ]);
        }
    }
}
