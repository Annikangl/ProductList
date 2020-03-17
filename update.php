<?php

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$status = isset($_POST['status']) ? 1 : 0;

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
$sql = "UPDATE product SET title=?,description=?,status=? WHERE id=?";
$statement = $pdo->prepare($sql);
$statement->bindValue(1,$title);
$statement->bindValue(2,$description);
$statement->bindValue(3,$status);
$statement->bindValue(4,$id);
$statement->execute();

header("Location: /index.php");