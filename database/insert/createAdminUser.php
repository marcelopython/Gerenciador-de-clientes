<?php

include __DIR__.'/../../vendor/autoload.php';
include __DIR__.'/../connectionInitial.php';
$password = password_hash('admin', PASSWORD_DEFAULT);
$stmt = \DB\Database\Connection::connect()->prepare("
    INSERT INTO users (name, email, password) VALUES ('Administrador', 'admin@admin.com.br', :password)
");
if($stmt->execute([':password'=>$password])){
    echo PHP_EOL;
    echo "Usuário adicionado com sucesso";
    echo PHP_EOL;
}else{
    echo PHP_EOL;
    echo "Falha ao adicionar usuário";
    echo PHP_EOL;
}
