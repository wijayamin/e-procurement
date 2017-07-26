<?php
/**
 * Copyright (c) 2017.
 */

/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 23/07/2017
 * Time: 18.38
 */

namespace ryan\controllers;

use \Slim\Http\Request;
use \Slim\Http\Response;

class usersMan extends \ryan\main{

    protected $container;
    protected $userModels;

    public function __construct ($container) {
        parent::__construct($container);
        $this->userModels = new \ryan\models\users($container);
    }

    public function users_get(Request $req, Response $res, $args){
        $users = $this->userModels->getUser();
        foreach ($users as &$user){
            unset($user['password']);
            unset($user['token']);
        }
        return $res->withJson(['data'=>$users]);
    }

    public function users_daftar(Request $req, Response $res, $args){
        return $this->view->render ("users/daftar", $req->getAttributes());
    }

    public function users_profile(Request $req, Response $res, $args){
        $user = $this->userModels->getUser($req->getAttribute ('active_user_data')[ 'id_user' ]);
        $req = $req->withAttribute ('user', $user);
        return $this->view->render ("users/profile", $req->getAttributes());
    }

    public function user_updateCommon(Request $req, Response $res, $args){
        $files = $req->getUploadedFiles();
        $data = [
            'nama'=>$_POST['nama'],
            'tanggal_lahir'=>$_POST['tanggal_lahir'],
            'alamat'=>$_POST['alamat']
        ];
        if(!empty($files)){
            $file = $files['image'];
            $fileinfo = pathinfo($file->getClientFilename());
            $data['image'] = $fileinfo['filename'].'_'.time().'.'.$fileinfo['extension'];
            if($this->userModels->setUser($data, $_POST['id_user'])){
                $file->moveTo("public/profile/".$data['image']);
                return $res->withJson([
                    'status'=>'success'
                ]);
            }
        }else{
            if($this->userModels->setUser($data, $_POST['id_user'])){
                return $res->withJson([
                    'status'=>'success'
                ]);
            }
        }
    }
    public function user_updatePassword(Request $req, Response $res, $args){
        $user = $this->userModels->getUser($_POST['id_user']);
        if(isset($_POST['old_password']) and md5($_POST['old_password']) == $user['password']){
            if(isset($_POST['new_password']) and isset($_POST['re_password']) and $_POST['new_password'] == $_POST['re_password']){
                $data = [
                    'password'=>md5($_POST['new_password'])
                ];
                if($this->userModels->setUser($data, $_POST['id_user'])){
                    return $res->withJson([
                        'status'=>'success'
                    ]);
                }
            }else{
                return $res->withJson([
                    'status'=>'failed',
                    'reason'=>'Password baru dan ulangi password tidak sama!'
                ]);
            }
        }else{
            return $res->withJson([
                'status'=>'failed',
                'reason'=>'Password lama salah!'
            ]);
        }
    }
}