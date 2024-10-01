<?php


try {
    $db = new PDO('mysql:host=db; dbname=db',  'db', 'db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    echo "Помилка підключення: " . $e->getMessage();
    exit;
}

