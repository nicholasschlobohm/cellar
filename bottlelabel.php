<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'cellar.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    header('Content-Type: image/png');

    $im = imagecreatetruecolor(400, 400);

    $colours = [
        'white' => imagecolorallocate($im, 255, 255, 255),
        'red' => imagecolorallocate($im, 255, 0, 0),
        'orange' => imagecolorallocate($im, 255, 165, 0),
        'yellow' => imagecolorallocate($im, 255, 255, 0),
        'green' => imagecolorallocate($im, 0, 255, 0),
        'blue' => imagecolorallocate($im, 0, 0, 255),
        'purple' => imagecolorallocate($im, 128, 0, 128)
    ];

    imagefilledrectangle($im, 0, 0, 399, 399, $colours['white']);
    imagettftext($im, 70, 0, 85, 240, $colours[BottleLabel::getColour($id)], __DIR__ . DIRECTORY_SEPARATOR . 'Inter-Regular.ttf', BottleLabel::getNumber($id));
    imagepng($im);
    imagedestroy($im);
} else {
    die('ERROR: Bottle ID required.');
}