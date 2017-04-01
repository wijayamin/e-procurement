<?php
    /**
     * Created by PhpStorm.
     * User: wijaya
     * Date: 3/27/2017
     * Time: 04:26
     */

    namespace ryan\controllers;


    use \Slim\Container as Container;
    use \Slim\Http\Request as Req;
    use \Slim\Http\Response as Res;

    class api extends \ryan\main {
        protected $container;
        protected $userModels;
        protected $penyelenggaraModels;
        protected $dokumenMasterModels;
        protected $tenderModels;

        public function __construct ($container) {
            parent::__construct ($container);
            $this->container = $container;
            $this->userModels = new \ryan\models\users($container);
            $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
            $this->dokumenMasterModels = new \ryan\models\dokumenMaster($container);
            $this->tenderModels = new \ryan\models\tender($container);
        }

        public function addPenyelenggara ($req, $res, $args) {
            $nama = $_POST[ 'nama' ];
            $alamat = $_POST[ 'alamat' ];
            $penyelenggara = $this->penyelenggaraModels->addPenyelenggara ([
                "nama" => $nama,
                "alamat" => $alamat
            ]);
            if ($penyelenggara) {
                return $res->withJson ([
                    "status" => 'success',
                    "data" => $penyelenggara
                ]);
            } else {
                return $res->withJson ([
                    "status" => 'failed'
                ]);
            }
        }

        public function getPenyelenggara ($req, $res, $args) {
            if (isset($args[ 'id' ])) {
                return $res->withJson ($this->penyelenggaraModels->getPenyelenggara (args[ 'id' ]));
            } else {
                return $res->withJson ($this->penyelenggaraModels->getPenyelenggara ());
            }
        }

        public function getDokumenMaster ($req, $res, $args) {
            if (isset($args[ 'id' ])) {
                return $res->withJson ($this->dokumenMasterModels->getDokumenMaster ($args[ 'id' ]));
            } else {
                return $res->withJson ($this->dokumenMasterModels->getDokumenMaster ());
            }
        }

        public function getDokumenList (Req $req, Res $res, $args){
            if (isset($args[ 'id' ])) {
//                return $res->withJson ($this->dokumenMasterModels->getDokumenMaster ($args[ 'id' ]));
            } else {
                return $res->withJson ($this->tenderModels->getDokumenPersyaratanTender());
            }
        }

        public function getDetailTender(Req $req, Res $res, $args){
            if (isset($args[ 'id' ])) {
                $dataTender = $this->tenderModels->getBeritaTender ($args[ 'id' ]);
                $dataTender['penyelenggara'] = $this->penyelenggaraModels->getPenyelenggara($dataTender['id_penyelenggara']);
                return $res->withJson ($dataTender);
            } else {
                return $res->withJson ($this->tenderModels->getBeritaTender());
            }
        }
    }