<?php
/**
 * Copyright (c) 2017. 
 */

/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 19/07/2017
 * Time: 14.10
 */

namespace ryan\controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class dokumenMaster extends \ryan\main{

    protected $container;
    protected $dokumenMasterModels;
    protected $userModels;

    public function __construct($container) {
        parent::__construct($container);
        $this->container = $container;
        $this->dokumenMasterModels = new \ryan\models\dokumenMaster($container);
        $this->userModels = new \ryan\models\users($container);
    }

    public function dokumenMaster_daftar(Request $req, Response $res, $args){
        $this->view->registerFunction('getUserUpload', function($id_user){
            $user = $this->userModels->getUserDetail($id_user);
            return $user;
        });
        $listDokumen = $this->dokumenMasterModels->getDokumenMaster();
        $req = $req->withAttribute ('dokumenMaster', $listDokumen);
        return $this->view->render ("dokumen-master/daftar", $req->getAttributes ());
    }

    public function dokumenMaster_get(Request $req, Response $res, $args){
        if(isset($args['id_dokumen'])){
            $dokumen = $this->dokumenMasterModels->getDokumenMaster($args['id_dokumen']);
            $dokumen['meta'] = json_decode($dokumen['meta'], true);
            return $res->withJson($dokumen);
        }else{
            $dokumens = $this->dokumenMasterModels->getDokumenMaster();
            foreach ($dokumens as &$dokumen){
                $dokumen['who'] = $this->userModels->getUserDetail($dokumen['diupload_oleh']);
            }
            return $res->withJson(['data'=>$dokumens]);
        }
    }
    public function dokumenMaster_delete(Request $req, Response $res, $args){
        if($this->dokumenMasterModels->deleteDokumenMaster($args['id_dokumen'])){
            return $res->withJson([
                'status'=>'success'
            ]);
        }
    }


    public function dokumenMaster_add(Request $req, Response $res, $args){
        $files = $req->getUploadedFiles();
        $file = $files['file_dokumen'];
        $fileinfo = pathinfo($file->getClientFilename());
        $file_dokumen = $fileinfo['filename'].'_'.time().'.'.$fileinfo['extension'];
        $data = [
            'nama_dokumen'=>implode('|', $_POST['nama_dokumen']),
            'file_dokumen'=>$file_dokumen,
            'diupload_oleh'=>$req->getAttribute ('active_user_data')[ 'id_user' ],
            'waktu'=>date ("Y-m-d H:i:s")
        ];
        if($this->dokumenMasterModels->setDokumenMaster($data)){
            $file->moveTo("public/content/dokumen/".$file_dokumen);
            return $res->withJson([
                'status'=>'success'
            ]);
        }
    }

    public function dokumenMaster_edit(Request $req, Response $res, $args){
        $files = $req->getUploadedFiles();
        $data = [
            'nama_dokumen'=>implode('|', $_POST['nama_dokumen']),
            'diupload_oleh'=>$req->getAttribute ('active_user_data')[ 'id_user' ],
            'waktu'=>date ("Y-m-d H:i:s")
        ];
        if(sizeof($files)){
            $file = $files['file_dokumen'];
            $fileinfo = pathinfo($file->getClientFilename());
            $file_dokumen = $fileinfo['filename'].'_'.time().'.'.$fileinfo['extension'];
            $data['file_dokumen'] = $file_dokumen;
            if($this->dokumenMasterModels->setDokumenMaster($data, $args['id_dokumen'])){
                $file->moveTo("public/content/dokumen/".$file_dokumen);
                return $res->withJson([
                    'status'=>'success'
                ]);
            }
        }else{
            if($this->dokumenMasterModels->setDokumenMaster($data, $args['id_dokumen'])){
                return $res->withJson([
                    'status'=>'success'
                ]);
            }
        }
    }

}