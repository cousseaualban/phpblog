<?php
    $host = 'localhost';
    $user = 'root';
    $pwd = '';
    $dbName = "mBlog";

    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbName . ';charset-utf8', $user, $pwd, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
?>