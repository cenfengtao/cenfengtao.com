<?php
namespace Home\Controller;

use Think\Controller;
use Org\Util\Secure;
use  Org\Util\JSModel;
use Common\Controller\Wechat;

require_once __DIR__ . '/../../../ThinkPHP/Library/Org/Util/JSDDK.class.php';

class BaseController extends Controller
{
    public $user;
    public $token;

    public function __construct()
    {
        parent::__construct();
//        if (!$this->checkWxAgent()) {
//            $this->error('请在微信中打开');
//        }
        $this->token = $this->initToken();
        $openid = $this->__checkOpenId();
        $this->isUpdateByOpenid($openid);
        $this->user = D('User')->getUserByOpenid($openid);
        $this->isShareUser();
        $wxuser = get_wxuser($this->token);
        $jssdk = new \JSSDK($wxuser['appid'], $wxuser['appsecret']);
        $signPackage = $jssdk->GetSignPackage();
        //设置默认分享信息
        $shareData = [
            'share_title' => '优培圈-育儿教育资讯平台',
            'share_desc' => "您的好友 {$this->user['username']} 给您一张优培圈【通行证】，点击进入。",
            'share_url' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER["QUERY_STRING"] . '&share_user_id=' . $this->user['id'] . '&token=' . $this->token,
            'share_img' => 'http://www.youpei-exc.com/Public/images/logo_m.png',
        ];
        $this->assign('signPackage', $signPackage)->assign('shareData', $shareData);
    }

    /**
     * 空操作处理
     */
    public function _empty($name)
    {
        $this->assign('msg', "你的思想太飘忽，系统完全跟不上....");
        $this->display('Common:sys_msg');
    }


    //检测微信代理
    public function checkWxAgent()
    {
        $agent = $_SERVER ['HTTP_USER_AGENT'];
        if (strpos($agent, "MicroMessenger") > 0) {
            return true;
        } else {
            return false;
        }
    }

    // 说明：获取无参数URL
    protected function curPageURL()
    {
        return 'http://' . $_SERVER ['HTTP_HOST'] . __SELF__;
    }

    protected function __authorizeJump($isMustUserInfo = false, $url = '')
    {
        $state = uniqid();
        $callback = $this->curPageURL();
        $callback = str_replace('nocache', '_n', $callback);
        $callback = $url ? $url : $callback;
        $callback = urlencode($callback);
        $_SESSION['OAUTH_STATE'] = $state;
        if ($isMustUserInfo) {
            $scope = 'snsapi_userinfo';
        } else {
            $scope = 'snsapi_base';
        }
        \OauthTools::oauth($this->token, $callback, $scope);
    }

    protected function __checkOpenId()
    {
        $openid = $_SESSION['openid'];
        if (!$openid) {
            $this->__authorizeJump();
        }
        return $openid;
    }

    protected function isUpdateByOpenid($openid)
    {
        $user = D('User')->getUserByOpenid($openid);
        if ($user) {
            // 1-已关注 2-未关注
            $userStatus = $this->attentioni();
            $lastLoginTime = M('user')->where(array('open_id' => $openid))->getField('last_login_time');
            //3天之内没登录且没关注的的提示关注
            $threeDay = strtotime(date('Y-m-d H:i:s', time())) - (86400 * 3);
            // 1-不提示 2-提示关注
            if ($lastLoginTime < $threeDay && $userStatus == 2) {
                $attentionStatus = 2;
            } else {
                $attentionStatus = 1;
            }
            //7天之内没登录的提示“玩转2.0”
            $sevenDay = strtotime(date('Y-m-d H:i:s', time())) - (86400 * 7);
            //1-不需要提醒 2-需要提醒
            if ($lastLoginTime < $sevenDay) {
                $hintStatus = 2;
            } else {
                $hintStatus = 1;
            }
            $this->assign('attentionStatus', $attentionStatus)->assign('userStatus', $userStatus)->assign('hintStatus', $hintStatus);
            D('User')->updateById($user['id'], array('last_login_time' => time()));
            if ($user['access_time'] + 3600 * 48 < time()) {
                $this->__authorizeJump(1);
            }
        } else {
            $this->__authorizeJump(1);
        }
    }

    public function get_http_domain()
    {
        return rtrim(C('site_url'), '/');
    }

    public function isShareUser()
    {
        //增加浏览记录并设置上下级
        if ($_GET['share_user_id'] && !empty($_GET['share_user_id']) && empty($this->user['up_user_id'])) {
            if ($_GET['share_user_id'] == $this->user['id']) {
                return false;
            }
            D('User')->updateById($this->user['id'], array('up_user_id' => $_GET['share_user_id']));
            $config = M('config')->where("token='{$this->token}'")->find();
            $integral = $this->add_user_integral($this->user['id'], $config['task_schoolmate_integral'], $config['max_integral']);
            //判断分享者是否完成每日任务
            $isInviteByTask = D('IntegralRecord')->isInviteByTask($_GET['share_user_id']);
            if (empty($isInviteByTask)) {
                $integralDataByShare = [
                    'user_id' => $_GET['share_user_id'],
                    'create_time' => time(),
                    'status' => 1,
                    'type' => 2,
                    'integral_type' => 8,
                    'desc' => '每日邀请任务',
                    'integral' => $integral['integral'],
                    'token' => $this->token,
                ];
                D('IntegralRecord')->insert($integralDataByShare);
                M('User')->where("id={$_GET['share_user_id']}")->setInc('integral', $integral['integral']);
                if ($integral['integral'] > 0) {
                    //发送通知模板
                    $nowIntegral = D('User')->getIntegralById($this->user['id']);
                    $first = '【优培圈】温馨提醒您的积分有变动';
                    $keyword1 = '+' . $config['task_schoolmate_integral'] . '分';
                    $keyword2 = '每日邀请任务';
                    $keyword3 = date("Y-m-d H:i:s", time());
                    $keyword4 = $integral['integral'] . '分';
                    $remark = '请点击“详情”查看具体内容';
                    $url = "http://{$_SERVER['HTTP_HOST']}/index.php/MemberIntegral/integrallist?token=" . $this->token;
                    $templeFormat = array('__OPENID__', '__URL__', '__FIRST__', '__KEYWORD1__', '__KEYWORD2__', '__KEYWORD3__', '__KEYWORD4__', '__REMARK__');
                    $infoFormat = array($this->user['open_id'], $url, $first, $keyword1, $keyword2, $keyword3, $keyword4, $remark);
                    $wxuser = get_wxuser($this->token);
                    execute_public_template('INTEGRAL_CHANGE', $templeFormat, $infoFormat, $wxuser);
                }
            }
        }
    }

    //检测token是否存在
    private function initToken()
    {
        $token = $_REQUEST ['token'];
        if (!$token) {
            $token = $_SESSION ['token'];
            if (!$token) {
                $this->error('token不能为空');
            }
        } else {
            $_SESSION ['token'] = $_REQUEST ['token'];
        }
        return $token;
    }

    //收藏
    public function collect()
    {
        $type = $_GET['type'];
        //type 1：机构 2：课程 3：商品 4：活动 5：文章
        $isCollect = D('Collect')->isCollectById($this->user['id'], $_GET['id'], $type);
        if ($isCollect) {//取消收藏
            $id = D('Collect')->deleteCollectById($this->user['id'], $_GET['id'], $type);
            if ($id) {
                $this->ajaxReturn(array('status' => '2'));
            }
        } else {//加入收藏
            $data = [
                'user_id' => $this->user['id'],
                'type_id' => $_GET['id'],
                'type' => $type,
                'create_time' => time()
            ];
            $id = D('Collect')->insert($data);
            if ($id) {
                $this->ajaxReturn(array('status' => '1'));
            }
        }
    }

    public function add_user_integral($userid, $integral, $max_integral)
    {
        // 今天已经获得的分数
        $date = strtotime(date("Y-m-d 00:00:00")); //时间戳
        $fetched = M('integral_record')->where(array(
            'user_id' => $userid,
            'type' => 2,
            'create_time' => array('egt', $date)
        ))->sum('integral');
        if ($integral > $max_integral) {
            $integral = $max_integral;
        }
        if ($max_integral == 0) {
            $data['integral'] = $integral;
        } else {
            $data['integral'] = min($integral, $max_integral - $fetched);
        }
        if ($data['integral'] <= 0) {
            $data['integral'] = 0;
        }
        return $data;
    }

    //用户是否关注公众号
    public function attentioni()
    {
        $access_token = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . C('APPID') . "&secret=" . C('SECRET');
        $access_msg = json_decode(file_get_contents($access_token));
        $token = $access_msg->access_token;
        $openid = $this->__checkOpenId();
        $subscribe_msg = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openid";
        $subscribe = json_decode(file_get_contents($subscribe_msg));
        $result = $subscribe->subscribe;
        //$userStatus 1 已关注
        if ($result === 1) {
            $userStatus = 1;
        } else {
            $userStatus = 2;
        }
        return $userStatus;
    }

    //增加浏览记录
    public function addFootprint($type, $typeId)
    {
        $isRead = M('footprint')->where(['type' => $type, 'type_id' => $typeId, 'user_id' => $this->user['id']])->getField('id');
        if ($isRead) { //已经浏览过，更新时间
            D('Footprint')->updateById($isRead, ['create_time' => time()]);
        } else { //增加记录
            $insertData = [
                'create_time' => time(),
                'user_id' => $this->user['id'],
                'type' => $type,
                'type_id' => $typeId,
                'status' => 1
            ];
            D('Footprint')->insert($insertData);
        }
    }
}