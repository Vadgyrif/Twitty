<?php

namespace App\Models;

class Twitt
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addTwitt( $userId, $twitt, $imagePath ){

        $stmt = $this->db->prepare("INSERT INTO twitts (user_id, twitt, `image`) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $twitt, $imagePath]);

    }

    public function getTwittById($twiitId){
        $stmt = $this->db->prepare("SELECT * FROM twitts WHERE id = ?");
        $stmt->execute([$twiitId]);
        return $stmt->fetch();      
    } 

    public function getTwittsByUserId($userId){
        $stmt = $this->db->prepare("SELECT * FROM twitts WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getAllTweets()
    {
        $stmt = $this->db->prepare("SELECT twitts.*, users.username FROM twitts JOIN users ON twitts.user_id = users.id ORDER BY twitts.created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function deleteTwitt($id){
        $stmt = $this->db->prepare("DELETE FROM twitts WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function editTwitt($twittId, $newContent){
        $stmt = $this->db->prepare("UPDATE twitts SET twitt = ?, updated_at = NOW() WHERE id = ? ");
        return $stmt->execute([$newContent, $twittId]);
    }

}