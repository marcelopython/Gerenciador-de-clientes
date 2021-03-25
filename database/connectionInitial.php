<?php


use \DB\Database\Connection;

$dataConnection = include __DIR__ . '/../config/database.php';
define('HOST', $dataConnection['host']);
define('DBNAME', $dataConnection['database']);
define('CHARSET', $dataConnection['charset']);
define('USER', $dataConnection['user']);
define('PASSWORD', $dataConnection['password']);
define('PORT', $dataConnection['port']);

Connection::connect();