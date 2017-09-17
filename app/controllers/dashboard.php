<?php
    /**
     * Created by PhpStorm.
     * User: wijaya
     * Date: 3/29/2017
     * Time: 02:11
     */

    namespace ryan\controllers;

    use \Slim\Container as Container;
    use \Slim\Http\Request as Req;
    use \Slim\Http\Response as Res;


    class dashboard extends \ryan\main{
        protected $container;
        protected $penyelenggaraModels;
        protected $tenderModels;
        protected $userModels;
        protected $notifikasiModels;
        protected $dokumenModels;
        protected $unitkerjaModels;

        public function __construct (Container $container) {
            parent::__construct ($container);
            $this->container = $container;
            $this->userModels = new \ryan\models\users($container);
            $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
            $this->tenderModels = new \ryan\models\tender($container);
            $this->notifikasiModels = new \ryan\models\notifikasi($container);
            $this->dokumenModels = new \ryan\models\dokumenTender($container);
            $this->unitkerjaModels = new \ryan\models\unitKerja($container);
        }

        public function homePage (Req $req, Res $res, $args) {
            $this->view->registerFunction ('getNamaPenyelenggara', function ($id_penyelenggara) {
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara ($id_penyelenggara);
                return $penyelenggara[ 'nama_penyelenggara' ];
            });
            $this->view->registerFunction ('getUnitKerja', function ($id_tender) {
                $unitKerja = $this->unitkerjaModels->getUnitKerjaByTender($id_tender);
                foreach ($unitKerja as &$unit){
                    $unit['user'] = $this->userModels->getUserDetail($unit['id_user']);
                }
                return $unitKerja;
            });
            $this->view->registerFunction ('getDokumenkelengkapan', function ($id_tender) {
                $dokumen = $this->dokumenModels->getDokumenByTender($id_tender);
                foreach ($dokumen as &$dok){
                    $dok['approval'] = json_decode($dok['approval'], true);
                }
                return $dokumen;
            });
            $this->view->registerFunction ('getProgress', function ($id_tender) {
                $progress = 0;
                $process = '';
                $tender = $this->tenderModels->getBeritaTender($id_tender);
                $tender_approval = json_decode($tender['approval'], true);
                if($tender_approval['direktur']['status'] == 'diterima' && $tender_approval['manajer']['status'] == 'diterima'){
                    $process = 'Menuggu Dokumen';
                    $progress = 50;
                }elseif($tender_approval['direktur']['status'] == '' && $tender_approval['manajer']['status'] == ''){
                    $process = 'Menuggu Approval';
                    $progress = 0;
                }elseif($tender_approval['direktur']['status'] == 'diterima' && $tender_approval['manajer']['status'] != 'diterima'){
                    $process = 'Menuggu Approval Manajer';
                    $progress = 25;
                }elseif($tender_approval['direktur']['status'] != 'diterima' && $tender_approval['manajer']['status'] == 'diterima'){
                    $process = 'Menuggu Approval Direktur';
                    $progress = 25;
                }
                $count_dokumen = $this->dokumenModels->countDokumenReqDetail($id_tender);
                $progress=$progress+(($count_dokumen['total'] ? ($count_dokumen['uploaded']/$count_dokumen['total']) : 0)*25);
                $progress=$progress+(($count_dokumen['total'] ? ($count_dokumen['approved']/$count_dokumen['total']) : 0)*25);
                if($progress == 100){
                    $process = 'Semua Proses Selesai';
                }
                return [
                    'process'=>$process,
                    'progress'=>$progress
                ];
            });
            $beritaTender = $this->tenderModels->getBeritaTender ();
            $req = $req->withAttribute ('beritaTender', $beritaTender);
            return $this->view->render ("login2", $req->getAttributes());
        }

        public function dashboardPage(Req $req, Res $res, $args){
            $this->view->registerFunction ('getNamaPenyelenggara', function ($id_penyelenggara) {
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara ($id_penyelenggara);
                return $penyelenggara[ 'nama_penyelenggara' ];
            });
            $this->view->registerFunction ('getProgress', function ($id_tender) {
                $progress = 0;
                $tender = $this->tenderModels->getBeritaTender($id_tender);
                $tender_approval = json_decode($tender['approval'], true);
                if($tender_approval['direktur']['status'] == 'diterima' && $tender_approval['manajer']['status'] == 'diterima'){
                    $process = 'Menuggu Dokumen';
                    $progress = 50;
                }elseif($tender_approval['direktur']['status'] == '' && $tender_approval['manajer']['status'] == ''){
                    $process = 'Menuggu Approval';
                    $progress = 0;
                }elseif($tender_approval['direktur']['status'] == 'diterima' && $tender_approval['manajer']['status'] != 'diterima'){
                    $process = 'Menuggu Approval Manajer';
                    $progress = 25;
                }elseif($tender_approval['direktur']['status'] != 'diterima' && $tender_approval['manajer']['status'] == 'diterima'){
                    $process = 'Menuggu Approval Direktur';
                    $progress = 25;
                }
                $count_dokumen = $this->dokumenModels->countDokumenReqDetail($id_tender);
                $progress=$progress+(($count_dokumen['total'] ? ($count_dokumen['uploaded']/$count_dokumen['total']) : 0)*25);
                $progress=$progress+(($count_dokumen['total'] ? ($count_dokumen['approved']/$count_dokumen['total']) : 0)*25);
                if($progress == 100){
                    $process = 'Semua Proses Selesai';
                }
                return [
                    'process'=>$process,
                    'progress'=>$progress
                ];
            });
            $beritaTender = $this->tenderModels->getBeritaTender ();
            $req = $req->withAttribute ('beritaTender', $beritaTender);
            return $this->view->render("dashboard", $req->getAttributes());
        }

    }