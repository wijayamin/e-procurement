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


class unitKerja extends \ryan\main{

    protected $container;

    public function __construct ($container) {
        parent::__construct ($container);
        $this->container = $container;
    }

    public function getUnitKerja($collumn = null, $id = null) {
        if($id == null){
            return $this->db->query("select * from unit_kerja")->fetchAll();
        }else{
            $select = $this->db->prepare("select * from unit_kerja WHERE ID_UNITKERJA=:id_unitkerja");
            $select->bindParam(':id_unitkerja', $id);
            $select->execute();
            return $select->fetch();
        }
    }

    public function getUnitKerjaTender($id_tender){
        $select = $this->db->query('select * from unit_kerja WHERE ID_TENDER=:id_tender');
        $select->bindParam(':id_tender', $id_tender);
        $select->execute();
        return $select->fetchAll();
    }

    public function countUnitKerjaTender($id_tender) {
        $select = $this->db->prepare("select count(ID_UNITKERJA) from unit_kerja where ID_TENDER=:id_tender");
        $select->bindParam(':id_tender', $id_tender);
        $select->execute();
        return $select->fetchColumn();
    }

    public function getUnitKerjaByTender($id_tender){
        $select = $this->db->prepare("select * from unit_kerja where ID_TENDER=:id_tender order by PENUGASAN");
        $select->bindParam(':id_tender', $id_tender);
        $select->execute();
        return $select->fetchAll();
    }

    public function isUnitKerjaExsist($id_tender, $id_user){
        $select = $this->db->prepare("select * from unit_kerja where ID_TENDER=:id_tender and ID_USER=:id_user");
        $select->bindParam(':id_tender', $id_tender);
        $select->bindParam(':id_user', $id_user);
        $select->execute();
        return $select->fetch();
    }

    public function setUnitKerja($data, $id_unitkerja = null){
        if($id_unitkerja == null){
            $insert = $this->db->prepare('
                insert into
                unit_kerja(ID_USER, ID_TENDER, PENUGASAN, METADATA)
                VALUE (:id_user, :id_tender, :penugasan, :metadata)
            ');
            $insert->bindParam(':id_user', $data['id_user']);
            $insert->bindParam(':id_tender', $data['id_tender']);
            $insert->bindParam(':penugasan', $data['penugasan']);
            $insert->bindParam(':metadata', $data['metadata']);
            $insert->execute();

            return $this->db->lastInsertId();
        }else{
            
        }
    }

}