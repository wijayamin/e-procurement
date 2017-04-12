<?php
/**
 * Copyright (c) 2017.
 */

// Group Login -> untuk authentifikasi
$app->group('/auth', function () {

    // Halaman Login
    $this->get('-login', \ryan\controllers\login::class . ':loginPage')->setName('loginPage');

    // Proses Login
    $this->post('-dologin', \ryan\controllers\login::class . ':doLogin')->setName('doLogin');

    // Proses Logout
    $this->get('-logout', \ryan\controllers\login::class . ':doLogout')->setName('doLogout');

});

// Group Root
$app->group('', function () {

    // Halaman Dashboard
    $this->get('/dashboard', \ryan\controllers\dashboard::class . ':dashboardPage')->setName('DashboardPage');

    // Group Menu Berita Tender
    $this->group('/berita-tender', function () {

        // Halaman Daftar Semua Berita Tender
        $this->any('', \ryan\controllers\beritaTender::class . ':daftarBeritaTender')->setName('daftarBeritaTender');

        // Halaman Untuk Menambah Berita Tender
        $this->any('/tambah', \ryan\controllers\beritaTender::class . ':tambahBeritaTender')->setName('tambahBeritaTender');

        // Halaman untuk menampilkan detail berita tender
        $this->any('/detail/{id_tender}', \ryan\controllers\beritaTender::class . ':detailBeritaTender')->setName('detailBeritaTender');

    });

    //group menu RKS dan Berita Acara
    $this->group('/acara-rks', function () {

        // group rks
        $this->group('/rks', function () {

            // halaman daftar berita yang dapat di input rks
            $this->any('', \ryan\controllers\acaraRKS::class . ':beritaTenderRKS')->setName('daftarBeritaTenderRKS');

            // halaman detail berita dan upload rks
            $this->any('/detail/{id_tender}', \ryan\controllers\acaraRKS::class . ':detailBeritaTenderRKS')->setName('detailBeritaTenderRKS');

        });

        //group berita acara
        $this->group('/acara', function () {

            //halaman daftar berita yang dapat di input berita acara
            $this->any('', \ryan\controllers\acaraRKS::class . ':beritaTenderAcara')->setName('daftarBeritaTenderAcara');
            // halaman detail berita dan upload berita acara
            $this->any('/detail/{id_tender}', \ryan\controllers\acaraRKS::class . ':detailBeritaTenderAcara')->setName('detailBeritaTenderAcara');

        });

    });

    //group approval
    $this->group('/approval', function () {

        $this->group('/tender', function () {

            $this->any('/berita', \ryan\controllers\approval::class . ':beritaTender')->setName('daftarApprovalBeritaTender');

            $this->any('/detail/{id_tender}[/{status}]', \ryan\controllers\approval::class . ':approvalBeritaTender')->setName('approvalBeritaTender');

        });

        $this->group('/acara-rks', function () {

            $this->any('/berita', \ryan\controllers\approval::class . ':beritaTenderRKS')->setName('daftarApprovalRKSTender');

            $this->any('/detail/{id_tender}[/{status}]', \ryan\controllers\approval::class . ':approvalBeritaTenderRKS')->setName('approvalRKSTender');

        });

    });

})->add(new \ryan\controllers\login($container));

$app->group('/api', function () {

    $this->post('/tambah-penyelenggara', \ryan\controllers\api::class . ':addPenyelenggara')->setName('apiAddPenyelenggara');

    $this->get('/penyelenggara[/{id}]', \ryan\controllers\api::class . ':getPenyelenggara')->setName('apiGetPenyelenggara');

    $this->get('/dokumen-master[/{id}]', \ryan\controllers\api::class . ':getDokumenMaster')->setName('apiGetDokumenMaster');

    $this->get('/syarat-dokumen-tender[/{id}]', \ryan\controllers\api::class . ':getDokumenList')->setName('apiGetDokumenTender');

    $this->get('/detail-berita-tender[/{id}]', \ryan\controllers\api::class . ':getDetailTender')->setName('apiGetDetailBeritaTender');

});

