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
    protected $historyModels;

    public function __construct (Container $container) {
        parent::__construct ($container);
        $this->container = $container;
        $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
        $this->tenderModels = new \ryan\models\tender($container);
        $this->userModels = new \ryan\models\users($container);
        $this->notifikasiModels = new \ryan\models\notifikasi($container);
        $this->historyModels = new \ryan\models\history($container);
    }

    public function daftarBeritaTender(Req $req, Res $res, $args){
        $route = $req->getAttribute('route');
        $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
            $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
            return $penyelenggara['nama_penyelenggara'];
        });
        $beritaTender = $this->tenderModels->getBeritaTenderApproved();
        $req = $req->withAttribute('beritaTender', $beritaTender);
        $req = $req->withAttribute ('approval', $route->getName() == 'rksAcara_daftarApproval');
        return $this->view->render ("rks-acara/daftar", $req->getAttributes ());
    }

    public function detailAcaraRKS(Req $req, Res $res, $args){
        $route = $req->getAttribute('route');
        $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
            $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
            return $penyelenggara['nama_penyelenggara'];
        });
        $this->view->registerFunction('getUserUpload', function($id_user){
            $user = $this->userModels->getUserDetail($id_user);
            return $user;
        });
        $beritaTender = $this->tenderModels->getBeritaTender($args['id_tender']);
        $req = $req->withAttribute ('tender', $beritaTender);
        $req = $req->withAttribute ('approval', $route->getName() == 'rksAcara_detailApproval');
        $req = $req->withAttribute ('no_file', $this->flash->getMessage ('no_file'));
        $req = $req->withAttribute ('file_saved', $this->flash->getMessage ('file_saved'));
        return $this->view->render ("rks-acara/detail", $req->getAttributes ());
    }

    public function uploadAcaraRKS(Req $req, Res $res, $args){
        $files = $req->getUploadedFiles();
        $tender = $this->tenderModels->getBeritaTender($args['id_tender']);
        $isNull = $tender[$args['type']];
        $tender[$args['type']] = json_decode($tender[$args['type']], true);

        $fileinfo = pathinfo($files[$args['type']]->getClientFilename());
        $filename = $fileinfo['filename'].'_'.time().'.'.$fileinfo['extension'];

        $tender[$args['type']]['file'] = $filename;
        $tender[$args['type']]['waktu'] = date ("Y-m-d H:i:s");
        $tender[$args['type']]['user_id'] = $req->getAttribute ('active_user_data')[ 'id_user' ];
        if($args['type'] == 'rks'){
            $tender[$args['type']]['approval'] = $req->getAttribute('blankApproval');
        }
        $data = [
            $args['type']=>json_encode($tender[$args['type']])
        ];
        if($this->tenderModels->updateBeritaTender($args['id_tender'], $data)){
            if($args['type'] == 'rks'){
                if($isNull){
                    $this->historyModels->add_history($args['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'e_rks', $args['id_tender']);
                    $this->notifikasiModels->sendNotificationByPreviledge(['2', '3'], [
                        "by_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                        "tentang" => 'Mengganti RKS dari berita tender "' . $tender['judul_tender'] . '". Anda perlu melakukan approval RKS kembali',
                        "waktu" => date ("Y-m-d H:i:s"),
                        "meta" => $this->router->pathFor ('rksAcara_detailApproval', ['id_tender' => $args['id_tender']])
                    ]);
                    $direktur = $this->userModels->getDirektur();
                    $this->sendSMS($direktur['telefon'], 'Dokumen RKS Berita tender "' . $tender['judul_tender'] . '" telah dirubah mohon melakukan approval ulang');
                    $manajer = $this->userModels->getManajer();
                    $this->sendSMS($manajer['telefon'], 'Dokumen RKS Berita tender "' . $tender['judul_tender'] . '" telah dirubah mohon melakukan approval ulang');
                }else{
                    $direktur = $this->userModels->getDirektur();
                    $this->sendSMS($direktur['telefon'], 'Dokumen RKS Berita tender "' . $tender['judul_tender'] . '" telah ditambahkan.');
                    $manajer = $this->userModels->getManajer();
                    $this->sendSMS($manajer['telefon'], 'Dokumen RKS Berita tender "' . $tender['judul_tender'] . '" telah ditambahkan.');
                    $this->historyModels->add_history($args['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'i_rks', $args['id_tender']);
                }
            }else{
                if($isNull){
                    $this->historyModels->add_history($args['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'e_acara', $args['id_tender']);
                }else{
                    $this->historyModels->add_history($args['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'i_acara', $args['id_tender']);
                }
            }
            $files[$args['type']]->moveTo("public/content/dokumen/".$filename);
            return $res->withJson([
                "status"=>"success"
            ]);
        }else{
            return $res->withJson([
                "status"=>"success"
            ]);
        }
    }

    public function approvalAcaraRKS(Req $req, Res $res, $args){
        $tender = $this->tenderModels->getBeritaTender($args['id_tender']);
        $tender['rks'] = json_decode($tender['rks'], true);
        $tender['rks']['approval'][$_POST['who']]['status'] = $_POST['status'];
        $tender['rks']['approval'][$_POST['who']]['waktu'] = date("Y-m-d H:i:s");
        $tender['rks']['approval'][$_POST['who']]['keterangan'] = ($_POST['status'] == 'ditolak' ? $_POST['keterangan'] : null);
        $data = [
            'rks'=>json_encode($tender['rks'])
        ];
        if($this->tenderModels->updateBeritaTender($args['id_tender'], $data)){
            $this->historyModels->add_history($args['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'a_rks', $args['id_tender'], json_encode($tender['rks']['approval'][$_POST['who']]));
            return $res->withJson([
                "status"=>"success"
            ]);
        }else{
            return $res->withJson([
                "status"=>"failed"
            ]);
        }
    }

}