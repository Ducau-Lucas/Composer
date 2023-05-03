<?php

use GuzzleHttp\Client;

require_once __DIR__ . '/vendor/autoload.php';

$httpClient = new Client();
$url = "https://my.api.mockaroo.com/users_composer.json?key=cf1f4fc0";
$response = $httpClient->request('GET', $url, ['verify' => false]);

$users = json_decode($response->getBody());

dump($users);
