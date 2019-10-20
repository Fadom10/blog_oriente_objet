<?php

//database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'prof_blog');
define('DB_PORT', '5432');
define('DB_USER', 'root');
define('DB_PASS', '');


$db = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once 'functions.php';
