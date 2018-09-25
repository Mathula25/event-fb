<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

isset($_SESSION)?:session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__.'/'.$class . '.php';
});

date_default_timezone_set('GMT');

$abspath = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'];

define('URL',$abspath);
define('ABSPATH',$abspath.'/admin');
define('UPLOAD',ABSPATH.'/uploads');
define('IMAGES',ABSPATH.'/images');
