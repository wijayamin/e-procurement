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

class BOQTender extends \ryan\main{

    protected $container;
    protected $penyelenggaraModels;
    protected $tenderModels;
    protected $userModels;
    protected $notifikasiModels;
    protected $BOQModels;
    protected $unitKerjaModels;
    protected $historyModels;

    public function __construct ($container) {
        parent::__construct ($container);
        $this->container = $container;
        $this->userModels = new \ryan\models\users($container);
        $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
        $this->tenderModels = new \ryan\models\tender($container);
        $this->notifikasiModels = new \ryan\models\notifikasi($container);
        $this->BOQModels = new \ryan\models\BOQ($container);
        $this->unitKerjaModels = new \ryan\models\unitKerja($container);
        $this->historyModels = new \ryan\models\history($container);
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
        $this->view->registerFunction('checkPenugasan', function($id_tender, $id_user){
            $unitKerja = $this->unitKerjaModels->getUnitForPenawaran($id_tender, $id_user);
            if($unitKerja){
                return true;
            }else{
                return false;
            }
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
        foreach ($_POST['data'] as $pdata) {
            $data = $this->BOQModels->getBOQ($pdata['id_penawaran']);
            $dataApproval = json_decode($data["approval"], true);
            $who = $req->getAttribute('active_user_data')['previledge'] == "2" ? 'direktur' : 'manajer';
            $dataApproval[$who]['status'] = $_POST["status"];
            $dataApproval[$who]['waktu'] = $_POST["status"];
            $dataApproval[$who]['keterangan'] = $_POST["keterangan"];
            $approval = [
                "approval" => json_encode($dataApproval),
            ];
            if ($this->BOQModels->setBOQ($approval, $pdata['id_penawaran'])) {
                $this->historyModels->add_history($pdata['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'a_boq', $pdata['id_penawaran'], json_encode($dataApproval[$who]));
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
            $BOQ['total'] = ($BOQ['harga_persatuan']*$BOQ['volume_barang'])+$BOQ['harga_jasa'];
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

    public function BOQ_add(Request $req, Response $res, $args){
        $data = $_POST;
        $data['id_user'] = $req->getAttribute ('active_user_data')[ 'id_user' ];
        $data['id_tender'] = $args['id_tender'];
        $data['waktu'] = date ("Y-m-d H:i:s");
        $data['approval']=$req->getAttribute('autoApprovalEncoded');
        $insert = $this->BOQModels->setBOQ($data);
        if($insert){
            $this->historyModels->add_history($args['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'i_boq', $insert);
            $tender = $this->tenderModels->getBeritaTender($args['id_tender']);
            $direktur = $this->userModels->getDirektur();
            $this->sendSMS($direktur['telefon'], 'BOQ  "' . $data['nama_vendor'] . ' - ' . $data['nama_barang'] . '" telah ditambahkan ke tender"' . $tender['judul_tender'] . '" telah dirubah. mohon melakukan approval ulang');
            $manajer = $this->userModels->getManajer();
            $this->sendSMS($manajer['telefon'], 'BOQ  "' . $data['nama_vendor'] . ' - ' . $data['nama_barang'] . '" telah ditambahkan ke tender"' . $tender['judul_tender'] . '" telah dirubah. mohon melakukan approval ulang');
            return $res->withJson([
                'status'=>'success'
            ]);
        }
    }

    public function BOQ_set(Request $req, Response $res, $args){
        $data = $_POST;
        $id_penawran = $_POST['id_penawaran'];
        unset($data['id_penawaran']);
        $data['id_user'] = $req->getAttribute ('active_user_data')[ 'id_user' ];
        $data['id_tender'] = $args['id_tender'];
        $data['waktu'] = date ("Y-m-d H:i:s");
        $data['approval']=$req->getAttribute('autoApprovalEncoded');
        if($this->BOQModels->setBOQ($data, $id_penawran)){
            $this->historyModels->add_history($args['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'e_boq', $id_penawran);
            $this->notifikasiModels->sendNotificationByPreviledge(['2', '3'], [
                "by_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                "tentang" => 'Mengubah BOQ  "' . $_POST['nama_vendor'] . ' - ' . $_POST['nama_barang'] . '". Anda perlu melakukan approval BOQ ini kembali',
                "waktu" => date ("Y-m-d H:i:s"),
                "meta" => $this->router->pathFor ('beritaTender_detail', ['id_tender' => $args['id_tender']])
            ]);
            $tender = $this->tenderModels->getBeritaTender($args['id_tender']);
            $direktur = $this->userModels->getDirektur();
            $this->sendSMS($direktur['telefon'], 'BOQ  "' . $_POST['nama_vendor'] . ' - ' . $_POST['nama_barang'] . '" dari tender"' . $tender['judul_tender'] . '" telah dirubah. mohon melakukan approval ulang');
            $manajer = $this->userModels->getManajer();
            $this->sendSMS($manajer['telefon'], 'BOQ  "' . $_POST['nama_vendor'] . ' - ' . $_POST['nama_barang'] . '" dari tender"' . $tender['judul_tender'] . '" telah dirubah. mohon melakukan approval ulang');
            return $res->withJson([
                'status'=>'success'
            ]);
        }
    }

    public function BOQ_delete(Request $req, Response $res, $args){
        if(isset($_POST['id_penawaran'])){
            if($this->BOQModels->deleteBOQ($_POST['id_penawaran'])){
                $this->historyModels->add_history($_POST['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'd_boq', $_POST['id_penawaran']);
                return $res->withJson([
                   'status'=>'success'
                ]);
            }
        }
    }

    public function BOQ_printPreview(Request $req, Response $res, $args){
        $boqs = $this->BOQModels->getBOQByTender($args['id_tender']);
        $tender = $this->tenderModels->getBeritaTender($args['id_tender']);
        $direktur = $this->userModels->getDirektur();
        foreach($boqs as $key => $boq){
            if(isset($_GET['approved'])){
                $approval = json_decode($boq['approval'], true);
                if($approval['direktur']['status'] != 'diterima' || $approval['manajer']['status'] != 'diterima'){
                    unset($boqs[$key]);
                }
            }
        }
        $req = $req->withAttribute ('BOQS', $boqs);
        $req = $req->withAttribute ('tender', $tender);
        $req = $req->withAttribute ('direktur', $direktur);
        $req = $req->withAttribute ('param', $_GET);
//        return $this->view->render ("boq/print", $req->getAttributes ());
        $this->pdf->loadHtml($this->view->getPlates()->render ("boq/print", $req->getAttributes()));
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->render();
        if(isset($args['download'])){
            return $this->pdf->stream("BOQ".(isset($_GET['approved']) ? '-Approved-' : '-' ).date('d-n-Y-G-i-s-').bin2hex(random_bytes(5)).".pdf", array("Attachment" => true));
        }else{
            return $this->pdf->stream("BOQ".(isset($_GET['approved']) ? '-Approved-' : '-' ).date('d-n-Y-G-i-s-').bin2hex(random_bytes(5)).".pdf", array("Attachment" => false));
        }
    }

}