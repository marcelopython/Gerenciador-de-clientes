<?php
namespace DB\Database;

use \DB\Database\ContractDatabase\ConnectionInterface;

class Connection implements ConnectionInterface{

    private static $pdo;

    public static function connect(): \PDO
    {
        if(!isset(self::$pdo)){
            try {
                self::$pdo = new \PDO(
                    'mysql:host='.HOST.';port='.PORT.';dbname='.DBNAME.';charset='.CHARSET.';',USER,PASSWORD
                );
            }catch(\PDOException $e){
                echo 'Falha na conexão';
            }
        }
        return self::$pdo;
    }

}