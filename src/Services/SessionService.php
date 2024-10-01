<?php
/*
namespace App\Services;
    

class SessionService
{
    public function __construct()
    {
        session_start();
    }

    public function isUserLoggedIn(){
        return isset($_SESSION['user_id']);
    }

    public function getUserId(){
        return $_SESSION['user_id'] ?? null;
    }

    public function loginUser($userId){
        $_SESSION['user_id'] = $userId;
    }

    public function logoutUser(){
        session_destroy();  
    }
}*/