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

    class main {
        protected $container;
        /** @var \PDO $db */
        protected $db;
        protected $view;
        /** @var \SlimSession\Helper $session */
        protected $session;
        /** @var \Slim\Router $router */
        protected $router;
        /** @var \Slim\Flash\Messages $flash */
        protected $flash;
        protected $uri;
        /** @var \Slim\PDO\Database $pdo */
        protected $pdo;
        /** @var \PHPMailerOAuth $mailer */
        protected $mailer;
        protected $notFoundHandler;
        /** @var \Dompdf\Dompdf $mailer */
        protected $pdf;

        function __construct (Container $container) {
            $this->container = $container;
            $this->db = $container->db;
            $this->pdo = $container->pdo;
            $this->view = $container->view;
            $this->session = $container->session;
            $this->router = $container->router;
            $this->flash = $container->flash;
            $this->notFoundHandler = $container->notFoundHandler;

            $mailer_seting = $container->get('settings')['mailer'];
            $this->mailer = new \PHPMailerOAuth();
            $this->mailer->CharSet = 'UTF-8';
            $this->mailer->isSMTP();
            $this->mailer->SMTPDebug = $mailer_seting['SMTPDebug'];
            $this->mailer->Debugoutput = $mailer_seting['Debugoutput'];
            $this->mailer->Host = $mailer_seting['Host'];
            $this->mailer->Port = $mailer_seting['Port'];
            $this->mailer->SMTPSecure = $mailer_seting['SMTPSecure'];
            $this->mailer->SMTPAuth = $mailer_seting['SMTPAuth'];
            $this->mailer->AuthType = $mailer_seting['AuthType'];
            $this->mailer->oauthUserEmail = $mailer_seting['setFrom']['email'];
            $this->mailer->oauthClientId = $mailer_seting['oauthClientId'];
            $this->mailer->oauthClientSecret = $mailer_seting['oauthClientSecret'];
            $this->mailer->oauthRefreshToken = $mailer_seting['oauthRefreshToken'];
            $this->mailer->setFrom($mailer_seting['setFrom']['email'], $mailer_seting['setFrom']['title']);

            $this->pdf = new \Dompdf\Dompdf();
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
            $this->view->registerFunction('indDateFull', function($dateString){
                return strftime('%d %B %Y', strtotime($dateString));
            });
            $this->view->registerFunction('indMonthYear', function($dateString){
//                return strftime ('%B, %Y', strtotime ($dateString));
                return strftime ('%B, %Y', strtotime ($dateString));
            });
            $this->view->registerFunction('indDateTime', function($dateString){
                return strftime('%d %B %Y %H:%M', strtotime($dateString));
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

        public function sendSMS($nomor, $messages){
            $curl = curl_init();
            $pesan = urlencode($messages);
            $settings = $this->container->get('settings')['sms'];
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://www.freesms4us.com/kirimsms.php?user=' . $settings['username'] . '&pass=' . $settings['password'] . '&no=' . $nomor . '&isi=' . $pesan
            ));
            $response = curl_exec($curl);
            if(strpos($response, 'sukses') !== false){
                return true;
            }else{
                return $response;
            }
        }

    }
