<?php
/**
 * Copyright (c) 2017.
 */

/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 12/04/2017
 * Time: 15.00
 */

namespace ryan\controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class unitKerja extends \ryan\main{

    protected $container;
    protected $penyelenggaraModels;
    protected $tenderModels;
    protected $userModels;
    protected $notifikasiModels;
    protected $unitKerjaModels;
    protected $historyModels;

    public function __construct ($container) {
        parent::__construct ($container);
        $this->container = $container;
        $this->userModels = new \ryan\models\users($container);
        $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
        $this->tenderModels = new \ryan\models\tender($container);
        $this->notifikasiModels = new \ryan\models\notifikasi($container);
        $this->unitKerjaModels = new \ryan\models\unitKerja($container);
        $this->historyModels = new \ryan\models\history($container);
    }

    public function unitKerja_daftar(Request $req, Response $res, $args){
        $route = $req->getAttribute('route');
        $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
            return $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara)['nama_penyelenggara'];
        });
        $this->view->registerFunction('detailUnitKerja', function($id_tender){
            return $this->unitKerjaModels->getUnitKerjaByTender($id_tender);
        });
        $this->view->registerFunction('getUserUpload', function($id_user){
            return $this->userModels->getUserDetail($id_user);
        });
        $beritaTender = $this->tenderModels->getBeritaTenderApprovedRKS();
        $req = $req->withAttribute('beritaTender', $beritaTender);
        $req = $req->withAttribute ('approval', $route->getName() == 'rksAcara_daftarApproval');
        return $this->view->render ("unit-kerja/daftar", $req->getAttributes ());
    }

    public function unitKerja_detail(Request $req, Response $res, $args){
        $route = $req->getAttribute('route');
        $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
            return $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara)['nama_penyelenggara'];
        });
        $this->view->registerFunction('getUserUpload', function($id_user){
            return $this->userModels->getUserDetail($id_user);
        });
        $beritaTender = $this->tenderModels->getBeritaTender($args['id_tender']);
        $req = $req->withAttribute('tender', $beritaTender);
        $req = $req->withAttribute ('approval', $route->getName() == 'rksAcara_daftarApproval');
        $req = $req->withAttribute ('no_file', $this->flash->getMessage ('no_file'));
        $req = $req->withAttribute ('file_saved', $this->flash->getMessage ('file_saved'));
        return $this->view->render ("unit-kerja/detail", $req->getAttributes ());
    }

    public function unitKerja_add(Request $req, Response $res, $args){
        $result = [
            'status'=>'failed'
        ];
        foreach ($_POST['pegawai'] as $pegawai){
            $waktu = date ("Y-m-d H:i:s");
            $data = [
                'id_user'=>$pegawai,
                'id_tender'=>$args['id_tender'],
                'penugasan'=>$_POST['penugasan'],
                'waktu'=>$waktu,
                'approval'=>json_encode([
                    'direktur'=>[
                        'status'=>'',
                        'waktu'=>''
                    ],
                    'manajer'=>[
                        'status'=>'',
                        'waktu'=>''
                    ]
                ])
            ];
            $insert = $this->unitKerjaModels->setUnitKerja($data);
            if($insert){
                $this->historyModels->add_history($args['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'i_unit', $insert);
                $tender = $this->tenderModels->getBeritaTender($args['id_tender']);
                $this->notifikasiModels->sendNotificationToUser($pegawai, [
                    "by_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                    "tentang" => 'Menunjuk anda sebagai Unit Kerja Berita Tender "' . $tender['judul_tender'] . '" dengan penugasan "'.$_POST['penugasan'].'"',
                    "waktu" => date ("Y-m-d H:i:s"),
                    "meta" => $this->router->pathFor ('beritaTender_detail', ['id_tender' => $args['id_tender']])
                ]);
                $result['status']='success';
            }
        }
        return $res->withJson($result);

    }

    public function unitKerja_available(Request $req, Response $res, $args){
        $users = $this->userModels->getUserWithPreviledge('4');
        foreach ($users as &$user){
            $unitkerja = $this->unitKerjaModels->isUnitKerjaExsist($args['id_tender'], $user['id_user']);
            $user['available'] = $unitkerja ? false : true;
        }
        return $res->withJson($users);
    }

    public function unitKerja_get(Request $req, Response $res, $args){
        $unitskerja = $this->unitKerjaModels->getUnitKerjaByTender($args['id_tender']);
        foreach ($unitskerja as &$unit){
            $unit['pegawai'] = $this->userModels->getUserDetail($unit['id_user']);
        }
        return $res->withJson(['data'=>$unitskerja]);
    }

    public function unitKerja_delete(Request $req, Response $res, $args){
        if($this->unitKerjaModels->deleteUnitKerja($_POST['id_unitkerja'])){
            $this->historyModels->add_history($_POST['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'd_unit', $_POST['id_unitkerja']);
            return $res->withJson([
               'status'=>'success'
            ]);
        }else{
            return $res->withJson([
                'status'=>'failed'
            ]);
        }
    }
}