<?php
use Common\Controller\Wechat;
abstract class WeixinControllerModel extends \Think\Controller
{
    protected $data;
    protected $token;
    protected $key;
    protected $isDone = false;
    protected $result = NULL;
    protected $params = array();
    protected $my = 'OOYYEE';
    protected $keyword;

    public function isDone()
    {
        return $this->isDone;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setParams($key, $value)
    {
        $this->params[$key] = $value;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function before_reply()
    {
    }

    public function reply(&$data)
    {
        $this->my = C('site_my');
        $this->data = $data;
        $this->keyword = $data['Content'];
        $this->before_reply();
        $this->result = $this->_reply();
        $this->after_reply();
        $data['module'] = $this->data['module'];
        return $this->result;
    }

    public abstract function _reply();

    public function after_reply()
    {
    }

    function recordLastRequest($key, $msgtype = 'text')
    {
        $rdata = array();
        $rdata ['time'] = time();
        $rdata ['token'] = $this->token;
        $rdata ['keyword'] = $key;
        $rdata ['msgtype'] = $msgtype;
        $rdata ['uid'] = $this->data ['FromUserName'];
        $user_request_model = M('User_request');
        $user_request_row = $user_request_model->where(array(
            'token' => $this->token,
            'msgtype' => $msgtype,
            'uid' => $rdata ['uid']
        ))->find();
        if (!$user_request_row) {
            $user_request_model->add($rdata);
        } else {
            $rid ['id'] = $user_request_row ['id'];
            $user_request_model->where($rid)->save($rdata);
        }
    }

    protected function map($x, $y)
    {
        $user_request_model = M('User_request');
        $user_request_row = $user_request_model->where(array(
            'token' => $this->token,
            'msgtype' => 'text',
            'uid' => $this->data ['FromUserName']
        ))->find();
        if (!(strpos($user_request_row ['keyword'], '附近') === FALSE)) {
            $user = M('Nearby_user')->where(array(
                'token' => $this->token,
                'uid' => $this->data ['FromUserName']
            ))->find();
            $keyword = $user ['keyword'];
            $radius = 2000;
            $url = C('site_url') . '/map.php?keyword=' . urlencode($keyword) . '&x=' . $x . '&y=' . $y;
            $str = file_get_contents($url);
            $array = json_decode($str);
            $map = array();
            foreach ($array as $key => $vo) {
                $map [] = array(
                    $vo->title,
                    $key,
                    rtrim(C('site_url'), '/') . '/themes/Static/images/home.jpg',
                    $vo->url
                );
            }
            return array(
                $map,
                'news'
            );
        } else {
            import("Home.Action.MapAction");
            $mapAction = new MapAction ();
            if (!(strpos($user_request_row ['keyword'], '开车去') === FALSE) || !(strpos($user_request_row ['keyword'], '坐公交') === FALSE) || !(strpos($user_request_row ['keyword'], '步行去') === FALSE)) {
                if (!(strpos($user_request_row ['keyword'], '步行去') === FALSE)) {
                    $companyid = str_replace('步行去', '', $user_request_row ['keyword']);
                    if (!$companyid) {
                        $companyid = 1;
                    }
                    return $mapAction->walk($x, $y, $companyid);
                }
                if (!(strpos($user_request_row ['keyword'], '开车去') === FALSE)) {
                    $companyid = str_replace('开车去', '', $user_request_row ['keyword']);
                    if (!$companyid) {
                        $companyid = 1;
                    }
                    return $mapAction->drive($x, $y, $companyid);
                }
                if (!(strpos($user_request_row ['keyword'], '坐公交') === FALSE)) {
                    $companyid = str_replace('坐公交', '', $user_request_row ['keyword']);
                    if (!$companyid) {
                        $companyid = 1;
                    }
                    return $mapAction->bus($x, $y, $companyid);
                }
            } else {
                switch ($user_request_row ['keyword']) {
                    case '最近的' :
                        return $mapAction->nearest($x, $y);
                        break;
                    default:
                        return array(
                            "已收到你的地理位置：请输入\n步行去\n坐公交\n开车去\n最近的\n附近",
                            'text'
                        );
                }
            }
        }
    }

    public function user($action, $keyword = '')
    {
        $user = M('Wxuser')->field('uid')->where(array(
            'token' => $this->token
        ))->find();
        $usersdata = M('Users');
        $dataarray = array(
            'id' => $user ['uid']
        );
        $users = $usersdata->field('gid,diynum,connectnum,activitynum,viptime')->where(array(
            'id' => $user ['uid']
        ))->find();
        $group = M('User_group')->where(array(
            'id' => $users ['gid']
        ))->find();
        if ($users ['diynum'] < $group ['diynum']) {
            $data ['diynum'] = 1;
            if ($action == 'diynum') {
                $usersdata->where($dataarray)->setInc('diynum');
            }
        }
        if ($users ['connectnum'] < $group ['connectnum']) {
            $data ['connectnum'] = 1;
            if ($action == 'connectnum') {
                $usersdata->where($dataarray)->setInc('connectnum');
            }
        }
        if ($users ['viptime'] > time()) {
            $data ['viptime'] = 1;
        }
        return $data;
    }

    public function get_tags($title, $num = 10)
    {
        vendor('Pscws.Pscws4', '', '.class.php');
        $pscws = new PSCWS4 ();
        $pscws->set_dict(CONF_PATH . 'etc/dict.utf8.xdb');
        $pscws->set_rule(CONF_PATH . 'etc/rules.utf8.ini');
        $pscws->set_ignore(true);
        $pscws->send_text($title);
        $words = $pscws->get_tops($num);
        $pscws->close();
        $tags = array();
        foreach ($words as $val) {
            $tags [] = $val ['word'];
        }
        return implode(',', $tags);
    }
}

?>