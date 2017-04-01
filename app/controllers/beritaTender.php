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

        public function __construct (Container $container) {
            parent::__construct ($container);
            $this->container = $container;
            $this->userModels = new \ryan\models\users($container);
            $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
            $this->tenderModels = new \ryan\models\tender($container);
            $this->notifikasiModels = new \ryan\models\notifikasi($container);
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
                ];
                $insert = $this->tenderModels->addBeritaTender ($data);
                if ($insert) {
                    $this->notifikasiModels->addNotification ([
                        "id_user" => $req->getAttribute ('active_user_data')[ 'id_user' ],
                        "tentang" => 'Telah Menambah Berita Tender Baru "' . $data[ 'judul_tender' ] . '"',
                        "waktu" => date ("Y-m-d H:i:s"),
                        "meta" => $this->router->pathFor ('detailBeritaTender', ['id_tender' => $insert])
                    ]);

                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('detailBeritaTender'));
                }
            }
        }

        public function daftarBeritaTender (Req $req, Res $res, $args) {
            if ($req->isGet ()) {
                $this->view->registerFunction ('getNamaPenyelenggara', function ($id_penyelenggara) {
                    $penyelenggara = $this->penyelenggaraModels->getPenyelenggara ($id_penyelenggara);

                    return $penyelenggara[ 'nama_penyelenggara' ];
                });
                $beritaTender = $this->tenderModels->getBeritaTender ();
                $req = $req->withAttribute ('beritaTender', $beritaTender);

                return $this->view->render ("berita-tender/get", $req->getAttributes ());
            }
        }

        public function detailBeritaTender (Req $req, Res $res, $args) {
            if ($req->isGet ()) {
                $this->view->registerFunction ('getNamaPenyelenggara', function ($id_penyelenggara) {
                    $penyelenggara = $this->penyelenggaraModels->getPenyelenggara ($id_penyelenggara);

                    return $penyelenggara[ 'nama_penyelenggara' ];
                });
                $this->view->registerFunction ('getUserUpload', function ($id_user) {
                    $user = $this->userModels->getUserDetail ($id_user);

                    return $user;
                });
                $beritaTender = $this->tenderModels->getBeritaTender ($args[ 'id_tender' ]);
                $req = $req->withAttribute ('tender', $beritaTender);

                return $this->view->render ("berita-tender/detail", $req->getAttributes ());
            }
        }
    }