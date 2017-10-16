<?php
return [
'settings' => [
        "database" => [
            "host" => "localhost",
            "database_name" => "tar-test",
            "user" => "root",
            "pass" => ""
        ],
        'debug' => true,
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true,
        'mailer' => [
            'setFrom' => [
                'email' => 'kartunamapal@gmail.com',
                'title' => 'PT. Kencana Alam Putra(No Reply)'
            ],
            'Host' => 'smtp.gmail.com',
            'Port' => '587',
            'SMTPSecure' => 'tls',
            'SMTPAuth' => 'true',
            'AuthType' => 'XOAUTH2',
            'oauthClientId' => "415435901048-edelac3m5bndr0v2e2qv0ssoh9e4t3mb.apps.googleusercontent.com",
            'oauthClientSecret' => "_8cVQNtmn3C2HD5Ixw_uM11A",
            'oauthRefreshToken' => "1/J3GOSF9i_kq4uCIffGAVhz6ITF--KUXX563UyZW1l9E",
            'SMTPDebug' => 0,
            'Debugoutput' => 'html',
        ],
        "server" => "192.168.100.8",
        "sms" => [
            'username'=>'ryanhadiw',
            'password'=>'ryan721995',
            'enabled'=>false
        ],
        "views"=>"views",
        'whoops.editor' => 'sublime',
    ],
];
