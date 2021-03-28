<!doctype html>
<html lang="pt-BR" style="height: 100%">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php
            if(isset($title)){
                echo $title;
            }
        ?>
    </title>
    <link rel="stylesheet" href="<?=  (new \Kabum\App\Router())->asset('/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?=  (new \Kabum\App\Router())->asset('/css/fontawesome.css') ?>">
    <script src="<?=  (new \Kabum\App\Router())->asset('/js/jquery.js') ?>"></script>
</head>
<body style="height: 100%">

