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
     * tambah history
     * @param      $id_tender       id tender
     * @param      $id_user         user yang merubah
     * @param      $perubahan       kode perubahan
     * @param      $id_perubahan    id yang dirubah
     * @param null $meta            keterangan tambahan
     * @return int    last inserted id | e => false
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

    public function history_set($data){
        return $this->pdo->insert(array_keys($data))->into('history')->values(array_values($data))->execute(true);
    }

    /**
     * last edited info tender
     * @param $id_tender
     * @return mixed    e => null
     */
    public function getLastEditTender($id_tender){
        return $this->pdo->select()->from('history')->where('id_tender', '=', $id_tender)->where('perubahan', '=', 'u_tender')->orderBy('id_history', 'DESC')->execute()->fetch();
    }

    /**
     * list history
     * @param $id_tender
     * @return mixed    e => null
     */
    public function get_history($id_tender = null){
        if($id_tender == null){
            return $this->pdo->select()->from('history')->orderBy('id_history', 'DESC')->execute()->fetchAll();
        }else {
            return $this->pdo->select()->from('history')->where('id_tender', '=', $id_tender)->orderBy('id_history', 'DESC')->execute()->fetchAll();
        }
    }

}