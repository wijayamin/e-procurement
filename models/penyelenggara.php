<?php
    /**
     * Created by PhpStorm.
     * User: wijaya
     * Date: 3/24/2017
     * Time: 20:10
     */

    namespace ryan\models;


    class penyelenggara extends \ryan\main {

        protected $container;

        public function __construct ($container) {
            parent::__construct ($container);
            $this->container = $container;
        }

        public function addPenyelenggara ($data) {
            $insert = $this->db->prepare ("insert into penyelenggara(nama_penyelanggara, alamat) values(:nama_penyelenggara, :alamat)");
            $insert->bindParam(":nama_penyelenggara", $data['nama_penyelenggara']);
            $insert->bindParam(":alamat", $data['alamat']);
            $insert->execute();
            return $insert->fetch();
        }
    }
