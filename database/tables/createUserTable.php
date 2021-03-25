<?php

require __DIR__.'/../../vendor/autoload.php';
include __DIR__.'/../connectionInitial.php';
//$password = password_hash('admin', PASSWORD_DEFAULT);

\DB\Database\Connection::connect()->prepare('
 CREATE TABLE users (
   id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(30) NOT NULL,
   email VARCHAR(30) NOT NULL,
   passwod VARCHAR(255) NOT NULL
 )
')->execute();


