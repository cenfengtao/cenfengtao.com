<?php
namespace Home\Controller;

use Think\Controller;

class OauthController extends Controller
{
    public function callback()
    {
        $id = $_GET['id'];
        $code = $_GET['code'];
        $state = $_GET['state'];
        $authorize = \OauthTools::__get_authorize($id);
        if ($authorize) {
            if ($authorize['selfstate'] == $state) {
                if ($code) {
                    $authorize['code'] = $code;
                    M('Authorize')->where(array('id' => $id))->setField('code', $code);
                    \OauthTools::__set_authorize($id, $authorize);
                    $this->access_token();
                } else {
                    $this->error('用户禁止授权!O(∩_∩)O~');
                }
            } else {
                $this->error('非法访问本链接!O(∩_∩)O~');
            }
        } else {
            $this->error('授权失败!O(∩_∩)O~');
        }
    }

    private function __http($url, $post = '', $extra = array(), $timeout = 60)
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
            curl_setopt($ch, CURLOPT_HEADER, 0);
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
                return @json_decode($data, true);
            }
        }
        return false;
    }

    public function access_token()
    {
        $id = $_GET['id'];
        $authorize = \OauthTools::__get_authorize($id);
        if ($authorize) {
            if ($authorize['openid'] && $authorize['status'] == 1) {
                $this->process_wx_open_id($id, $authorize, $authorize['openid']);
            } else {
                $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$authorize['appid']}&secret={$authorize['secret']}&code={$authorize['code']}&grant_type=authorization_code";
                $data = $this->__http($url);
                $open_id = $data ['openid'];
                if ($open_id) {
                    $authorize['openid'] = $open_id;
                    $authorize['access_token'] = $data['access_token'];
                    $authorize['refresh_token'] = $data['refresh_token'];
                    $authorize['status'] = 1;
                    D('Authorize')->updateById($id, array('openid' => $open_id, 'status' => 1));
                    \OauthTools::__set_authorize($id, $authorize);
                    if ($data['scope'] == 'snsapi_userinfo') { // 系统获取用户信息
                        $this->oauth_userinfo($data['access_token'], $data['refresh_token'], $open_id, $authorize);
                    } else {
                        $this->process_wx_open_id($id, $authorize, $open_id);
                    }
                } else {
                    $this->error_ajax_return($data);
                }
            }
        } else {
            $this->result(array('status' => 0, 'errcode' => 1, 'message' => '授权失败!O(∩_∩)O~'));
        }
    }

    public function process_wx_open_id($id, $authorize, $open_id)
    {
        if ($authorize['scope'] == 'snsapi_userinfo') {  // 网站想获得用户信息
            $user = D('User')->getUserByOpenid($open_id);
            if ($user) {  // 本地有用户信息
                if ($user['access_time'] + 3600 * 24 > NOW_TIME) { // 本地数据库保存的数据还没有到24小时，那么就用本地数据库的
                    $this->success_result_userinfo($authorize);
                } else { // 用refresh_token 换取access_token
                    if ($user['refresh_token']) {
                        $refresh_url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid={$authorize['appid']}&grant_type=refresh_token&refresh_token={$user['refresh_token']}";
                        $refresh_token_result = $this->__http($refresh_url);
                        if ($refresh_token_result['access_token']) {// 换取access_token 成功
                            // 获取oauth 用户
                            $this->oauth_userinfo($refresh_token_result['access_token'], $refresh_token_result['refresh_token'], $open_id, $authorize, $user);
                        } else { // 换取access_token 失败了
                            if (42002 == $refresh_token_result['errcode']) { // 如果是refresh_token 过期了
                                $this->fail_result_userinfo_snsapi($id, $authorize); // 重新授权
                            } elseif (40030 == $refresh_token_result['errcode']) {//token 不合法
                                $this->fail_result_userinfo_snsapi($id, $authorize); // 重新授权
                            } else {
                                $this->error_ajax_return($refresh_token_result);
                            }
                        }
                    } else {
                        $this->fail_result_userinfo_snsapi($id, $authorize); // 重新授权
                    }
                }
            } else { // 本地没有该用户信息
                $this->fail_result_userinfo_snsapi($id, $authorize);// 需要授权
            }
        } else {
            $this->success_result_userinfo($authorize);
        }
    }

    //获取用户信息
    public function getWxUserInfo($accessToken, $openid)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$accessToken}&openid={$openid}&lang=zh_CN";
        $result = http_get($url, true);
        $result = json_decode($result['content'], true);
        if (!$result['openid'] || empty($result['openid'])) {
            $this->error('获取用户信息失败');
        }
        return $result;
    }

    //通过code获取access_token
    function getAccessByCode($code)
    {
        $result = http_get("https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . C(APPID) . "&secret=" . C(SECRET) . "&code={$code}&grant_type=authorization_code ", true);
        $result = json_decode($result['content'], true);
        if (!$result['access_token'] || empty($result['access_token'])) {
            $this->error('授权失败');
        }
        return $result;
    }

    public function success_result_userinfo($authorize)
    {
        $_SESSION['openid'] = $authorize['openid'];
        $urlset = parse_url(urldecode($authorize['redirect_uri']));
        if (empty ($urlset ['path'])) {
            $urlset ['path'] = '/';
        }
        if (!empty ($urlset ['query'])) {
            $urlset ['query'] = "?{$urlset['query']}&openid={$authorize['openid']}&state={$authorize['state']}&scope={$authorize['scope']}";
        } else {
            $urlset ['query'] = "?openid={$authorize['openid']}&state={$authorize['state']}&scope={$authorize['scope']}";
        }
        if (empty ($urlset ['port'])) {
            $urlset ['port'] = '80';
        }
        $url = $urlset ['scheme'] . '://' . $urlset ['host'] . ($urlset ['port'] == '80' ? '' : ':' . $urlset ['port']) . $urlset ['path'] . $urlset ['query'];
        $this->result(array('status' => 1, 'errcode' => 0, 'url' => $url));
    }

    public function result($result)
    {
        if (IS_AJAX) {
            $this->ajaxReturn($result);
        } else {
            if ($result['status'] == 1) {
                redirect($result['url']);
            } else if ($result['status'] == 0 && $result['errcode'] == 404) {
                redirect($result['url']);
            } else {
                $this->assign('error', 'true');
                $this->assign('message', $result['message']);
                $this->display('authorize');
            }
        }
    }

    public function oauth_userinfo($access_token, $refresh_token, $openid, $authorize, $user = array())
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
        $userinfo = $this->__http($url);
        if ($userinfo) { // oauth 获取用户信息成功
            $userinfo['access_time'] = NOW_TIME;
            $userinfo['access_token'] = $access_token;
            $userinfo['refresh_token'] = $refresh_token;
            $userinfo['open_id'] = $openid;
            $userinfo['username'] = filterEmoji($userinfo['nickname']);
            $userinfo['last_login_time'] = time();
            $this->update_authorize_user($user, $userinfo); // 更新本地用户信息
            $this->success_result_userinfo($authorize);
        } else {
            $this->error_ajax_return($userinfo);
        }
    }

    public function fail_result_userinfo_snsapi($id, $authorize)
    {
        $redirect_uri = urlencode('http://' . $_SERVER ['HTTP_HOST'] . '/oauth/callback.php?id=' . $id);
        $oauth_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$authorize['appid']}&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state={$authorize['selfstate']}#wechat_redirect";
        $this->result(array('status' => 0, 'errcode' => 404, 'url' => $oauth_url)); // 需要授权
    }

    public function update_authorize_user($user, $userinfo)
    {
        if (empty($user)) {
            $user = D('User')->getUserByOpenid($userinfo['open_id']);
        }
        if (!$user['open_id'] || empty($user['open_id'])) {
            $userinfo['create_time'] = time();
            $userId = D('User')->insert($userinfo);
        } else {
            $userId = D('User')->updateById($user['id'], $userinfo);
        }
        return $userId;
    }

    /**
     * 全局错误反回码
     *
     * @param unknown_type $code
     * @return Ambigous <string>
     */
    public function error_code($code)
    {
        $array = array(
            1 => '系统繁忙',
            0 => '请求成功',
            40001 => '获取access_token时AppSecret错误，或者access_token无效',
            40002 => '不合法的凭证类型',
            40003 => '不合法的OpenID',
            40004 => '不合法的媒体文件类型',
            40005 => '不合法的文件类型',
            40006 => '不合法的文件大小',
            40007 => '不合法的媒体文件id',
            40008 => '不合法的消息类型',
            40009 => '不合法的图片文件大小',
            40010 => '不合法的语音文件大小',
            40011 => '不合法的视频文件大小',
            40012 => '不合法的缩略图文件大小',
            40013 => '不合法的APPID',
            40014 => '不合法的access_token',
            40015 => '不合法的菜单类型',
            40016 => '不合法的按钮个数',
            40017 => '不合法的按钮个数',
            40018 => '不合法的按钮名字长度',
            40019 => '不合法的按钮KEY长度',
            40020 => '不合法的按钮URL长度',
            40021 => '不合法的菜单版本号',
            40022 => '不合法的子菜单级数',
            40023 => '不合法的子菜单按钮个数',
            40024 => '不合法的子菜单按钮类型',
            40025 => '不合法的子菜单按钮名字长度',
            40026 => '不合法的子菜单按钮KEY长度',
            40027 => '不合法的子菜单按钮URL长度',
            40028 => '不合法的自定义菜单使用用户',
            40029 => '不合法的oauth_code',
            40030 => '不合法的refresh_token',
            40031 => '不合法的openid列表',
            40032 => '不合法的openid列表长度',
            40033 => '不合法的请求字符，不能包含\uxxxx格式的字符',
            40035 => '不合法的参数',
            40038 => '不合法的请求格式',
            40039 => '不合法的URL长度',
            40050 => '不合法的分组id',
            40051 => '分组名字不合法',
            41001 => '缺少access_token参数',
            41002 => '缺少appid参数',
            41003 => '缺少refresh_token参数',
            41004 => '缺少secret参数',
            41005 => '缺少多媒体文件数据',
            41006 => '缺少media_id参数',
            41007 => '缺少子菜单数据',
            41008 => '缺少oauthcode',
            41009 => '缺少openid',
            42001 => 'access_token超时',
            42002 => 'refresh_token超时',
            42003 => 'oauth_code超时',
            43001 => '需要GET请求',
            43002 => '需要POST请求',
            43003 => '需要HTTPS请求',
            43004 => '需要接收者关注',
            43005 => '需要好友关系',
            44001 => '多媒体文件为空',
            44002 => 'POST的数据包为空',
            44003 => '图文消息内容为空',
            44004 => '文本消息内容为空',
            45001 => '多媒体文件大小超过限制',
            45002 => '消息内容超过限制',
            45003 => '标题字段超过限制',
            45004 => '描述字段超过限制',
            45005 => '链接字段超过限制',
            45006 => '图片链接字段超过限制',
            45007 => '语音播放时间超过限制',
            45008 => '图文消息超过限制',
            45009 => '接口调用超过限制',
            45010 => '创建菜单个数超过限制',
            45015 => '回复时间超过限制',
            45016 => '系统分组，不允许修改',
            45017 => '分组名字过长',
            45018 => '分组数量超过上限',
            46001 => '不存在媒体数据',
            46002 => '不存在的菜单版本',
            46003 => '不存在的菜单数据',
            46004 => '不存在的用户',
            47001 => '解析JSON/XML内容错误',
            48001 => 'api功能未授权',
            50001 => '用户未授权该api'
        );
        return $array [$code];
    }

    public function error_ajax_return($data)
    {
        $this->result(array('status' => 0, 'errcode' => $data['errcode'], 'message' => $this->error_code($data['errcode'])));
    }
}