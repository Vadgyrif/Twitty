<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Twitt;

class MainController
{
    private $tweetModel;

    public function __construct($db)
    {
        $this->tweetModel = new Twitt($db);
    }

    public function showHome()
    {
        $tweets = $this->tweetModel->getAllTweets();
        require_once '../src/Views/home.php';
    }
}
