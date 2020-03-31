<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'logic.php');

const CELLAR_VERSION = '0.1a-prealpha';

header('X-cellar-Version: ' . CELLAR_VERSION);
$_CELLAR[] = array();
$_CELLAR['params'] = ! empty($_GET);

const DB_HOST = 'localhost:3306';

const DB_USER = 'root';

const DB_PASS = '';

const DB_NAME = 'cellar';

$_CELLAR['database'] = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
    printf('Connect failed: %s' . PHP_EOL, mysqli_correct_error());
    exit();
}
$config_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;
$_CELLAR['gmaps_embed_enabled'] = filter_var(@file_get_contents($config_dir . 'GoogleMapsEmbedEnabled'), FILTER_VALIDATE_BOOLEAN);
$_CELLAR['gmaps_embed_apikey'] = @file_get_contents($config_dir . 'GoogleMapsEmbedApiKey');
$_CELLAR['gmaps_embed_view'] = @file_get_contents($config_dir . 'GoogleMapsEmbedView');
unset($config_dir);
