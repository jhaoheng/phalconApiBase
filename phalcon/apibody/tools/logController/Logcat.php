<?php  

include_once BASE_PATH ."/apibody/tools/logController/slackMessager.php";

use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as FileAdapter;

/** 紀錄所有的 log
 * 
 * Tag
 * - info
 * - alert
 * - critical
 * - emergency
 * - debug
 * - error
 * - notice
 * - warning
 */

class Logcat
{
    
    function __construct()
    {
        # code...
    }

    public function insertLog($log, $tag='info', $logFile='default.log', $slack=false){
        $logPath = BASE_PATH."/log/".$logFile;
        $this->checkLogDir();
        $this->checkFileSize($logPath);        
        // return;


        $logger = new FileAdapter($logPath);

        if($tag == 'info'){
            $logger->info($log);
        }
        else if ($tag == 'alert') {
            $logger->alert($log);
        }
        else if ($tag == 'debug') {
            $logger->debug($log);
        }
        else if ($tag == 'warning') {
            $logger->warning($log);
        }
        else if ($tag == 'error') {    
            $logger->error($log);
        }

        if ($slack) {
            $slackMsg = new slack;
            $slackMsg->slackBot($log);
        }
    }

    public function  checkFileSize($file){
        if (file_exists($file)){
            $size = filesize($file);
            // echo $size." bytes";
            if ($size >= 1000000) {
                unlink($file);
            }
        }
    }

    public function checkLogDir(){

        $logDir = BASE_PATH."/log";
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }
    }
}

?>