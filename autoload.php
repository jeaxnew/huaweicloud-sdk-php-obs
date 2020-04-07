<?php
/**
 * @author: 小蒋同学 <lk99@vip.qq.com>
 * @qq: 505088318
 * @link: www.xinby.cn
 * @create: 2020/4/7 9:28
 */
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