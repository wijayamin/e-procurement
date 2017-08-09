<?php
    session_start ();
    date_default_timezone_set ('Asia/Jakarta');
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require 'vendor/autoload.php';

    $settings = require 'app/settings.php';
    $app = new \Slim\App($settings);
//    $app->add (new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);

    $app->add (new \Slim\Middleware\Session([
        'name' => 'dummy_session',
        'autorefresh' => true,
        'lifetime' => '12 hour'
    ]));

    $container = $app->getContainer ();
    require 'app/container.php';
    require 'app/main.php';

    $app->add (new \ryan\main($container));

    spl_autoload_register (function ($classname) {
        $parts = explode ('\\', $classname);
        $classes = "app/models/" . end ($parts);
        if (file_exists ($classes . '.php')) {
            require $classes . '.php';
        }
    });

    spl_autoload_register (function ($classname) {
        $parts = explode ('\\', $classname);
        $classes = "app/controllers/" . end ($parts);
        if (file_exists ($classes . '.php')) {
            require $classes . '.php';
        }
    });

    require 'app/route.php';

    $app->get ('/', function ($req, $res, $args) {
        return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('loginPage'));
    });

    $app->run ();
