<?php

require __DIR__.'/../../vendor/autoload.php';
include __DIR__.'/../connectionInitial.php';
$password = password_hash('admin', PASSWORD_DEFAULT);
$stmt = \DB\Database\Connection::connect()->prepare("
    INSERT INTO users (name, email, password) VALUES ('Administrador', 'kabumAdmin@admin.com.br', ':password')
");
var_dump($stmt->execute([':password'=>$password]));
echo $stmt->rowCount();
