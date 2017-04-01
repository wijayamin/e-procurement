<?php
    /**
     * Created by PhpStorm.
     * User: wijaya
     * Date: 3/27/2017
     * Time: 18:07
     */

    namespace ryan\models;


    class dokumenMaster extends \ryan\main{

        protected $container;

        public function __construct ($container) {
            parent::__construct ($container);
            $this->container = $container;
        }

        public function getDokumenMaster($id = null){
            if($id == null){
                return $this->db->query('select * from dokumen_master_administrasi')->fetchAll();
            }else{
                $select  = $this->db->prepare('select * from dokumen_master_administrasi where ID_DOKUMEN_MASTER=:id_dokumen');
                $select->bindParam(':id_dokumen', $id);
                $select->execute();
                return $select->fetch();
            }
        }

    }