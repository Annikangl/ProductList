<!--
1. Создать обработчик формы
2. Сформировать запрос
3. Подключиться к базе
4. Выполнить запрос
5. Подставить данные в запрос
6. Переадресовать пользователя на главную -->
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
    <title>Create</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Добавление продукта</h1>
                <form action="store.php" class="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Название</label>
                        <input type="text" class="form-control" name="title">
                    </div>

                    <div class="form-group">
                        <label for="">Описание</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="category">Категория</label>
                        <select name="category" id="" class="form-control">
                            <option value="" selected>Без категории</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?=$category['id']?>"><?=$category['title']?></option>
                        <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pictr">Картинка</label>
                        <input type="file" class="form-control" name="pictr">
                    </div>

                    <div class="form-group">
                        <label for="">Показать</label>
                        <input type="checkbox" class="" name="status">
                    </div>

                    <button class="btn btn-success" type="submit">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>