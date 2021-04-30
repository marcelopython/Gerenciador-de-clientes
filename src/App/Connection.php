<?php

namespace App\App;


class Connection
{

    private static $pdo;

    public static function connect(): \PDO
    {
        if(!isset(self::$pdo)){
            try {
                self::$pdo = new \PDO(
                    'mysql:host='.getenv('DB_HOST').';port='.getenv('DB_PORT').
                    ';dbname='. getenv('DB_DATABASE').';charset='.getenv('DB_CHARSET').';',
                    getenv('DB_USER'),getenv('DB_PASSWORD')
                );
            }catch(\PDOException $e){
                echo 'Falha na conexão';
            }
        }
        return self::$pdo;
    }

}