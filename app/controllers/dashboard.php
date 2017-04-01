<?php
    /**
     * Created by PhpStorm.
     * User: wijaya
     * Date: 3/29/2017
     * Time: 02:11
     */

    namespace ryan\controllers;


    class dashboard extends \ryan\main{

        protected $container;

        public function __construct( $container ) {
            parent::__construct( $container );
            $this->container = $container;
        }

        public function dashboardPage($req, $res, $args){
            return $this->view->render("dashboard", $req->getAttributes());
        }

    }