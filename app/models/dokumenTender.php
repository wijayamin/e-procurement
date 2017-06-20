<?php
/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 12/04/2017
 * Time: 13.46
 */

namespace ryan\models;


class dokumenTender extends \ryan\main {

    protected $container;

    public function __construct($container) {
        parent::__construct($container);
        $this->container = $container;
    }

    public function getDokumenByTender($id_tender){
        return $this->pdo->select()->from('dokumen_tender')->where('id_tender', '=', $id_tender)->execute()->fetchAll();
    }

    public function getDokumenTender($id_dokumen){
        return $this->pdo->select()->from('dokumen_tender')->where('id_dokumen', '=', $id_dokumen)->execute()->fetch();
    }

    public function countDokumenTender($id_tender, $is_syarat=null){
        if($is_syarat == null){
            $total = $this->db->prepare("select count(id_dokumen) from dokumen_tender where ID_TENDER=:id_tender");
            $total->bindParam('id_tender', $id_tender);
            $total->execute();
            $done = $this->db->prepare("select count(id_dokumen) from dokumen_tender where ID_TENDER=:id_tender and FILE_DOKUMEN is not null");
            $done->bindParam('id_tender', $id_tender);
            $done->execute();
            return [
                "total"=>$total->fetchColumn(),
                "done"=>$done->fetchColumn()
            ];
        }else{
            $total = $this->db->prepare("select count(id_dokumen) from dokumen_tender where ID_TENDER=:id_tender and dokumen_syarat=:dokumen_syarat");
            $total->bindParam('id_tender', $id_tender);
            $total->bindParam('dokumen_syarat', $is_syarat);
            $total->execute();
            $done = $this->db->prepare("select count(id_dokumen) from dokumen_tender where ID_TENDER=:id_tender and dokumen_syarat=:dokumen_syarat and FILE_DOKUMEN is not null");
            $done->bindParam('id_tender', $id_tender);
            $done->bindParam('dokumen_syarat', $is_syarat);
            $done->execute();
            return [
                "total"=>$total->fetchColumn(),
                "done"=>$done->fetchColumn()
            ];
        }
    }

    public function getDokumenReq($id_tender, $dokName){
        return $this->pdo->select()->from('dokumen_tender')->where('id_tender', '=', $id_tender)->where('nama_dokumen', '=', $dokName)->execute()->fetch();
    }

    public function deleteDokumenReq($id_dokumen){
        return $this->pdo->delete()->from('dokumen_tender')->where('id_dokumen', '=', $id_dokumen)->execute();
    }

    public function setDokumenTender($data, $id_dokumen=null){
        if($id_dokumen == null){
            return $this->pdo->insert(array_keys($data))->into('dokumen_tender')->values(array_values($data))->execute(true);
        }else{
            return $this->pdo->update($data)->table('dokumen_tender')->where('id_dokumen', '=', $id_dokumen)->execute();
        }
    }

    public function countApprovalDokumen($id_tender){
        $select = $this->db->prepare("select * from dokumen_tender where ID_TENDER=:id_tender and approval is not NULL ");
        $select->bindParam(':id_tender', $id_tender);
        $select->execute();
        $total = $all = $partial = 0;
        foreach ($select->fetchAll() as $sel){
            $approval = json_decode($sel["approval"], true);
            $total++;
            if($approval['direktur']['status'] == 'diterima' && $approval['manajer']['status'] == 'diterima'){
                $all++;
            }elseif($approval['direktur']['status'] == 'diterima' || $approval['manajer']['status'] == 'diterima'){
                $partial++;
            }
        }
        return [
            'total'=>$total,
            'all'=>$all,
            'partial'=>$partial,
        ];
    }

    public function countDokumenReqDetail($id_tender){
        $total_q = $this->pdo->select()->from('dokumen_tender')->where('id_tender', '=', $id_tender)->where('dokumen_syarat', '=', '1')->execute()->fetchAll();
        $uploaded_q = $this->pdo->select()->from('dokumen_tender')->where('id_tender', '=', $id_tender)->where('dokumen_syarat', '=', '1')->whereNotNull('file_dokumen')->execute()->fetchAll();
        $approved = 0;
        foreach ($total_q as $dok){
            $approval = json_decode($dok['approval'], true);
            if($approval){
                if($approval['direktur']['status'] == 'diterima' && $approval['manajer']['status'] == 'diterima' ){
                    $approved++;
                }
            }
        }
        return [
            'total'=>sizeof($total_q),
            'uploaded'=>sizeof($uploaded_q),
            'approved'=>$approved
        ];
    }
}