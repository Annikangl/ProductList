<?php

$driver = 'mysql';
$host = 'localhost';
$db_name = 'products_db';
$db_user = 'root';
$db_password = '';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // массив с дополнительными настройками подключения. В данном примере мы установили отображение ошибок, связанных с базой данных, в виде исключений

// $dsn = "$driver:host=$host;dbname=$db_name;charset=$charset";
$dsn = "$driver:host=$host;dbname=$db_name;charset=$charset";
$pdo = new PDO($dsn,$db_user,$db_password,$options);

$sql = "SELECT * FROM product";
$statement = $pdo->query($sql);
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1>Список продуктов</h1>
                <a href="createProduct.php" class="btn btn-success">Добавить продукт</a>
                <a href="./categories/showCategories.php" class="btn btn-success">Мои категории</a>
                <table class="table">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Картинка</th>
                        <th>Действие</th>
                        </tr>
                    </thead>
                    <?php foreach ($products as $product): ?>
                    <tbody>
                        <td><?= $product["id"]?></td>
                        <td><a href="showProduct.php"><?= $product["title"]?></a></td>
                        <td><?= $product["description"]?></td>
                        <td>
                            <img width="100" src="<?= $product["image"]?>" alt="product-image">
                        </td>
                        <td>
                            <a href="editProduct.php?id=<?= $product['id']?>" class="btn btn-warning">Изменить</a>
                            <a href="delete.php?id=<?= $product['id']?>" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</a>
                        </td>
                    </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>