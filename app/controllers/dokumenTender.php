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

    public function __construct(Container $container) {
        parent::__construct($container);
        $this->container = $container;
        $this->userModels = new \ryan\models\users($container);
        $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
        $this->tenderModels = new \ryan\models\tender($container);
        $this->notifikasiModels = new \ryan\models\notifikasi($container);
    }

    public function daftarBeritaTender(Request $req, Response $res, $args){
        if ($req->isGet ()) {
            $this->view->registerFunction ('getNamaPenyelenggara', function ($id_penyelenggara) {
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara ($id_penyelenggara);

                return $penyelenggara[ 'nama_penyelenggara' ];
            });
            $beritaTender = $this->tenderModels->getBeritaTender ();
            $req = $req->withAttribute ('beritaTender', $beritaTender);

            return $this->view->render ("dokumen/daftar-berita", $req->getAttributes ());
        }
    }

}