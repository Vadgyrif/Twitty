<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Twitt;

class MainController
{
    private $tweetModel;
    private $userModel;

    public function __construct($db)
    {
        $this->tweetModel = new Twitt($db);
        $this->userModel = new User($db);
    }

    public function showHome()
    {
        
        $tweets = $this->tweetModel->getAllTweets();
        require_once __DIR__ . '/../Views/home.php';
    }
}
