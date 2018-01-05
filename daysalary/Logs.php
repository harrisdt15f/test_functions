<?php
class Logs {

    private $FilePath;
    private $FileName;
    private $m_MaxLogFileNum;
    private $m_RotaType;
    private $m_RotaParam;
    private $m_InitOk;
    private $m_Priority;
    private $m_LogCount;

    /**
     * 初始化
     * Logs constructor.
     * @param $dir 文件路径
     * @param $filename 文件名
     * @param int $priority
     * @param int $maxlogfilenum
     * @param int $rotatype
     * @param int $rotaparam
     */
    function __construct($dir, $filename, $priority = Logs::INFO, $maxlogfilenum = 100000, $rotatype = 1, $rotaparam = 5242880) {
        $dot_offset = strpos($filename, ".");
        if ($dot_offset !== false)
            $this->FileName = substr($filename, 0, $dot_offset);
        else
            $this->FileName = $filename;
        $this->FilePath = $dir;
        $this->m_MaxLogFileNum = intval($maxlogfilenum);
        $this->m_RotaParam = intval($rotaparam);
        $this->m_RotaType = intval($rotatype);
        $this->m_Priority = intval($priority);
        $this->m_LogCount = 0;

        $this->m_InitOk = $this->InitDir();
        umask(0000);
        $path = $this->getLogFilePath($this->FilePath, $this->FileName);
       if (!$this->isExist($path)) {
            if (!$this->createDir($this->FilePath)) {
                //echo("创建目录失败1!");
            }
//            if (!$this->createLogFile($path)) {
//                //echo("创建文件失败2!");
//            }
        }
    }

    private function InitDir() {
        if (is_dir($this->FilePath) === false) {
            if (!$this->createDir($this->FilePath)) {
                return false;
            }
        }
        return true;
    }
    /**
     * anytime to china time
     * @param $time must be Y-m-d H:i:s format
     * @return string
     * author : Harris
     */
    private function china_time($time,$format='Y-m-d H:i:s')
    {
        $datetime = new DateTime($time);
        $cn_time = new DateTimeZone('Asia/Shanghai');
        $datetime->setTimezone($cn_time);
        return $datetime->format($format);
    }
    /**
     * anytime to east america time
     * @param $time must be Y-m-d H:i:s format
     * @return string
     * author : Harris
     */
    private function EUSA_time($time,$format='Y-m-d H:i:s')
    {
        $datetime = new DateTime($time);
        $cn_time = new DateTimeZone('Etc/GMT+4');
        $datetime->setTimezone($cn_time);
        return $datetime->format($format);
    }

    /**
     * 写入日志
     * @param String $log 
     * 内容
     */
    function setLog($log) {
        $this->Log(Logs::NOTICE, $log);
    }

    function LogDebug($log) {
        $this->Log(Logs::DEBUG, $log);
    }

    function LogError($log) {
        $this->Log(Logs::ERROR, $log);
    }

    function LogNotice($log) {
        $this->Log(Logs::NOTICE, $log);
    }

    function Log($priority, $log) {
        if ($this->m_InitOk == false)
            return;
        if ($priority > $this->m_Priority)
            return;
        $path = $this->getLogFilePath($this->FilePath, $this->FileName) . ".log";
        $handle = @fopen($path, "a+");
        if ($handle === false) {
            return;
        }
        $today = date('Y-m-d H:i:s', time());
        $datestr = ' 北京时间：' . $this->china_time($today);
//        $datestr = $datestr.' 美东时间：' . $this->EUSA_time($today); //$datestr = strftime("%Y-%m-%d %H:%M:%S ");
//        $caller_info = $this->get_caller_info();//占时关闭
        $caller_info ='';
        if (!@fwrite($handle, $caller_info . $datestr . $log . "\n")) {//写日志失败
            //echo("写入日志失败");
        }
        @fclose($handle);
        $this->RotaLog();
    }

    private function get_caller_info() {
        $ret = debug_backtrace();
        foreach ($ret as $item) {
            if (isset($item['class']) && 'Logs' == $item['class']) {
                continue;
            }
            $file_name = basename($item['file']);
            return <<<S
{$file_name}:{$item['line']}  
S;
        }
    }

    private function RotaLog() {
        $file_path = $this->getLogFilePath($this->FilePath, $this->FileName) . ".log";
        if ($this->m_LogCount % 10 == 0)
            clearstatcache();
        ++$this->m_LogCount;
        $file_stat_info = stat($file_path);
        if ($file_stat_info === FALSE)
            return;
        if ($this->m_RotaType != 1)
            return;
        if ($file_stat_info['size'] < $this->m_RotaParam)
            return;

        $raw_file_path = $this->getLogFilePath($this->FilePath, $this->FileName);
        $file_path = $raw_file_path . ($this->m_MaxLogFileNum - 1) . ".log";
        if ($this->isExist($file_path)) {
            unlink($file_path);
        }
        for ($i = $this->m_MaxLogFileNum - 2; $i >= 0; $i--) {
            if ($i == 0)
                $file_path = $raw_file_path . ".log";
            else
                $file_path = $raw_file_path . $i . ".log";

            if ($this->isExist($file_path)) {
                $new_file_path = $raw_file_path . ($i + 1) . ".log";
                if (rename($file_path, $new_file_path) < 0) {
                    continue;
                }
            }
        }
    }

    function isExist($path) {
        return file_exists($path);
    }

    /**
     * 创建目录
     * @param $dir 目录名
     * @return bool
     */
    function createDir($dir) {
        return is_dir($dir) or ( $this->createDir(dirname($dir)) and @ mkdir($dir, 0777));
    }


    /**
     * 创建日志文件
     * @param $path
     * @return bool
     */
    function createLogFile($path) {
        $handle = @fopen($path, "w"); //创建文件
        @fclose($handle);
        return $this->isExist($path);
    }

    /**
     * 创建路径
     * @param type $dir
     * 目录名
     * @param type $filename
     * @return type
     */
    function getLogFilePath($dir, $filename) {
        return $dir . "/" . $filename;
    }

    const EMERG = 0;
    const FATAL = 0;
    const ALERT = 100;
    const CRIT = 200;
    const ERROR = 300;
    const WARN = 400;
    const NOTICE = 500;
    const INFO = 600;
    const DEBUG = 700;

}