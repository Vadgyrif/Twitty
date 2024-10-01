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

    public function addNewTwitt()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $twitt = $_POST['twitt_input'];
            $userId = $_SESSION['user_id'];

            if (empty($twitt)) {
                echo "Твіт не може бути порожнім";
                return;
            }

            $this->twittModel->addTwitt($userId, $twitt);
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
}
