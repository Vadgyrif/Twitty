<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new User($db);

    }

    public function showRegisterForm(){
<<<<<<< HEAD
        require_once '../src/Views/register.php';
=======
        require_once __DIR__ . '/../Views/register.php';
>>>>>>> 4986444 (twitty 1.5)
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->userModel->register($username, $email, $password)) {
                $user = $this->userModel->login($email, $password);
                $_SESSION['user_id'] = $user['id']; 
                header('Location: /profile');
                exit();
            } else {
                echo "Помилка під час реєстрації";
            }
        }
    }

    public function showLoginForm(){
<<<<<<< HEAD
        require_once '../src/Views/login.php';
=======
        require_once __DIR__ . '/../Views/login.php';
>>>>>>> 4986444 (twitty 1.5)
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id']; 
                header('Location: /profile');
                exit();
            } else {
                echo "Неправильний логін або пароль";
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
    }
}
