<?php
/**
 * Copyright (c) 2017.
 */

/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 27/04/2017
 * Time: 17.35
 */

namespace ryan\models;


class BOQ extends \ryan\main{

    protected $container;

    public function __construct ($container) {
        parent::__construct ($container);
        $this->container = $container;
    }

    public function countBOQTender($id_tender){
        $select  = $this->db->prepare('select count(ID_PENAWARAN) from penawaran where ID_TENDER=:id_tender');
        $select->bindParam(':id_tender', $id_tender);
        $select->execute();
        return $select->fetchColumn();
    }

    public function getBOQByTender($id_tender){
        $select = $this->db->prepare('select * from penawaran where ID_TENDER=:id_tender and INPUTAN_MANAJER is null');
        $select->bindParam(':id_tender', $id_tender);
        $select->execute();
        return $select->fetchAll();
    }

    public function getBOQManajer($id_penawaran){
        $select = $this->db->prepare('select * from penawaran where INPUTAN_MANAJER=:id_penawaran');
        $select->bindParam(':id_penawaran', $id_penawaran);
        $select->execute();
        return $select->fetch();
    }

    public function getBOQ($id_penawaran = null){
        if($id_penawaran == null){

        }else{
            $select = $this->db->prepare('select * from penawaran where id_penawaran=:id_penawaran');
            $select->bindParam(':id_penawaran', $id_penawaran);
            $select->execute();
            return $select->fetch();
        }
    }


    public function setBOQ($data, $id_penawaran = null){
        if($id_penawaran == null){
            $insert = $this->pdo->insert(array_keys($data))->into('penawaran')->values(array_values($data));
            return $insert->execute(true);
        }else{
            $update = $this->pdo->update($data)->table('penawaran')->where("id_penawaran", '=', $id_penawaran);
            return $update->execute();
        }
    }

    public function deleteBOQ($id_penawaran){
        return $this->pdo->delete()->from('penawaran')->where('id_penawaran', '=', $id_penawaran)->execute();
    }

    public function countBOQApproval($id_tender){
        $select = $this->db->prepare('select COUNT(ID_PENAWARAN) from penawaran where ID_TENDER=:id_tender and APPROVAL is not NULL');
        $select->bindParam(':id_tender', $id_tender);
        $select->execute();
        return $select->fetchColumn();
    }

}