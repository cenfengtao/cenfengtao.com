<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
      
/**
 * ThinkPHP 普通模式定义
 */
return array(
    // 配置文件
    'config'    =>  array(
        THINK_PATH.'Conf/convention.php',   // 系统惯例配置
        CONF_PATH.'config'.CONF_EXT,      // 应用公共配置
    ),

    // 别名定义
    'alias'     =>  array(
        'Think\Log'               => CORE_PATH . 'Log'.EXT,
        'Think\Log\Driver\File'   => CORE_PATH . 'Log/Driver/File'.EXT,
        'Think\Exception'         => CORE_PATH . 'Exception'.EXT,
        'Think\Model'             => CORE_PATH . 'Model'.EXT,
        'Think\Db'                => CORE_PATH . 'Db'.EXT,
        'Think\Template'          => CORE_PATH . 'Template'.EXT,
        'Think\Cache'             => CORE_PATH . 'Cache'.EXT,
        'Think\Cache\Driver\File' => CORE_PATH . 'Cache/Driver/File'.EXT,
        'Think\Storage'           => CORE_PATH . 'Storage'.EXT,
    ),

    // 函数和类文件
    'core'      =>  array(
        THINK_PATH.'Common/functions.php',
        COMMON_PATH.'Common/function.php',
        CORE_PATH . 'Hook'.EXT,
        CORE_PATH . 'App'.EXT,
        CORE_PATH . 'Dispatcher'.EXT,
        //CORE_PATH . 'Log'.EXT,
        CORE_PATH . 'Route'.EXT,
        CORE_PATH . 'Controller'.EXT,
        CORE_PATH . 'View'.EXT,
        BEHAVIOR_PATH . 'BuildLiteBehavior'.EXT,
        BEHAVIOR_PATH . 'ParseTemplateBehavior'.EXT,
        BEHAVIOR_PATH . 'ContentReplaceBehavior'.EXT,
    ),
    // 行为扩展定义
    'tags'  =>  array(
        'app_init'     =>  array(
            'Behavior\BuildLiteBehavior', // 生成运行Lite文件
        ),        
        'app_begin'     =>  array(
            'Behavior\ReadHtmlCacheBehavior', // 读取静态缓存
        ),
        'app_end'       =>  array(
            'Behavior\ShowPageTraceBehavior', // 页面Trace显示
        ),
        'view_parse'    =>  array(
            'Behavior\ParseTemplateBehavior', // 模板解析 支持PHP、内置模板引擎和第三方模板引擎
        ),
        'template_filter'=> array(
            'Behavior\ContentReplaceBehavior', // 模板输出替换
        ),
        'view_filter'   =>  array(
            'Behavior\WriteHtmlCacheBehavior', // 写入静态缓存
        ),
    ),
);
//中文截取
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
    if(function_exists("mb_substr"))
        return mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix) return $slice."…";
    return $slice;
}
