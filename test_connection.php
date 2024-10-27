<?php

try {
    $db = new PDO('mysql:host=sql201.infinityfree.com;dbname=if0_37566835_db', 'if0_37566835', 'DZKqNIBHXi');
    echo "Підключення успішне!";
} catch (PDOException $e) {
    echo "Помилка підключення: " . $e->getMessage();
}

