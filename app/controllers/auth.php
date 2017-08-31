<?php
    namespace ryan\controllers;

    use \Slim\Http\Request as Req;
    use \Slim\Http\Response as Res;
    use \GuzzleHttp\Psr7;
    use \GuzzleHttp\Client;

    class auth extends \ryan\main {

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

        public function __construct ($container) {
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

        public function loginPage (Req $req, Res $res, $args) {
            $req = $req->withAttribute ('lala', 'lolo');
            $req = $req->withAttribute ('authError', $this->flash->getMessage ('AuthError'));

            if(isset($this->session->id_user)){
                return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('DashboardPage'));
            }else{
                return $this->view->render ("login", $req->getAttributes());
            }
        }

        public function doLogin ($req, $res, $args) {
            $username = $_POST[ 'username' ];
            $password = $_POST[ 'password' ];
            $login = $this->userModels->checkAuth ($username, md5 ($password));
            if ($login) {
                if($login['status'])
                $this->session->set ('id_user', $login[ 'id_user' ]);
                $this->session->set ('previledge', $login[ 'previledge' ]);
                if($login['previledge'] == '5'){
                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('users_daftar'));
                }else{
                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('DashboardPage'));
                }
            } else {
                $this->flash->addMessage ('AuthError', true);

                return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('loginPage'));
            }
        }


        public function doLogout ($req, $res, $args) {
            $this->session->destroy ();

            return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('loginPage'));
        }

        public function __invoke ($req, $res, $next) {
            $this->view->registerFunction('getUserDetail', function($id_user){
                $user = $this->userModels->getUserDetail($id_user);
                return $user;
            });
            $this->view->registerFunction('thisPriviledge', function(){
                $user = $this->userModels->getUserDetail($this->session->id_user)['previledge'];
                switch ($user){
                    case '1':
                        return 'admin';
                        break;
                    case '2':
                        return 'direktur';
                        break;
                    case '3':
                        return 'manajer';
                        break;
                    case '4':
                        return 'unitkerja';
                        break;
                }
                return $user;
            });
            if(!isset($this->session->id_user)){
                if($req->isGet()) {
                    return $res->withStatus(302)->withHeader('Location', $this->router->pathFor('loginPage'));
                }else {
                    return $res->withStatus(405)->withJson(['success'=>false, 'cause'=>'Session Expired']);
                }
            }else{
                $userData = $this->userModels->getUser($this->session->id_user);
                $notificationData = $this->notifikasiModels->getNotificationForUser($this->session->id_user);
                $this->view->registerFunction ('userDetailHelper', function ($id_user) {
                    return $this->userModels->getUserDetail ($id_user);
                });

                $req = $req->withAttribute('active_user_data', $userData);
                $req = $req->withAttribute('active_notification_list', [
                    'notifikasi'=>$notificationData,
                    'histories'=>$this->histories_helper()
                ]);
                $res = $next($req, $res);
                return $res;
            }

        }

        public function signUpPage(Req $req, Res $res, $args){
            $data = $this->userModels->getUserByToken($args['token']);
            $req = $req->withAttribute('token', $args['token']);
            if($data){
                $req = $req->withAttribute ('sign_data', $data);
                return $this->view->render ("signup", $req->getAttributes());
            }else{
                throw new \Slim\Exception\NotFoundException($req, $res);
            }
        }

        public function doSignUp(Req $req, Res $res, $args){
            $smscode = strtoupper(bin2hex(openssl_random_pseudo_bytes(3)));
            if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['telefon'])){
                if($_POST['password'] == $_POST['repassword']){
                    $data = [
                        'username' => $_POST['username'],
                        'nama' => $_POST['username'],
                        'password' => md5($_POST['password']),
                        'telefon' => $_POST['telefon'],
                        'status' => 1,
                        'smscode' => $smscode,
                        'image' => 'no-photo.jpg',
                        'token' => null
                    ];
//                    return $res->write('http://www.freesms4us.com/kirimsms.php?user=ryanhadiw&pass=ryan721995&no=' . $_POST['telefon'] . '&isi=' . $pesan);
                    if($this->userModels->setUser($data, $_POST['id_user'])){
                        $sms = $this->sendSMS($_POST['telefon'], 'Harap masukkan kode '. $smscode . ' di aplikasi E-Admin Tender');
                        if($sms === true){
                            return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('verificationSMSPage', ['id_user'=>$_POST['id_user']]));
                        }else{
                            return $res->write($sms);
                        }
                    }
                }
            }else{
                return $res->withJson([
                    'status' => 'failed'
                ]);
            }

        }

        public function verificationSMSPage(Req $req, Res $res, $args){
            $req = $req->withAttribute ('codeError', $this->flash->getMessage ('codeError'));
            $req = $req->withAttribute('id_user', $args['id_user']);
            $req = $req->withAttribute('telefon', $this->userModels->getUser($args['id_user'])['telefon']);
            return $this->view->render ("sms", $req->getAttributes());
        }

        public function doVerificateSMS(Req $req, Res $res, $args){
            $user = $this->userModels->getUser($args['id_user']);
            if($_POST['smscode'] == $user['smscode']){
                $data = [
                    'smscode' => null
                ];
                if($this->userModels->setUser($data, $user['id_user'])){
                    $this->session->set ('id_user', $user[ 'id_user' ]);
                    $this->session->set ('previledge', $user[ 'previledge' ]);
                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('users_profile'));
                }
            }else{
                $this->flash->addMessage ('codeError', true);
                return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('verificationSMSPage', ['id_user'=>$args['id_user']]));
            }
        }

        public function reSendVerificationSMS(Req $req, Res $res, $args){
            $smscode = strtoupper(bin2hex(openssl_random_pseudo_bytes(3)));
            $user = $this->userModels->getUserByToken($args['token']);
            $data = [
                'smscode'=>$smscode
            ];
            if($this->userModels->setUser($data, $user['id_user'])){
                $sms = $this->sendSMS($args['telefon'], 'Harap masukkan kode '. $smscode . ' di aplikasi E-Admin Tender');
                if($sms === true){
                    return $res->withJson([
                        'status'=>'success'
                    ]);
                }else{
                    return $res->withJson([
                        'status' => 'failed',
                        'reason' => $sms
                    ]);
                }
            }else{
                return $res->withJson([
                    'status'=>'failed'
                ]);
            }
        }

        public function check(Req $req, Res $res, $args){
            if(isset($_GET['username'])){
                if($this->userModels->getUserByUsername($_GET['username'])){
                    return $res->withStatus(404);
                }else{
                    return $res->withStatus(200);
                }
            }
        }

        public function check_email(Req $req, Res $res, $args){
            if(isset($_GET['email'])){
                if($this->userModels->getUserByEmail($_GET['email'])){
                    return $res->withStatus(404);
                }else{
                    return $res->withStatus(200);
                }
            }
        }

        public function coba(Req $req, Res $res, $args){
//            $uri = $req->getUri();
//            $this->mailer->addAddress('genthowijaya@gmail.com', 'Amin Wijaya');
//            $this->mailer->Subject = 'Undangan penggunaan aplikasi';
//            $this->mailer->isHTML(true);
//            $this->mailer->Body = $this->view->render ("email", $req->getAttributes());
//            $this->mailer->send();
//            $data = $this->pdo->select()->from('user')->where('id_user', '=', 1)->count('*', 'count')->execute()->fetch();
//            return $res->withJson($data);
//            $curl = curl_init();
//            curl_setopt_array($curl, array(
//                CURLOPT_RETURNTRANSFER => 1,
//                CURLOPT_URL => 'http://www.freesms4us.com/kirimsms.php?user=ryanhadiw&pass=ryan721995&no=0895338201953&isi=halooooooooo'
//            ));
//            return $res->write(curl_exec($curl));
            $path = 'http://'. $req->getHeader('Host')[0] . $this->router->pathFor ('signUpPage', ['token'=>'aaa']);
            $req = $req->withAttribute ('path', $path);
            $req = $req->withAttribute ('who', 'astaga');
            $req = $req->withAttribute ('jabatan', 'taudeh');
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => 'http://capi-mailer.appspot.com/',
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);
            try {
                $response = $client->request('POST', 'http://capi-mailer.appspot.com/appspot/no_reply', [
                    'headers' => [
                        'X-CAPI-AUTH' => '$2y$10$MsVKU9Eym.muyQA4KwPdguSzGnW8k2WMUubgqRAkr4W9OguJgY8hC'
                    ],
                    'form_params'=>[
                        'send_to'=>'genthowijaya@gmail.com',
                        'subject'=>'undangan',
                        'message'=> $this->view->getPlates()->render ("email", $req->getAttributes())
                    ]
                ]);
                return $res->withJson(json_decode($response->getBody(), true));
            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    return $res->write(Psr7\str($e->getResponse()));
                }
                return $res->write(Psr7\str($e->getRequest()));
            }
//            return $res->write(bin2hex(openssl_random_pseudo_bytes(3)));
//            return $res->withJson($req->getHeader('Host'));
        }

        public function histories_helper(){
            $histories = $this->historyModels->get_history();
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
                        $history['detail'] = $this->tenderModels->getBeritaTender($history['id_tender']);
                        $history['extra'] = $this->unitkerjaModels->getUnitKerja($history['id_perubahan']);
                        break;
                    case 'i_dok':
                    case 'u_dok':
                    case 'e_dok':
                    case 'd_dok':
                    case 'a_dok':
                        $history['detail'] = $this->tenderModels->getBeritaTender($history['id_tender']);
                        $history['extra'] = $this->dokumenModels->getDokumenTender($history['id_perubahan']);
                        break;
                    case 'i_boq':
                    case 'e_boq':
                    case 'd_boq':
                    case 'a_boq':
                        $history['detail'] = $this->tenderModels->getBeritaTender($history['id_tender']);
                        $history['extra'] = $this->BOQModels->getBOQ('38');
                        break;
                }
            }
            return $histories;
            unset($history);
        }

    }
