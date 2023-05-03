<?php
require_once __DIR__ . '/vendor/autoload.php';

echo "Create Table";

$pdo = new PDO("mysql:host=localhost;dbname=composer_users;port=3306;charset=utf8", "admin", "admin");

dump($pdo);

$sql = "CREATE TABLE users (
    id int(11) NOT NULL AUTO_INCREMENT,
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    gender varchar(255) NOT NULL,
    ip_address varchar(255) NOT NULL,
    PRIMARY KEY (id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$stmt = $pdo->prepare($sql);
$stmt->execute();