<?php

$app->get('/', function ($req,  $res, $args) {
	return $res->write('lala');
});