<?php
    namespace ryan\controllers;


    class login extends \ryan\main {

        protected $container;
        protected $userModels;

        public function __construct ($container) {
            parent::__construct ($container);
            $this->container = $container;
            $this->userModels = new \ryan\models\users($container);
        }

        public function loginPage ($req, $res, $args) {
            $req = $req->withAttribute ('lala', 'lolo');
            $req = $req->withAttribute ('authError', $this->flash->getMessage ('AuthError'));

            return $this->view->render ("login", $req->getAttributes ());
        }

        public function doLogin ($req, $res, $args) {
            $username = $_POST[ 'username' ];
            $password = $_POST[ 'password' ];
            $login = $this->userModels->checkAuth ($username, md5 ($password));
            if ($login) {
                $this->session->set ('id_user', $login[ 'id_user' ]);
                $this->session->set ('previledge', $login[ 'previledge' ]);

//			return $res->withJson($login);
                return $this->previledgeDivider ($res, $login[ 'previledge' ]);
            } else {
                $this->flash->addMessage ('AuthError', true);

                return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('loginPage'));
            }
        }

        public function previledgeDivider ($res, $previledge) {
            switch ($previledge) {
                case '1':
                    return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('adminDashboardPage'));
                    break;
            }
        }

        public function doLogout ($req, $res, $args) {
            $this->session->destroy ();

            return $res->withStatus (302)->withHeader ('Location', $this->router->pathFor ('loginPage'));
        }
    }
