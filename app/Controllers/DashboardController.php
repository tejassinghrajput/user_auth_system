<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class DashboardController extends BaseController{

    protected $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function dashboard(){
        if(empty(session()->get('user'))){
            return redirect()->to('/');
        }
        $data = session()->get('user');
        $userId = $data['id'];
        $res = $this->userModel->getUserById($userId);
        session()->set('user', $res);
        return view("dashboard");
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
        if($detail['email'] == ''){
            $data['email'] = '1';
        }
        else{
            $data['email'] = '0';
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
        
        $phone = $json->phone ?? '';
        $password = $json->password ?? '';
        $email = $json->email ?? '';
        $username = $json->username ?? '';
        
        $data = [];
        if ($phone !== '') {
            $data['phone'] = $phone;
        }
        if ($password !== '') {
            $data['password'] = $password;
        }
        if ($email !== '') {
            $data['email'] = $email;
        }
        if ($username !== '') {
            $data['username'] = $username;
        }
    
        $userId = $json->id;
        
        $result = $this->userModel->insertdetailsByArray($data, $userId);
        
        if ($result) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
}
