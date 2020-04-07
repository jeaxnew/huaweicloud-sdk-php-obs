<?php
/**
 * @author: 小蒋同学 <lk99@vip.qq.com>
 * @qq: 505088318
 * @link: www.xinby.cn
 * @create: 2020/4/7 9:30
 */
use Obs\ObsClient;
use Obs\ObsException;

require __DIR__.'/autoload.php';
include __DIR__.'/src/GuzzleHttp/functions_include.php';
include __DIR__.'/src/GuzzleHttp/Psr7/functions_include.php';
include __DIR__.'/src/GuzzleHttp/Promise/functions_include.php';

$obsClient = ObsClient::factory(array (
    'key' => '',
    'secret' => '',
    'endpoint' => '',
));

try {
    $resp = $obsClient->putObject(array (
        'Bucket' => '',
        'Key' => 'test',
        'Body'=>'msg to put',
        //'SourceFile' => '/temp/test.txt'
    ));
    //var_dump($resp);
    echo $resp['ObjectURL'];
} catch ( ObsException $e ) {
    echo $e;
}