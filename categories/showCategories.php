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

$sql = "SELECT * FROM categories";
$statement = $pdo->query($sql);
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product categories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1>Мои категории</h1>
                <a href="createCategory.php" class="btn btn-success">Добавить категории</a>

                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>категория</th>
                        <th>Действие</th>
                    </thead>
                    <?php foreach ($categories as $category) :?>
                    <tbody>
                        <td><?= $category['id']?></td>
                        <td><?= $category['title'] ?></td>
                        <td>
                            <a href="editCategory.php?id=<?= $category['id']?>" class="btn btn-warning">Изменить</a>
                            <a href="deleteCategory.php?id=<?= $category['id']?>" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</a>
                        </td>
                    </tbody>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>