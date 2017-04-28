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

    public function __construct ($container) {
        parent::__construct ($container);
        $this->container = $container;
        $this->userModels = new \ryan\models\users($container);
        $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
        $this->tenderModels = new \ryan\models\tender($container);
        $this->notifikasiModels = new \ryan\models\notifikasi($container);
        $this->unitKerjaModels = new \ryan\models\unitKerja($container);
    }

    public function beritaTenderUnitKerja(Request $req, Response $res, $args) {
        if($req->isGet()){
            $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                return $penyelenggara['nama_penyelenggara'];
            });
            $this->view->registerFunction('countUnitKerja', function($id_tender){
                $unitKerja = $this->unitKerjaModels->countUnitKerjaTender($id_tender);
                return $unitKerja;
            });
            $beritaTender = $this->tenderModels->getBeritaTender();
            $req = $req->withAttribute('beritaTender', $beritaTender);
            return $this->view->render ("unit-kerja/daftar-berita", $req->getAttributes ());
        }
    }

    public function detaiTenderUnitKerja(Request $req, Response $res, $args){
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
            return $this->view->render ("unit-kerja/detail-berita", $req->getAttributes ());
        }
    }


    public function getAvailableUnitKerja(Request $req, Response $res, $args){
        $users = $this->userModels->getUserWithPreviledge('4');
        foreach ($users as &$user){
            $unitkerja = $this->unitKerjaModels->isUnitKerjaExsist($args['id_tender'], $user['id_user']);
            $user['available'] = $unitkerja ? false : true;
        }
        return $res->withJson($users);
    }

    public function getUnitKerjaTender(Request $req, Response $res, $args){
        $unitskerja = $this->unitKerjaModels->getUnitKerjaByTender($args['id_tender']);
        foreach ($unitskerja as &$unit){
            $unit['pegawai'] = $this->userModels->getUserDetail($unit['id_user']);
            $unit['metadata'] = json_decode($unit['metadata'], true);
            $unit['metadata']['who'] = $this->userModels->getUserDetail($unit['metadata']['who'])['nama'];
        }
        return $res->withJson(['data'=>$unitskerja]);
    }

    public function setUnitKerja(Request $req, Response $res, $args){
        $result = [
            'status'=>'failed'
        ];
        foreach ($_POST['pegawai'] as $pegawai){
            $data = [
                'id_user'=>$pegawai,
                'id_tender'=>$args['id_tender'],
                'penugasan'=>$_POST['penugasan'],
                'metadata'=>json_encode([
                    'time'=>date ("Y-m-d H:i:s"),
                    'who'=>$req->getAttribute ('active_user_data')[ 'id_user' ]
                ])
            ];
            if($this->unitKerjaModels->setUnitKerja($data)){
                $result['status']='success';
            }
        }
        return $res->withJson($result);
        
    }


}