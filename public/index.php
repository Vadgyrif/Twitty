<?php

session_start();

require_once '../vendor/autoload.php'; 
require_once '../src/config/database.php'; 

use App\Controllers\AuthController;
use App\Controllers\MainController;
use App\Controllers\ProfileController;

require_once '../src/Views/frontpage.php';

$profileController = new ProfileController($db);
$authController = new AuthController($db);
$mainController = new MainController($db); // Змініть тут

// Маршрутизація
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestUri) {
    case '/':
        $mainController->showHome(); // Змініть тут
        break;
    case '/register':
        if ($requestMethod === 'POST') {
            $authController->register();
        } else {
            $authController->showRegisterForm();
        }
        break;

    case '/login':
        if ($requestMethod === 'POST') {
            $authController->login();
        } else {
            $authController->showLoginForm();
        }
        break;

    case '/logout':
        $authController->logout(); // Додайте маршрут для виходу
        break;
    case '/profile':
        if (isset($_SESSION['user_id'])) {
            $profileController->showProfile(); // Переконайтеся, що у вас є ProfileController
        } else {
            header('Location: /login'); // Якщо користувач не авторизований
            exit();
        }
            break;
    
    case '/twitt':
        if (isset($_SESSION['user_id']) && $requestMethod === 'POST') {
            $tweetModel = new \App\Models\Twitt($db);
            $tweetModel->addTwitt($_SESSION['user_id'], $_POST['twitt']);
            header('Location: /'); // Повернення на головну сторінку
            exit();
        }
            break;
    case '/twitt/delete':
        if($requestMethod === 'POST'){
            $profileController->deleteTwitt();
        }
        break;  
    case '/twitt/update':
        if ($requestMethod === 'POST') {
            $profileController->updateTwitt(); // Додайте метод для редагування твітів
        }
        break;

    default:
       // echo "404 Not Found";
       // break;
}
