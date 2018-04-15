<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class SignController extends BaseController
{
    public function index()
    {
        $this->title = '签到页面';
        //当月签到次数
        $month = strtotime(date('Y-m', time()));
        $list = M('sign')->where(array('user_id' => $this->user['id'], 'create_time' => array('EGT', $month)))->select();
        //连续签到人数最近10人
        $num = D('SignGiftRecord')->getList();
        foreach ($num as $k => $v) {
            $num[$k]['name'] = D('User')->getNameById($v['user_id']);
        }
        //今日时间戳
        $start = strtotime(date('Y-m-d 00:00:00'));
        $status = D('Sign')->getStatusUserId($this->user['id'], $start);
        $data = [];
        foreach ($list as $k => $v) {
            $i[$k] = date('d', $v['create_time']);
            foreach ($i as $ke => $va) {
                $data[$ke] = $va - 1;
            }
        }
        $datas = json_encode($data);
        //广告图
        $config = D('Config')->find(1);
        $count = $list[0]['count'];
        $this->assign('data', $datas)->assign('count', $count)->assign('status', $status)->assign('config', $config)->assign('num', $num);
        $this->display();
    }

    //签到
    public function today_signin()
    {
        //判断ajax和post
        if (IS_AJAX && IS_POST) {
            $t = time();
            //今日时间戳
            $now_start_time = strtotime(date('Y-m-d 00:00:00'));
            $now_end_time = strtotime(date('Y-m-d H:i:s'));
            $res = M('sign')->where(array('create_time' => array(array('gt', $now_start_time), array('lt', $now_end_time), 'and'), 'user_id' => $this->user['id']))->find();
            $list = D('Sign')->getListUserId($this->user['id']);
            //今天是否有记录签到
            if ($res) {
                $this->ajaxReturn(array('status' => 1, 'msg' => '今天已经签到过了'));
            }
            //昨天时间戳
            $last_start_time = mktime(0, 0, 0, date("m", $t), date("d", $t) - 1, date("Y", $t));
            $last_end_time = mktime(23, 59, 59, date("m", $t), date("d", $t) - 1, date("Y", $t));
            //昨天是否有记录签到
            if ($last_start_time < $list[0]['create_time'] && $list[0]['create_time'] < $last_end_time) {
                //每月次数清0
                $year_start_time = date('Y-m', time());
                $yearRecord = M('sign')->where(array('create_time' => array('gt', $year_start_time), 'user_id' => $this->user['id']))->getField('id');
                if ($yearRecord) {
                    $newCount = $list[0]['count'] + 1;
                } else {
                    $newCount = 1;
                }
                $rest = D('Sign')->addinsertSign($this->user['id'], $newCount);
            } else {
                $rest = D('Sign')->addinsertSign($this->user['id'], 1);
            }
            //添加签到记录
            $config = M('config')->find();
            $integral = $this->add_user_integral($this->user['id'], $config['task_sign_integral'], $config['max_integral']);
            $data = array();
            $data['user_id'] = $this->user['id'];
            $data['integral'] = $integral['integral'];
            $data['status'] = 1;
            $data['type'] = 2;
            $data['integral_type'] = 1;
            $data['desc'] = '签到赠送积分';
            $data["create_time"] = time();
            $data['token'] = $this->token;
            $rs = M('integral_record')->add($data);
            if (false !== $rs) {
                $re = array(
                    'lottery_count' => array('exp', '`lottery_count`+1'),
                    'integral' => array('exp', '`integral`+' . $integral['integral']));
                M('user')->where(array('id' => $this->user['id']))->setInc($re);
            }
            if ($integral['integral'] > 0) {
                //发送通知模板
                $nowIntegral = M('user')->where("id={$this->user['id']}")->getField('integral');
                $first = '【优培圈】温馨提醒您的积分有变动';
                $keyword1 = '+' . $integral['integral'] . '分';
                $keyword2 = '签到赠送积分';
                $keyword3 = date("Y-m-d H:i:s", time());
                $keyword4 = $nowIntegral . '分';
                $remark = '请点击“详情”参与幸运大抽奖';
                $url = "http://{$_SERVER['HTTP_HOST']}/index.php/Lottery/index?token=" . $this->token;
                $templeFormat = array('__OPENID__', '__URL__', '__FIRST__', '__KEYWORD1__', '__KEYWORD2__', '__KEYWORD3__', '__KEYWORD4__', '__REMARK__');
                $infoFormat = array($this->user['open_id'], $url, $first, $keyword1, $keyword2, $keyword3, $keyword4, $remark);
                $wxuser = get_wxuser($this->token);
                execute_public_template('INTEGRAL_CHANGE', $templeFormat, $infoFormat, $wxuser);
            }
            $count = D('Sign')->find($rest);
            if ($count['count'] == 7) {
                //1：积分integral 2：红包red 3：代金券
                $status = D('SignGiftRecord')->getStatus($this->user['id'], 7);
                if ($status == 0) {
                    $data = [
                        //份额
                        'amount' => 20,
                    ];
                    M('user')->where(array('id' => $this->user['id']))->setInc('integral', $data['amount']);
                    //增加签到发放记录
                    $record = array(
                        'user_id' => $this->user['id'],
                        'username' => $this->user['username'],
                        'title' => '连续7天签到送积分',
                        'amount' => $data['amount'],
                        'create_time' => NOW_TIME,
                        'type' => 1,
                        'typeid' => 7
                    );
                    $res = D('SignGiftRecord')->insert($record);
                    if ($res) {
                        $arr = [
                            'user_id' => $this->user['id'],
                            'integral' => $data['amount'],
                            'status' => 1,
                            'type' => 2,
                            'integral_type' => 1,
                            'desc' => '连续7天签到送积分',
                            'create_time' => time(),
                            'token' => $this->token,
                        ];
                        $rs = M('integral_record')->add($arr);
                        $re = $this->sendTemplate($data['amount'], 7);
                        $this->ajaxReturn(array('status' => 2, 'msg' => '连续签到7天成功'));
                    }
                }
            } elseif ($count['count'] == 14) {
                //1：积分integral 2：红包red 3：代金券
                $status = D('SignGiftRecord')->getStatus($this->user['id'], 14);
                if ($status == 0) {
                    $data = [
                        //份额
                        'amount' => 30,
                    ];
                    M('user')->where(array('id' => $this->user['id']))->setInc('integral', $data['amount']);
                    //增加签到发放记录
                    $record = array(
                        'user_id' => $this->user['id'],
                        'username' => $this->user['username'],
                        'title' => '连续14天签到送积分',
                        'amount' => $data['amount'],
                        'create_time' => NOW_TIME,
                        'type' => 1,
                        'typeid' => 14,
                    );
                    $res = D('SignGiftRecord')->insert($record);
                    if ($res) {
                        $arr = [
                            'user_id' => $this->user['id'],
                            'integral' => $data['amount'],
                            'status' => 1,
                            'type' => 2,
                            'integral_type' => 1,
                            'desc' => '连续14天签到送积分',
                            'create_time' => time(),
                            'token' => $this->token,
                        ];
                        $rs = M('integral_record')->add($arr);
                        $re = $this->sendTemplate($data['amount'], 14);
                        $this->ajaxReturn(array('status' => 2, 'msg' => '连续签到14天成功'));
                    }
                }
            } elseif ($count['count'] == 30) {
                $id = M('sign')->where(array('user_id' => $this->user['id']))->order('create_time desc')->getField('id');
                $countData = ['count' => 0];
                $isSign = D('Sign')->updateById($id, $countData);
                if ($isSign) {
                    $data = [
                        //份额
                        'amount' => 100,
                    ];
                    //1：积分integral 2：红包red 3：代金券
                    $status = D('SignGiftRecord')->getStatus($this->user['id'], 30);
                    if ($status == 0) {
                        M('user')->where(array('id' => $this->user['id']))->setInc('integral', $data['amount']);
                        //增加签到发放记录
                        $record = array(
                            'user_id' => $this->user['id'],
                            'username' => $this->user['username'],
                            'title' => '连续30天签到送积分',
                            'amount' => $data['amount'],
                            'create_time' => NOW_TIME,
                            'type' => 1,
                            'typeid' => 30
                        );
                        $res = D('SignGiftRecord')->insert($record);
                        if ($res) {
                            $arr = [
                                'user_id' => $this->user['id'],
                                'integral' => $data['amount'],
                                'status' => 1,
                                'type' => 2,
                                'integral_type' => 1,
                                'desc' => '连续30天签到送积分',
                                'create_time' => time(),
                                'token' => $this->token,
                            ];
                            $rs = M('integral_record')->add($arr);
                            $re = $this->sendTemplate($data['amount'], 30);
                            $this->ajaxReturn(array('status' => 2, 'msg' => '连续签到30天成功'));
                        }
                    }
                }
            }
            if ($rest) {
                $this->ajaxReturn(array('status' => 1, 'msg' => '连续签到' . $count['count'] . '天成功'));
            }
        }
    }

    public function sendTemplate($amount, $day)
    {
        $nowIntegral = M('user')->where("id={$this->user['id']}")->getField('integral');
        $first = '【优培圈】温馨提醒您的积分有变动';
        $keyword1 = '+' . $amount . '分';
        $keyword2 = "连续签到{$day}天赠送{$amount}积分";
        $keyword3 = date("Y-m-d H:i:s", time());
        $keyword4 = $nowIntegral . '分';
        $remark = '请点击“详情”查看具体内容';
        $url = "http://{$_SERVER['HTTP_HOST']}/index.php/Personal/index/current/4.html";
        $templeFormat = array('__OPENID__', '__URL__', '__FIRST__', '__KEYWORD1__', '__KEYWORD2__', '__KEYWORD3__', '__KEYWORD4__', '__REMARK__');
        $infoFormat = array($this->user['open_id'], $url, $first, $keyword1, $keyword2, $keyword3, $keyword4, $remark);
        $wxuser = get_wxuser($this->token);
        $result = execute_public_template('INTEGRAL_CHANGE', $templeFormat, $infoFormat, $wxuser);
        return $result;
    }
}