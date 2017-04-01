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

        public function __construct (Container $container) {
            parent::__construct ($container);
            $this->container = $container;
            $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
            $this->tenderModels = new \ryan\models\tender($container);
            $this->userModels = new \ryan\models\users($container);
            $this->notifikasiModels = new \ryan\models\notifikasi($container);
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
    }