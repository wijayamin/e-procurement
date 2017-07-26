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


use JsonSchema\Constraints\ObjectConstraint;

class BOQ extends \ryan\main{

    protected $container;

    public function __construct ($container) {
        parent::__construct ($container);
        $this->container = $container;
    }

    /**
     * @param $id_tender
     * @return int
     */
    public function countBOQTender($id_tender){
        $select = $this->pdo->select()->from('penawaran')->whereMany([
            'id_tender'=> $id_tender,
            'deleted'=> 0
        ], '=')->count('*', 'count')->execute()->fetch();
//        $select  = $this->db->prepare('select count(ID_PENAWARAN) from penawaran where ID_TENDER=:id_tender');
//        $select->bindParam(':id_tender', $id_tender);
//        $select->execute();
        return $select['count'];
    }

    /**
     * @param $id_tender
     * @return array
     */
    public function getBOQByTender($id_tender){
        return $this->pdo->select()->from('penawaran')->whereMany([
            'id_tender'=> $id_tender,
            'deleted'=> 0
        ], '=')->execute()->fetchAll();
//        $select = $this->db->prepare('select * from penawaran where ID_TENDER=:id_tender and INPUTAN_MANAJER is null');
//        $select->bindParam(':id_tender', $id_tender);
//        $select->execute();
//        return $select->fetchAll();
    }

    /**
     * @param $id_penawaran
     * @return array
     */
    public function getBOQManajer($id_penawaran){
        return $this->pdo->select()->from('penawaran')->whereMany([
            'inputan_manajer'=> $id_penawaran,
            'deleted'=> 0
        ], '=')->execute()->fetch();
//        $select = $this->db->prepare('select * from penawaran where INPUTAN_MANAJER=:id_penawaran');
//        $select->bindParam(':id_penawaran', $id_penawaran);
//        $select->execute();
//        return $select->fetch();
    }

    /**
     * @param null $id_penawaran
     * @return boolean|array
     */
    public function getBOQ($id_penawaran = null){
        if($id_penawaran == null){
            return false;
        }else{
            return $this->pdo->select()->from('penawaran')->whereMany([
                'id_penawaran'=> $id_penawaran,
                'deleted'=> 0
            ], '=')->execute()->fetchAll();
            $select = $this->db->prepare('select * from penawaran where id_penawaran=:id_penawaran');
            $select->bindParam(':id_penawaran', $id_penawaran);
            $select->execute();
            return $select->fetch();
        }
    }

    /**
     * @param      $data
     * @param null $id_penawaran
     * @return int|boolean
     */
    public function setBOQ($data, $id_penawaran = null){
        if($id_penawaran == null){
            $insert = $this->pdo->insert(array_keys($data))->into('penawaran')->values(array_values($data));
            return $insert->execute(true);
        }else{
            $update = $this->pdo->update($data)->table('penawaran')->where("id_penawaran", '=', $id_penawaran);
            return $update->execute();
        }
    }

    /**
     * @param $id_penawaran
     * @return boolean
     */
    public function deleteBOQ($id_penawaran){
        return $this->pdo->delete()->from('penawaran')->where('id_penawaran', '=', $id_penawaran)->execute();
    }

    /**
     * @param $id_tender
     * @return int
     */
    public function countBOQApproval($id_tender){
        $select = $this->db->prepare('select COUNT(ID_PENAWARAN) from penawaran where ID_TENDER=:id_tender and APPROVAL is not NULL');
        $select->bindParam(':id_tender', $id_tender);
        $select->execute();
        return $select->fetchColumn();
    }

}