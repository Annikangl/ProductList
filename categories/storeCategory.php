<?php
$host = 'localhost';
$db = 'products_db';
$user = 'root';
$pass = '';
$charset = 'utf8';
$dsn = ("mysql:host=$host; dbname=$db; charset=$charset");
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn,$user,$pass,$opt);

$title = $_POST['title'];



$sql = "INSERT INTO categories (title) VALUES (:title)";
$statement = $pdo->prepare($sql);
$statement->execute([
    'title' => $title,
]);


header("Location: /categories/showCategories.php");