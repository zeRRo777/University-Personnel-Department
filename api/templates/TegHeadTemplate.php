<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <?php
    $type = match ($argv['worker']->type)
    {
        ROLE_WORKER=>"Сотрудник отдела кадров",
        ROLE_DEKAN=>"Декан",
        ROLE_TEACHER=>"Преподаватель",
        ROLE_HEADTEACHER=>"Заведующий кафедры"
    }
    ?>
    <title><?php echo $type;?></title>
</head>