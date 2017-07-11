<?php
/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 3/27/2017
 * Time: 18:56
 */

namespace ryan\models;


class history extends \ryan\main{

    protected $container;
    protected $userModels;
    protected $penyelenggaraModels;
    protected $tenderModels;
    protected $dokumenModels;
    protected $unitkerjaModels;
    protected $BOQModels;

    public function __construct ($container) {
        parent::__construct ($container);
        $this->container = $container;
        $this->userModels = new \ryan\models\users($container);
        $this->penyelenggaraModels = new \ryan\models\penyelenggara($container);
        $this->tenderModels = new \ryan\models\tender($container);
        $this->dokumenModels = new \ryan\models\dokumenTender($container);
        $this->unitkerjaModels = new \ryan\models\unitKerja($container);
        $this->BOQModels = new \ryan\models\BOQ($container);
    }

    /**
     * @param $data [id_user, tentang, waktu]
     */
    public function add_history($id_tender, $id_user, $perubahan, $id_perubahan, $meta = null){
        $data = [
            'id_tender'=>$id_tender,
            'id_user'=>$id_user,
            'waktu'=> date ("Y-m-d H:i:s"),
            'perubahan'=>$perubahan,
            'id_perubahan'=>$id_perubahan,
            'meta'=>$meta
        ];
        return $this->pdo->insert(array_keys($data))->into('history')->values(array_values($data))->execute(true);
    }

    public function getLastEditTender($id_tender){
        return $this->pdo->select()->from('history')->where('id_tender', '=', $id_tender)->where('perubahan', '=', 'u_tender')->orderBy('id_history', 'DESC')->execute()->fetch();
    }

    public function get_history($id_tender){
        $histories = $this->pdo->select()->from('history')->where('id_tender', '=', $id_tender)->execute()->fetchAll();
        foreach($histories as &$history){
            switch ($history['perubahan']){
                case 'u_tender':
                    $history['detail'] = $this->tenderModels->getBeritaTender($history['id_perubahan']);
                    break;
            }
        }
        return $histories;
    }

}