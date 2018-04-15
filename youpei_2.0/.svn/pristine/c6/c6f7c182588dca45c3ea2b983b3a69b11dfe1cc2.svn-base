<?php
namespace Org\Util;
class JSModel
{
    private $call_count = 0;
    private $wxuser = null;
    private static $instance = null;
    private $package = null;

    /**
     * wxuser 必须有 appid,appsecret,wxid 字段
     * @param array $wxuser
     * @author lpdx111
     * 开发日期 2015-1-12 上午9:34:19
     *
     */
    private function __construct(array $wxuser)
    {
        $this->wxuser = $wxuser;
    }

    public static function getInstance($wxuser)
    {
        if (!JSModel::$instance) {
            if (!$wxuser['appid']) {
                $wxuser['appid'] = 'wx2a478415b419d817';
                $wxuser['appsecret'] = '5777fd0e27efa96cf5c85bbf1d2e5baa';
            }
            $wxuser['share_appid'] = $wxuser['share_appid'] ? $wxuser['share_appid'] : $wxuser['appid'];
            $wxuser['share_appsecret'] = $wxuser['share_appsecret'] ? $wxuser['share_appsecret'] : $wxuser['appsecret'];
            JSModel::$instance = new JSModel($wxuser);
        }
        return JSModel::$instance;
    }


    public function getSignPackage()
    {
        if ('localhost' == $_SERVER['HTTP_HOST']) {
            return array('timestamp' => NOW_TIME);
        }
        if ($this->package) {
            return $this->package;
        }
        $jsapiTicket = $this->getJsApiTicket();
        $url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $timestamp = NOW_TIME;
        $nonceStr = $this->createNonceStr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId" => $this->wxuser['share_appid'],
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        $this->package = $signPackage;
        return $signPackage;
    }

    private function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }


    private function getJsApiTicket($refresh = false)
    {
        $this->call_count++;
        $CACHE_KEY = 'JS_TICKET_' . $this->wxuser['share_appid'];
        $ticket = \MCache::get($CACHE_KEY);
        if (!$ticket || $refresh) {
            if ($this->call_count > 1) {
                \Tools::log('REFRESH_CALL_getJsApiTicket_wecha_id' . session('wecha_id') . '__call_count=' . $this->call_count);
            }
            //
            $wxuser = $this->wxuser;
            $wxuser['appid'] = $wxuser['share_appid'];
            $wxuser['appsecret'] = $wxuser['share_appsecret'];
            $access_token = get_weixin_access_token($wxuser, $refresh);
            if ($access_token) {
                $content = http_get("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token}&type=jsapi");
                $result = @json_decode($content ['content'], true);
                $ticket = $result ['ticket'];
                $expires_in = (int)$result['expires_in'];
                if ($ticket) {
                    \MCache::set($CACHE_KEY, $ticket, $expires_in - 200);
                } else {
                    \Tools::log('获取JS_TICKET_时' . $this->wxuser ['share_appid'] . ' 发生错误:' . $result['errcode'] . '-' . $result['errmsg'], __FILE__ . '_' . __LINE__);
                    if ($result['errcode'] == '40001') {
                        if ($this->call_count < 2) {
                            return $this->getJsApiTicket(true);
                        }
                    }
                }
            } else {
                if ($this->call_count < 2) {
                    return $this->getJsApiTicket(true);
                }
            }
        }

        //Tools::log("TICKET:<span style='color:red;'>$ticket</span><br/>WECHAID:<span style='color:green'>{$_SESSION['wecha_id']}</span> <br/>URL:<span style='color:blue;'>".__SELF__."</span>" ,$CACHE_KEY,__FILE__.__LINE__);
        return $ticket;
    }
}

?>