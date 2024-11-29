<?php namespace App\Services\Login;

abstract class BaseLoginService{
    
    abstract public function authenticate(array $credentials);
}
