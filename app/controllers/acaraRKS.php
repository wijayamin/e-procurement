<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 4/4/2017
 * Time: 10:07 PM
 */

namespace ryan\controllers;


use \Slim\Container as Container;
use \Slim\Http\Request as Req;
use \Slim\Http\Response as Res;


class acaraRKS extends \ryan\main {

    protected $container;
    protected $penyelenggaraModels;
    protected $tenderModels;
    protected $userModels;
    protected $notifikasiModels;

    public function __construct (Container $container) {
        parent::__construct ($container);
        $this->container = $container;
        $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
        $this->tenderModels = new \ryan\models\tender($container);
        $this->userModels = new \ryan\models\users($container);
        $this->notifikasiModels = new \ryan\models\notifikasi($container);
    }

    public function beritaTenderRKS(Req $req, Res $res, $args){
        if($req->isGet()){
            $this->view->registerFunction('getNamaPenyelenggara', function($id_penyelenggara){
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                return $penyelenggara['nama_penyelenggara'];
            });
            $beritaTender = $this->tenderModels->getBeritaTender();
            $req = $req->withAttribute('beritaTender', $beritaTender);
            return $this->view->render ("rks-acara/rks/daftar-berita", $req->getAttributes ());
        }
    }

    public function detailBeritaTenderRKS(Req $req, Res $res, $args){
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
            return $this->view->render ("rks-acara/rks/detail-berita", $req->getAttributes ());
        }
    }
}