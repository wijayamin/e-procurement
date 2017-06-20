<?php
/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 12/04/2017
 * Time: 13.46
 */

namespace ryan\controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class dokumenTender extends \ryan\main {
    protected $container;
    protected $penyelenggaraModels;
    protected $tenderModels;
    protected $userModels;
    protected $notifikasiModels;
    protected $dokumenModels;
    protected $unitKerjaModels;

    public function __construct($container) {
        parent::__construct($container);
        $this->container = $container;
        $this->userModels = new \ryan\models\users($container);
        $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
        $this->tenderModels = new \ryan\models\tender($container);
        $this->notifikasiModels = new \ryan\models\notifikasi($container);
        $this->dokumenModels = new \ryan\models\dokumenTender($container);
        $this->unitKerjaModels = new \ryan\models\unitKerja($container);
    }

    public function daftarBeritaTender(Request $req, Response $res, $args){
        $route = $req->getAttribute('route');
        if ($req->isGet ()) {
            $this->view->registerFunction ('getNamaPenyelenggara', function ($id_penyelenggara) {
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara ($id_penyelenggara);
                return $penyelenggara[ 'nama_penyelenggara' ];
            });
            $this->view->registerFunction ('countDokumen', function ($id_tender) {
                $count = $this->dokumenModels->countDokumenTender($id_tender, 1);
                return $count;
            });
            $beritaTender = $this->tenderModels->getBeritaTender ();
            $req = $req->withAttribute ('beritaTender', $beritaTender);
            $req = $req->withAttribute ('approval', $route->getName() == 'dokumenTender_daftarApproval');
            return $this->view->render ("dokumen/daftar", $req->getAttributes ());
        }
    }

    public function detailTenderDokumen(Request $req, Response $res, $args){
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
            $dokumenTender = $this->dokumenModels->getDokumenByTender($args['id_tender']);
            $req = $req->withAttribute('tender', $beritaTender);
            $req = $req->withAttribute('dokumenTender', $dokumenTender);
            $req = $req->withAttribute ('no_file', $this->flash->getMessage ('no_file'));
            $req = $req->withAttribute ('file_saved', $this->flash->getMessage ('file_saved'));
            $req = $req->withAttribute ('approval', $route->getName() == 'dokumenTender_detailApproval');
            return $this->view->render ("dokumen/detail", $req->getAttributes ());
        }
    }

    public function detailTenderDokumenApproval(Request $req, Response $res, $args){
        $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
            $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
            return $penyelenggara['nama_penyelenggara'];
        });
        $this->view->registerFunction('getUserUpload', function($id_user){
            $user = $this->userModels->getUserDetail($id_user);
            return $user;
        });
        $beritaTender = $this->tenderModels->getBeritaTender($args['id_tender']);
        $dokumenTender = $this->dokumenModels->getDokumenByTender($args['id_tender']);
        $req = $req->withAttribute('tender', $beritaTender);
        $req = $req->withAttribute('dokumenTender', $dokumenTender);
        $req = $req->withAttribute ('no_file', $this->flash->getMessage ('no_file'));
        $req = $req->withAttribute ('file_saved', $this->flash->getMessage ('file_saved'));
        return $this->view->render ("dokumen/detail-approval", $req->getAttributes ());
    }

    
    
    
    public function approvalTenderDokumen(Request $req, Response $res, $args){
        $select = $this->dokumenModels->getDokumenTender($args['id_dokumen']);
        $approval = json_decode($select['approval'], true);
        if($req->getAttribute('active_user_data')['previledge'] == "3"){
            $approval['manajer']['status']=$args['status'];
            $approval['manajer']['waktu']=date("Y-m-d H:i:s");
        }elseif($req->getAttribute('active_user_data')['previledge'] == "2"){
            $approval['direktur']['status']=$args['status'];
            $approval['direktur']['waktu']=date("Y-m-d H:i:s");
        }
        $update = [
            'approval'=>json_encode($approval)
        ];
        if($this->dokumenModels->setDokumenTender($update, $args['id_dokumen'])){
            return $res->withJson([
                'status'=>'success'
            ]);
        }else {
            return $res->withJson([
                'status' => 'failed'
            ]);
        }
    }

    public function getRequiredDokumenTender(Request $req, Response $res, $args){
        $doks = $this->dokumenModels->getDokumenByTender($args['id_tender']);
        foreach ($doks as $key => &$dok){
            if($dok['dokumen_syarat'] == '1'){
                $dok['who'] = $this->userModels->getUserDetail($dok['pengupload']);
                $dok['who']['unit_kerja'] = $this->unitKerjaModels->getUnitKerja($dok['pengupload']);
                $dok['approval'] = json_decode($dok['approval'], true);
            }else{
                unset($doks[$key]);
            }
        }
        return $res->withJson(['data'=>array_values($doks)]);
    }

    public function getOptionalDokumenTender(Request $req, Response $res, $args){
        $doks = $this->dokumenModels->getDokumenByTender($args['id_tender']);
        foreach ($doks as $key => &$dok){
            if($dok['dokumen_syarat'] == '0'){
                $dok['who'] = $this->userModels->getUserDetail($dok['pengupload']);
                $dok['who']['unit_kerja'] = $this->unitKerjaModels->getUnitKerjaByUser($dok['pengupload'], $args['id_tender']);
                $dok['approval'] = json_decode($dok['approval'], true);
            }else{
                unset($doks[$key]);
            }
        }
        return $res->withJson(['data'=>array_values($doks)]);
    }


    public function getDokumenTender(Request $req, Response $res, $args){
        $doks = $this->dokumenModels->getDokumenByTender($args['id_tender']);
        foreach ($doks as &$dok){
            $dok['who'] = $this->userModels->getUserDetail($dok['pengupload']);
            $dok['approval'] = json_decode($dok['approval'], true);
        }
        return $res->withJson(['data'=>$doks]);
    }

    public function countDokumenTender(Request $req, Response $res, $args){
        $count = $this->dokumenModels->countDokumenTender($args['id_tender'], 1);
        return $res->withJson($count);
    }

    public function deleteDokumenTender(Request $req, Response $res, $args){
        if($this->dokumenModels->deleteDokumenReq($args['id_dokumen'])){
            return $res->withJson([
                "status"=>"success"
            ]);
        }
    }

    public function setDokumenTender(Request $req, Response $res, $args){
        $files = $req->getUploadedFiles();
        $result = [];
        if(!isset( $_POST['nama_dokumen'] )){
            if(array_key_exists("dokReq", $files)){
                foreach ($files['dokReq'] as $id_dokumen => $file){
                    $fileinfo = pathinfo($file->getClientFilename());
                    $filename = $fileinfo['filename'].'_'.time().'.'.$fileinfo['extension'];
                    $data = [
                        "file_dokumen"=>$filename,
                        "tgl_upload"=>date ("Y-m-d H:i:s"),
                        "pengupload"=>$req->getAttribute ('active_user_data')[ 'id_user' ],
                        "approval"=>json_encode([
                            "direktur"=>[
                                "status"=>"",
                                "waktu"=>""
                            ],
                            "manajer"=>[
                                "status"=>"",
                                "waktu"=>"",
                            ]
                        ])
                    ];
                    if($this->dokumenModels->setDokumenTender($data, $id_dokumen)){
                        $file->moveTo("public/content/dokumen/".$filename);
                        $result = [
                            "status"=>"success"
                        ];
                    }
                }
            }
        }else{
            if(array_key_exists("dokOpt", $files)){
                foreach ($files['dokOpt'] as $id_dokumen => $file){
                    if($id_dokumen == 0){
                        $fileinfo = pathinfo($file->getClientFilename());
                        $filename = $fileinfo['filename'].'_'.time().'.'.$fileinfo['extension'];
                        $data = [
                            "id_tender"=>$_POST['id_tender'],
                            "nama_dokumen"=>$_POST['nama_dokumen'],
                            "file_dokumen"=>$filename,
                            "tgl_upload"=>date ("Y-m-d H:i:s"),
                            "pengupload"=>$req->getAttribute ('active_user_data')[ 'id_user' ],
                            "approval"=>json_encode([
                                "direktur"=>[
                                    "status"=>"",
                                    "waktu"=>""
                                ],
                                "manajer"=>[
                                    "status"=>"",
                                    "waktu"=>"",
                                ]
                            ])
                        ];
                        if($this->dokumenModels->setDokumenTender($data)){
                            $file->moveTo("public/content/dokumen/".$filename);
                            $result = [
                                "status"=>"success"
                            ];
                        }
                    }
                }
            }
        }
        return $res->withJson($result);
    }

}