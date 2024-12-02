<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Login\AuthServiceFactory;
use App\Models\UserModel;

class AuthController extends BaseController{

    protected $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function index(){
        return view('loginpanel');
    }

    public function verifyLogin($check){
        
        $email = $this->request->getPost('email') ? $this->request->getPost('email') : '';
        $password = $this->request->getPost('password') ? $this->request->getPost('password') : '';
        $phone = $this->request->getPost('phone') ? $this->request->getPost('phone') : '';
        $otp = $this->request->getPost('otp') ? $this->request->getPost('otp') : '';

        $authService = AuthServiceFactory::create($check);
        
        $user = $authService->authenticate(['email' => $email, 'password' => $password, 'phone' => $phone, 'otp' => $otp]);
        if($user){
            session()->set(['user' => $user]);
            return redirect()->to('/dashboard');
        }
        return redirect()->to('/login')->with('error', lang('messages.login_invalid_credentials'));
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/');
    }

    public function socialLogin($service) {

        $authService = AuthServiceFactory::create($service);
        $authUrl = $authService->authenticate([]);
        return redirect()->to($authUrl);
    }

    public function googleCallback() {

        $code = $this->request->getGet('code');

        if (!$code) {
            return redirect()->to('/login')->with('error', lang('messages.google_auth_error'));
        }

        $authService = AuthServiceFactory::create('google');

        try {
            $user = $authService->authenticate(['code' => $code]);

            session()->set('user', $user);
            return redirect()->to('/add/google');
            
        } catch (\Exception $e) {
            return redirect()->to('/login')->with('error', lang('messages.google_login_failed'));
        }
    }

    public function handlesocialLogin($type){

        $user = session()->get('user');
        $checkEmail = $this->userModel->checkifEmailExists($user['email']);
        
        if ($checkEmail) {
            session()->remove('user');
            session()->set('user', $checkEmail);
            return redirect()->to('/dashboard');
        } else {
            $newUser = $this->userModel->addUser($user['email'], '', '', '', '', '2');
    
            if ($newUser) {
                $checkEmail = $this->userModel->checkifEmailExists($user['email']);
                session()->remove('user');
                session()->set('user', $checkEmail);
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/login')->with('error', lang('messages.auth_user_creation_failed'));
            }

        }
    }
    
}