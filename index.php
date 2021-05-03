<?php

require __DIR__.'/vendor/autoload.php';

use App\App\Environment;
use App\App\Router;
;
//Carrega variáveis de ambiente
Environment::load(__DIR__);
   
define('URL', getenv('URL'));
$router = new Router(URL);

//Inclue as rotas de paginas
include __DIR__.'/routes/routes.php';

$router->run()->sendResponse();
