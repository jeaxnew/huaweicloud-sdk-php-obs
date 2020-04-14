# huaweicloud-sdk-php-obs

华为云存储 OBS PHP SDK

- 去除基于 monolog 日志组件提供的日志功能。
- 去除 composer。

## 日志配置

日志功能默认是关闭的，需要主动开启。如需日志功能，请在 Obs\Log\Logger->addRecord 中自行更改，默认不做任何处理。并通过 ObsClient->initLog 开启日志功能并进行配置。

```php
<?php
use Obs\ObsClient;

$obsClient = ObsClient::factory(array (
    'key' => '',
    'secret' => '',
    'endpoint' => '',
));

$obsClient -> initLog ([
   'FilePath' => './logs', // 配置日志文件夹
   'FileName' => 'eSDK-OBS-PHP.log', // 配置日志文件名
   'MaxFiles' => 10, // 配置最大可保留的日志文件个数
   'Level' => WARN  // 配置日志级别
]);
```

## 文件引入

因去除了 composer，文件需要按以下方式载入：

- autoload.php
```php
<?php
function classLoader($class){
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $path . '.php';
    if (file_exists($file)) {
        require_once $file;
        return true;
    }
    return false;
}
spl_autoload_register('classLoader');
```

## 使用方法

- demo.php
```php
<?php
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
```