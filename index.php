<?php
$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
//var_dump('Location: '.$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'public');
//echo '<pre>';
//var_dump($_SERVER);
header('Location: '.$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'public');
