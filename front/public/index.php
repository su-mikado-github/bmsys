<?php
$mimes = include($_SERVER['DOCUMENT_ROOT'] . '/mime.php');

$path = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];
$ext = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '.'));
$mime = (isset($mimes[$ext]) ? $mimes[$ext] : $mimes['*']);
header('Content-Type: ' . $mime);

if (!file_exists($path)) {
    http_response_code(404);
}
else {
    if (in_array($ext, [ '.html', '.js', '.css' ])) {
        require_once $path;
    }
    else {
        echo file_get_contents($path);
    }
}
