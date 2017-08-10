<?php
/**
 * Copyright (c) 2017.
 */

/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 12/04/2017
 * Time: 15.01
 */

namespace ryan\models;


class unitKerja extends \ryan\main {

    protected $container;

    public function __construct($container) {
        parent::__construct($container);
        $this->container = $container;
    }

    public function getUnitKerja($id_unitkerja = null) {
        if ($id_unitkerja == null) {
            return $this->pdo->select()->from('unit_kerja')->whereMany([
                'deleted'=> 0
            ], '=')->execute()->fetchAll();
//            return $this->db->query("select * from unit_kerja")->fetchAll();
        } else {
            return $this->pdo->select()->from('unit_kerja')->whereMany([
                'id_unitkerja'=> $id_unitkerja
            ], '=')->execute()->fetch();
//            $select = $this->db->prepare("select * from unit_kerja WHERE ID_UNITKERJA=:id_unitkerja");
//            $select->bindParam(':id_unitkerja', $id);
//            $select->execute();
//
//            return $select->fetch();
        }
    }

    public function getUnitKerjaByUser($id_user, $id_tender = null) {
        if ($id_tender == null) {
            return $this->pdo->select()->from('unit_kerja')->whereMany([
                'id_user'=> $id_user,
                'deleted'=> 0
            ], '=')->execute()->fetchAll();
//            return $this->pdo->select()->from('unit_kerja')->where('id_user', '=', $id_user)->execute()->fetchAll();
        } else {
            return $this->pdo->select()->from('unit_kerja')->whereMany([
                'id_user'=> $id_user,
                'id_tender'=> $id_tender,
                'deleted'=> 0
            ], '=')->execute()->fetchAll();
//            return $this->pdo->select()->from('unit_kerja')->where('id_user', '=', $id_user)->where('id_tender', '=', $id_tender)->execute()->fetch();
        }
    }

    public function getUnitKerjaTender($id_tender) {
        return $this->pdo->select()->from('unit_kerja')->whereMany([
            'id_tender'=> $id_tender,
            'deleted'=> 0
        ], '=')->execute()->fetchAll();
//        $select = $this->db->query('select * from unit_kerja WHERE ID_TENDER=:id_tender');
//        $select->bindParam(':id_tender', $id_tender);
//        $select->execute();
//
//        return $select->fetchAll();
    }

    public function countUnitKerjaTender($id_tender) {
        $select = $this->pdo->select()->from('unit_kerja')->whereMany([
            'id_tender'=> $id_tender,
            'deleted'=> 0
        ], '=')->count('*', 'count')->execute()->fetch();
        return $select['count'];
//        $select = $this->db->prepare("select count(ID_UNITKERJA) from unit_kerja where ID_TENDER=:id_tender and deleted = 0");
//        $select->bindParam(':id_tender', $id_tender);
//        $select->execute();
//
//        return $select->fetchColumn();
    }

    public function getUnitKerjaByTender($id_tender) {
        return $this->pdo->select()->from('unit_kerja')->whereMany([
            'id_tender'=> $id_tender,
            'deleted'=> 0
        ], '=')->orderBy('penugasan')->execute()->fetchAll();
//        $select = $this->db->prepare("select * from unit_kerja where ID_TENDER=:id_tender order by PENUGASAN");
//        $select->bindParam(':id_tender', $id_tender);
//        $select->execute();
//
//        return $select->fetchAll();
    }

    public function getUnitForPenawaran($id_tender, $id_user) {
        return $this->pdo->select()->from('unit_kerja')->whereMany([
            'id_tender'=> $id_tender,
            'id_user'=> $id_user,
            'penugasan'=>'Penawaran',
            'deleted'=> 0
        ], '=')->execute()->fetchAll();
//        $select = $this->db->prepare("select * from unit_kerja where ID_TENDER=:id_tender order by PENUGASAN");
//        $select->bindParam(':id_tender', $id_tender);
//        $select->execute();
//
//        return $select->fetchAll();
    }

    public function isUnitKerjaExsist($id_tender, $id_user) {
        return $this->pdo->select()->from('unit_kerja')->whereMany([
            'id_tender'=> $id_tender,
            'id_user'=> $id_user,
            'deleted'=> 0
        ], '=')->execute()->fetch();
//        $select = $this->db->prepare("select * from unit_kerja where ID_TENDER=:id_tender and ID_USER=:id_user");
//        $select->bindParam(':id_tender', $id_tender);
//        $select->bindParam(':id_user', $id_user);
//        $select->execute();
//
//        return $select->fetch();
    }

    /**
     * @param array $data
     * @param null  $id_unitkerja
     * @return int|boolean
     */
    public function setUnitKerja($data, $id_unitkerja = null) {
        if ($id_unitkerja == null) {
            return $this->pdo->insert(array_keys($data))->into('unit_kerja')->values(array_values($data))->execute(true);
        } else {
            return $this->pdo->update($data)->table('unit_kerja')->where('id_unitkerja', '=', $id_unitkerja)->execute();
        }
    }

    public function deleteUnitKerja($id_unitkerja) {
        return $this->pdo->update(['deleted'=>1])->table('unit_kerja')->where('id_unitkerja', '=', $id_unitkerja)->execute();
//        return $this->pdo->delete()->from('unit_kerja')->where('id_unitkerja', '=', $id_unitkerja)->execute();
    }

}