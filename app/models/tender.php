<?php
    /**
     * Created by PhpStorm.
     * User: wijaya
     * Date: 3/24/2017
     * Time: 19:18
     */

    namespace ryan\models;

    class tender extends \ryan\main {

        protected $container;

        public function __construct ($container) {
            parent::__construct ($container);
            $this->container = $container;
        }

        public function addBeritaTender ($data) {
            return $this->pdo->insert(array_keys($data))->into('tender')->values(array_values($data))->execute(true);
        }

        public function setBeritaTender($data, $id_tender){
            return $this->pdo->update($data)->table('tender')->where('id_tender', '=', $id_tender)->execute();
        }

        public function updateBeritaTender($id_tender, $data){
            return $this->pdo->update($data)->table('tender')->where('id_tender', '=', $id_tender)->execute();
        }

        public function getBeritaTender($id_tender = null){
            if($id_tender == null){
                return $this->db->query("select * from tender where DELETED = 0")->fetchAll();
            }else{
                $select = $this->db->prepare("select * from tender where ID_TENDER=:id_tender");
                $select->bindParam(':id_tender', $id_tender);
                $select->execute();
                return $select->fetch();
            }
        }

        public function getBeritaTenderApproved(){
            $tenders = $this->db->query("select * from tender where DELETED = 0")->fetchAll();
            foreach ($tenders as $key => $tender){
                $approval = json_decode($tender['approval'], true);
                if($approval){
                    if($approval['direktur']['status'] != 'diterima' && $approval['direktur']['status'] != 'diterima'){
                        unset($tenders[$key]);
                    }
                }
            }
            return $tenders;
        }

        public function getBeritaTenderApprovedRKS(){
            $tenders = $this->db->query("select * from tender where DELETED = 0")->fetchAll();
            foreach ($tenders as $key => $tender){
                $approval = json_decode($tender['approval'], true);
                $rks = json_decode($tender['rks'], true);
                if($approval){
                    if($approval['direktur']['status'] != 'diterima' && $approval['direktur']['status'] != 'diterima'){
                        unset($tenders[$key]);
                    }else{
                        if($rks){
                            if($rks['approval']['direktur']['status'] != 'diterima' && $rks['approval']['direktur']['status'] != 'diterima'){
                                unset($tenders[$key]);
                            }
                        }
                    }
                }
            }
            return $tenders;
        }

        public function getDokumenPersyaratanTender($id_tender = null){
            if($id_tender == null){
                return $this->db->query("select UPLOAD from tender")->fetchAll();
            }else{
                $select = $this->db->prepare("select UPLOAD from tender where ID_TENDER=:id_tender");
                $select->bindParam(':id_tender');
                $select->execute();
                return $select->fetch();
            }
        }

        public function setApprovalBeritaTender($id_tender, $who, $status){
            $query = '';
            if($who == '2'){
                $query = "update tender set DIREKTUR_APPROVAL=:approval where ID_TENDER=:id_tender";
            }elseif ($who == '3'){
                $query = "update tender set MANAJER_APPROVAL=:approval where ID_TENDER=:id_tender";
            }
            $update = $this->db->prepare($query);
            $update->bindValue(':approval', json_encode([
                'status'=>$status,
                'waktu' =>date ("Y-m-d H:i:s")
            ]));
            $update->bindParam(':id_tender', $id_tender);
            return $update->execute();
        }

        public function setRKSBeritaTender($id_tender, $rks){
            $update = $this->db->prepare('update tender set RKS=:rks where ID_TENDER=:id_tender');
            $update->bindParam(':rks', $rks);
            $update->bindParam(':id_tender', $id_tender);
            return $update->execute();
        }

        public function setApprovalRKSBeritaTender($id_tender, $who, $status){
            $tender = $this->getBeritaTender($id_tender);
            $rks = json_decode($tender['rks'], true);
            if($who == '2'){
                $rks['approval']['direktur'] = [
                    'status' => $status,
                    'waktur' => date ("Y-m-d H:i:s")
                ];
            }elseif($who == '3'){
                $rks['approval']['manajer'] = [
                    'status' => $status,
                    'waktur' => date ("Y-m-d H:i:s")
                ];
            }
            $rks = json_encode($rks);
            $update = $this->db->prepare('update tender set rks=:rks where id_tender=:id_tender');
            $update->bindParam(':rks', $rks);
            $update->bindParam(':id_tender', $id_tender);
            return $update->execute();
        }

        public function setAcaraBeritaTender($id_tender, $acara){
            $update = $this->db->prepare('update tender set berita_acara=:acara where ID_TENDER=:id_tender');
            $update->bindParam(':acara', $acara);
            $update->bindParam(':id_tender', $id_tender);
            return $update->execute();
        }
    }
