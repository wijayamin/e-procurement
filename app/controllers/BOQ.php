<?php
/**
 * Copyright (c) 2017. 
 */

/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 27/04/2017
 * Time: 17.35
 */

namespace ryan\controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class BOQ extends \ryan\main{

    protected $container;
    protected $penyelenggaraModels;
    protected $tenderModels;
    protected $userModels;
    protected $notifikasiModels;
    protected $BOQModels;

    public function __construct ($container) {
        parent::__construct ($container);
        $this->container = $container;
        $this->userModels = new \ryan\models\users($container);
        $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
        $this->tenderModels = new \ryan\models\tender($container);
        $this->notifikasiModels = new \ryan\models\notifikasi($container);
        $this->BOQModels = new \ryan\models\BOQ($container);
    }

    public function beritaTenderBOQ(Request $req, Response $res, $args) {
        if($req->isGet()){
            $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                return $penyelenggara['nama_penyelenggara'];
            });
            $this->view->registerFunction('countBOQ', function($id_tender){
                $BOQ = $this->BOQModels->countBOQTender($id_tender);
                return $BOQ;
            });
            $beritaTender = $this->tenderModels->getBeritaTender();
            $req = $req->withAttribute('beritaTender', $beritaTender);
            return $this->view->render ("boq/daftar-tender", $req->getAttributes ());
        }
    }

    public function detaiTenderBOQ(Request $req, Response $res, $args){
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
            return $this->view->render ("boq/detail-boq", $req->getAttributes ());
        }
    }

    public function getBOQTender(Request $req, Response $res, $args){
        $BOQs = $this->BOQModels->getBOQByTender($args['id_tender']);
        foreach ($BOQs as &$BOQ){
            $BOQ['pegawai'] = [
                'who'=>$this->userModels->getUserDetail($BOQ['id_user']),
                'time'=>$BOQ['waktu']
            ];
            $BOQ['total'] = $BOQ['harga_persatuan']*$BOQ['volume_barang'];
            $BOQ['inputan_manajer'] = $this->BOQModels->getBOQManajer($BOQ['id_penawaran']);
            $BOQ['approval'] = json_decode($BOQ['approval'], true);
            if($BOQ['inputan_manajer']){
                $BOQ['inputan_manajer']['pegawai'] = [
                    'who'=>$this->userModels->getUserDetail($BOQ['inputan_manajer']['id_user']),
                    'time'=>$BOQ['inputan_manajer']['waktu']
                ];
                $BOQ['inputan_manajer']['total'] = $BOQ['inputan_manajer']['harga_persatuan']*$BOQ['inputan_manajer']['volume_barang'];
            }
        }
        return $res->withJson(['data'=>$BOQs]);
    }

    public function setBOQ(Request $req, Response $res, $args){
        $result = [
            'status'=>'failed'
        ];

        $data = $_POST;
        $data['ukuran_satuan'] = $data['ukuran_satuan'][0];
        $data['id_user'] = $req->getAttribute ('active_user_data')[ 'id_user' ];
        $data['id_tender'] = $args['id_tender'];
        $data['waktu'] = date ("Y-m-d H:i:s");
        if($this->BOQModels->setBOQ($data)){
            $result['status']='success';
        }
        return $res->withJson($data);
    }

}