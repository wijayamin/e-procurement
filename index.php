<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$settings = require 'settings.php';
$app = new \Slim\App($settings);
$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);

$app->add(new \Slim\Middleware\Session([
    'name' => 'dummy_session',
    'autorefresh' => true,
    'lifetime' => '12 hour'
]));

$container = $app->getContainer();
require 'container.php';

spl_autoload_register(function ($classname) {
    require ("models/" . $classname . ".php");
});

spl_autoload_register(function ($classname) {
    require ("controllers/" . $classname . ".php");
});

require 'route.php';

$app->run();
