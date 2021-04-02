<?php
$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
header('Location: '.$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'public');
