<?php

$config = parse_ini_file('/var/opt/trailers/config.ini');
$host = $config['server'];
$uname = $config['username'];
$pass = $config['password'];
$db = $config['database'];
$char = $config['char'];


$dsn = "mysql:host=$host;dbname=$db;charset=$char";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$con = new PDO($dsn, $uname, $pass, $opt);


?>