<?php
use Illuminate\Support\Facades\Route;
// use Jooyeshgar\Moadian\Facades\Moadian;
use Jooyeshgar\Moadian\Moadian;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-moadian', function () {
    try {
        $privateKey = file_get_contents(__DIR__.'/../storage/app/keys/private.pem');
        $certificate = file_get_contents(__DIR__.'/../storage/app/keys/certificate.crt');
        // $base_url = 'https://Sandboxrc.tax.gov.ir/';
        $base_url = 'https://tp.tax.gov.ir/requestsmanager/api/v2/';
        $moadian = new Moadian($privateKey, $certificate, $base_url);
        $nonce = $moadian->getNonce();
        var_dump($nonce);
        $info = $moadian->getServerInfo();
        var_dump($info);
        return response()->json([
            $nonce,
            $info,
        ]);
    } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
