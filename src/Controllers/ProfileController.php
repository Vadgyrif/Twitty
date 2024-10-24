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
<<<<<<< HEAD
=======

        $users = $this->userModel->getAllUsers();

>>>>>>> 4986444 (twitty 1.5)
        $twitts = $this->twittModel->getTwittsByUserId($userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['twitt_id'])) {
            $twitts = $this->twittModel->getTwittsByUserId($userId);
        }

<<<<<<< HEAD
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
=======
        include __DIR__ . '/../Views/profile.php';
    }   

    public function showAllUsers(){
        $users = $this->userModel->getAllUsers();
    }


    public function showEditProfileForm(){
        include __DIR__ . '/../Views/profile_edit.php'; 
    }

   
  
    
    public function editProfile() {
        $user_id = $_SESSION['user_id'];
        $bio = $_POST['bio'];
        $birthdate = $_POST['birthdate'];
        $avatarPath = null; // Додаємо цю змінну для збереження шляху до аватара

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../uploads/avatars/'; // Зберігаємо аватар у цій директорії
            $fileName = basename($_FILES['avatar']['name']); // Отримуємо ім'я файлу
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $filePath)) {
                $avatarPath = '/src/uploads/avatars/' . $fileName; // Правильний шлях для збереження в базі даних
            } else {
                echo "Не вдалося завантажити аватар.";
                return; // Вихід з методу, якщо завантаження не вдалось
            }
        }

        if (empty($birthdate)) {
            $birthdate = null; 
        }

        $this->userModel->editProfile($user_id, $bio, $birthdate, $avatarPath); // Передаємо avatarPath
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

        include __DIR__ . '/../Views/user_profile.php';
        

    }

>>>>>>> 4986444 (twitty 1.5)
}
