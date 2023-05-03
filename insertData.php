<?php
require_once __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;
echo "Insert Data";

$httpClient = new Client();
$url = "https://my.api.mockaroo.com/users_composer.json?key=cf1f4fc0";
$response = $httpClient->request('GET', $url, ['verify' => false]);

$users = json_decode($response->getBody());

dump($users);
$pdo = new PDO("mysql:host=localhost;dbname=composer_users;port=3306;charset=utf8", "admin", "admin");

$sql = "INSERT INTO users (`first_name`, `last_name`, `email`, `gender`, `ip_address`) 
VALUES (:first_name,:last_name,:email,:gender,:ip_address)";
$stmt = $pdo->prepare($sql);
$pdo->beginTransaction();
foreach ($users as $user) {
    $stmt->execute([
        ":first_name" => $user->first_name,
        ":last_name" => $user->last_name,
        ":email" => $user->email,
        ":gender" => $user->gender,
        ":ip_address" => $user->ip_address
    ]);
}
$pdo->commit();