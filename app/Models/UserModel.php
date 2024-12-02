<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{

    protected $table = 'users';
    protected $primaryKey = 'id';
    
    public function addUser($email, $password, $phone, $username, $type){
        $query = $this->db->query("INSERT INTO users (email, username, password, phone, type) VALUES ('$email','$password','$phone','$username', '$type')");
        return $query;
    }

    public function checkifEmailExists($email){
        $query = $this->db->query("SELECT * FROM users WHERE email = '$email'")->getRowArray();
        return $query;
    }

    public function checkUserDetailsbyId($userId){
        $query = $this->db->query("SELECT * FROM users WHERE id = '$userId'")->getRowArray();
        return $query;
    }

    public function insrtdetailsByArray($keys, $values, $userId){
        $setValues = [];
        foreach ($keys as $index => $key) {
            $setValues[] = "$key = '{$values[$index]}'";
        }
        $setValuesStr = implode(", ", $setValues);
        $query = $this->db->query("UPDATE users SET $setValuesStr WHERE id = '$userId'");
        return $query;
    }

    public function getuserByPhone($phone){
        $query = $this->db->query("SELECT * FROM users WHERE phone = '$phone'")->getRowArray();
        return $query;
    }

    public function addOnlyPhone($phone){
        $query = $this->db->query("INSERT INTO users (phone, type) VALUES ('$phone','3')");
        return $query;
    }
}
