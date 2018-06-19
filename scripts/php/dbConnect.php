<?php

$host_name = 'db742173504.db.1and1.com';
$uname = 'dbo742173504';
$pass = 'C0mm0nP@rt5';
$db = 'db742173504';
$char = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$char";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$con = new PDO($dsn, $uname, $pass, $opt);


?>