<?php
use GuzzleHttp\Client;

require_once __DIR__ . '/vendor/autoload.php';
require_once "HandleUser.php";
/**
 * On récupère les données d'une API Mockaroo
 */
$httpClient = new Client();
$url = "https://my.api.mockaroo.com/users_composer.json?key=cf1f4fc0";
$response = $httpClient->request('GET', $url, ['verify' => false]);

$users = json_decode($response->getBody());

dump($users);

/**
 * On enregistre les données en BDD
 */
$handleUsers = new HandleUsers();
$handleUsers->saveUsersFromApi($users);