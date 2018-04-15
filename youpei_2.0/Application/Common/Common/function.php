<?php
/**
 * 通用函数
 */
function show($status, $message, $data = array())
{
    $result = array(
        'status' => $status,
        'message' => $message,
        'data' => $data
    );
    exit(json_encode($result));
}

//获取md5后的密码
function getMd5Password($password)
{
    return md5($password . C('MD5_RANDOM'));
}

/**
 * 获取网站域名
 */
function HTTPDomain()
{
    $server = $_SERVER['HTTP_HOST'];
    $http = is_ssl() ? 'https://' : 'http://';
    return $http . $server . __ROOT__;
}

//判断是否存在该字段
function strExists($string, $find)
{
    return !(strpos($string, $find) === FALSE);
}


/**
 * 只保留字符串首尾字符，隐藏中间用*代替（两个字符时只显示第一个）
 * @param string $user_name 姓名
 * @return string 格式化后的姓名
 */
function substr_cut($user_name)
{
    $strlen = mb_strlen($user_name, 'utf-8');
    $firstStr = mb_substr($user_name, 0, 1, 'utf-8');
    $lastStr = mb_substr($user_name, -1, 1, 'utf-8');
    return $strlen == 2 ? $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1) : $firstStr . str_repeat("*", $strlen - 2) . $lastStr;
}

//二维数组去掉重复值 并保留键值
function array_unique_fb($array2D)
{
    foreach ($array2D as $k => $v) {
        $v = join(",", $v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
        $temp[$k] = $v;
    }
    $temp = array_unique($temp); //去掉重复的字符串,也就是重复的一维数组
    foreach ($temp as $k => $v) {
        $array = explode(",", $v); //再将拆开的数组重新组装
        $temp2[$k]["token"] = $array[0];

    }
    return $temp2;
}

function http_request($url, $post = '', $extra = array(), $timeout = 60, $header = true)
{
    $urlset = parse_url($url);
    if (empty($urlset['path'])) {
        $urlset['path'] = '/';
    }
    if (!empty($urlset['query'])) {
        $urlset['query'] = "?{$urlset['query']}";
    }
    if (empty($urlset['port'])) {
        $urlset['port'] = $urlset['scheme'] == 'https' ? '443' : '80';
    }
    if (strExists($url, 'https://') && !extension_loaded('openssl')) {
        if (!extension_loaded("openssl")) {
            die('请开启您PHP环境的openssl');
        }
    }
    if (function_exists('curl_init') && function_exists('curl_exec')) {
        $ch = curl_init();
        $curl_url = $urlset['scheme'] . '://' . $urlset['host'] . ($urlset['port'] == '80' ? '' : ':' . $urlset['port']) . $urlset['path'] . $urlset['query'];
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, $header);
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);
            if (is_array($post)) {
                $post = http_build_query($post);
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1');
        if (!empty($extra) && is_array($extra)) {
            $headers = array();
            foreach ($extra as $opt => $value) {
                if (strexists($opt, 'CURLOPT_')) {
                    curl_setopt($ch, constant($opt), $value);
                } elseif (is_numeric($opt)) {
                    curl_setopt($ch, $opt, $value);
                } else {
                    $headers[] = "{$opt}: {$value}";
                }
            }
            if (!empty($headers)) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }
        }

        $data = curl_exec($ch);
        $status = curl_getinfo($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($errno || empty ($data)) {
            return false;
        } else {
            if ($header) {
                return http_response_parse($data);
            } else {
                return array(
                    'content' => $data
                );
            }
        }
    }
    $method = empty ($post) ? 'GET' : 'POST';
    $fdata = "{$method} {$urlset['path']}{$urlset['query']} HTTP/1.1\r\n";
    $fdata .= "Host: {$urlset['host']}\r\n";
    if (function_exists('gzdecode')) {
        $fdata .= "Accept-Encoding: gzip, deflate\r\n";
    }
    $fdata .= "Connection: close\r\n";
    if (!empty ($extra) && is_array($extra)) {
        foreach ($extra as $opt => $value) {
            if (!strexists($opt, 'CURLOPT_')) {
                $fdata .= "{$opt}: {$value}\r\n";
            }
        }
    }
    $body = '';
    if ($post) {
        if (is_array($post)) {
            $body = http_build_query($post);
        } else {
            $body = urlencode($post);
        }
        $fdata .= 'Content-Length: ' . strlen($body) . "\r\n\r\n{$body}";
    } else {
        $fdata .= "\r\n";
    }
    if ($urlset['scheme'] == 'https') {
        $fp = fsockopen('ssl://' . $urlset['host'], $urlset['port'], $errno, $error);
    } else {
        $fp = fsockopen($urlset['host'], $urlset['port'], $errno, $error);
    }
    stream_set_blocking($fp, true);
    stream_set_timeout($fp, $timeout);
    if (!$fp) {
        return false;
    } else {
        fwrite($fp, $fdata);
        $content = '';
        while (!feof($fp))
            $content .= fgets($fp, 512);
        fclose($fp);
        return http_response_parse($content);
    }
}

function http_response_parse($data)
{
    $rlt = array();
    $pos = strpos($data, "\r\n\r\n");
    $split1 [0] = substr($data, 0, $pos);
    $split1 [1] = substr($data, $pos + 4, strlen($data));

    $split2 = explode("\r\n", $split1 [0], 2);
    preg_match('/^(\S+) (\S+) (\S+)$/', $split2 [0], $matches);
    $rlt ['code'] = $matches [2];
    $rlt ['status'] = $matches [3];
    $rlt ['responseline'] = $split2 [0];
    $header = explode("\r\n", $split2 [1]);
    $isgzip = false;
    foreach ($header as $v) {
        $row = explode(':', $v);
        $key = trim($row [0]);
        $value = trim($row [1]);
        if (is_array($rlt ['headers'] [$key])) {
            $rlt ['headers'] [$key] [] = $value;
        } elseif (!empty ($rlt ['headers'] [$key])) {
            $temp = $rlt ['headers'] [$key];
            unset ($rlt ['headers'] [$key]);
            $rlt ['headers'] [$key] [] = $temp;
            $rlt ['headers'] [$key] [] = $value;
        } else {
            $rlt ['headers'] [$key] = $value;
        }
        if (!$isgzip && strtolower($key) == 'content-encoding' && strtolower($value) == 'gzip') {
            $isgzip = true;
        }
    }
    if ($isgzip && function_exists('gzdecode')) {
        $rlt ['content'] = gzdecode($split1 [1]);
    } else {
        $rlt ['content'] = $split1 [1];
    }
    $rlt ['meta'] = $data;
    return $rlt;
}

function http_get($url, $header = true)
{
    return http_request($url, null, null, 60, $header);
}

function http_post($url, $data, $header = true)
{
    $headers = array(
        'Content-Type' => 'application/x-www-form-urlencoded'
    );
    return http_request($url, $data, $headers, 60, $header);
}

function post_weixin_curl($wxuser, $url, $data = '', $refresh = false)
{
    $access_token = get_weixin_access_token($wxuser, $refresh);
    if ($access_token) {
        $u = $url . '?access_token=' . $access_token;
        $result = http_post($u, $data, false);
        $result = @json_decode($result ['content'], true);
        if ($result['errcode'] == '40001') {
            Tools::log('execute:[' . $u . '] --(40001:invalid credential, access_token is invalid or not latest ) [--重新获取---]--token=' . $wxuser['token'], __FILE__ . '_' . __LINE__);
            return post_weixin_curl($wxuser, $url, $data, true);
        } else if ($result ['errcode'] == '40014') {
            Tools::log('execute:[' . $u . '] --(40014:不合法的access_token) --token=' . $wxuser['token'], __FILE__ . '_' . __LINE__);
        } else if ($result ['errcode'] == '41001') {
            Tools::log('execute:[' . $u . '] --(41001:缺少access_token参数) --token=' . $wxuser['token'], __FILE__ . '_' . __LINE__);
        } else if ($result ['errcode'] == '42001') {
            Tools::log('execute:[' . $u . '] --(42001:access_token超时) [--重新获取---]--token=' . $wxuser['token'], __FILE__ . '_' . __LINE__);
            return post_weixin_curl($wxuser, $url, $data, true);
        } else if ($result ['errcode'] == '45015') {
            Tools::log('execute:[' . $u . '] --(45015:response out of time limit) [超过24小时未与公众号互动]');
            return $result;
            //return post_weixin_curl($wxuser,$url,$data,true);
        } else {
            if ($result['errcode'] != 0) {
                Tools::log(array($result, $u), __FILE__ . '_' . __LINE__);
            }
            return $result;
        }
    } else {
        Tools::log('获取微信access_token 失败', __FILE__ . '_' . __LINE__);
        return false;
    }
}

function cjson_encode($data)
{
    switch ($type = gettype($data)) {
        case 'NULL':
            return 'null';
        case 'boolean':
            return ($data ? 'true' : 'false');
        case 'integer':
        case 'double':
        case 'float':
            return $data;
        case 'string':
            return '"' . addslashes($data) . '"';
        case 'object':
            $data = get_object_vars($data);
            return $data;
        case 'array':
            $output_index_count = 0;
            $output_indexed = array();
            $output_associative = array();
            foreach ($data as $key => $value) {
                $output_indexed[] = cjson_encode($value);
                $output_associative[] = cjson_encode($key) . ':' . cjson_encode($value);
                if ($output_index_count !== NULL && $output_index_count++ !== $key) {
                    $output_index_count = NULL;
                }
            }
            if ($output_index_count !== NULL) {
                return '[' . implode(',', $output_indexed) . ']';
            } else {
                return '{' . implode(',', $output_associative) . '}';
            }
        default:
            return ''; // Not supported
    }
}

/**
 * 获取 weixin token
 * @param array $wxuser 商家信息 array('appid');
 * @param boolean $refresh
 *            是否刷新access_token
 * @return String boolean ，失败返回 false
 */
function get_weixin_access_token($wxuser, $refresh = false)
{
    $CACHE_KEY = 'weixin_token_' . $wxuser['appid'];
    if ($refresh) {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $wxuser['appid'] . "&secret=" . $wxuser['appsecret'];
        $content = http_get($url);
        $result = @json_decode($content ['content'], true);
        $access_token = $result ['access_token'];
        $expires_in = (int)$result['expires_in'];
        if ($access_token) {
            MCache::set($CACHE_KEY, $access_token, $expires_in - 200);
            Tools::log('fetch_access_token_ok[' . $wxuser['appid'] . ']:[' . $access_token . ']', __FILE__ . '_' . __LINE__);
            return $access_token;
        } else {
            if ($result ['errcode'] == '40001') {
                Tools::log('获取access时:(40001:获取access_token时AppSecret错误，或者access_token无效)--token=', __FILE__ . '_' . __LINE__);
            } else if ($result ['errcode'] == '40013') {
                Tools::log('获取access时:(40013:不合法的APPID)--token=' . $wxuser['appid'], __FILE__ . '_' . __LINE__);
            } else {
                Tools::log($result, __FILE__ . '_' . __LINE__);
            }
            return false;
        }
    } else {
        $access_token = MCache::get($CACHE_KEY);
        if ($access_token) {
            return $access_token;
        } else {
            return get_weixin_access_token($wxuser, true);
        }
    }
}

/**
 * 通过token获取公众号信息
 */
function get_wxuser($token, $field = '*', $return_single_value = false)
{
    $wxuser = M('Wxuser')->where(array('token' => $token))->field($field)->find();
    if ($return_single_value) {
        return $wxuser[$field];
    }
    return $wxuser;
}

/**
 * 模板通知
 * @param $template  string 模板类型
 * @param $templeFormat array 模板格式
 * @param $infoFormat  array 内容格式(与模板格式相对应)
 * */
function execute_public_template($template, $templeFormat, $infoFormat, $wxuser)
{
    $message = C('TEMPLATE.' . $template);
    $message = str_replace($templeFormat, $infoFormat, $message);
    $postURL = 'https://api.weixin.qq.com/cgi-bin/message/template/send';
    $data = post_weixin_curl($wxuser, $postURL, $message);
    return $data;
}

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

/**
 * 微信OA登录
 */
class OauthTools
{
    static public function userinfo($openid)
    {
        $user = M('AuthorizeUser')->where(array('wx_open_id' => $openid))->find();
        if ($user && $user['update_time'] + 3600 * 48 > NOW_TIME) {
            $user['open_id'] = $user['wx_open_id'];
            unset($user['wx_open_id']);
            return $user;
        } else {
            return null;
        }
    }

    private static $tools = null;

    public static function __set_authorize($id, $authorize)
    {
        $authorize['id'] = $id;
        MCache::set('__OUATH2_AUTHORIZE_' . $id, $authorize, 20);
    }

    public static function __get_authorize($id)
    {
        $authorize = MCache::get('__OUATH2_AUTHORIZE_' . $id);
        if (!$authorize) {
            $authorize = M('Authorize')->find($id);
        }
        return $authorize;
    }

    public function _oauth($token, $url, $scope = 'snsapi_base', $state = NOW_TIME)
    {
        $wxuser = get_wxuser($token);
        $scope = $scope ?: 'snsapi_base';//snsapi_base
        $state = $state ?: NOW_TIME;
        $selfstate = md5(NOW_TIME . 'authorize');
        session('_oauth_state', $state);
        $authorize = array('redirect_uri' => $url, 'scope' => $scope, 'state' => $state, 'status' => 0, 'selfstate' => $selfstate, 'create_time' => NOW_TIME, 'appid' => $wxuser['appid'], 'secret' => $wxuser['appsecret']);
        $id = M('Authorize')->add($authorize);
        if ($id) {
            $this->__set_authorize($id, $authorize);
            $redirect_uri = urlencode('http://' . $_SERVER['HTTP_HOST'] . '/index.php/Oauth/callback?id=' . $id);
            $oauth_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $wxuser['appid'] . "&redirect_uri=$redirect_uri&response_type=code&scope={$scope}&state=$selfstate#wechat_redirect";
            redirect($oauth_url);
        } else {
            $this->error('授权失败!O(∩_∩)O~');
        }
    }

    public static function oauth($token, $url, $scope = 'snsapi_base')
    {
        if (self::$tools == null) {
            self::$tools = new OauthTools();
        }
        self::$tools->_oauth($token, $url, $scope);
    }
}

class MCache
{
    static $memcache = null;


    /**
     *
     * @return Memcache
     */
    public static function getInstance()
    {
        if (!self::$memcache) {

            /*self::$memcache = Cache::getInstance('File');*/
            self::$memcache = new Memcached();
            self::$memcache->addServer("127.0.0.1", 11211);
            self::$memcache->setOption(Memcached::OPT_COMPRESSION, false);
        }
        return self::$memcache;
    }

    /**
     *
     * @param String $key
     */
    public static function get($key)
    {
        return self::getInstance()->get(self::buildKey($key));
    }

    public static function getAll()
    {
        $keys = self::getInstance()->getAllKeys();
        return self::getInstance()->getMulti($keys);
    }


    public static function buildKey($key)
    {
        return $key;
    }

    /**
     *
     * @param String $key
     * @param String|array $value
     * @param int $expire
     */
    public static function set($key, $value, $expire = 3600)
    {
        if (is_array($value)) {
            error_log("\r\n" . '[' . $key . ']=[' . print_r($value, 1) . ']', 3, 2);
        } else {
            error_log("\r\n" . '[' . $key . ']=[' . $value . ']', 3, 2);
        }
        self::getInstance()->set(self::buildKey($key), $value, $expire);
    }

    public static function delete($key)
    {
        self::getInstance()->delete(self::buildKey($key));
        //  self::getInstance()->rm(self::buildKey($key));
    }

    public static function clear()
    {
        self::getInstance()->flush();
    }
}

if (!class_exists('Memcached')) {
    class Memcached
    {
        const OPT_COMPRESSION = 1;
        const OPT_DISTRIBUTION = 1;
        const DISTRIBUTION_CONSISTENT = 1;
        const OPT_HASH = 1;
        const HASH_CRC = 1;

        public function addServer()
        {

        }

        function addServers()
        {

        }

        public function setOption()
        {

        }

        public function get()
        {
            return false;
        }

        public function set($key, $value, $expire = 3600)
        {
            return true;
        }

        public function delete($key)
        {
            return true;
        }
    }
}
//微信用户信息
function get_app_info($token, $field = "*")
{
    static $_app_wxuser = array();
    $key = md5($token . $field);
    if (!isset($_app_wxuser[$key])) {
        $data = M('wxuser')->where(array('token' => $token))->field($field)->find();
        $_app_wxuser[$key] = $data;
    }
    return $_app_wxuser[$key];
}

//去除emoj表情
function filterEmoji($str)
{
    $str = preg_replace_callback(
        '/./u',
        function (array $match) {
            return strlen($match[0]) >= 4 ? '' : $match[0];
        },
        $str);
    return $str;
}

//阿里云接口请求
function ali_api_request($method, $url, $headers = array())
{
    array_push($headers, "Authorization:APPCODE " . "bb851762499542599b8bdd7b4b8a45d6");
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    if (1 == strpos("$" . $url, "https://")) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    $result = curl_exec($curl);
    return $result;
}

//获取&更新发现页列表信息
function _getDiscoverInfo()
{
    //最新内容  type:1-文章 2-视频 3-普通课程 4-团购课程 5-砍价 6-团购商品
    $articleList = M('article')->field('id,create_time,1 as type')->where(['cate_id' => array(['neq', 10], ['neq', 13], 'and'), 'status' => 2])->select();
    $videoList = M('article')->field('id,create_time,2 as type')->where(['cate_id' => 10, 'status' => 2])->select();
    $classList = M('product')->field('id,create_time,3 as type')->where(['status' => 1, 'check_status' => 2, 'type' => 1])->select();
    $groupClassList = M('group_product')->field('id,create_time,4 as type')
        ->where(['status' => array(['eq', 1], ['eq', 2], 'or'), 'check_status' => 2, 'start_time' => array('lt', time()),
            'end_time' => array('gt', time()), 'type' => ['neq', 2], 'is_show' => 1])->select();
    $bargainList = M('bargain')->field('id,start_time as create_time,5 as type')->where(['type' => 1, 'start_time' => ['lt', time()], 'end_time' => ['gt', time()]])->select();
    $bargainList = array_chunk($bargainList, 2);
    $bargainEnd = end($bargainList);
    if (count($bargainEnd) == 1) {
        array_pop($bargainList);
    }
    $newBargainList = [];
    foreach ($bargainList as $k => $v) {
        $newBargainList[] = [
            'create_time' => $v[0]['create_time'],
            'type' => $v[0]['type'],
            'info' => $v
        ];
    }
    $groupProductList = M('group_product')->field('id,create_time,6 as type')
        ->where(['status' => array(['eq', 1], ['eq', 2], 'or'), 'is_show' => 1, 'start_time' => array('lt', time()),
            'end_time' => array('gt', time()), 'check_status' => 2, 'type' => 2])->select();
    $groupProductList = array_chunk($groupProductList, 2);
    $groupProductEnd = end($groupProductList);
    if (count($groupProductEnd) == 1) {
        array_pop($groupProductList);
    }
    $newGroupProductList = [];
    foreach ($groupProductList as $k => $v) {
        $newGroupProductList[] = [
            'create_time' => $v[0]['create_time'],
            'type' => $v[0]['type'],
            'info' => $v
        ];
    }
    $list = array_merge($articleList, $classList, $videoList, $groupClassList, $newBargainList, $newGroupProductList);
    $flag = [];
    foreach ($list as $val) {
        $flag[] = $val['create_time'];
    }
    array_multisort($flag, SORT_DESC, $list);
    //存进缓存
    S('DISCOVER_INFO_LIST', $list);
    return $list;
}

function _getIndexInfo()
{
    //加载课程分类
    $list = M('product_class')->where(array('type' => 1))->order('sort desc')->select();
    $productList = [];
    foreach ($list as $k => $v) {
        //文章
        $article[$k] = M('article')->where(array('id' => $v['article_id'], 'status' => 2))->field('content', true)->find();
        if ($article[$k]) {
            $article[$k]['count'] = D('Comment')->getCountByArtId($article[$k]['id']);
            $article[$k]['collect'] = D('Collect')->getPageByType($article[$k]['id'], 5);
            $prefix[$k] = mb_strpos($article[$k]['title'], '】', 0, 'utf-8');
            $article[$k]['prefix'] = mb_substr($article[$k]['title'], 0, $prefix[$k] + 1, 'utf-8');
            $article[$k]['title'] = mb_substr($article[$k]['title'], $prefix[$k] + 1, null, 'utf-8');
            $article[$k]['class_title'] = $v['title'];
        }
        $productList[$k]['article'] = $article[$k];
        //团购课程
        $groupCurriculum[$k] = M('group_product')->where(array('class_id' => $v['id'], 'type' => 1,
            'is_show' => 1, 'check_status' => 2, 'status' => [array('eq', 1), array('eq', 2), 'or'],
            'start_time' => array('lt', time()), 'end_time' => array('gt', time())))->field('description,cost', true)
            ->order('create_time desc')->limit(2)->select();
        if ($groupCurriculum[$k]) {
            foreach ($groupCurriculum[$k] as $n => $m) {
                $groupCurriculumCount[$n] = M('order')->where(array('group_id' => array('eq', $m['id'],
                    'status' => array(array('eq', 1), array('eq', 4), 'or'))))->sum('amount');
                if (!$groupCurriculumCount[$n]) {
                    $groupCurriculum[$k][$n]['groupCount'] = 0;
                } else {
                    $groupCurriculum[$k][$n]['groupCount'] = $groupCurriculumCount[$n];
                }
                $groupCurriculum[$k][$n]['logo'] = M('organization')->where(array('token' => $m['token']))->getField('picture');
                $groupCurriculumTag = explode(' ', $m['tag']);
                $groupCurriculum[$k][$n]['tagA'] = $groupCurriculumTag[0] ?: '';
                $groupCurriculum[$k][$n]['tagB'] = $groupCurriculumTag[1] ?: '';
                $groupCurriculum[$k][$n]['tagC'] = $groupCurriculumTag[2] ?: '';
            }
        }
        $productList[$k]['groupCurriculum'] = $groupCurriculum[$k];
        //普通课程
        $product[$k] = M('product')->where(array('class_id' => $v['id'], 'check_status' => 2, 'status' => 1))
            ->field("id,title,f_title,pic_url,type,price,status,tag,token")->order('create_time desc')->find();
        if ($product[$k]) {
            $tag = explode(' ', $product[$k]['tag']);
            $product[$k]['tagA'] = $tag[0] ?: '';
            $product[$k]['tagB'] = $tag[1] ?: '';
            $product[$k]['tagC'] = $tag[2] ?: '';
            $price = json_decode($product[$k]['price'], true);
            $product[$k]['original_price'] = reset($price)['original_price'];
            $product[$k]['now_price'] = reset($price)['now_price'];
            $product[$k]['logo'] = M('organization')->where(array('token' => $product[$k]['token']))->getField('picture');
            $productList[$k]['product'] = $product[$k];
        } else {
            $productList[$k]['product'] = '';
        }
        //视频文章
        $video[$k] = M('article')->where(array('cate_id' => 13, 'status' => 2))->field('content', true)
            ->order('create_time desc')->limit($k, 1)->select();
        $productList[$k]['video'] = $video[$k][0];
        //团购商品&砍价
        if ($k % 2 == 1) {
            $bargainProduct[$k] = M('bargain')->field('id,key,type_id')->where(['type' => 1, 'start_time' => ['lt', time()],
                'end_time' => ['gt', time()], 'extra' => 2])->limit($k - 1, 2)->order('start_time desc')->select();
            if ($bargainProduct[$k]) {
                $bargainProductCount[$k] = count($bargainProduct[$k]);
                if ($bargainProductCount[$k] > 1) {
                    foreach ($bargainProduct[$k] as $l => $i) {
                        $newProduct = M('product')->field('pic_url,title,price,tag')->where(['id' => $i['type_id']])->find();
                        $bargainTag = explode(' ', $newProduct['tag']);
                        $prices = json_decode($newProduct['price'], true);
                        $bargainProduct[$k][$l] = [
                            'id' => $i['type_id'],
                            'key' => $i['key'],
                            'tagA' => $bargainTag[0] ?: '',
                            'tagB' => $bargainTag[1] ?: '',
                            'pic_url' => $newProduct['pic_url'],
                            'title' => mb_strlen($newProduct['title'], 'utf-8') > 10 ? mb_substr($newProduct['title'], 0, 10, 'utf-8') : $newProduct['title'],
                            'original_price' => $prices[$i['key']]['original_price'],
                            'now_price' => $prices[$i['key']]['now_price']
                        ];
                    }
                } elseif ($bargainProductCount[$k] = 1 && $k > 1) {//如果最后一组只有一个时，调取前一组的最后一个
                    $bargain[$k] = M('bargain')->field('id,key,type_id')->where(['type' => 1, 'start_time' => ['lt', time()],
                        'end_time' => ['gt', time()], 'extra' => 2])->limit($k - 2, 1)->order('start_time desc')->select();
                    $bargainProduct[$k][1] = $bargain[$k][0];
                    foreach ($bargainProduct[$k] as $l => $i) {
                        $newProduct = M('product')->field('pic_url,title,price,tag')->where(['id' => $i['type_id']])->find();
                        $bargainTag = explode(' ', $newProduct['tag']);
                        $prices = json_decode($newProduct['price'], true);
                        $bargainProduct[$k][$l] = [
                            'id' => $i['type_id'],
                            'key' => $i['key'],
                            'tagA' => $bargainTag[0] ?: '',
                            'tagB' => $bargainTag[1] ?: '',
                            'pic_url' => $newProduct['pic_url'],
                            'title' => mb_strlen($newProduct['title'], 'utf-8') > 10 ? mb_substr($newProduct['title'], 0, 10, 'utf-8') : $newProduct['title'],
                            'original_price' => $prices[$i['key']]['original_price'],
                            'now_price' => $prices[$i['key']]['now_price']
                        ];
                    }
                }
                $productList[$k]['bargain'] = $bargainProduct[$k];
            } else {
                $productList[$k]['bargain'] = [];
            }
        } else {
            $groupProducts[$k] = M('group_product')->where(array('type' => 2, 'is_show' => 1, 'check_status' => 2,
                'start_time' => array('lt', time()), 'end_time' => array('gt', time()),
                'status' => [array('eq', 1), array('eq', 2), 'or']))->field('description,cost', true)
                ->order('create_time desc')->limit($k, 2)->select();
            if ($groupProducts[$k]) {
                $groupProductsCount[$k] = count($groupProducts[$k]);
                if ($groupProductsCount[$k] > 1) {
                    foreach ($groupProducts[$k] as $q => $w) {
                        $groupProductCount[$q] = M('order')->where(array('group_id' => array('eq', $w['id']),
                            'status' => [array('eq', 1), array('eq', 4), 'or']))->sum('amount');
                        if (!$groupProductCount[$q]) {
                            $groupProducts[$k][$q]['groupCount'] = 0;
                        } else {
                            $groupProducts[$k][$q]['groupCount'] = $groupProductCount[$q];
                        }
                        $groupProducts[$k][$q]['logo'] = M('organization')->where(array('token' => $w['token']))->getField('picture');
                        $groupProductTag = explode(' ', $w['tag']);
                        $groupProducts[$k][$q]['tagA'] = $groupProductTag[0] ?: '';
                        $groupProducts[$k][$q]['tagB'] = $groupProductTag[1] ?: '';
                    }
                } elseif ($groupProductsCount[$k] == 1 && $k > 0) {//如果最后一组只有一个时，调取前一组的最后一个
                    $groupProduct[$k] = M('group_product')->where(array('type' => 2, 'is_show' => 1, 'check_status' => 2,
                        'start_time' => array('lt', time()), 'end_time' => array('gt', time()),
                        'status' => [array('eq', 1), array('eq', 2), 'or']))->field('description,cost', true)
                        ->order('create_time desc')->limit($k - 1, 1)->select();
                    $groupProducts[$k][1] = $groupProduct[$k][0];
                    foreach ($groupProducts[$k] as $q => $w) {
                        $groupProductCount[$q] = M('order')->where(array('group_id' => array('eq', $w['id']),
                            'status' => [array('eq', 1), array('eq', 4), 'or']))->sum('amount');
                        if (!$groupProductCount[$q]) {
                            $groupProducts[$k][$q]['groupCount'] = 0;
                        } else {
                            $groupProducts[$k][$q]['groupCount'] = $groupProductCount[$q];
                        }
                        $groupProducts[$k][$q]['logo'] = M('organization')->where(array('token' => $w['token']))->getField('picture');
                        $groupProductTag = explode(' ', $w['tag']);
                        $groupProducts[$k][$q]['tagA'] = $groupProductTag[0] ?: '';
                        $groupProducts[$k][$q]['tagB'] = $groupProductTag[1] ?: '';
                    }
                }
                $productList[$k]['groupProduct'] = $groupProducts[$k];
            } else {
                $productList[$k]['groupProduct'] = [];
            }
        }
    }
    //存进缓存
    S('INDEX_INFO_LIST', $productList);
    return $productList;
}