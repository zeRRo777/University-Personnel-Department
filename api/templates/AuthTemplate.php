<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Отдел кадров института" />
    <title>Авторизация</title>
    <link rel="stylesheet" href="../../css/Auth.css">
</head>
<body>
<div class="login-page">
    <form action="" method="post" class="login-form">
        <label>
            <input name="login" type="text" placeholder="login"/>
        </label>
        <label>
            <input name="password" type="password" placeholder="password"/>
        </label>
        <button>login</button>
        <?php
            if (!$argv["LoginTrue"])
            {
                echo "<p>Неправильный логин или пароль!</p>";
            }
        ?>
    </form>
</div>
</body>
</html>

