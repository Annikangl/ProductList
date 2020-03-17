<!-- 
    1. Вытащить определенную запись по id из таблицы
    2. ПОдставить актуальные значения в форму
    3. Настроить форму
 -->

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
$pdo = new PDO($dsn,$user,$pass,$opt);
$sql = 'SELECT * FROM product WHERE id = ?';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $id);
$statement->execute();
$product = $statement->fetch();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Изменение продукта</h1>

                <form action="update.php" method="POST">
                    <input type="hidden" name="id" value="<?= $product['id']?>">
                    <div class="form-group">
                        <label for="">Название</label>
                        <input type="text" name="title" class="form-control" value="<?= $product['title']?>">
                    </div>
                    <div class="form-group">
                        <label for="">Описание</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control"><?= $product['description']?></textarea>
                    </div>

                    <!-- <div class="form-group">
                        <label for="category">Категория</label>
                        <select name="category" id="" class="form-control">
                            <option value="">Ноутбук</option>
                            <option value="">Телефон</option>
                            <option value="">Планшет</option>
                        </select>
                    </div> -->

                    <!-- <div class="form-group">
                        <label for="pictr">Картинка</label>
                        <input type="file" class="form-control" name="pictr">
                        <img src="" alt="">
                    </div> -->

                    <div class="form-group">
                        <label for="">Показать</label>
                        <input type="checkbox" name="status" <?= $product['status'] == 1 ? "checked" : ''?>>
                    </div>

                    <button class="btn btn-warning">Сохранить изменения</button>
                </form>

            </div>
        </div>
    </div>
</body>

</html>