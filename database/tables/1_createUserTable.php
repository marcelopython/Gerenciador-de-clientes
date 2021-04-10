<?php

include __DIR__.'/../../vendor/autoload.php';
include __DIR__.'/../connectionInitial.php';

$stmt = \DB\Database\Connection::connect()->prepare('
 CREATE TABLE users (
   id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(30) NOT NULL,
   email VARCHAR(30) NOT NULL UNIQUE,
   password VARCHAR(255) NOT NULL
 )
');

if($stmt->execute()){
    echo PHP_EOL;
    echo "Tabela usuário criada com sucesso";
    echo PHP_EOL;
}else{
    echo PHP_EOL;
    App\App\Pre::pre($stmt->errorInfo());
    echo PHP_EOL;
}
