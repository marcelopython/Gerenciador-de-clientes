<?php

include __DIR__.'/../../vendor/autoload.php';
include __DIR__.'/../connectionInitial.php';

$stmt = \DB\Database\Connection::connect()->prepare('
 CREATE TABLE address (
   id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   people_id int UNSIGNED NOT NULL,
   FOREIGN KEY(people_id) REFERENCES peoples(id) ON UPDATE CASCADE,
   
   cep VARCHAR(9) NOT NULL,
   address VARCHAR(100) NOT NULL,
   number VARCHAR(10) NOT NULL,
   complement VARCHAR(60) NOT NULL,
   neighborhood VARCHAR(60) NOT NULL,
   city VARCHAR(60) NOT NULL,
   state VARCHAR(30) NOT NULL
 )
');

if($stmt->execute()){
    echo PHP_EOL;
    echo "Tabela endereço criada com sucesso";
    echo PHP_EOL;
}else{
    echo PHP_EOL;
    echo "Falha ao criar tabela endereço";
    echo PHP_EOL;
}
