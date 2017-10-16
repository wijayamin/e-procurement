<?php
/**
 * Copyright (c) 2017.
 */

/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 27/09/2017
 * Time: 00.04
 */

namespace ryan;
use \Slim\Container as Container;
use \League\Plates\Engine;
use \League\Plates\Extension\ExtensionInterface;

//require_once 'models/users.php';

class template_helper implements ExtensionInterface {

    protected $penyelenggaraModels;
    protected $tenderModels;
    protected $userModels;
    protected $notifikasiModels;
    protected $dokumenModels;
    protected $unitkerjaModels;
    protected $BOQModels;
    protected $historyModels;
    protected $dokumenMasterModels;

    protected $session;

    public function __construct (Container $container) {
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
        $this->session = $container->session;
    }

    public function register(Engine $engine){
        $engine->registerFunction('autocomplete', [$this, 'autocomplete']);
        $engine->registerFunction('local_date', [$this, 'local_date']);

        $engine->registerFunction('penyelenggara', [$this, 'penyelenggara']);

        $engine->registerFunction('user_detail', [$this, 'user_detail']);

        $engine->registerFunction('dokumen_count', [$this, 'dokumen_count']);
    }

    public function local_date($type, $val = null){
        switch ($type){
            case 'shortDate':
                return date('d M Y', strtotime($val));
                break;
            case 'fullDate_ID':
                return strftime('%d %B %Y', strtotime($val));
                break;
            case 'fullDateTime_ID':
                return strftime('%d %B %Y %H:%M', strtotime($val));
                break;
            case 'monthYear_ID':
                return strftime ('%B, %Y', strtotime ($val));
                break;
            case 'year_now':
                return date('Y');
                break;
            default:
                return date('d M Y', strtotime($val));
                break;
        }
    }

    public function autocomplete($type, $param = []){
        switch ($type){
            case 'kualifikasi':
                $kualifikasi = [];
                foreach ($this->tenderModels->getBeritaTender(in_array('id_tender', $param) ? $param['id_tender'] : null) as $tender){
                    foreach (explode('|', $tender['kualifikasi'])as $kualf){
                        if(!in_array($kualf, $kualifikasi) && $kualf !== ''){
                            array_push($kualifikasi, $kualf);
                        }
                    }
                }
                return $kualifikasi;
                break;
        }
    }

    /**
     * @param      $id_penyelenggara
     * @param null $type
     * @return array|mixed
     */
    public function penyelenggara($id_penyelenggara,  $type = null){
        switch ($type){
            case 'nama':
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                return $penyelenggara[ 'nama_penyelenggara' ];
                break;
            default:
                $penyelenggara = $this->penyelenggaraModels->getPenyelenggara($id_penyelenggara);
                return $penyelenggara;
                break;
        }
    }

    public function user_detail($id_user, $type = '', $self = false){
        switch ($type){
            case 'image':
                return $this->userModels->getUser($id_user)['image'];
                break;
            case 'nama':
                if($self && $this->session->exists('id_user') && $this->session->id_user == $id_user){
                    return 'Anda Sendiri';
                }else{
                    return $this->userModels->getUser($id_user)['nama'];
                }
                break;
            default:
                return $this->userModels->getUserDetail($id_user);
                break;
        }
    }

    public function dokumen_count($id_tender, $type = null){
        $dokumen = $this->dokumenModels->getDokumenByTender($id_tender);
        $count = [
            'total' => sizeof($dokumen),
            'uploaded' => 0,
            'approved' => 0
        ];
        foreach ($dokumen as $dok){
            if($dok['file_dokumen']){
                $count['uploaded']++;
            }
            $appr = json_decode($dok['approval'], true);
            if($appr['direktur']['status'] && $appr['manajer']['status']){
                $count['uploaded']++;
            }
        }
        return $count;
    }

}