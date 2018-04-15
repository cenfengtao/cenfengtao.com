<?php
namespace Common\Common;
class Tools
{
    static $log = true;
    /* 是否开启异步处理信息 */
    const ASYNC_QUEUE_MODE = false;
    static $error_log = true;

    static function log($data = array(), $name = '', $file_line = '')
    {
        if ($data == "\r\n" || empty ($data)) {
            return false;
        }

        if (defined('MODE_NAME') && MODE_NAME == 'cli' && Tools::$log) {
            $str = "\r\n" . date('Y-m-d H:i:s') . "---------$name $file_line begin---------" . "\r\n";
            $str .= Tools::log_details($data);
            $str .= "\r\n" . date('Y-m-d H:i:s') . "---------$name $file_line end---------" . "\r\n";
            file_put_contents(CLI_PATH . '/1', $str, FILE_APPEND);
        } else if (Tools::$log) {
            error_log("\r\n" . date('Y-m-d H:i:s') . "---------$name $file_line begin---------" . "\r\n", 3, true);
            error_log(Tools::log_details($data), 3, 1);
            error_log("\r\n" . date('Y-m-d H:i:s') . "---------$name $file_line end---------" . "\r\n", 3, true);
        }
    }

    static function log_details($data, $pref = "")
    {
        if (is_array($data)) {
            $str = array(
                ""
            );
            foreach ($data as $k => $v)
                array_push($str, $pref . $k . " => " . Tools::log_details($v, $pref . "\t"));
            return implode("\n", $str);
        }
        return $data;
    }

    static function logData()
    {
        $data = $_REQUEST;
        $path = "/home/www/log/";
        $string = '[' . date('H:i:s') . '][M:' . MODULE_NAME . '][A:' . ACTION_NAME . '][data:';
        $string .= print_r($data, 1);
        $string .= ']';
        $filename = $path . $_SERVER['HTTP_HOST'] . '_' . date("Ymd");
        file_put_contents($filename, $string, FILE_APPEND);
    }
}