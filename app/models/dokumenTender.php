<?php
/**
 * Created by PhpStorm.
 * User: wijaya
 * Date: 12/04/2017
 * Time: 13.46
 */

namespace ryan\models;


class dokumenTender extends \ryan\main {

    protected $container;

    public function __construct($container) {
        parent::__construct($container);
        $this->container = $container;
    }
}