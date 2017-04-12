<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 4/4/2017
 * Time: 10:07 PM
 */

namespace ryan\controllers;


use \Slim\Container as Container;
use \Slim\Http\Request as Req;
use \Slim\Http\Response as Res;


class acaraRKS extends \ryan\main {

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

    public function beritaTenderRKS(Req $req, Res $res, $args){
        if($req->isGet()){
            $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                return $penyelenggara['nama_penyelenggara'];
            });
            $beritaTender = $this->tenderModels->getBeritaTender();
            $req = $req->withAttribute('beritaTender', $beritaTender);
            return $this->view->render ("rks-acara/rks/daftar-berita", $req->getAttributes ());
        }
    }

    public function detailBeritaTenderRKS(Req $req, Res $res, $args){
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
            return $this->view->render ("rks-acara/rks/detail-berita", $req->getAttributes ());
        }else{
            $files = $req->getUploadedFiles();
            if($files['rks']->getClientFilename() != null){
                $fileinfo = pathinfo($files['rks']->getClientFilename());
                $filename = $fileinfo['filename'].'_'.time().'.'.$fileinfo['extension'];
                $files['rks']->moveTo("public/content/rks/".$filename);
                $rks = [
                    'file' => $filename,
                    'time' => date ("Y-m-d H:i:s"),
                    'who' => $this->session->id_user,
                    'approval'=>[
                        'direktur'=>[
                            'status'=>'',
                            'waktu'=>''
                        ],
                        'manajer'=>[
                            'status'=>'',
                            'waktu'=>''
                        ],
                    ]
                ];
                if($this->tenderModels->setRKSBeritaTender($args['id_tender'], json_encode($rks))){
                    $this->notifikasiModels->addNotification ([
                        "id_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                        "tentang" => 'Telah Menambahkan Dokumen RKS ke  "' . $this->tenderModels->getBeritaTender($args['id_tender'])[ 'judul_tender' ] . '"',
                        "waktu" => date ("Y-m-d H:i:s"),
                        "meta" => $this->router->pathFor ('detailBeritaTenderRKS', ['id_tender'=>$args['id_tender']])
                    ]);
                    $this->flash->addMessage ('file_saved', true);
                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('detailBeritaTenderRKS', ['id_tender'=>$args['id_tender']]));
                }
            }else{
                $this->flash->addMessage ('no_file', true);
                return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('detailBeritaTenderRKS', ['id_tender'=>$args['id_tender']]));
            }
        }
    }

    public function beritaTenderAcara(Req $req, Res $res, $args){
        if($req->isGet()){
            $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                return $penyelenggara['nama_penyelenggara'];
            });
            $beritaTender = $this->tenderModels->getBeritaTender();
            $req = $req->withAttribute('beritaTender', $beritaTender);
            return $this->view->render ("rks-acara/acara/daftar-berita", $req->getAttributes ());
        }
    }

    public function detailBeritaTenderAcara(Req $req, Res $res, $args){
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
            return $this->view->render ("rks-acara/acara/detail-berita", $req->getAttributes ());
        }else{
            $files = $req->getUploadedFiles();
            if($files['berita_acara']->getClientFilename() != null){
                $fileinfo = pathinfo($files['berita_acara']->getClientFilename());
                $filename = $fileinfo['filename'].'_'.time().'.'.$fileinfo['extension'];
                $files['berita_acara']->moveTo("public/content/berita-acara/".$filename);
                $acara = [
                    'file' => $filename,
                    'time' => date ("Y-m-d H:i:s"),
                    'who' => $this->session->id_user,
                ];
                if($this->tenderModels->setAcaraBeritaTender($args['id_tender'], json_encode($acara))){
                    $this->notifikasiModels->addNotification ([
                        "id_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                        "tentang" => 'Telah Menambahkan Dokumen Berita Acara ke  "' . $this->tenderModels->getBeritaTender($args['id_tender'])[ 'judul_tender' ] . '"',
                        "waktu" => date ("Y-m-d H:i:s"),
                        "meta" => $this->router->pathFor ('detailBeritaTenderAcara', ['id_tender'=>$args['id_tender']])
                    ]);
                    $this->flash->addMessage ('file_saved', true);
                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('detailBeritaTenderAcara', ['id_tender'=>$args['id_tender']]));
                }
            }else{
                $this->flash->addMessage ('no_file', true);
                return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('detailBeritaTenderAcara', ['id_tender'=>$args['id_tender']]));
            }
        }
    }
}