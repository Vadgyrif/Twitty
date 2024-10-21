<?php


try {
    $db = new PDO('mysql:host=db; dbname=db',  'db', 'db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    $createUsersTable = "
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            avatar VARCHAR(255),
            bio VARCHAR(255),
            birthdate DATE
        )
    ";

    $createTwittsTable = "
    CREATE TABLE IF NOT EXISTS twitts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        twitt VARCHAR(300) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        image VARCHAR(255),
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    


    $db->exec($createUsersTable);
    $db->exec($createTwittsTable);

   // echo "Таблиця 'users' успішно створена (або вже існує).";

} catch (PDOException $e) {
    echo "Помилка підключення: " . $e->getMessage();
    exit;
}


