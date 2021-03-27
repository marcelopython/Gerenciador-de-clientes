<?php

include __DIR__.'/../../vendor/autoload.php';
include __DIR__.'/../connectionInitial.php';

$stmt = \DB\Database\Connection::connect()->prepare('
 CREATE TABLE peoples (
   id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(60) NOT NULL,
   birth_date DATE NOT NULL,
   cpf VARCHAR(14) NOT NULL,
   rg VARCHAR(7) NOT NULL,
   phone VARCHAR(11) NOT NULL
 )
');

if($stmt->execute()){
    echo PHP_EOL;
    echo "Tabela pessoas criada com sucesso";
    echo PHP_EOL;
}else{
    echo PHP_EOL;
    echo "Falha ao criar tabela pessoas";
    echo PHP_EOL;
}
