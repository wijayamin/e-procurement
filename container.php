<?php

$container['db'] = function ($c) {
	$settings = $c->get('settings')['database'];
	$pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['database_name'], $settings['user'], $settings['pass']);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	return $pdo;
};

$container['view'] = function ($container) {
	$settings = $container->get('settings')['views'];
	$view = new Slim\Views\PhpRenderer($settings);
	return $view;
};

$container['session'] = function ($c) {
	return new \SlimSession\Helper;
};

$container['flash'] = function () {
	return new \Slim\Flash\Messages();
};