<?php

error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
require __DIR__ . '/../../../vendor/autoload.php';

define('LOCALSERVER', 'http://localhost:8000/backend/');
define('PRODSERVER', 'https://add-production-server-after-deployment/backend/');

if($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1'){
    define('BASE_URL', 'http://localhost:8000/backend/');
} else {
    define('BASE_URL', 'https://add-production-server-after-deployment/backend/');
}

$openapi = \OpenApi\Generator::scan([
    __DIR__ . '/doc_setup.php',
    __DIR__ . '/../../../rest/routes'
]);
header('Content-Type: application/json');
echo $openapi->toJson();
?>