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
            $insert = $this->db->prepare ("
                insert into 
                tender(id_penyelenggara, id_user, judul_tender, link_website, wilayah, upload, tgl_mulai, tgl_selesai, tgl_upload, approval)
                values(:id_penyelenggara, :id_user, :judul_tender, :link_website, :wilayah, :upload, :tgl_mulai, :tgl_selesai, :tgl_upload, :approval)
            ");
            $insert->bindParam(':id_penyelenggara', $data['id_penyelenggara']);
            $insert->bindParam(':id_user', $data['id_user']);
            $insert->bindParam(':judul_tender', $data['judul_tender']);
            $insert->bindParam(':link_website', $data['link_website']);
            $insert->bindParam(':wilayah', $data['wilayah']);
            $insert->bindParam(':upload', $data['upload']);
            $insert->bindParam(':tgl_mulai', $data['tgl_mulai']);
            $insert->bindParam(':tgl_selesai', $data['tgl_selesai']);
            $insert->bindParam(':tgl_upload', $data['tgl_upload']);
            $insert->bindParam(':approval', $data['approval']);
            $insert->execute();
            return $this->db->lastInsertId();
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
