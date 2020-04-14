<?php
/**
 * @author: 小蒋同学 <lk99@vip.qq.com>
 * @qq: 505088318
 * @link: www.xinby.cn
 * @create: 2020/4/7 0:28
 */
namespace Obs\Log;

class Logger{
    const DEBUG = 100;
    const INFO = 200;
    const NOTICE = 250;
    const WARNING = 300;
    const ERROR = 400;
    const CRITICAL = 500;
    const ALERT = 550;
    const EMERGENCY = 600;
    
    protected static $levels = array(
        self::DEBUG     => 'DEBUG',
        self::INFO      => 'INFO',
        self::NOTICE    => 'NOTICE',
        self::WARNING   => 'WARNING',
        self::ERROR     => 'ERROR',
        self::CRITICAL  => 'CRITICAL',
        self::ALERT     => 'ALERT',
        self::EMERGENCY => 'EMERGENCY',
    );
    
    protected $filepath;
    protected $log_maxFiles;
    protected $log_level;

    public function RotatingFileHandler($filepath, $log_maxFiles, $log_level){
        $this->filepath = $filepath;
        $this->log_maxFiles = $log_maxFiles;
        $this->log_level = $log_level;
    }
    
    public function debug($message){
        return $this->addRecord(static::DEBUG, $message);
    }
    public function info($message){
        return $this->addRecord(static::INFO, $message);
    }
    public function notice($message){
        return $this->addRecord(static::NOTICE, $message);
    }
    public function warning($message){
        return $this->addRecord(static::WARNING, $message);
    }
    public function error($message){
        return $this->addRecord(static::ERROR, $message);
    }
    public function critical($message){
        return $this->addRecord(static::CRITICAL, $message);
    }
    public function alert($message){
        return $this->addRecord(static::ALERT, $message);
    }
    public function emergency($message){
        return $this->addRecord(static::EMERGENCY, $message);
    }
    
    public function addRecord($level, $message){
        return true;
    }
}