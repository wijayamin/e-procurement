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
            $insert = $this->db->prepare ("insert into penyelenggara(nama_penyelenggara, alamat) values(:nama_penyelenggara, :alamat)");
            $insert->bindParam(":nama_penyelenggara", $data['nama']);
            $insert->bindParam(":alamat", $data['alamat']);
            $insert->execute();
            return $this->db->lastInsertId();
        }

        public function getPenyelenggara($id = null){
            if($id == null){
                return $this->db->query("select * from penyelenggara")->fetchAll();
            }else{
                $select  = $this->db->prepare("select * from penyelenggara where id_penyelenggara=:id_penyelenggara");
                $select->bindParam(':id_penyelenggara', $id);
                $select->execute();
                return $select->fetch();
            }
        }
    }
