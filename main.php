<?php
/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 3/23/2017
 * Time: 16:39
 */

namespace ryan;


class main {
	protected $db;
	protected $view;
	protected $session;
	protected $router;
	protected $flash;

	function __construct($container) {
		$this->db = $container->get('db');
		$this->view = $container->get('view');
		$this->session = $container->get('session');
		$this->router = $container->get('router');
		$this->flash = $container->get('flash');
	}

	public function __invoke($req, $res, $next) {
		$uri = $req->getUri();
		$req = $req->withAttribute('uri', $uri);
		$req = $req->withAttribute('router', $this->router);
		$res = $next($req, $res);
		return $res;
	}

}
