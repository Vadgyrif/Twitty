<?php

session_start();

require_once '../vendor/autoload.php'; 
require_once '../src/config/database.php'; 

use App\Controllers\AuthController;
use App\Controllers\MainController;
use App\Controllers\ProfileController;
use App\Controllers\TwittsController;

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitty</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>



<?php

require_once '../src/Views/frontpage.php';

$profileController = new ProfileController($db);
$twittsController = new TwittsController($db); 
$authController = new AuthController($db);
$mainController = new MainController($db); 




// Маршрутизація
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestUri) {
    case '/':
        $mainController->showHome(); 
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
    case '/profedit':
        if ($requestMethod === 'POST') {
            $profileController->editProfile();
        } else {
            $profileController->showEditProfileForm();
        }
        break;    
    case '/profile':
        if (isset($_SESSION['user_id'])) {
            $profileController->showProfile(); 
        } else {
            header('Location: /login'); // Якщо користувач не авторизований
            exit();
        }
            break;

    case (preg_match('/\/user\/(\d+)/', $requestUri, $matches) ? true : false):
        $userId = $matches[1]; 
        $profileController->showUserProfile($userId); 
        break;
            
    
    case '/twitt':
        if (isset($_SESSION['user_id']) && $requestMethod === 'POST') {
            $twittsController->addNewTwitt();
            header('Location: /profile'); // Повернення на головну сторінку
            exit();
        }
            break;
    case '/twitt/delete':
        if($requestMethod === 'POST'){
            $twittsController->deleteTwitt();
        }
        break;  
    case '/twitt/update':
        if ($requestMethod === 'POST') {
            $twittsController->updateTwitt(); // Додайте метод для редагування твітів
        }
        break;
    

    default:
       // echo "404 Not Found";
       // break;
}

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./js/script.js" ></script>
<script src="./js/jqueryScript.js">  </script>


</body>