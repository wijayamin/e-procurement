<?php
/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 3/23/2017
 * Time: 20:30
 */

namespace ryan\controllers;


class admin extends \ryan\main{

    protected $container;
    protected $userModels;
    protected $penyelenggaraModels;
    protected $tenderModels;
    protected $notifikasiModels;

    public function __construct( $container ) {
        parent::__construct( $container );
        $this->container = $container;
        $this->userModels = new \ryan\models\users($container);
        $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
        $this->tenderModels = new \ryan\models\tender($container);
        $this->notifikasiModels = new \ryan\models\notifikasi($container);
    }

    public function dashboardPage($req, $res, $args){
//        return $this->view->render("admin/dashboard", $req->getAttributes());
        return $this->view->render("adminv2/dashboard", $req->getAttributes());
    }

    public function beritaTenderPage($req, $res, $args){
        return $this->view->render("adminv2/berita-tender", $req->getAttributes());
    }

    public function addBeritaTender($req, $res, $args){
        $data = [
            'id_penyelenggara'=>$_POST['id_penyelenggara'],
            'id_user'=>$req->getAttribute('active_user_data')['id_user'],
            'judul_tender'=>$_POST['judul_tender'],
            'link_website'=>$_POST['link_website'],
            'wilayah'=>$_POST['wilayah'],
            'upload'=>implode('|', $_POST['upload']),
            'tgl_mulai'=>$_POST['tgl_mulai'],
            'tgl_selesai'=>$_POST['tgl_selesai'],
            'tgl_upload'=>date("Y-m-d H:i:s"),
        ];
        $insert = $this->tenderModels->addBeritaTender($data);
        if($insert){
            $this->notifikasiModels->addNotification([
                "id_user" => $req->getAttribute('active_user_data')['id_user'],
                "tentang" => 'Telah Menambah Berita Tender Baru "'.$data['judul_tender'].'"',
                "waktu" => date("Y-m-d H:i:s"),
            ]);
            return $res->withJson($insert);
        }
    }

}
