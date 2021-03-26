<?php

require __DIR__.'/../vendor/autoload.php';
include __DIR__.'/../database/connectionInitial.php';

session_start();


$route = include __DIR__ . '/../routes/routes.php';

