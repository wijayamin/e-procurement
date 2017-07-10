<?php
/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 3/27/2017
 * Time: 18:56
 */

namespace ryan\models;


class history extends \ryan\main{

    protected $container;
    protected $userModels;

    public function __construct ($container) {
        parent::__construct ($container);
        $this->container = $container;
        $this->userModels = new \ryan\models\users($container);
    }

    /**
     * @param $data [id_user, tentang, waktu]
     */
    public function add_history($data){
        return $this->pdo->insert(array_keys($data))->into('history')->values(array_values($data))->execute(true);
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

    public function sendNotificationByPreviledge($array_previledge, $data){
        foreach ($array_previledge as $previledge){
            foreach ($this->userModels->getUserWithPreviledge($previledge) as $user){
                $data['for_user'] = $user['id_user'];
                $insert = $this->pdo->insert(array_keys($data))->into('notifikasi')->values(array_values($data))->execute(true);
            }
        }
    }

    public function sendNotification($data){
        $insert = $this->pdo->insert(array_keys($data))->into('notifikasi')->values(array_values($data))->execute(true);
    }
}