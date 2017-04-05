<?php

    $app->group ('/auth', function () {
        $this->get ('-login', \ryan\controllers\login::class . ':loginPage')->setName ('loginPage');
        $this->post ('-dologin', \ryan\controllers\login::class . ':doLogin')->setName ('doLogin');
        $this->get ('-logout', \ryan\controllers\login::class . ':doLogout')->setName ('doLogout');
    });

    $app->group ('', function () {
        $this->get ('/dashboard', \ryan\controllers\dashboard::class . ':dashboardPage')->setName ('DashboardPage');
        $this->group('/berita-tender', function(){
            $this->map(['GET', 'POST'], '', \ryan\controllers\beritaTender::class . ':daftarBeritaTender')->setName ('daftarBeritaTender');
            $this->map(['GET', 'POST'], '/tambah', \ryan\controllers\beritaTender::class . ':tambahBeritaTender')->setName ('tambahBeritaTender');
            $this->map(['GET', 'POST'], '/detail/{id_tender}', \ryan\controllers\beritaTender::class . ':detailBeritaTender')->setName ('detailBeritaTender');
        });

        $this->group('/approval', function(){
            $this->group('/tender', function(){
                $this->map(['GET', 'POST'], '/berita', \ryan\controllers\approval::class . ':beritaTender')->setName ('daftarApprovalBeritaTender');
                $this->map(['GET', 'POST'], '/detail/{id_tender}[/{status}]', \ryan\controllers\approval::class . ':approvalBeritaTender')->setName ('approvalBeritaTender');
            });
        });

        $this->group('/acara-RKS', function(){
            $this->group('/RKS', function(){
                $this->map(['GET', 'POST'], '', \ryan\controllers\acaraRKS::class . ':beritaTenderRKS')->setName ('daftarBeritaTenderRKS');
                $this->map(['GET', 'POST'], '/detail/{id_tender}', \ryan\controllers\acaraRKS::class . ':detailBeritaTenderRKS')->setName ('detailBeritaTenderRKS');
            });
        });
    })->add( new \ryan\controllers\login($container));

    $app->group('/api', function(){
        $this->post ('/tambah-penyelenggara', \ryan\controllers\api::class . ':addPenyelenggara')->setName ('apiAddPenyelenggara');
        $this->get ('/penyelenggara[/{id}]', \ryan\controllers\api::class . ':getPenyelenggara')->setName ('apiGetPenyelenggara');
        $this->get ('/dokumen-master[/{id}]', \ryan\controllers\api::class . ':getDokumenMaster')->setName ('apiGetDokumenMaster');
        $this->get ('/syarat-dokumen-tender[/{id}]', \ryan\controllers\api::class . ':getDokumenList')->setName ('apiGetDokumenTender');
        $this->get ('/detail-berita-tender[/{id}]', \ryan\controllers\api::class . ':getDetailTender')->setName ('apiGetDetailBeritaTender');
    });

