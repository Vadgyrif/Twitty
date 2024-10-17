<?php

namespace App\Controllers;

use App\Models\Twitt;
use App\Models\User;

class ProfileController
{
    private $twittModel;
    private $userModel;

    public function __construct($db)
    {
        $this->twittModel = new Twitt($db);
        $this->userModel = new User($db);
    }

    public function showProfile()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getUserByID($userId);

        $users = $this->userModel->getAllUsers();

        $twitts = $this->twittModel->getTwittsByUserId($userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['twitt_id'])) {
            $twitts = $this->twittModel->getTwittsByUserId($userId);
        }

        include '../src/Views/profile.php';
    }   

    public function showAllUsers(){
        $users = $this->userModel->getAllUsers();
    }


    public function showEditProfileForm(){
        require_once '../src/Views/profile_edit.php';
    }

    public function editProfile(){

        $user_id = $_SESSION['user_id'];
        $bio = $_POST['bio'];
        $birthdate = $_POST['birthdate'];

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir =  '../uploads/avatars';
            $fileName = basename($_FILES['image']['name']);
            $filePath = $uploadDir . $fileName;        

            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $filePath)) {
                $avatarPath = $filePath;
            } 
        }

        if (empty($birthdate)) {
            $birthdate = null; 
        }

        $this->userModel->editProfile($user_id, $bio, $birthdate);
        header('Location: /profile');
        exit();
    }   
        

    public function showUserProfile($userId){

        $user = $this->userModel->getUserByID($userId);

        if(!$user){
            echo "Користувача не знайдено";
            return;
        }

        $twitts = $this->twittModel->getTwittsByUserId($userId);

        include "../src/Views/user_profile.php";

    }

}
