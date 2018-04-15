<?php
/**
 * 数据库连接
 */

if(in_array($_SERVER['HTTP_HOST'],array('www.youpei-exc.com'))) {
    return array(
        'DB_TYPE' => 'mysql',
        'DB_HOST' => '112.74.38.232',
        'DB_USER' => 'youpeinew',
        'DB_PWD' => 'youpei@201707',
        'DB_PORT' => '3306',
        'DB_NAME' => 'weixin_youpei',
        'DB_CHARSET' => 'utf8',
        'DB_PREFIX' => 'yp_',
    );
} if(in_array($_SERVER['HTTP_HOST'],array('debug.youpei-exc.com'))) {
    return array(
        'DB_TYPE' => 'mysql',
        'DB_HOST' => '112.74.38.232',
        'DB_USER' => 'tanmw',
        'DB_PWD' => 'youpei2017',
        'DB_PORT' => '3306',
        'DB_NAME' => 'debug_weixin_youpei',
        'DB_CHARSET' => 'utf8',
        'DB_PREFIX' => 'yp_',
    );
} else {
    return array(
        'DB_TYPE' => 'mysql',
        'DB_HOST' => 'localhost',
        'DB_USER' => 'root',
        'DB_PWD' => 'root',
        'DB_PORT' => '3306',
        'DB_NAME' => 'new_youpei',
        'DB_CHARSET' => 'utf8',
        'DB_PREFIX' => 'yp_',
    );
}
