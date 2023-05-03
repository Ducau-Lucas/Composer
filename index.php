<?php

require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$appEnv = $_ENV["APP_ENV"];
dump($_ENV);
// Créez un nouveau logger avec un nom personnalisé, par exemple 'app'
$logger = new Logger('app');

// Ajoutez un gestionnaire de fichiers (handler) pour enregistrer les messages dans un fichier journal
$logFile = __DIR__ . '/logs/app.log';
$logger->pushHandler(new StreamHandler($logFile, Level::Debug));

// Fonction personnalisée pour gérer les erreurs PHP
function monologErrorHandler($errno, $errstr, $errfile, $errline)
{
    global $logger;
    // dump($errno);
    // Convertir le niveau d'erreur PHP en niveau Monolog
    $levelMap = [
        E_ERROR => Level::Error,
        E_WARNING => Level::Warning,
        E_NOTICE => Level::Notice,
        E_USER_ERROR => Level::Error,
        E_USER_WARNING => Level::Warning,
        E_USER_NOTICE => Level::Notice,
        E_STRICT => Level::Notice,
        E_RECOVERABLE_ERROR => Level::Error,
        E_DEPRECATED => Level::Notice,
        E_USER_DEPRECATED => Level::Notice,
    ];

    $level = isset($levelMap[$errno]) ? $levelMap[$errno] : Level::Error;

    // Enregistrer le message d'erreur dans le journal avec Monolog
    $logger->log($level, $errstr, [
        'file' => $errfile,
        'line' => $errline,
    ]);
}
// Définir la fonction personnalisée comme gestionnaire d'erreurs PHP
if($appEnv === "prod"){
    set_error_handler('monologErrorHandler');
}

echo $ok;