<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Login\AuthServiceFactory;
use App\Models\UserModel;
use CodeIgniter\Commands\Database\Seed;

class AuthController extends BaseController{

    protected $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function index(){
        return view('loginpanel');
    }

    public function signUpPage(){
        return view('signuppanel');
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
        return view('loginpanel', ['error' => lang('messages.login_invalid_credentials')]);
    }

    public function dashboard(){
        return view("dashboard");
    }


    public function logout(){
        session()->destroy();
        return redirect()->to('/');
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

    public function handlesocialLogin(){

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
    

    public function checkDetails(){
        $json = $this->request->getJSON();
        $userId = $json->userId;
        $detail = $this->userModel->checkUserDetailsbyId($userId);

        if($detail['password'] == ''){
            $data['password'] = '1';
        }
        else{
            $data['password'] = '0';
        }
        if($detail['phone'] == ''){
            $data['phone'] = '1';
        }
        else{
            $data['phone'] = '0';
        }
        if($detail['username'] == ''){
            $data['username'] = '1';
        }
        else{
            $data['username'] = '0';
        }
        return $this->response->setJSON([$data]);
    }

    public function updateDetails(){
        
        $json = $this->request->getJSON();

        $keys = array_keys((array) $json);
        $values = array_values((array) $json);
        $userId = $json->id;

        $result = $this->userModel->insrtdetailsByArray($keys, $values, $userId);

        if($result){
            return $this->response->setJSON(['success' => true]);
        }
        else{
            return $this->response->setJSON(['success' => false]);
        }
    }
}