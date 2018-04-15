<?php
/**
 * 定时脚本控制器
 */
namespace Admin\Controller;

use Think\Controller;

require_once __DIR__ . '/../../../ThinkPHP/Library/Vendor/ChuanglanSmsHelper/ChuanglanSmsApi.php';

class ScriptController extends Controller
{
    /**
     * 过期订单处理脚本
     */
    public function overdueOrder()
    {
        $overdueTime = 540; //过期时间
        $overdueList = M('order')->where(array('status' => 0, 'create_time' => array('lt', time() - $overdueTime)))->select();
        foreach ($overdueList as $k => $v) {
            D('Order')->updateById($v['id'], array('status' => 2, 'end_time' => time()));
            //发送短信给机构
            if (!empty($v['product_id'])) {
                $proTitle = M('product')->where("id={$v['product_id']}")->getField('title');
            } else if (!empty($v['parenting_id'])) {
                $proTitle = M('parenting')->where("id={$v['parenting_id']}")->getField('title');
            } else if (!empty($v['activity_id'])) {
                $proTitle = M('organization_activity')->where("id={$v['activity_id']}")->getField('title');
            } else if (!empty($v['group_record_id'])) {
                $groupId = M('group_record')->where("id={$v['group_record_id']}")->getField('group_id');
                $proTitle = M('group_product')->where("id={$groupId}")->getField('title');
            } else {
                return 'no product';
            }
            $organization = M('organization')->where(array('token' => $v['token']))->field('id,org_name')->find();
            $orgMobile = M('admin_user')->where(array('org_id' => $organization['id'], 'mobile' => array(array('exp', 'is not null'), array('neq', ''), 'and')))->getField('mobile');
            $sms = new \ChuanglanSmsApi();
            $msg = '{$var} 您好，您在优培圈的 {$var} 有用户已下单未支付，请跟进沟通！';
            $params = "{$orgMobile},{$organization['org_name']},{$proTitle}";
            $result = $sms->sendVariableSMS($msg, $params);
            $recordData = [
                'create_time' => time(),
                'content' => "{$organization['org_name']} 您好，您在优培圈的 {$proTitle} 有用户已下单未支付，请跟进沟通！",
                'type' => 2,
                'type_id' => $v['id'],
                'mobile' => $orgMobile
            ];
            if (!is_null(json_decode($result))) {
                $output = json_decode($result, true);
                if (isset($output['code']) && $output['code'] == '0') {
                    $recordData['status'] = 2;
                    $recordData['err_code'] = $output['code'];
                    D('SmsRecord')->insert($recordData);
                } else {
                    $recordData['status'] = 3;
                    $recordData['err_code'] = $output['code'];
                    $recordData['err_msg'] = $output['errorMsg'];
                    D('SmsRecord')->insert($recordData);
                }
            } else {
                $recordData['status'] = 3;
                $recordData['err_code'] = 'undefined';
                $recordData['err_msg'] = '发送失败';
                D('SmsRecord')->insert($recordData);
            }
        }
        echo 'finish';
    }

    //砍价进度通知
    public function bargainSchedule()
    {
        $bargainProduct = D('Bargain')->getList(array('type' => 1, 'start_time' => array('LT', time()), 'end_time' => array('GT', time())));
        foreach ($bargainProduct as $k => $v) {
            //砍价商品名称
            $productTitle = M('product')->where(array('id' => $v['type_id']))->getField('title');
            //暂时写死我们的机构token
//            $productToken = M('product')->where(array('id' => $v['type_id']))->getField('token');
            $productToken = "g232238gc959";
            //分享砍价的用户
            $bargainUser = D('BargainRecord')->getList(array('bargain_id' => $v['id'], 'share_user_id' => array('EXP', 'IS NULL'),
                'create_time' => array(array('GT', $v['start_time']), array('LT', $v['end_time']), 'and')));
            foreach ($bargainUser as $key => $val) {
                //未付款
                $isOrder = M('order')->where(array('user_id' => $val['user_id'], 'product_id' => $v['type_id'],
                    'bargain_id' => $val['bargain_id'], 'status' => array('neq', 0),
                    'create_time' => array(array('GT', $v['start_time']), array('LT', $v['end_time']), 'and')))->getField('id');
                if ($isOrder) {
                    unset($bargainUser[$key]);
                }
            }
            foreach ($bargainUser as $j => $i) {
                $userPeople = D('BargainRecord')->bargainHelpByUser($i['user_id'], $i['bargain_id'], $v['start_time'], $v['end_time']);
                $userCount = count($userPeople);
                $price = D('BargainRecord')->bargainHelpByPrice($i['user_id'], $i['bargain_id'], $v['start_time'], $v['end_time']);
                if (!$price) {
                    $price = 0;
                }
                $user = D('User')->find($i['user_id']);
                //判断当日是否已发送消息
                $start_time = strtotime(date('Y-m-d', time()));
                $isSend = M('TemplateRecord')->where(array('type' => 1, 'type_id' => $v['type_id'], 'user_id' => $user['id'],
                    'status' => 2, 'create_time' => array('EGT', $start_time)))->getField('id');
                if ($isSend) {
                    continue;
                }
                //发送通知模板
                $first = '【优培圈】温馨提醒您的砍价进度';
                $keyword1 = $productTitle;
                $keyword2 = '已有' . $userCount . '个人帮您砍了' . $price . '元了';
                $keyword3 = date("Y-m-d H:i:s", time());
                $remark = '请点击“详情”购买商品';
                $url = "http://{$_SERVER['HTTP_HOST']}/index.php/Product/bargain.html?pro_id=" . $v['type_id'] . "&key=" . $v['key'] . "&token=" . $productToken;
                $templeFormat = array('__OPENID__', '__URL__', '__FIRST__', '__KEYWORD1__', '__KEYWORD2__', '__KEYWORD3__', '__KEYWORD4__', '__REMARK__');
                $infoFormat = array($user['open_id'], $url, $first, $keyword1, $keyword2, $keyword3, $remark);
                $wxuser = get_wxuser($productToken);
                $result = execute_public_template('BARGAIN_SCHEDULE', $templeFormat, $infoFormat, $wxuser);
                if (isset($result['errcode']) && $result['errcode'] == 0) {
                    $status = 2;
                } else {
                    $status = 1;
                }
                $data = [
                    'user_id' => $user['id'],
                    'type' => 1,
                    'type_id' => $v['type_id'],
                    'create_time' => time(),
                    'errmsg' => $result['errmsg'],
                    'errcode' => $result['errcode'],
                    'status' => $status,
                ];
                D('TemplateRecord')->insert($data);
            }
        }
    }

    //课程通知
    public function classSchedule()
    {
        $startTime = strtotime(date('Y-m-d'), time()) + 86400;
        $endTime = $startTime + 86400;
        $list = M('class_time')->where(['start_day_time' => array(['EGT', $startTime], ['LT', $endTime], 'AND'), 'status' => 1])
            ->distinct(true)->field('user_id')->select();
        if ($list) {
            foreach ($list as $k => $v) {
                $user = D('User')->find($v['user_id']);
                $class = M('class_time')->where(['start_day_time' => array(['EGT', $startTime], ['LT', $endTime], 'AND'),
                    'status' => 1, 'user_id' => $v['user_id']])->select();
                //判断当日是否已发送消息
                $todayStartTime = strtotime(date('Y-m-d', time()));
                $isSend = M('TemplateRecord')->where(array('type' => 2, 'type_id' => $class[0]['id'], 'user_id' => $user['id'],
                    'status' => 2, 'create_time' => array('EGT', $todayStartTime)))->getField('id');
                if ($isSend) {
                    continue;
                }
                $titles = [];
                foreach ($class as $m) {
                    $titles[] = $m['class_title'];
                }
                $title = implode('+', $titles);
                //暂时写死我们的机构token
                $token = "g232238gc959";
                //发送通知模板
                $first = '【优培圈】温馨提醒，您明天有' . count($class) . '节课，请提前安排好上课时间！';
                $keyword1 = $title;
                $keyword2 = $class[0]['username'];
                $remark = '点击查看课程安排';
                $url = "http://{$_SERVER['HTTP_HOST']}/index.php/Personal/schedule.html?token=" . $token;
                $templeFormat = array('__OPENID__', '__URL__', '__FIRST__', '__KEYWORD1__', '__KEYWORD2__', '__REMARK__');
                $infoFormat = array($user['open_id'], $url, $first, $keyword1, $keyword2, $remark);
                $wxuser = get_wxuser($token);
                $result = execute_public_template('COURSE_NOTICE', $templeFormat, $infoFormat, $wxuser);
                if (isset($result['errcode']) && $result['errcode'] == 0) {
                    $status = 2;
                } else {
                    $status = 1;
                }
                $data = [
                    'user_id' => $user['id'],
                    'type' => 2,
                    'type_id' => $class[0]['id'],
                    'create_time' => time(),
                    'errmsg' => $result['errmsg'],
                    'errcode' => $result['errcode'],
                    'status' => $status,
                ];
                D('TemplateRecord')->insert($data);
            }
        }
    }

}