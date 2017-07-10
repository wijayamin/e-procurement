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

    $this->get('/dashboard', \ryan\controllers\dashboard::class . ':dashboardPage')->setName('DashboardPage');

    $this->group('/tender', function () {
        $this->get('/list', \ryan\controllers\beritaTender::class . ':daftarBeritaTender')->setName('beritaTender_daftar');
        $this->map(['GET', 'POST'], '/add', \ryan\controllers\beritaTender::class . ':tambahBeritaTender')->setName('beritaTender_tambah');
        $this->map(['GET', 'POST'], '/edit/{id_tender}', \ryan\controllers\beritaTender::class . ':beritaTender_edit')->setName('beritaTender_edit');
        $this->get('/detail/{id_tender:[0-9]+}', \ryan\controllers\beritaTender::class . ':detailBeritaTender')->setName('beritaTender_detail');

        $this->get('/approval', \ryan\controllers\beritaTender::class . ':daftarBeritaTender')->setName('beritaTender_daftarApproval');
        $this->get('/approval/{id_tender:[0-9]+}', \ryan\controllers\beritaTender::class . ':detailBeritaTender')->setName('beritaTender_detailApproval');
        $this->post('/approve/{id_tender:[0-9]+}', \ryan\controllers\beritaTender::class . ':approvalBeritaTender')->setName('beritaTender_approval');

    });

    $this->group('/rks-acara', function(){
        $this->get('/list', \ryan\controllers\acaraRKS::class . ':daftarBeritaTender')->setName('rksAcara_daftar');
        $this->get('/detail/{id_tender:[0-9]+}', \ryan\controllers\acaraRKS::class . ':detailAcaraRKS')->setName('rksAcara_detail');
        $this->post('/upload/{id_tender:[0-9]+}/{type}', \ryan\controllers\acaraRKS::class . ':uploadAcaraRKS')->setName('rksAcara_upload');

        $this->get('/approval', \ryan\controllers\acaraRKS::class . ':daftarBeritaTender')->setName('rksAcara_daftarApproval');
        $this->get('/approval/{id_tender:[0-9]+}', \ryan\controllers\acaraRKS::class . ':detailAcaraRKS')->setName('rksAcara_detailApproval');
        $this->post('/approve/{id_tender:[0-9]+}', \ryan\controllers\acaraRKS::class . ':approvalAcaraRKS')->setName('rksAcara_approval');
    });

    $this->group('/unit-kerja', function () {
        $this->get('/list', \ryan\controllers\unitKerja::class . ':unitKerja_daftar')->setName('unitKerja_daftar');
        $this->get('/daftar/{id_tender:[0-9]+}', \ryan\controllers\unitKerja::class . ':unitKerja_detail')->setName('unitKerja_detail');
        $this->get('/available/{id_tender:[0-9]+}', \ryan\controllers\unitKerja::class . ':unitKerja_available')->setName('unitKerja_tersedia');
        $this->get('/get/{id_tender:[0-9]+}', \ryan\controllers\unitKerja::class . ':unitKerja_get')->setName('unitKerja_list');
        $this->post('/add/{id_tender:[0-9]+}', \ryan\controllers\unitKerja::class . ':unitKerja_add')->setName('unitKerja_tambah');
        $this->post('/delete', \ryan\controllers\unitKerja::class . ':unitKerja_delete')->setName('unitKerja_hapus');
    });

    $this->group('/boq', function () {
        $this->get('/daftar', \ryan\controllers\BOQ::class . ':BOQ_daftar')->setName('BOQTender_daftar');
        $this->get('/detail/{id_tender:[0-9]+}', \ryan\controllers\BOQ::class . ':BOQ_detail')->setName('BOQTender_detail');

        $this->post('/set/{id_tender}', \ryan\controllers\BOQ::class . ':BOQ_set')->setName('BOQTender_set');
        $this->get('/get/{id_tender}', \ryan\controllers\BOQ::class . ':BOQ_get')->setName('BOQTender_get');
        $this->post('/delete', \ryan\controllers\BOQ::class . ':BOQ_delete')->setName('BOQTender_delete');

        $this->any('/approval', \ryan\controllers\BOQ::class . ':BOQ_daftar')->setName('BOQTender_daftarApproval');
        $this->any('/approval/{id_tender}', \ryan\controllers\BOQ::class . ':BOQ_detail_approval')->setName('BOQTender_detailApproval');
        $this->post('/approve', \ryan\controllers\BOQ::class . ':BOQ_approval')->setName('BOQTender_approval');

    });

    $this->group('/dokumen', function(){
        $this->get('/daftar', \ryan\controllers\dokumenTender::class . ':daftarBeritaTender')->setName('dokumenTender_daftar');
        $this->get('/detail/{id_tender:[0-9]+}', \ryan\controllers\dokumenTender::class . ':detailTenderDokumen')->setName('dokumenTender_detail');


        $this->post('/add/{id_tender:[0-9]+}', \ryan\controllers\dokumenTender::class . ':dokumen_add')->setName('dokumenTender_add');
        $this->get('/get/{id_tender:[0-9]+}', \ryan\controllers\dokumenTender::class . ':getDokumenTender')->setName('dokumenTender_get');
        $this->get('/get/required/{id_tender:[0-9]+}', \ryan\controllers\dokumenTender::class . ':getRequiredDokumenTender')->setName('dokumenTender_getRequired');
        $this->get('/get/optional/{id_tender:[0-9]+}', \ryan\controllers\dokumenTender::class . ':getOptionalDokumenTender')->setName('dokumenTender_getOptional');
        $this->post('/set/{id_tender:[0-9]+}', \ryan\controllers\dokumenTender::class . ':dokumen_edit')->setName('dokumenTender_set');
        $this->get('/delete[/{id_dokumen:[0-9]+}]', \ryan\controllers\dokumenTender::class . ':deleteDokumenTender')->setName('dokumenTender_delete');

//        $this->get('/count/{id_tender}', \ryan\controllers\dokumenTender::class . ':countDokumenTender')->setName('dokumenTender_getDoned');
//        $this->get('/delete[/{id_dokumen:[0-9]+}]', \ryan\controllers\dokumenTender::class . ':deleteDokumenTender')->setName('deleteDokumenTender');
        
        $this->any('/approval', \ryan\controllers\dokumenTender::class . ':daftarBeritaTender')->setName('dokumenTender_daftarApproval');
        $this->any('/approval/{id_tender:[0-9]+}', \ryan\controllers\dokumenTender::class . ':detailTenderDokumenApproval')->setName('dokumenTender_detailApproval');
        $this->get('/approve[/{id_dokumen:[0-9]+}[/{status}]]', \ryan\controllers\dokumenTender::class . ':approvalTenderDokumen')->setName('dokumenTender_Approval');
    });

    $this->group('/approval', function () {
//        $this->group('/tender', function () {
//            $this->any('/daftar', \ryan\controllers\approval::class . ':beritaTender')->setName('daftarApprovalBeritaTender');
////            $this->any('/detail/{id_tender}[/{status}]', \ryan\controllers\approval::class . ':approvalBeritaTender')->setName('approvalBeritaTender');
//            $this->any('/detail/{id_tender}', \ryan\controllers\approval::class . ':approvalBeritaTender')->setName('approvalBeritaTender');
//
//        });
//
//        // group proses approval rks
//        $this->group('/acara-rks', function () {
//
//            // ghalaman daftar berita yang sudah di input rks
//            $this->any('/daftar', \ryan\controllers\approval::class . ':beritaTenderRKS')->setName('daftarApprovalRKSTender');
//
//            // halaman approval rks
//            $this->any('/detail/{id_tender}[/{status}]', \ryan\controllers\approval::class . ':approvalBeritaTenderRKS')->setName('approvalRKSTender');
//
//        });

//        // group proses approval BOQ
//        $this->group('/boq', function () {
//
//            // ghalaman daftar berita yang sudah di input rks
//            $this->any('/daftar', \ryan\controllers\approval::class . ':beritaTenderBOQ')->setName('daftarApprovalBOQTender');
//
//            // halaman approval rks
//            $this->any('/detail/{id_tender}', \ryan\controllers\approval::class . ':detaiTenderBOQ')->setName('DetailApprovalBOQTender');
//
//            // halaman approval rks
//            $this->post('/approve', \ryan\controllers\approval::class . ':approvalTenderBOQ')->setName('ApprovalBOQTender');
//
//        });

        // group proses approval rks
//        $this->group('/dokumen', function () {
//
//            // ghalaman daftar berita yang sudah di input rks
//            $this->any('/daftar', \ryan\controllers\approval::class . ':daftarTenderDokumen')->setName('daftarApprovalDokumenTender');
//
//            // halaman approval rks
//            $this->any('/detail/{id_tender}', \ryan\controllers\approval::class . ':detailTenderDokumen')->setName('detailApprovalTenderDokumen');
//            $this->get('/approve[/{id_dokumen}[/{status}]]', \ryan\controllers\approval::class . ':approvalTenderDokumen')->setName('ApproveTenderDokumen');
//
//        });

    });

})->add(new \ryan\controllers\login($container));

$app->group('/api', function () {

    $this->post('/tambah-penyelenggara', \ryan\controllers\api::class . ':addPenyelenggara')->setName('apiAddPenyelenggara');

    $this->get('/penyelenggara[/{id}]', \ryan\controllers\api::class . ':getPenyelenggara')->setName('apiGetPenyelenggara');

    $this->get('/dokumen-master[/{id}]', \ryan\controllers\api::class . ':getDokumenMaster')->setName('apiGetDokumenMaster');

    $this->get('/syarat-dokumen-tender[/{id}]', \ryan\controllers\api::class . ':getDokumenList')->setName('apiGetDokumenTender');

    $this->get('/detail-berita-tender[/{id}]', \ryan\controllers\api::class . ':getDetailTender')->setName('apiGetDetailBeritaTender');

    $this->group('/unit-kerja', function(){

        $this->get('/available/{id_tender}', \ryan\controllers\unitKerja::class . ':getAvailableUnitKerja')->setName('isUnitKerjaAvailable');

        $this->post('/set/{id_tender}', \ryan\controllers\unitKerja::class . ':setUnitKerja')->setName('setUnitKerja');

        $this->get('/get/{id_tender}', \ryan\controllers\unitKerja::class . ':getUnitKerjaTender')->setName('getUnitKerjaTender');

    });

    $this->group('/boq', function(){

//        $this->get('/available/{id_tender}', \ryan\controllers\unitKerja::class . ':getAvailableUnitKerja')->setName('isUnitKerjaAvailable');


    });

    $this->group('/dokumen', function(){
    });

})->add(new \ryan\controllers\login($container));

