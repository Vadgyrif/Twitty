<?php

namespace App\Models;

class User 
{
    private $db; 

    public function __construct($db){

        $this->db = $db;

    }

    public function register($username, $email, $password){

        $hashedPasword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPasword]);

    }

    public function login($email, $password){
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])){
            return $user;   
        } 

        return FALSE;
   
    }

    public function getUserByID($id){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);  
        return $stmt->fetch();
    }

    public function editProfile($userId, $bio, $birthdate){
        $stmt = $this->db->prepare("UPDATE users SET bio = ?, birthdate = ? WHERE id = ?");
        return $stmt->execute([$bio, $birthdate, $userId ]);
    }
    

}