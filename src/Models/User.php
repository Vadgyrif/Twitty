<?php

namespace App\Models;

class User 
{
    private $db; 

    public function __construct($db){

        $this->db = $db;

    }

    public function register($username, $email, $password){

        if (empty($username) || empty($email) || empty($password)) {
            throw new \Exception("Усі поля мають бути заповнені."); 
        }
        
       
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Некоректний email."); 
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword]);

    }

    public function login($email, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
    
            if ($user && password_verify($password, $user['password'])) {
                return $user;   
            } 
    
            return false;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    

    public function getUserByID($id){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);  
        return $stmt->fetch();
    }

    public function getAllUsers(){
        $stmt = $this->db->prepare("SELECT id, username, avatar FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function editProfile($userId, $bio, $birthdate = null) {
    $sql = "UPDATE users SET bio = ?";
    

        if (!empty($birthdate)) {
            $sql .= ", birthdate = ?";
        }

        $sql .= " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $params = [$bio];
        if (!empty($birthdate)) {
            $params[] = $birthdate;
        }
        $params[] = $userId;
        return $stmt->execute($params);
    }

    

}