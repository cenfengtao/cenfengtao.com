<?php
error_reporting(E_ERROR);
require_once __DIR__ . '/phpqrcode/phpqrcode.php';
$url = urldecode($_GET["data"]);
QRcode::png($url);
