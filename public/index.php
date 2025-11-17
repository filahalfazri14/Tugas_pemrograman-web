<?php

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'mahasiswa/index';
$url = explode('/', $url);

$controller = ucfirst($url[0]);
$method = $url[1] ?? 'index';
$param = $url[2] ?? null;

require_once __DIR__ . "/../app/controllers/{$controller}.php";

$ctrl = new $controller;

if ($param) {
    $ctrl->$method($param);
} else {
    $ctrl->$method();
}
