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
use \GuzzleHttp\Psr7;
use \GuzzleHttp\Client;

class usersMan extends \ryan\main{

    protected $container;
    protected $userModels;

    public function __construct ($container) {
        parent::__construct($container);
        $this->userModels = new \ryan\models\users($container);
    }

    public function users_get(Request $req, Response $res, $args){
        $users = $this->userModels->getUserDetail();
        foreach ($users as $key => &$user){
            unset($user['password']);
            unset($user['token']);
            unset($user['smscode']);
        }
        return $res->withJson(['data'=>$users]);
    }

    public function users_daftar(Request $req, Response $res, $args){
        return $this->view->render ("users/daftar", $req->getAttributes());
    }

    public function users_invite(Request $req, Response $res, $args){
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $path = 'http://'. $req->getHeader('Host')[0] . $this->router->pathFor ('signUpPage', ['token'=>$token]);
        if(isset($_POST['email']) && isset($_POST['previledge'])){
            $req = $req->withAttribute ('path', $path);
            $req = $req->withAttribute ('who', $req->getAttribute('active_user_data')['nama']);
            $req = $req->withAttribute ('jabatan', $_POST['jabatan']);
            $data = [
                'email'=>$_POST['email'],
                'previledge'=>$_POST['previledge'],
                'jabatan'=>$_POST['jabatan'],
                'token'=>$token
            ];
            $insert = $this->userModels->setUser($data);
            if($insert){
                $uri = $req->getUri();
                $client = new Client([
                    'base_uri' => 'http://capi-mailer.appspot.com/',
                    'timeout'  => 2.0,
                ]);
                $response = $client->request('POST', 'http://capi-mailer.appspot.com/appspot/no_reply', [
                    'headers' => [
                        'X-CAPI-AUTH' => '$2y$10$MsVKU9Eym.muyQA4KwPdguSzGnW8k2WMUubgqRAkr4W9OguJgY8hC'
                    ],
                    'form_params'=>[
                        'send_to'=>$_POST['email'],
                        'subject'=> 'Undangan penggunaan aplikasi',
                        'message'=> $this->view->getPlates()->render ("email", $req->getAttributes())
                    ]
                ]);
                $response = json_decode($response->getBody(), true);
                if($response['status'] == 'success'){
                    return $res->withJson([
                        'status'=>'success'
                    ]);
                }
//
//                $this->mailer->addAddress($_POST['email']);
//                $this->mailer->Subject = 'Undangan penggunaan aplikasi';
//                $this->mailer->isHTML(true);
//                $this->mailer->Body = $this->view->getPlates()->render ("email", $req->getAttributes());
//                if($this->mailer->send()){
//                    return $res->withJson([
//                        'status'=>'success'
//                    ]);
//                }
            }
        }else{
            return $res->withJson([
                'status'=>'failed',
                'reason'=>'Mohon isi Email dan Pilih jabatan'
            ]);
        }
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
                    'status'=>'success'
                ]);
            }
        }else{
            return $res->withJson([
                'status'=>'failed',
                'reason'=>'Password lama salah!'
            ]);
        }
    }

    public function user_updateEmail(Request $req, Response $res, $args){
//        $token = bin2hex(openssl_random_pseudo_bytes(16));
//        $path = 'http://'. $req->getHeader('Host')[0] . $this->router->pathFor ('signUpPage', ['token'=>$token]);
        $user = $this->userModels->getUser($_POST['id_user']);
        if(isset($_POST['email']) and isset($_POST['password']) and $_POST['email'] != $user['email'] and md5($_POST['password']) == $user['password']){
            $data = [
                'email'=> $_POST['email'],
//                'token'=> $token
            ];
            if($this->userModels->setUser($data, $_POST['id_user'])){
                return $res->withJson([
                    'status'=>'success'
                ]);
            }
        }else{
            return $res->withJson([
                'status'=>'failed',
                'reason'=>'Email telah digunakan atau Password salah!'
            ]);
        }
    }

    public function user_updateTelepon(Request $req, Response $res, $args){
        $smscode = strtoupper(bin2hex(openssl_random_pseudo_bytes(3)));
        $user = $this->userModels->getUser($_POST['id_user']);
        if(isset($_POST['telefon']) and isset($_POST['password']) and $_POST['telefon'] != $user['telefon'] and md5($_POST['password']) == $user['password']){
            $data = [
                'telefon'=> $_POST['telefon'],
                'smscode'=> $smscode
            ];
            if($this->userModels->setUser($data, $_POST['id_user'])){
                return $res->withJson([
                    'status'=>'success'
                ]);
            }
        }else{
            return $res->withJson([
                'status'=>'failed',
                'reason'=>'Password salah!'
            ]);
        }
    }

    public function user_delete(Request $req, Response $res, $args){
        if(isset($_POST['id_user'])){
            $data = [
                'deleted'=>1
            ];
            if($this->userModels->setUser($data, $_POST['id_user'])){
                return $res->withJson([
                    'status'=>'success'
                ]);
            }else{
                return $res->withJson([
                    'status'=>'failed'
                ]);
            }
        }
    }
}