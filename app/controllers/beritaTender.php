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
        }

        public function tambahBeritaTender (Req $req, Res $res, $args) {
            if ($req->isGet ()) {
                return $this->view->render ("berita-tender/insert", $req->getAttributes ());
            } else {
                $data = [
                    'id_penyelenggara' => $_POST[ 'id_penyelenggara' ],
                    'id_user' => $req->getAttribute ('active_user_data')[ 'id_user' ],
                    'judul_tender' => $_POST[ 'judul_tender' ],
                    'link_website' => $_POST[ 'link_website' ],
                    'wilayah' => $_POST[ 'wilayah' ],
                    'upload' => implode ('|', $_POST[ 'upload' ]),
                    'tgl_mulai' => $_POST[ 'tgl_mulai' ],
                    'tgl_selesai' => $_POST[ 'tgl_selesai' ],
                    'tgl_upload' => date ("Y-m-d H:i:s"),
                    'approval'=>json_encode([
                        'direktur'=>[
                            'status'=>'',
                            'waktu'=>''
                        ],
                        'manajer'=>[
                            'status'=>'',
                            'waktu'=>''
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
                    foreach ($_POST['upload'] as $dokumen){
                        $dataDok = [
                            'id_tender'=>$insert,
                            'nama_dokumen'=>$dokumen,
                            'dokumen_syarat'=>'1'
                        ];
                        $insertDok = $this->dokumenModels->setDokumenTender($dataDok);
                    }
                    $this->notifikasiModels->sendNotificationByPreviledge(['1', '2', '3'], [
                        "by_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                        "tentang" => 'Menambahkan berita tender baru: "' . $data[ 'judul_tender' ] . '"',
                        "waktu" => date ("Y-m-d H:i:s"),
                        "meta" => $this->router->pathFor ('beritaTender_detail', ['id_tender' => $insert])
                    ]);

                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('beritaTender_detail', ['id_tender'=>$insert]));
                }
            }
        }
        public function beritaTender_edit (Req $req, Res $res, $args) {
            if ($req->isGet ()) {
                $beritaTender = $this->tenderModels->getBeritaTender($args['id_tender']);
                $req = $req->withAttribute ('tender', $beritaTender);
                return $this->view->render ("berita-tender/edit", $req->getAttributes ());
            } else {
                $tender = $this->tenderModels->getBeritaTender($args['id_tender']);
                $tender['rks'] = json_decode($tender['rks'], true);
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
                $data = [
                    'id_penyelenggara' => $_POST[ 'id_penyelenggara' ],
                    'judul_tender' => $_POST[ 'judul_tender' ],
                    'link_website' => $_POST[ 'link_website' ],
                    'wilayah' => $_POST[ 'wilayah' ],
                    'tgl_mulai' => $_POST[ 'tgl_mulai' ],
                    'tgl_selesai' => $_POST[ 'tgl_selesai' ],
                    'approval'=>json_encode([
                        'direktur'=>[
                            'status'=>'',
                            'waktu'=>''
                        ],
                        'manajer'=>[
                            'status'=>'',
                            'waktu'=>''
                        ]
                    ]),
                    'rks'=>json_encode($tender['rks']),
                ];
                if($this->tenderModels->setBeritaTender($data, $args['id_tender'])){
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
                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('beritaTender_detail', ['id_tender'=>$args['id_tender']]));
                }
            }
        }

        public function daftarBeritaTender (Req $req, Res $res, $args) {
            $route = $req->getAttribute('route');
            $this->view->registerFunction ('getNamaPenyelenggara', function ($id_penyelenggara) {
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara ($id_penyelenggara);
                return $penyelenggara[ 'nama_penyelenggara' ];
            });
            $beritaTender = $this->tenderModels->getBeritaTender ();
            $req = $req->withAttribute ('beritaTender', $beritaTender);
            $req = $req->withAttribute ('approval', $route->getName() == 'beritaTender_daftarApproval');
            return $this->view->render ("berita-tender/daftar", $req->getAttributes ());
        }

        public function detailBeritaTender (Req $req, Res $res, $args) {
            $route = $req->getAttribute('route');
            $this->view->registerFunction ('getNamaPenyelenggara', function ($id_penyelenggara) {
                return $this->penyelenggaraModels->getPenyelenggara ($id_penyelenggara)[ 'nama_penyelenggara' ];
            });
            $this->view->registerFunction ('getUserUpload', function ($id_user) {
                return $this->userModels->getUserDetail ($id_user);
            });
            $this->view->registerFunction ('getDirektur', function () {
                return $this->userModels->getDirektur();
            });
            $this->view->registerFunction ('getManajer', function () {
                return $this->userModels->getManajer();
            });
            $beritaTender = $this->tenderModels->getBeritaTender ($args[ 'id_tender' ]);
            $beritaTender['dokumen_syarat'] = $this->dokumenModels->getDokumenByTender($args[ 'id_tender' ]);
            $beritaTender['unit_kerja'] = $this->unitkerjaModels->getUnitKerjaByTender($args[ 'id_tender' ]);
            $req = $req->withAttribute ('tender', $beritaTender);
            $req = $req->withAttribute ('menu', ['tender'=>['detail']]);
            $req = $req->withAttribute ('approval', $route->getName() == 'beritaTender_detailApproval');
            return $this->view->render ("berita-tender/detail", $req->getAttributes ());
        }

        public function approvalBeritaTender(Req $req, Res $res, $args){
            $tender = $this->tenderModels->getBeritaTender($args['id_tender']);
            $tender['approval'] = json_decode($tender['approval'], true);
            $tender['approval'][$_POST['who']]['status'] = $_POST['status'];
            $tender['approval'][$_POST['who']]['waktu'] = date("Y-m-d H:i:s");
            $data = [
                'approval'=>json_encode($tender['approval'])
            ];
            if($this->tenderModels->updateBeritaTender($args['id_tender'], $data)){
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