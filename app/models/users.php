<?php
    /**
     * Created by PhpStorm.
     * User: wijaya
     * Date: 3/23/2017
     * Time: 17:54
     */

    namespace ryan\models;


    class users extends \ryan\main {

        protected $container;

        public function __construct ($container) {
            parent::__construct ($container);
            $this->container = $container;
        }

        public function checkAuth ($username, $password) {
            $login = $this->db->prepare ("select * from user where username=:username and password=:password");
            $login->bindParam (':username', $username);
            $login->bindParam (':password', $password);
            $login->execute ();

            return $login->fetch ();
        }

        public function getUserDetail($id_user){
            $select = $this->db->prepare("select id_user, nama, image, jabatan, previledge  from user where id_user=:id_user");
            $select->bindParam(':id_user', $id_user);
            $select->execute();
            return $select->fetch();;
        }

        public function getUserWithPreviledge($previledge) {
            $select = ['id_user', 'nama', 'image'];
            return $this->pdo->select($select)->from('user')->where('PREVILEDGE', '=', $previledge)->execute()->fetchAll();
        }

        public function getUser($id_user = null) {
            if($id_user == null){
                return $this->db->query('select * from user')->fetchAll();
            }else{
                $user = $this->db->prepare("select * from user where ID_USER=:ID_USER");
                $user->bindParam(':ID_USER', $id_user);
                $user->execute();
                return $user->fetch();
            }
        }

        public function getUserByToken($token) {
            return $this->pdo->select()->from('user')->where('token', '=', $token)->execute()->fetch();
        }

        public function getUserByUsername($username) {
            return $this->pdo->select()->from('user')->where('username', '=', $username)->execute()->fetch();
        }

        public function getDirektur(){
            $select = ['id_user', 'nama', 'image'];
            return $this->pdo->select($select)->from('user')->where('previledge', '=', 2)->execute()->fetch();
        }

        public function getManajer(){
            $select = ['id_user', 'nama', 'image'];
            return $this->pdo->select($select)->from('user')->where('previledge', '=', 3)->execute()->fetch();
        }

        public function setUser($data, $id_user = null){
            if($id_user == null){
                return $this->pdo->insert(array_keys($data))->into('user')->values(array_values($data))->execute(true);
            }else{
                return $this->pdo->update($data)->table('user')->where('id_user', '=', $id_user)->execute();
            }
        }
    }
