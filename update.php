<?php

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$category = $_POST['category_id'];
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
$sql = "UPDATE product SET title=?,description=?,category_id=?,status=? WHERE id=?";
$statement = $pdo->prepare($sql);
$statement->bindValue(1,$title);
$statement->bindValue(2,$description);
$statement->bindValue(3,$category);
$statement->bindValue(4,$status);
$statement->bindValue(5,$id);
$statement->execute();

if (is_uploaded_file($_FILES['pictr']['tmp_name'])){
    $image = $_FILES['pictr']['name'];
    

    $sql = "SELECT * FROM product WHERE id=?";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $id);
    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);

    if(is_file('uploads/'.$product['image'])) {
        unlink('uploads/'.$product['image']);
    }

    move_uploaded_file($_FILES['pictr']['tmp_name'],'uploads/'.$image);

    $sql = "UPDATE product SET image=? WHERE id=?";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(1,'uploads/'.$image);
    $statement->bindValue(2,$id);
    $statement->execute();
}

header("Location: /index.php");