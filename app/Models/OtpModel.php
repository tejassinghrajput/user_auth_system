<?php

namespace App\Models;

use CodeIgniter\Model;

class OtpModel extends Model
{
    protected $table            = 'otp_verification';
    protected $primaryKey       = 'id';
    
    public function addOtp($otp,$phone){
        $query = $this->db->query("INSERT INTO otp_verification (otp, phone) VALUE ('$otp','$phone')");
        return $query;
    }

    public function verifyOtp($otp, $phone){
        $this->validateOtp($otp);
        $query = "SELECT * FROM otp_verification WHERE otp = '$otp' AND phone = '$phone' AND status = 'valid'";
        return $this->db->query($query)->getRowArray();
    }

    public function validateOtp($otp){
        $query = $this->db->query("UPDATE otp_verification SET status = 'exp' WHERE TIMESTAMPDIFF(SECOND, datetime, NOW())>60 AND status = 'valid'");
    }

    
}
