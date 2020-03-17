<?php
var_dump($_POST['category']); die;
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
$description = $_POST['description'];
$category = $_POST['category'];
$status = isset($_POST['status']) ? 1 : 0;
$image = $_FILES['pictr'];
$name = $_FILES['pictr']['name'];
$templocation = $_FILES['pictr']['tmp_name'];
move_uploaded_file("$templocation", "uploads/".$name);


$sql = "INSERT INTO product (title,description,image,status,category_id) VALUES (:title, :description, :image, :status, :category_id)";
$statement = $pdo->prepare($sql);
$statement->execute([
    'title' => $title,
    'description' => $description,
    'image' => 'uploads/'.$name,
    'status' => $status,
    "category_id" => $category,
]);


header("location: /index.php");