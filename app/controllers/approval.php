<?php
    /**
     * Created by PhpStorm.
     * User: wijaya
     * Date: 3/31/2017
     * Time: 01:46
     */

    namespace ryan\controllers;


    use \Slim\Container as Container;
    use \Slim\Http\Request as Req;
    use \Slim\Http\Response as Res;

    class approval extends \ryan\main{

        protected $container;
        protected $penyelenggaraModels;
        protected $tenderModels;
        protected $userModels;
        protected $notifikasiModels;
        protected $BOQModels;

        public function __construct (Container $container) {
            parent::__construct ($container);
            $this->container = $container;
            $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
            $this->tenderModels = new \ryan\models\tender($container);
            $this->userModels = new \ryan\models\users($container);
            $this->notifikasiModels = new \ryan\models\notifikasi($container);
            $this->BOQModels = new \ryan\models\BOQ($container);
        }

        public function beritaTender(Req $req, Res $res, $args){
            if($req->isGet()){
                $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
                    $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                    return $penyelenggara['nama_penyelenggara'];
                });
                $beritaTender = $this->tenderModels->getBeritaTender();
                $req = $req->withAttribute('beritaTender', $beritaTender);
                return $this->view->render ("approval/berita-tender/daftar-berita", $req->getAttributes ());
            }
        }

        public function approvalBeritaTender(Req $req, Res $res, $args){
            if(!isset($args['status'])){
                $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
                    $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                    return $penyelenggara['nama_penyelenggara'];
                });
                $this->view->registerFunction('getUserUpload', function($id_user){
                    $user = $this->userModels->getUserDetail($id_user);
                    return $user;
                });
                $beritaTender = $this->tenderModels->getBeritaTender($args['id_tender']);
                $req = $req->withAttribute('tender', $beritaTender);
                return $this->view->render ("approval/berita-tender/detail-berita", $req->getAttributes ());
            }elseif(isset($args['status'])){
                if($this->tenderModels->setApprovalBeritaTender($args['id_tender'], $this->session->previledge, $args['status'])){
                    if($args['status'] == 'diterima'){
                        $this->notifikasiModels->addNotification ([
                            "id_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                            "tentang" => 'Telah Melakukan Approve Berita Tender "' . $this->tenderModels->getBeritaTender($args['id_tender'])[ 'judul_tender' ] . '"',
                            "waktu" => date ("Y-m-d H:i:s"),
                            "meta" => $this->router->pathFor ('detailBeritaTender', ['id_tender'=>$args['id_tender']])
                        ]);
                    }elseif($args['status'] == 'ditolak'){
                        $this->notifikasiModels->addNotification ([
                            "id_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                            "tentang" => 'Telah Menolak Berita Tender "' . $this->tenderModels->getBeritaTender($args['id_tender'])[ 'judul_tender' ] . '"',
                            "waktu" => date ("Y-m-d H:i:s"),
                            "meta" => $this->router->pathFor ('detailBeritaTender', ['id_tender'=>$args['id_tender']])
                        ]);
                    }
                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('approvalBeritaTender', ['id_tender'=>$args['id_tender']]));
                }
            }else{
                return $res->write($args['status']);
            }
        }

        public function beritaTenderRKS(Req $req, Res $res, $args){
            if($req->isGet()){
                $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
                    $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                    return $penyelenggara['nama_penyelenggara'];
                });
                $beritaTender = $this->tenderModels->getBeritaTender();
                $req = $req->withAttribute('beritaTender', $beritaTender);
                return $this->view->render ("approval/rks-acara/daftar-berita", $req->getAttributes ());
            }
        }

        public function approvalBeritaTenderRKS(Req $req, Res $res, $args){
            if(!isset($args['status'])){
                $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
                    $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                    return $penyelenggara['nama_penyelenggara'];
                });
                $this->view->registerFunction('getUserUpload', function($id_user){
                    $user = $this->userModels->getUserDetail($id_user);
                    return $user;
                });
                $beritaTender = $this->tenderModels->getBeritaTender($args['id_tender']);
                $req = $req->withAttribute('tender', $beritaTender);
                return $this->view->render ("approval/rks-acara/detail-berita", $req->getAttributes ());
            }elseif(isset($args['status'])){
                if($this->tenderModels->setApprovalRKSBeritaTender($args['id_tender'], $this->session->previledge, $args['status'])){
                    if($args['status'] == 'diterima'){
                        $this->notifikasiModels->addNotification ([
                            "id_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                            "tentang" => 'Telah Melakukan Approve Dokumen RKS dari Berita Tender "' . $this->tenderModels->getBeritaTender($args['id_tender'])[ 'judul_tender' ] . '"',
                            "waktu" => date ("Y-m-d H:i:s"),
                            "meta" => $this->router->pathFor ('detailBeritaTender', ['id_tender'=>$args['id_tender']])
                        ]);
                    }elseif($args['status'] == 'ditolak'){
                        $this->notifikasiModels->addNotification ([
                            "id_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                            "tentang" => 'Telah Menolak Dokumen RKS dari Berita Tender "' . $this->tenderModels->getBeritaTender($args['id_tender'])[ 'judul_tender' ] . '"',
                            "waktu" => date ("Y-m-d H:i:s"),
                            "meta" => $this->router->pathFor ('detailBeritaTender', ['id_tender'=>$args['id_tender']])
                        ]);
                    }
                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('approvalRKSTender', ['id_tender'=>$args['id_tender']]));
                }
            }else{
                return $res->write($args['status']);
            }
        }

        public function beritaTenderBOQ(Req $req, Res $res, $args) {
            if($req->isGet()){
                $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
                    $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                    return $penyelenggara['nama_penyelenggara'];
                });
                $this->view->registerFunction('countBOQApproval', function($id_tender){
                    $BOQ = $this->BOQModels->countBOQApproval($id_tender);
                    return $BOQ;
                });
                $beritaTender = $this->tenderModels->getBeritaTender();
                $req = $req->withAttribute('beritaTender', $beritaTender);
                return $this->view->render ("approval/boq/daftar-tender", $req->getAttributes ());
            }
        }


        public function detaiTenderBOQ(Req $req, Res $res, $args){
            if($req->isGet()){
                $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
                    $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                    return $penyelenggara['nama_penyelenggara'];
                });
                $this->view->registerFunction('getUserUpload', function($id_user){
                    $user = $this->userModels->getUserDetail($id_user);
                    return $user;
                });
                $beritaTender = $this->tenderModels->getBeritaTender($args['id_tender']);
                $req = $req->withAttribute('tender', $beritaTender);
                $req = $req->withAttribute ('no_file', $this->flash->getMessage ('no_file'));
                $req = $req->withAttribute ('file_saved', $this->flash->getMessage ('file_saved'));
                return $this->view->render ("approval/boq/detail-boq", $req->getAttributes ());
            }
        }
        public function approvalTenderBOQ(Req $req, Res $res, $args) {
            $result = [];
            if($req->getAttribute ('active_user_data')[ 'previledge' ] == "3" and $_POST["status"] == "ditolak"){
                $data = [
                    "id_tender" => $_POST['data'][0]['id_tender'],
                    "id_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                    "nama_vendor" => $_POST['data'][0]['nama_vendor'],
                    "nama_barang" => $_POST['data'][0]['nama_barang'],
                    "harga_persatuan" => $_POST['data'][0]['harga_persatuan'],
                    "volume_barang" => $_POST['data'][0]['volume_barang'],
                    "ukuran_satuan" => $_POST['data'][0]['ukuran_satuan'],
                    "waktu" => date ("Y-m-d H:i:s"),
                    "approval" => json_encode([
                        "direktur" => [
                            "status" => "",
                            "waktu" => "",
                        ],
                        "manajer" => [
                            "status" => "diterima",
                            "waktu" => date ("Y-m-d H:i:s"),
                        ]
                    ]),
                    "inputan_manajer" => $_POST['data'][0]['id_penawaran']
                ];
                if($this->BOQModels->setBOQ($data)){
                    $result['status']='success';
                }
            }
            foreach ($_POST['data'] as $pdata){
                $data = $this->BOQModels->getBOQ($pdata['id_penawaran']);
                $dataApproval = json_decode($data["approval"], true);
                if($req->getAttribute ('active_user_data')[ 'previledge' ] == "2"){
                    $dataApproval["direktur"] = [
                        "status" => $_POST["status"],
                        "waktu" => date ("Y-m-d H:i:s"),
                    ];
                }elseif($req->getAttribute ('active_user_data')[ 'previledge' ] == "3"){
                    $dataApproval["manajer"] = [
                        "status" => $_POST["status"],
                        "waktu" => date ("Y-m-d H:i:s"),
                    ];
                }
                $approval = [
                    "approval" => json_encode($dataApproval)
                ];
                if($this->BOQModels->setBOQ($approval, $pdata['id_penawaran'])){
                    $result['status']='success';
                }
            }
            return $res->withJson($result);
        }
    }