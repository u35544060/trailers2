<?php

$host = 'localhost';
$uname = 'trailers';
$pass = 'omNS2EsqbWYGtexl';
$db = 'trailers';
$char = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$char";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$con = new PDO($dsn, $uname, $pass, $opt);


?>