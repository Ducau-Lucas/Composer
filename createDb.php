<?php
require_once __DIR__ . '/vendor/autoload.php';

echo "Create DB";

$pdo = new PDO("mysql:host=localhost;port=3306;charset=utf8", "admin", "admin");

dump($pdo);