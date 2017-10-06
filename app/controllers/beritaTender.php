<?php
    /**
     * Created by PhpStorm.
     * User: wijaya
     * Date: 3/29/2017
     * Time: 02:09
     */

    namespace ryan\controllers;

    use \Slim\Container as Container;
    use \Slim\Http\Request as Req;
    use \Slim\Http\Response as Res;

    class beritaTender extends \ryan\main {
        protected $container;
        protected $penyelenggaraModels;
        protected $tenderModels;
        protected $userModels;
        protected $notifikasiModels;
        protected $dokumenModels;
        protected $unitkerjaModels;
        protected $BOQModels;
        protected $historyModels;
        protected $dokumenMasterModels;

        public function __construct (Container $container) {
            parent::__construct ($container);
            $this->container = $container;
            $this->userModels = new \ryan\models\users($container);
            $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
            $this->tenderModels = new \ryan\models\tender($container);
            $this->notifikasiModels = new \ryan\models\notifikasi($container);
            $this->dokumenModels = new \ryan\models\dokumenTender($container);
            $this->unitkerjaModels = new \ryan\models\unitKerja($container);
            $this->BOQModels = new \ryan\models\BOQ($container);
            $this->historyModels = new \ryan\models\history($container);
            $this->dokumenMasterModels = new \ryan\models\dokumenMaster($container);
        }

        /**
         * Controller Tambah Berita Tender
         * GET  -> tampilkan halaman tambah berita tender
         * POST -> proses simpan berita tender
         * @param Req $req
         * @param Res $res
         * @param     $args
         * @return static
         */
        public function beritaTender_add (Req $req, Res $res, $args) {
            if ($req->isGet ()) {
                return $this->view->render ("berita-tender/insert", $req->getAttributes ());
            } else {
                $data = [
                    'id_penyelenggara' => $_POST[ 'id_penyelenggara' ],
                    'id_user' => $req->getAttribute ('active_user_data')[ 'id_user' ],
                    'judul_tender' => $_POST[ 'judul_tender' ],
                    'link_website' => $_POST[ 'link_website' ],
                    'wilayah' => $_POST[ 'wilayah' ],
                    'kualifikasi' => implode ('|', $_POST[ 'kualifikasi' ]),
                    'upload' => implode ('|', $_POST[ 'upload' ]),
                    'tgl_mulai' => $_POST[ 'tgl_mulai' ],
                    'tgl_selesai' => $_POST[ 'tgl_selesai' ],
                    'tgl_upload' => date ("Y-m-d H:i:s"),
                    'approval'=>json_encode([
                        'direktur'=>[
                            'status'=>($req->getAttribute ('active_user_data')[ 'previledge' ] == '2' ? 'diterima' : ''),
                            'waktu'=>($req->getAttribute ('active_user_data')[ 'previledge' ] == '2' ? date ("Y-m-d H:i:s") : '')
                        ],
                        'manajer'=>[
                            'status'=>($req->getAttribute ('active_user_data')[ 'previledge' ] == '3' ? 'diterima' : ''),
                            'waktu'=>($req->getAttribute ('active_user_data')[ 'previledge' ] == '3' ? date ("Y-m-d H:i:s") : '')
                        ]
                    ]),
                    'berita_acara'=>json_encode([
                        'file'=>'',
                        'waktu'=>'',
                        'approval'=>[
                            'direktur'=>[
                                'status'=>'',
                                'waktu'=>''
                            ],
                            'manajer'=>[
                                'status'=>'',
                                'waktu'=>''
                            ]
                        ]
                    ]),
                    'rks'=>json_encode([
                        'file'=>'',
                        'waktu'=>'',
                        'approval'=>[
                            'direktur'=>[
                                'status'=>'',
                                'waktu'=>''
                            ],
                            'manajer'=>[
                                'status'=>'',
                                'waktu'=>''
                            ]
                        ]
                    ])
                ];
                $insert = $this->tenderModels->addBeritaTender ($data);
                if ($insert) {
                    $this->historyModels->add_history($insert, $req->getAttribute ('active_user_data')[ 'id_user' ], 'i_tender', $insert);
                    foreach ($_POST['upload'] as $dokumen){
                        $dataDok = [
                            'id_tender'=>$insert,
                            'nama_dokumen'=>$dokumen,
                            'dokumen_syarat'=>'1'
                        ];
                        $dokMaster = $this->dokumenMasterModels->searchDokumenMaster($dokumen);
                        
                        if($dokMaster){
                            $dataDok['file_dokumen'] = $dokMaster['file_dokumen'];
                            $dataDok['tgl_upload'] = $dokMaster['waktu'];
                            $dataDok['pengupload'] = $dokMaster['diupload_oleh'];
                            $dataDok['approval'] = json_encode([
                                'direktur'=>[
                                    'status'=>($req->getAttribute ('active_user_data')[ 'previledge' ] == '2' ? 'diterima' : ''),
                                    'waktu'=>($req->getAttribute ('active_user_data')[ 'previledge' ] == '2' ? date ("Y-m-d H:i:s") : '')
                                ],
                                'manajer'=>[
                                    'status'=>($req->getAttribute ('active_user_data')[ 'previledge' ] == '3' ? 'diterima' : ''),
                                    'waktu'=>($req->getAttribute ('active_user_data')[ 'previledge' ] == '3' ? date ("Y-m-d H:i:s") : '')
                                ]
                            ]);
                        }
                        $insertDok = $this->dokumenModels->setDokumenTender($dataDok);
                    }
                    $this->notifikasiModels->sendNotificationByPreviledge(['1', '2', '3'], [
                        "by_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                        "tentang" => 'Menambahkan berita tender baru: "' . $data['judul_tender'] . '"',
                        "waktu" => date ("Y-m-d H:i:s"),
                        "meta" => $this->router->pathFor ('beritaTender_detail', ['id_tender' => $insert])
                    ]);
                    $direktur = $this->userModels->getDirektur();
                    $this->sendSMS($direktur['telefon'], 'Ada berita tender baru "' . $data['judul_tender'] . '" menunggu approval anda');
                    $manajer = $this->userModels->getManajer();
                    $this->sendSMS($manajer['telefon'], 'Ada berita tender baru "' . $data['judul_tender'] . '" menunggu approval anda');
                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('beritaTender_detail', ['id_tender'=>$insert]));
                }
            }
        }

        /**
         * Controler edit berita tender
         * GET  -> tampilkan halaman berita tender
         * POST -> proses simpan berita tender
         * @param Req $req
         * @param Res $res
         * @param     $args
         * @return static
         */
        public function beritaTender_edit (Req $req, Res $res, $args) {
            if ($req->isGet ()) {
                $beritaTender = $this->tenderModels->getBeritaTender($args['id_tender']);
                $req = $req->withAttribute ('tender', $beritaTender);
                return $this->view->render ("berita-tender/edit", $req->getAttributes ());
            } else {
                $tender = $this->tenderModels->getBeritaTender($args['id_tender']);
                $tender['rks'] = json_decode($tender['rks'], true);
                $data = [
                    'id_penyelenggara' => $_POST[ 'id_penyelenggara' ],
                    'judul_tender' => $_POST[ 'judul_tender' ],
                    'link_website' => $_POST[ 'link_website' ],
                    'kualifikasi' => implode ('|', $_POST[ 'kualifikasi' ]),
                    'wilayah' => $_POST[ 'wilayah' ],
                    'tgl_mulai' => $_POST[ 'tgl_mulai' ],
                    'tgl_selesai' => $_POST[ 'tgl_selesai' ],
                    'approval'=>json_encode([
                        'direktur'=>[
                            'status'=>($req->getAttribute ('active_user_data')[ 'previledge' ] == '2' ? 'diterima' : ''),
                            'waktu'=>($req->getAttribute ('active_user_data')[ 'previledge' ] == '2' ? date ("Y-m-d H:i:s") : '')
                        ],
                        'manajer'=>[
                            'status'=>($req->getAttribute ('active_user_data')[ 'previledge' ] == '3' ? 'diterima' : ''),
                            'waktu'=>($req->getAttribute ('active_user_data')[ 'previledge' ] == '3' ? date ("Y-m-d H:i:s") : '')
                        ]
                    ]),
                ];
                if($tender['rks'] and array_key_exists('file', $tender['rks'])){
                    $tender['rks']['approval'] = [
                        'direktur'=>[
                            'status'=>'',
                            'waktu'=>''
                        ],
                        'manajer'=>[
                            'status'=>'',
                            'waktu'=>''
                        ]
                    ];
                    $data['rks'] = json_encode($tender['rks']);
                }
                if($this->tenderModels->setBeritaTender($data, $args['id_tender'])){
                    $this->historyModels->add_history($args['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'e_tender', $args['id_tender']);
                    foreach($this->BOQModels->getBOQByTender($args['id_tender']) as $boq){
                        $this->BOQModels->setBOQ(['approval'=>''], $boq['id_penawaran']);
                        echo 'lala';
                    }
                    foreach ($this->dokumenModels->getDokumenByTender($args['id_tender']) as $dok){
                        echo 'lala';
                        if($dok['approval']){
                            $approval = json_encode([
                                'direktur'=>[
                                    'status'=>'',
                                    'waktu'=>''
                                ],
                                'manajer'=>[
                                    'status'=>'',
                                    'waktu'=>''
                                ]
                            ]);
                            $this->dokumenModels->setDokumenTender(['approval'=>$approval], $dok['id_dokumen']);
                        }
                    }
                    $this->notifikasiModels->sendNotificationByPreviledge(['2', '3'], [
                        "by_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                        "tentang" => 'Mengubah Berita Tender "' . $data['judul_tender'] . '". Anda perlu melakukan approval Berita Tender, RKS, BOQ, dan Dokumen Tender kembali',
                        "waktu" => date ("Y-m-d H:i:s"),
                        "meta" => $this->router->pathFor ('beritaTender_detailApproval', ['id_tender' => $args['id_tender']])
                    ]);
                    $direktur = $this->userModels->getDirektur();
                    $this->sendSMS($direktur['telefon'], 'Berita tender "' . $data['judul_tender'] . '" telah dirubah mohon melakukan approval ulang');
                    $manajer = $this->userModels->getManajer();
                    $this->sendSMS($manajer['telefon'], 'Berita tender "' . $data['judul_tender'] . '" telah dirubah mohon melakukan approval ulang');
                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('beritaTender_detail', ['id_tender'=>$args['id_tender']]));
                }
            }
        }

        /**
         * Controller hapus berita tender
         * (set kolom deleted berita tender dengan value 1)
         * @param Req $req
         * @param Res $res
         * @param     $args
         * @return static
         */
        public function beritaTender_delete (Req $req, Res $res, $args) {
            if(isset($_POST['id_tender'])){
                $this->historyModels->add_history($_POST['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'd_tender', $_POST['id_tender']);
                if($this->tenderModels->updateBeritaTender($_POST['id_tender'], ['deleted'=>'1'])){
                    return $res->withJson([
                       'status'=>'success'
                    ]);
                }
            }
        }

        /**
         * Controller tampilkan daftar berita tender
         * (daftar berita tender dengan value deleted = 0)
         * @param Req $req
         * @param Res $res
         * @param     $args
         * @return mixed
         */
        public function beritaTender_daftar (Req $req, Res $res, $args) {
            $route = $req->getAttribute('route');
//            $this->view->registerFunction ('getNamaPenyelenggara', function ($id_penyelenggara) {
//                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara ($id_penyelenggara);
//                return $penyelenggara[ 'nama_penyelenggara' ];
//            });
            $beritaTender = $this->tenderModels->getBeritaTender ();
            $req = $req->withAttribute ('beritaTender', $beritaTender);
            $req = $req->withAttribute ('approval', $route->getName() == 'beritaTender_daftarApproval');
            return $this->view->render ("berita-tender/daftar", $req->getAttributes ());
        }

        /**
         * Controller halaman  detail berita tender
         * @param Req $req
         * @param Res $res
         * @param     $args
         * @return mixed
         */
        public function beritaTender_detail (Req $req, Res $res, $args) {
            $route = $req->getAttribute('route');
//            $this->view->registerFunction ('getNamaPenyelenggara', function ($id_penyelenggara) {
//                return $this->penyelenggaraModels->getPenyelenggara ($id_penyelenggara)[ 'nama_penyelenggara' ];
//            });
//            $this->view->registerFunction ('getUserUpload', function ($id_user) {
//                return $this->userModels->getUserDetail ($id_user);
//            });
            $this->view->registerFunction ('getDirektur', function () {
                return $this->userModels->getDirektur();
            });
            $this->view->registerFunction ('getManajer', function () {
                return $this->userModels->getManajer();
            });
            $beritaTender = $this->tenderModels->getBeritaTender ($args[ 'id_tender' ]);
            $beritaTender['dokumen_syarat'] = $this->dokumenModels->getDokumenByTender($args[ 'id_tender' ]);
            $beritaTender['unit_kerja'] = $this->unitkerjaModels->getUnitKerjaByTender($args[ 'id_tender' ]);
            $beritaTender['last_edit'] = $this->historyModels->getLastEditTender($args[ 'id_tender' ]);
            $beritaTender['history'] = $this->beritaTender_getHistory($args['id_tender']);
            $req = $req->withAttribute ('tender', $beritaTender);
            $req = $req->withAttribute ('menu', ['tender'=>['detail']]);
            $req = $req->withAttribute ('approval', $route->getName() == 'beritaTender_detailApproval');
            return $this->view->render ("berita-tender/detail", $req->getAttributes ());
        }

        /**
         * Controller approval berita tender
         * @param Req $req
         * @param Res $res
         * @param     $args
         * @return static
         */
        public function beritaTender_approval(Req $req, Res $res, $args){

            $tender = $this->tenderModels->getBeritaTender($args['id_tender']);
            $tender['approval'] = json_decode($tender['approval'], true);
            $tender['approval'][$_POST['who']]['status'] = $_POST['status'];
            $tender['approval'][$_POST['who']]['waktu'] = date("Y-m-d H:i:s");
            $data = [
                'approval'=>json_encode($tender['approval'])
            ];
            if($this->tenderModels->updateBeritaTender($args['id_tender'], $data)){
                $this->historyModels->add_history($args['id_tender'], $req->getAttribute ('active_user_data')[ 'id_user' ], 'a_tender', $args['id_tender'], $_POST['status']);
                return $res->withJson([
                    "status"=>"success"
                ]);
            }else{
                return $res->withJson([
                    "status"=>"failed"
                ]);
            }
        }

        /**
         * API daftar history
         * @param Req $req
         * @param Res $res
         * @param     $args
         * @return static
         */
        public function beritaTender_getHistory($id_tender){
            $histories = $this->historyModels->get_history($id_tender);
            foreach($histories as &$history){
                switch ($history['perubahan']){
                    case 'i_tender':
                    case 'e_tender':
                    case 'a_tender':
                    case 'd_tender':
                    case 'i_rks':
                    case 'e_rks':
                    case 'a_rks':
                    case 'i_acara':
                    case 'e_acara':
                        $history['detail'] = $this->tenderModels->getBeritaTender($history['id_perubahan']);
                        break;
                    case 'i_unit':
                    case 'd_unit':
                        $history['detail'] = $this->unitkerjaModels->getUnitKerja($history['id_perubahan']);
                        $history['extra'] = $this->unitkerjaModels->getUnitKerja($history['id_perubahan']);
                        break;
                    case 'i_dok':
                    case 'u_dok':
                    case 'e_dok':
                    case 'd_dok':
                    case 'a_dok':
                        $history['detail'] = $this->dokumenModels->getDokumenTender($history['id_perubahan']);
                        $history['extra'] = $this->dokumenModels->getDokumenTender($history['id_perubahan']);
                        break;
                    case 'i_boq':
                    case 'e_boq':
                    case 'd_boq':
                    case 'a_boq':
                        $history['detail'] = $this->BOQModels->getBOQ($history['id_perubahan']);
                        $history['extra'] = $this->BOQModels->getBOQ($history['id_perubahan']);
                        break;
                }
            }
            return $histories;
            unset($history);
        }
    }