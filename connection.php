<?php 
$host = "127.0.0.1";
$dbName = "studentbook";
$username = "root";
$password = "";
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charser=$charset",$username,$password,$options);
}
catch(PDOException $e){
    die('Не могу подключится к базе данных');
}

