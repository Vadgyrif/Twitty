<?php
/*

namespace App\Services;


use App\Models\Twitt;

class TwittServices
{
    private $twittModel;

    public function __construct(Twitt $twittModel)
    {
        $this->twittModel = $twittModel;
    }


    public function addNewTwitt($userId, $twitt) {

        if(empty($twitt)){
            throw new \Exception("Твіт не може бути порожнім");
        }
        return $this->twittModel->addTwitt($userId, $twitt);

    }


    public function getTwittsByUserId($userId){
        return $this->twittModel->getTwittsByUserId($userId);
    }

    public function getAllTwitts(){
        return $this->twittModel->getAllTwitts();
    }

    
    






}*/