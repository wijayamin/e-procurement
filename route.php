<?php

$app->group('/login', function(){
	$this->get('', \ryan\controllers\login::class.':loginPage')->setName('loginPage');
	$this->post('', \ryan\controllers\login::class.':doLogin')->setName('doLogin');
});

