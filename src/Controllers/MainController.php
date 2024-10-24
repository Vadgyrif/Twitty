<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Twitt;

class MainController
{
    private $tweetModel;
<<<<<<< HEAD
=======
    private $userModel;
>>>>>>> 4986444 (twitty 1.5)

    public function __construct($db)
    {
        $this->tweetModel = new Twitt($db);
<<<<<<< HEAD
=======
        $this->userModel = new User($db);
>>>>>>> 4986444 (twitty 1.5)
    }

    public function showHome()
    {
<<<<<<< HEAD
        $tweets = $this->tweetModel->getAllTweets();
        require_once '../src/Views/home.php';
=======
        
        $tweets = $this->tweetModel->getAllTweets();
        require_once __DIR__ . '/../Views/home.php';
>>>>>>> 4986444 (twitty 1.5)
    }
}
