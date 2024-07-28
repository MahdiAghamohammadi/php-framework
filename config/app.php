<?php

const APP_NAME = "MVC Framework";
const APP_VERSION = "1.0.0";

define("BASE_URL", "https://{$_SERVER['HTTP_HOST']}:8000");
define("BASE_DIR", realpath(__DIR__ . "/../"));

$current_route = explode("?", $_SERVER["REQUEST_URI"])[0];
$current_route = substr($current_route, 1);
define('CURRENT_ROUTE', $current_route);