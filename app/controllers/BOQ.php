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

    public function BOQ_daftar(Request $req, Response $res, $args) {
        $route = $req->getAttribute('route');
        $this->view->registerFunction ('getNamaPenyelenggara', function ($id_penyelenggara) {
            $penyelenggara = $this->penyelenggaraModels->getPenyelenggara ($id_penyelenggara);
            return $penyelenggara[ 'nama_penyelenggara' ];
        });
        $this->view->registerFunction('detailBOQ', function($id_tender){
            return $this->BOQModels->getBOQByTender($id_tender);
        });
        $this->view->registerFunction('getUserUpload', function($id_user){
            $user = $this->userModels->getUserDetail($id_user);
            return $user;
        });
        $beritaTender = $this->tenderModels->getBeritaTenderApprovedRKS ();
        $req = $req->withAttribute ('beritaTender', $beritaTender);
        $req = $req->withAttribute ('approval', $route->getName() == 'BOQTender_daftarApproval');
        return $this->view->render ("boq/daftar", $req->getAttributes ());
    }

    public function BOQ_detail(Request $req, Response $res, $args){
        $route = $req->getAttribute('route');
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
            return $this->view->render ("boq/detail", $req->getAttributes ());
        }
    }

    public function BOQ_detail_approval(Request $req, Response $res, $args) {
        if ($req->isGet()) {
            $this->view->registerFunction('getNamaPenyelenggara', function ($id_penyelenggara) {
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);

                return $penyelenggara['nama_penyelenggara'];
            });
            $this->view->registerFunction('getUserUpload', function ($id_user) {
                $user = $this->userModels->getUserDetail($id_user);

                return $user;
            });
            $beritaTender = $this->tenderModels->getBeritaTender($args['id_tender']);
            $req = $req->withAttribute('tender', $beritaTender);
            $req = $req->withAttribute('no_file', $this->flash->getMessage('no_file'));
            $req = $req->withAttribute('file_saved', $this->flash->getMessage('file_saved'));

            return $this->view->render("boq/detail-approval", $req->getAttributes());
        }
    }

    public function BOQ_approval(Request $req, Response $res, $args) {
        $result = [];
        if ($req->getAttribute('active_user_data')['previledge'] == "3" and $_POST["status"] == "ditolak") {
            $data = [
                "id_tender"       => $_POST['data'][0]['id_tender'],
                "id_user"         => $req->getAttribute('active_user_data')['id_user'],
                "nama_vendor"     => $_POST['data'][0]['nama_vendor'],
                "nama_barang"     => $_POST['data'][0]['nama_barang'],
                "harga_persatuan" => $_POST['data'][0]['harga_persatuan'],
                "volume_barang"   => $_POST['data'][0]['volume_barang'],
                "ukuran_satuan"   => $_POST['data'][0]['ukuran_satuan'],
                "waktu"           => date("Y-m-d H:i:s"),
                "approval"        => json_encode([
                    "direktur" => [
                        "status" => "",
                        "waktu"  => "",
                    ],
                    "manajer"  => [
                        "status" => "diterima",
                        "waktu"  => date("Y-m-d H:i:s"),
                    ],
                ]),
                "inputan_manajer" => $_POST['data'][0]['id_penawaran'],
            ];
            if ($this->BOQModels->setBOQ($data)) {
                $result['status'] = 'success';
            }
        }
        foreach ($_POST['data'] as $pdata) {
            $data = $this->BOQModels->getBOQ($pdata['id_penawaran']);
            $dataApproval = json_decode($data["approval"], true);
            if ($req->getAttribute('active_user_data')['previledge'] == "2") {
                $dataApproval["direktur"] = [
                    "status" => $_POST["status"],
                    "waktu"  => date("Y-m-d H:i:s"),
                ];
            } elseif ($req->getAttribute('active_user_data')['previledge'] == "3") {
                $dataApproval["manajer"] = [
                    "status" => $_POST["status"],
                    "waktu"  => date("Y-m-d H:i:s"),
                ];
            }
            $approval = [
                "approval" => json_encode($dataApproval),
            ];
            if ($this->BOQModels->setBOQ($approval, $pdata['id_penawaran'])) {
                $result['status'] = 'success';
            }
        }

        return $res->withJson($result);
    }

    public function BOQ_get(Request $req, Response $res, $args){
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

    public function BOQ_set(Request $req, Response $res, $args){
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
        return $res->withJson($result);
    }

    public function BOQ_delete(Request $req, Response $res, $args){
        if(isset($_POST['id_penawaran'])){
            if($this->BOQModels->deleteBOQ($_POST['id_penawaran'])){
                return $res->withJson([
                   'status'=>'success'
                ]);
            }
        }
    }

}