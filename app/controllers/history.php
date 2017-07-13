<?php
/**
 * Copyright (c) 2017.
 */

/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 13/07/2017
 * Time: 16.58
 */

namespace ryan\controllers;

use \Slim\Container as Container;
use \Slim\Http\Request as Req;
use \Slim\Http\Response as Res;

class history {
    protected $container;
    protected $penyelenggaraModels;
    protected $tenderModels;
    protected $userModels;
    protected $notifikasiModels;
    protected $dokumenModels;
    protected $unitkerjaModels;
    protected $BOQModels;
    protected $historyModels;

    public function __construct (Container $container) {
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
    }

    public function tender_add($id_tender){
        $data = [
            
        ]
        return $this->historyModels->history_set($data);
    }
}