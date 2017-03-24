<?php
/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 3/23/2017
 * Time: 20:30
 */

namespace ryan\controllers;


class admin extends \ryan\main{

    protected $container;
    protected $userModels;

    public function __construct( $container ) {
        parent::__construct( $container );
        $this->container = $container;
        $this->userModels = new \ryan\models\users($container);
    }

    public function dashboardPage($req, $res, $args){
        return $this->view->render("admin/dashboard", $req->getAttributes());
    }

    public function beritaTenderPage($req, $res, $args){
        return $this->view->render("admin/berita-tender", $req->getAttributes());
    }

    public function addPenyelenggara($req, $res, $args){

    }

}
