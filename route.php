<?php

    $app->group ('/auth', function () {
        $this->get ('-login', \ryan\controllers\login::class . ':loginPage')->setName ('loginPage');
        $this->post ('-dologin', \ryan\controllers\login::class . ':doLogin')->setName ('doLogin');
        $this->post ('-logout', \ryan\controllers\login::class . ':doLogout')->setName ('doLogout');
    });

    $app->group ('/admin', function () {
        $this->get ('', \ryan\controllers\admin::class . ':dashboardPage')->setName ('adminDashboardPage');
        $this->get ('/berita-tender', \ryan\controllers\admin::class . ':beritaTenderPage')->setName ('adminBeritaTenderPage');
    });

    $app->group('/api', function(){
        $this->post ('/tambah-penyelenggara', \ryan\controllers\admin::class . ':addPenyelenggara')->setName ('addPenyelenggara');
    });

