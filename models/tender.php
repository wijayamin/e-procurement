<?php
    /**
     * Created by PhpStorm.
     * User: wijaya
     * Date: 3/24/2017
     * Time: 19:18
     */

    namespace ryan\models;


    class tender extends \ryan\main {

        protected $container;

        public function __construct ($container) {
            parent::__construct ($container);
            $this->container = $container;
        }

        public function addBeritaTender ($data) {
            $this->db->prepare ("
              insert into tender()
            ");
        }

    }
