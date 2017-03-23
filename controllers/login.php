<?php
/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 3/23/2017
 * Time: 16:34
 */

namespace ryan\controllers;


class login extends \ryan\main{

	protected $container;
	protected $userModels;

	public function __construct( $container ) {
		parent::__construct( $container );
		$this->container = $container;
		$this->userModels = new \ryan\models\users($container);
	}

	public function loginPage($req, $res, $args){
		$req = $req->withAttribute('lala', 'lolo');
		$req = $req->withAttribute('authError', $this->flash->getMessage('AuthError'));
		return $this->view->render($res, "login.phtml", $req->getAttributes());
	}

	public function doLogin($req, $res, $args){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$login = $this->userModels->checkAuth($username, md5($password));
		if($login){
			return $res->withJson($login);
		}else{
			$this->flash->addMessage('AuthError', true);
			return $res->withStatus(302)->withHeader('Location', $this->router->pathFor('loginPage'));
		}
	}
}
