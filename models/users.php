<?php
/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 3/23/2017
 * Time: 17:54
 */

namespace ryan\models;


class users extends \ryan\main{

	protected $container;

	public function __construct( $container ) {
		parent::__construct( $container );
		$this->container = $container;
	}

	public function checkAuth($username, $password){
		$login = $this->db->prepare("select * from user where username=:username and password=:password");
		$login->bindParam(':username', $username);
		$login->bindParam(':password', $password);
		$login->execute();
		return $login->fetch();
	}
}