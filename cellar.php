<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'logic.php');

header('X-cellar-Version: 0.1a-prealpha');
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
