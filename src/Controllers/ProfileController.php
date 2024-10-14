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
        $twitts = $this->twittModel->getTwittsByUserId($userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['twitt_id'])) {
            $twitts = $this->twittModel->getTwittsByUserId($userId);
        }

        include '../src/Views/profile.php';
    }   

    public function addNewTwitt(){

        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $imagePath = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $twitt = $_POST['twitt'];
            $userId = $_SESSION['user_id'];


            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = realpath(__DIR__ . '/../../uploads/twitts') . '/';
                $fileName = basename($_FILES['image']['name']);
                $filePath = $uploadDir . $fileName;
    

                if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
                    $imagePath = $filePath;
                }
            }

            if (empty($twitt)) {
                echo "Твіт не може бути порожнім";
                return;
            }

           // var_dump($imagePath);
           // exit();

            $this->twittModel->addTwitt($userId, $twitt, $imagePath);
            header('Location: /mypage');
        }
    }

    public function deleteTwitt(){
        if(isset($_POST['twitt_id'])){
            $twittId = $_POST['twitt_id'];

            $twitt = $this->twittModel->getTwittById($twittId);
            if($twitt['user_id'] === $_SESSION['user_id']){
                $this->twittModel->deleteTwitt($twittId);
                header("Location: /profile");
                exit();
            } else {
                echo 'Ви не можете видалити цей твіт';
            }
        } else {
            echo 'крч, ще якась помилка';
        }
    }

    public function updateTwitt(){
        if( isset($_POST['twitt_id']) && isset($_POST['twitt'])){
            $twittId = $_POST['twitt_id'];
            $newContent = $_POST['twitt'];

            error_log("Twitt ID: " . $twittId);
            error_log("New Content: " . $newContent);

            $twitt = $this->twittModel->getTwittById($twittId);
            if($twitt['user_id'] === $_SESSION['user_id']){
                $this->twittModel->editTwitt($twittId, $newContent);
                http_response_code(200);
                echo "Twitt updated";

            } else {
                http_response_code(403);
                echo "Ви не можете редагувати цей твіт";
            }
        } else {
            http_response_code(400);
            echo "Помилка редагування твіту";
        }
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

        $this->userModel->editProfile($user_id, $bio, $birthdate);
        header('Location: /profile');
        exit();
    }   
        

}
