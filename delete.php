<?php
$id = $_GET['id'];

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
$pdo = new PDO($dsn,$user,$passwd,$opt);

$sql = "SELECT * FROM product WHERE id=?";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

if(is_file('uploads/'.$product['image'])) {
    unlink('uploads/'.$product['image']);
}

$sql = "DELETE FROM product WHERE id = ?";
$statement = $pdo->prepare($sql);
$statement->bindValue(1,$id);
$statement->execute();

header("Location: ./index.php");