<?php
    /**
     * Created by PhpStorm.
     * User: wijaya
     * Date: 3/27/2017
     * Time: 18:56
     */

    namespace ryan\models;


    class notifikasi extends \ryan\main{

        protected $container;

        public function __construct ($container) {
            parent::__construct ($container);
            $this->container = $container;
        }

        /**
         * @param $data [id_user, tentang, waktu]
         */
        public function addNotification($data){
            $users = $this->db->prepare('select * from user where id_user<>:id_user');
            $users->bindParam(':id_user', $data['id_user']);
            $users->execute();
            $status = false;
            foreach ($users->fetchAll() as $user){
                $insert = $this->db->prepare("
                  insert into 
                  notifikasi(by_user, for_user, tentang, waktu, meta) 
                  values(:by_user, :for_user, :tentang, :waktu, :meta)
                ");
                $insert->bindParam(':by_user', $data['id_user']);
                $insert->bindParam(':for_user', $user['id_user']);
                $insert->bindParam(':tentang', $data['tentang']);
                $insert->bindParam(':waktu', $data['waktu']);
                $insert->bindParam(':meta', $data['meta']);
                $status = $insert->execute();
            }
            return $status;
        }

        public function getNotificationForUser($id_user, $id_notifikasi = null){
            if($id_notifikasi == null){
                $select = $this->db->prepare('select * from notifikasi where for_user=:id_user ORDER BY id_notifikasi DESC');
                $select->bindParam(':id_user', $id_user);
                $select->execute();
                return $select->fetchAll();
            }else{
                $select = $this->db->prepare('select * from notifikasi where for_user=:id_user and id_notifikasi=:id_notifikasi');
                $select->bindParam(':id_user', $id_user);
                $select->bindParam(':id_notifikasi', $id_notifikasi);
                $select->execute();
                return $select->fetch();
            }
        }
    }