<?php
    /**
     * Created by PhpStorm.
     * User: wijaya
     * Date: 3/23/2017
     * Time: 16:39
     */

    namespace ryan;

    use \Slim\Container as Container;
    use \Slim\Http\Request as Req;
    use \Slim\Http\Response as Res;
    use PDO;

    class main {
        protected $container;
        protected $db;
        protected $view;
        protected $session;
        protected $router;
        protected $flash;
        protected $uri;
        protected $pdo;

        function __construct (Container $container) {
            $this->container = $container;
//            $this->db = $container->db;
            $this->view = $container->view;
            $this->session = $container->session;
            $this->router = $container->router;
            $this->flash = $container->flash;

            $settings = $container->get('settings')['database'];
            $this->db = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['database_name'], $settings['user'], $settings['pass']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $this->pdo = new \Slim\PDO\Database("mysql:host=" . $settings['host'] . ";dbname=" . $settings['database_name'], $settings['user'], $settings['pass']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        public function __invoke ($req, $res, $next) {
            $uri = $req->getUri ();
            $req = $req->withAttribute ('uri', $uri);
            $req = $req->withAttribute ('router', $this->router);
            $this->uri = $req->getUri();

            $this->view->registerFunction('res', function($type, $filename){
                $url = $this->uri->getBaseUrl();
                return $url.'/public/assets/'.$type.'/'.$filename;
            });
            $this->helperIndDate();
            $this->helperDateIsGreaterThanNow();
            $this->time_elapsed_string();
            $res = $next($req, $res);

            return $res;
        }

        function helperIndDate(){
            $this->view->registerFunction('indDate', function($dateString){
                return date('d M Y', strtotime($dateString));
            });
            $this->view->registerFunction('indDateTime', function($dateString){
                return date('d M Y H:i', strtotime($dateString));
            });
            $this->view->registerFunction('copyDate', function(){
                return date('Y');
            });

        }

        function helperDateIsGreaterThanNow(){
            $this->view->registerFunction('dateAboveNow', function($dateString){
                return (strtotime($dateString) >= time() ? true : false);
            });
        }

        function time_elapsed_string() {
            $this->view->registerFunction('timeElapsed', function($datetime, $full = false) {
                $now = new \DateTime;
                $ago = new \DateTime($datetime);
                $diff = $now->diff ($ago);

                $diff->w = floor ($diff->d / 7);
                $diff->d -= $diff->w * 7;

                $string = array(
                    'y' => 'tahun',
                    'm' => 'bulan',
                    'w' => 'minggu',
                    'd' => 'hari',
                    'h' => 'jam',
                    'i' => 'menit',
                    's' => 'detik',
                );
                foreach ($string as $k => &$v) {
                    if ($diff->$k) {
                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
                    } else {
                        unset($string[ $k ]);
                    }
                }

                if (!$full) $string = array_slice ($string, 0, 2);

                return $string ? implode (', ', $string) . ' yang lalu' : 'baru saja';
            });
        }

    }
