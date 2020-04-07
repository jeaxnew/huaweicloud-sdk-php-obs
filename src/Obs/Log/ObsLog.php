<?php

/**
 * Copyright 2019 Huawei Technologies Co.,Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use
 * this file except in compliance with the License.  You may obtain a copy of the
 * License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software distributed
 * under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR
 * CONDITIONS OF ANY KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations under the License.
 *
 */

namespace Obs\Log;

use MoCloud\Logger;

class ObsLog extends Logger{
    public static $log;
    
    public static function initLog($logConfig= []){
        $arr = empty($logConfig) ? [
            'FilePath' => './logs',
            'FileName' => 'eSDK-OBS-PHP.log',
            'MaxFiles' => 10,
            'Level' => INFO
        ] : $logConfig;
        $log_path = $arr['FilePath'];
        $log_name = $arr['FileName'];
        $log_maxFiles = is_numeric($arr['MaxFiles']) ? 0 : intval($arr['MaxFiles']);
        $log_level = $arr['Level'];
        if (!is_dir($log_path)){
            mkdir($log_path, 0755, true);
        }
        $filepath =  $log_path.'/'.$log_name;
        self::$log = new Logger();
        self::$log->RotatingFileHandler($filepath, $log_maxFiles, $log_level);
    }
    
    private static function writeLog($level, $msg){
        self::$log->addRecord($level, $msg);
    }
    
    public static function commonLog($level, $format, $args1 = null, $arg2 = null){
        if(ObsLog::$log){
            if ($args1 === null && $arg2 === null) {
                $msg = urldecode($format);
            } else {
                $msg = sprintf($format, $args1, $arg2);
            }
            $back = debug_backtrace();
            $line = $back[0]['line'];
            $funcname = $back[1]['function'];
            $filename = basename($back[0]['file']);
            $message = '['.$filename.':'.$line.']: '.$msg;
            ObsLog::writeLog($level, $message);
        }
    }
}
