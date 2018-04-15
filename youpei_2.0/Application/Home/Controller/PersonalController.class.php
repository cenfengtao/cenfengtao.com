<?php
namespace Home\Controller;

use Think\Controller;

require_once __DIR__ . '/../../../ThinkPHP/Library/Vendor/ChuanglanSmsHelper/ChuanglanSmsApi.php';

class PersonalController extends BaseController
{
    public function personalData()
    {
        $this->display();
    }

    public function myMatch()
    {
        $this->display();
    }

    public function appointList()
    {
        $this->display();
    }

    public function couponList()
    {
        //电子券
        $couponList = M('coupon')->where(array('user_id' => $this->user['id'], 'status' => 1))->select();
        $couponOfferList = [];
        foreach ($couponList as $k => $v) {
            $couponOfferList[$k] = M('coupon_offer')->where(array('id' => $v['offer_id'], 'start_time' => array('lt', time()),
                'end_time' => array('gt', time())))->find();
            if (!$couponOfferList[$k]) {
                unset($couponOfferList[$k]);
            } else {
                $couponOfferList[$k]['start_time'] = date('Y年m月d日', $couponOfferList[$k]['start_time']);
                $couponOfferList[$k]['end_time'] = date('Y年m月d日', $couponOfferList[$k]['end_time']);
                if ($couponOfferList[$k]['coupon_type'] == 1) {
                    $couponOfferList[$k]['full'] = floatval($couponOfferList[$k]['full']);
                    $couponOfferList[$k]['subtract'] = floatval($couponOfferList[$k]['subtract']);
                } else {
                    $couponOfferList[$k]['fee'] = floatval($couponOfferList[$k]['fee']);
                }
                if ($couponOfferList[$k]['type'] == 1) {
                    $couponOfferList[$k]['logo'] = M('organization')->where(array('id' => $couponOfferList[$k]['type_id']))->getField('picture');
                } else {
                    $couponOfferList[$k]['logo'] = M('organization')->where(array('id' => 1))->getField('picture');
                }
            }
        }
        $couponOfferList = array_merge($couponOfferList);
        $this->assign('couponOfferList', $couponOfferList);
        $this->display();
    }

    public function myBargain()
    {
        $this->display();
    }

    public function myAppoint()
    {
        $this->display();
    }

    public function myLimit()
    {
        $this->display();
    }

    public function leave()
    {
        $this->display();
    }

    public function index()
    {
        $this->title = "个人中心";
        $m = D('PersonalBackground');
        $list = $m->queryPicture();
        $this->assign('object', $list);
        //签到任务
        $isSign = D('IntegralRecord')->querysignintime($this->user['id']);
        $this->assign('isSign', $isSign);
        $current = (int)I('current', 4);
        $this->assign('current', $current);
        //待付款数
        $needPayCount = D("Order")->getPayCount($this->user['id'], 0);
        $this->assign('needPayCount', $needPayCount)->assign('user', $this->user);
        //电子券
        $couponList = M('coupon')->where(array('user_id' => $this->user['id'], 'status' => 1))->select();
        $couponOfferList = [];
        foreach ($couponList as $k => $v) {
            $couponOfferList[$k] = M('coupon_offer')->where(array('id' => $v['offer_id'], 'start_time' => array('lt', time()),
                'end_time' => array('gt', time())))->find();
            if (!$couponOfferList[$k]) {
                unset($couponOfferList[$k]);
            } else {
                $couponOfferList[$k]['start_time'] = date('Y年m月d日', $couponOfferList[$k]['start_time']);
                $couponOfferList[$k]['end_time'] = date('Y年m月d日', $couponOfferList[$k]['end_time']);
                if ($couponOfferList[$k]['coupon_type'] == 1) {
                    $couponOfferList[$k]['full'] = floatval($couponOfferList[$k]['full']);
                    $couponOfferList[$k]['subtract'] = floatval($couponOfferList[$k]['subtract']);
                } else {
                    $couponOfferList[$k]['fee'] = floatval($couponOfferList[$k]['fee']);
                }
                if ($couponOfferList[$k]['type'] == 1) {
                    $couponOfferList[$k]['logo'] = M('organization')->where(array('id' => $couponOfferList[$k]['type_id']))->getField('picture');
                } else {
                    $couponOfferList[$k]['logo'] = M('organization')->where(array('id' => 1))->getField('picture');
                }
            }
        }
        $couponOfferList = array_merge($couponOfferList);
        $this->assign('couponOfferList', $couponOfferList);
        //学友团
        $friendCount = $this->getFriendCount();
        $this->assign('friend_count', $friendCount);
        //积分汇总
        $totalGetIntegral = D('IntegralRecord')->totalGetByUserId($this->user['id']);//共获得
        $totalUseIntegral = D('IntegralRecord')->totalUseByUserId($this->user['id']);//已使用
        $this->assign('totalGetIntegral', $totalGetIntegral)->assign('totalUseIntegral', $totalUseIntegral);
        //转发任务
        $isShare = D('ShareRecord')->isShareArticle($this->user['id']);
        $this->assign('isShare', $isShare);
        //阅读任务
        $todayReadCount = D('ReadRecord')->getTodayCount($this->user['id']);
        $this->assign('todayReadCount', $todayReadCount);
        //评论任务
        $isTodayComment = D('Comment')->isTodayComment($this->user['id']);
        $this->assign('isTodayComment', $isTodayComment);
        //邀请任务
        $isTodayInvite = D('User')->isTodayInvite($this->user['id']);
        $this->assign('isTodayInvite', $isTodayInvite);
        //任务积分
        $taskIntegral = M('config')->where("token='{$this->token}'")->field("task_share_integral,task_sign_integral,
        task_read_integral,task_comment_integral,task_schoolmate_integral")->find();
        $this->assign('taskIntegral', $taskIntegral);
        //完善个人资料任务
        $personalInfo = M('user_data')->where(['user_id'=>$this->user['id']])->find();
        if ($personalInfo) {
            $personalData = 1;
        } else {
            $personalData = 2;
        }
        $this->assign('personalData', $personalData);
        $sum = M('UserMessage')->where(array('user_id' => $this->user['id'], 'is_read' => 1))->count();
        $this->assign('sum', $sum);
        $this->display();
    }

    public function index_bak()
    {
        $this->title = "个人中心";
        $m = D('PersonalBackground');
        $list = $m->queryPicture();
        $this->assign('object', $list);
        //签到任务
        $isSign = D('IntegralRecord')->querysignintime($this->user['id']);
        $this->assign('isSign', $isSign);
        $current = (int)I('current', 4);
        $this->assign('current', $current);
        //待付款数
        $needPayCount = D("Order")->getPayCount($this->user['id'], 0);
        $this->assign('needPayCount', $needPayCount)->assign('user', $this->user);
        //电子券
        //todo
        $this->assign('coupon_count', 0);
        //学友团
        $friendCount = $this->getFriendCount();
        $this->assign('friend_count', $friendCount);
        //积分汇总
        $totalGetIntegral = D('IntegralRecord')->totalGetByUserId($this->user['id']);//共获得
        $totalUseIntegral = D('IntegralRecord')->totalUseByUserId($this->user['id']);//已使用
        $this->assign('totalGetIntegral', $totalGetIntegral)->assign('totalUseIntegral', $totalUseIntegral);
        //转发任务
        $isShare = D('ShareRecord')->isShareArticle($this->user['id']);
        $this->assign('isShare', $isShare);
        //阅读任务
        $todayReadCount = D('ReadRecord')->getTodayCount($this->user['id']);
        $this->assign('todayReadCount', $todayReadCount);
        //评论任务
        $isTodayComment = D('Comment')->isTodayComment($this->user['id']);
        $this->assign('isTodayComment', $isTodayComment);
        //邀请任务
        $isTodayInvite = D('User')->isTodayInvite($this->user['id']);
        $this->assign('isTodayInvite', $isTodayInvite);
        //任务积分
        $taskIntegral = M('config')->where("token='{$this->token}'")->field("task_share_integral,task_sign_integral,
        task_read_integral,task_comment_integral,task_schoolmate_integral")->find();
        $this->assign('taskIntegral', $taskIntegral);


        $sum = M('UserMessage')->where(array('user_id' => $this->user['id'], 'is_read' => 1))->count();
        $this->assign('sum', $sum);
//        $this->display();
    }

    public function red()
    {
        $id = $_GET['id'];
        // $user = $this->getUserById($id);
        $res = M('user')->where(array('id' => $this->user['id']))->field('id,integral')->find();
        $this->assign('integral', $res);
//        $this->display('collar_red');
    }

    public function exchange()
    {
        exit;
        //判断有否关注
        $access_token = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . C('APPID') . "&secret=" . C('SECRET');
        $access_msg = json_decode(file_get_contents($access_token));
        $token = $access_msg->access_token;
        $subscribe_msg = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid={$this->user['open_id']}";
        $subscribe = json_decode(file_get_contents($subscribe_msg));
        $result = $subscribe->subscribe;
        //$userStatus 1 已关注
        if ($result != 1) {
            $this->ajaxReturn(['status' => 3, 'msg' => '请先关注服务号']);
        }
        $money = $_POST['price'];
        $m = D('PersonalBackground');
        $rs = $m->exchangered($money, $this->user['id']);
        $this->ajaxReturn($rs);
    }

    //签到
    public function today_signin()
    {
        //判断ajax和post
        if (IS_AJAX && IS_POST) {
            $res = D('IntegralRecord')->querysignintime($this->user['id']);
            if ($res['status'] == 1) {
                $this->ajaxReturn(array('status' => 0, 'msg' => '你今天已经签到了'));
            }
            //添加签到记录
            $rs = D('IntegralRecord')->addintegralRecord($this->user['id'], $this->token);
            //发送通知模板
            $config = M('Config')->where("token='{$this->token}'")->find();
            $nowIntegral = M('user')->where("id={$this->user['id']}")->getField('integral');
            $first = '【优培圈】温馨提醒您的积分有变动';
            $keyword1 = '+' . $config['task_sign_integral'] . '分';
            $keyword2 = '签到赠送积分';
            $keyword3 = date("Y-m-d H:i:s", time());
            $keyword4 = $nowIntegral . '分';
            $remark = '请点击“详情”查看具体内容';
            $url = "http://{$_SERVER['HTTP_HOST']}/index.php/Lottery/index?token=" . $this->token;
            $templeFormat = array('__OPENID__', '__URL__', '__FIRST__', '__KEYWORD1__', '__KEYWORD2__', '__KEYWORD3__', '__KEYWORD4__', '__REMARK__');
            $infoFormat = array($this->user['open_id'], $url, $first, $keyword1, $keyword2, $keyword3, $keyword4, $remark);
            $wxuser = get_wxuser($this->token);
            execute_public_template('INTEGRAL_CHANGE', $templeFormat, $infoFormat, $wxuser);
            if ($rs['status'] == 1) {
                $this->ajaxReturn(array('status' => 1, 'msg' => '签到成功', 'data' => ['addIntegral' => $config['task_sign_integral']]));
            }
        }
    }

    //获取学友团总数
    public function getFriendCount()
    {
        $count = 0;
        $children = D('User')->getChildren($this->user['id']);
        $count += count($children);
        foreach ($children as $v) {
            $childrenByChild = D('User')->getChildren($v['id']);
            $count += count($childrenByChild);
        }
        return $count;
    }

    public function schedule()
    {
        $this->display();
    }


    public function ajaxSchedule()
    {
        if (!$_POST['year'] && !$_POST['month']) {
            return show(0, '参数错误');
        }
        //查出当月的所有数据
        $startMonthTime = strtotime($_POST['year'] . $_POST['month'] . '01');
        $endMonthTime = strtotime('+1 month', $startMonthTime) - 86400;
        $monthList = M('class_time')->where(['start_day_time' => [array('EGT', $startMonthTime),
            array('LT', $endMonthTime)], 'user_id' => $this->user['id']])
            ->field('type,status,errmsg,user_id,username', true)->order('start_hour_time asc')->select();
        $data = [];
        foreach ($monthList as $key => $val) {
            $monthList[$key]['start_day_time'] = date('Y-m-d', $val['start_day_time']);
            //1-已请假 2-未请假
            if ($val['leave']) {
                $monthList[$key]['leave_status'] = 1;
            } else {
                $monthList[$key]['leave_status'] = 2;
            }
            if ($val['upload_type'] == 1) {
                $organization[$key] = M('organization')->where(['token' => $val['token']])->find();
                $monthList[$key]['tel'] = $organization[$key]['tel'];
            } else {
                $monthList[$key]['tel'] = '';
            }
            $data[date('Y-m-d', $val['start_day_time'])][$key] = $monthList[$key];
        }
        $list = [];
        foreach ($data as $k => $v) {
            $list[$k] = array_merge($data[$k]);
        }
        $babyName = M('user_data')->where(['user_id' => $this->user['id']])->getField('baby_name');
        return show(1, '', ['list' => $list, 'mobile' => $this->user['mobile'], 'babyName' => $babyName]);
    }


    public function uploadClass()
    {
        if (!$_POST['start_day_time']) {
            return show(0, '日期不能为空');
        }
        if (!$_POST['class_title']) {
            return show(0, '课程名称不能为空');
        }
        if (!$_POST['username']) {
            return show(0, '学生名称不能为空');
        }
        if (!$_POST['teacher']) {
            return show(0, '老师名称不能为空');
        }
        if (!$_POST['province'] && !$_POST['city'] && !$_POST['area'] && !$_POST['address']) {
            return show(0, '地址不能为空');
        }
        $_POST['user_id'] = $this->user['id'];
        $_POST['token'] = $this->token;
        $_POST['start_day_time'] = strtotime($_POST['start_day_time']);
        $_POST['upload_type'] = 2;
        $id = D('ClassTime')->insert($_POST);
        if ($id) {
            return show(1, '添加成功');
        } else {
            return show(0, '添加失败');
        }
    }

    //我的砍价
    public function ajaxMyBargain()
    {
        $bargainRecord = M('bargain_record')->where(array('user_id' => $this->user['id'], 'share_user_id' => array('EXP', 'is null')))->select();
        $bargainProduct = [];
        foreach ($bargainRecord as $k => $v) {
            $bargain[$k] = M('bargain')->where(array('id' => $v['bargain_id'], 'start_time' => array('lt', time()), 'end_time' => array('gt', time())))->find();
            if (!$bargain[$k]) {
                unset($bargain[$k]);
            } else {
                $bargainProduct[$k] = M('product')->where(array('id' => $bargain[$k]['type_id']))->field('desc,cost', true)->find();
                $tag = explode(' ', $bargainProduct[$k]['tag']);
                $bargainProduct[$k]['tagA'] = $tag[0] ?: '';
                $bargainProduct[$k]['tagB'] = $tag[1] ?: '';
                $bargainProduct[$k]['tagC'] = $tag[2] ?: '';
                $price = json_decode($bargainProduct[$k]['price'], true);
                $bargainProduct[$k]['original_price'] = $price[$bargain[$k]['key']]['original_price'];
                $bargainProduct[$k]['now_price'] = $price[$bargain[$k]['key']]['now_price'];
                $bargainProduct[$k]['key'] = $bargain[$k]['key'];
            }
        }
        $bargainProduct = array_merge($bargainProduct);
        return show(1, '', ['bargainProduct' => $bargainProduct]);
    }

    //我的比赛
    public function ajaxMyMatch()
    {
        $contribution = M('contribution_record')->where(array('user_id' => $this->user['id']))->select();
        $vote = [];
        if ($contribution) {
            foreach ($contribution as $k => $v) {
                $vote[$k] = M('vote')->where(array('id' => $v['vote_id']))->field('description', true)->find();
                $vote[$k]['work_start_time'] = date('Y/m/d', $vote[$k]['work_start_time']);
                $vote[$k]['vote_end_time'] = date('Y/m/d', $vote[$k]['vote_end_time']);
                $vote[$k]['userWorksCount'] = M('contribution_record')->where(array('vote_id' => $v['vote_id'], 'status' => 2))->count('id');
                //1-活动结束 2-进行中
                if ($vote[$k]['vote_end_time'] < time()) {
                    $vote[$k]['voteStatus'] = 1;
                } else {
                    $vote[$k]['voteStatus'] = 2;
                }
            }
        }
        return show(1, '', ['vote' => $vote]);
    }

    //请假单
    public function ajaxLeave()
    {
        if (!$_GET['id']) {
            return show(0, 'ID不能为空');
        }
        $class = M('class_time')->where(['id' => $_GET['id']])->field('type,status,errmsg', true)->find();
        return show(1, '', ['class' => $class]);
    }

    public function uploadLeave()
    {
        if (!$_POST['id']) {
            return show(0, 'ID不能为空');
        }
        if (!$_POST['leave']) {
            return show(0, '请假内容不能为空');
        }
        $data = [
            'leave' => $_POST['leave']
        ];
        $id = D('ClassTime')->updateById($_POST['id'], $data);
        if ($id) {
            return show(1, '提交成功');
        } else {
            return show(0, '提交失败');
        }
    }

    //个人资料
    public function ajaxPersonalData()
    {
        $user = M('user_data')->where(['user_id' => $this->user['id']])->find();
        return show(1, '', ['user' => $user, 'number' => $this->user['mobile']]);
    }


    public function uploadPersonalData()
    {
        if (!$_POST['baby_name']) {
            return show(0, '宝贝名称不能为空');
        }
        if (!$_POST['baby_age']) {
            return show(0, '宝贝年龄不能为空');
        }
        if (!$_POST['number']) {
            return show(0, '联系电话不能为空');
        }
        if (!$_POST['name']) {
            return show(0, '收货人不能为空');
        }
        if (!$_POST['mobile']) {
            return show(0, '收货号码不能为空');
        }
        if (!$_POST['family_address']) {

            return show(0, '家庭地址不能为空');
        }
        if (!$_POST['address']) {
            return show(0, '收货地址不能为空');
        }
        if (!$_POST['code']) {
            return show(0, '验证码不能为空');
        }
        if (!$_POST['id']) {
            if (!$_POST['family_province'] || !$_POST['family_address']) {
                return show(0, '家庭地址不能为空');
            }
            if (!$_POST['province'] || !$_POST['address']) {
                return show(0, '收货地址不能为空');
            }
        }
        //判断验证码是否有效
        $codeId = M('sms_code')->where(['user_id' => $this->user['id'], 'create_time' => ['egt', time() - 7200],
            'code' => $_POST['code'], 'status' => 1])->getField('id');
        if (empty($codeId)) {
            return show(0, '验证码不正确或已失效');
        }
        if ($_POST['id']) {
            if (!$_POST['family_province']) {
                unset($_POST['family_province']);
                unset($_POST['family_city']);
                unset($_POST['family_area']);
            }
            if (!$_POST['province']) {
                unset($_POST['province']);
                unset($_POST['city']);
                unset($_POST['area']);
            }
            $id = D('UserData')->updateById($_POST['id'], $_POST);
            D('User')->updateById($this->user['id'], ['mobile' => $_POST['number']]);
            if ($id === false) {
                return show(0, '修改失败');
            } else {
                D('SmsCode')->updateById($codeId, ['status' => 2]);
                return show(1, '修改成功');
            }
        }
        $_POST['user_id'] = $this->user['id'];
        $_POST['token'] = $this->token;
        $id = D('UserData')->insert($_POST);
        D('User')->updateById($this->user['id'], ['mobile' => $_POST['number']]);
        if ($id) {
            $status = M('integral_record')->where(['user_id' => $this->user['id'], 'starts' => 1, 'type' => 2, 'integral_type' => 12])->find();
            if (!$status) {
                $integralData = [
                    'user_id' => $this->user['id'],
                    'integral' => 20,
                    'create_time' => time(),
                    'status' => 1,
                    'type' => 2,
                    'integral_type' => 12,
                    'desc' => '完善个人资料',
                    'token' => $this->token,
                ];
                D("IntegralRecord")->insert($integralData);
                M('User')->where("id={$this->user['id']}")->setInc('integral', 20);
                //发送模板消息
                $this->sendTemplate(20, $this->user['id'], $this->user['open_id'], '完善个人资料');
            }
            D('SmsCode')->updateById($codeId, ['status' => 2]);
            return show(1, '提交成功');
        } else {
            return show(0, '提交失败');
        }
    }

    public function sendTemplate($integral, $userId, $userOpenid, $type)
    {
        if ($integral > 0) {
            //发送积分信息
            $nowIntegral = D('User')->getIntegralById($userId);
            $first = '【优培圈】温馨提醒您的积分有变动';
            $keyword1 = '+' . $integral . '分';
            $keyword2 = $type;
            $keyword3 = date("Y-m-d H:i:s", time());
            $keyword4 = $nowIntegral . '分';
            $remark = '请点击“详情”查看具体内容';
            $url = "http://{$_SERVER['HTTP_HOST']}/index.php/MemberIntegral/integrallist?token=" . $this->token;
            $templeFormat = array('__OPENID__', '__URL__', '__FIRST__', '__KEYWORD1__', '__KEYWORD2__', '__KEYWORD3__', '__KEYWORD4__', '__REMARK__');
            $infoFormat = array($userOpenid, $url, $first, $keyword1, $keyword2, $keyword3, $keyword4, $remark);
            $wxuser = get_wxuser($this->token);
            $executeResult = execute_public_template('INTEGRAL_CHANGE', $templeFormat, $infoFormat, $wxuser);
            return $executeResult;
        }
    }

    //预约表
    public function ajaxAppointList()
    {
        $_GET['page'] = $_GET['page'] ? $_GET['page'] : 0;
        $list = M('book_record')->where(['type' => 1, 'user_id' => $this->user['id']])->limit($_GET['page'], 6)->select();
        if (!$list) {
            return show(0, '暂时没有预约');
        }
        //1-正在排课 2-预约成功 3-预约失败
        foreach ($list as $k => $v) {
            $list[$k]['book_time'] = date('Y-m-d', $v['book_time']);
            $product[$k] = M('product')->where(['id' => $v['type_id']])->find();
            $list[$k]['address'] = $product[$k]['city'] . $product[$k]['area'] . $product[$k]['address'];
            $list[$k]['title'] = $product[$k]['title'];
            $organization[$k] = M('organization')->where(['token' => $product[$k]['token']])->find();
            $list[$k]['logo'] = $organization[$k]['picture'];
            $list[$k]['orgId'] = $organization[$k]['id'];
            //获取关注信息
            $followed[$k] = M('Collect')->where(array('user_id' => $this->user['id'], 'type' => 1, 'type_id' => $organization[$k]['id']))->find();
            //1-已关注 2-未关注
            if ($followed[$k]) {
                $list[$k]['isFollowed'] = 1;
            } else {
                $list[$k]['isFollowed'] = 2;
            }
            if ($v['status'] == 1) {
                $list[$k]['bookStatus'] = 1;
            } elseif ($v['status'] == 2 || $v['status'] == 4) {
                $list[$k]['bookStatus'] = 2;
            } else {
                $list[$k]['bookStatus'] = 3;
            }
        }
        return show(1, '', ['list' => $list]);
    }

    //获取验证码
    public function getCode()
    {
        if (!preg_match("/^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/", $_POST['mobile'])) {
            return show(0, '手机格式不正确');
        }
        //判断手机号码今天是否接收过通知
        $todayTime = strtotime(date("Y-m-d", time()));
        $sendCount = M('sms_code')->where(['mobile' => $_POST['mobile'], 'send_status' => ['neq', 1], 'type' => 2, 'create_time' => ['egt', $todayTime]])->count();
        if ($sendCount >= 5) {
            return show(0, '已经超出今天可用的次数了');
        }
        $code = $this->generate_code(4);
        $codeData = [
            'create_time' => time(),
            'user_id' => $this->user['id'],
            'mobile' => $_POST['mobile'],
            'code' => $code,
            'status' => 1,
            'send_status' => 1,
            'type' => 2,
        ];
        $id = D('SmsCode')->insert($codeData);
        //把之前的验证码改成已失效
        M('sms_code')->where(['user_id' => $this->user['id'], 'status' => 1, 'send_status' => 2, 'type' => 2,
            'id' => ['neq', $id]])->save(['status' => 3]);
        if ($id) {
            //发送短信
            $sms = new \ChuanglanSmsApi();
            $msg = '【优培圈】验证码：{$var}，您正在通过优培圈验证手机号，短信有效时间为2分钟，注意保密哦！';
            $params = "{$_POST['mobile']},{$code}";
            $result = $sms->sendVariableSMS($msg, $params);
            if (!is_null(json_decode($result))) {
                $output = json_decode($result, true);
                if (isset($output['code']) && $output['code'] == '0') {
                    $updateData = [
                        'send_status' => 2,
                        'content' => $msg,
                    ];
                    D('SmsCode')->updateById($id, $updateData);
                } else {
                    $updateData = [
                        'send_status' => 3,
                        'content' => $msg,
                        'errmsg' => $output['errorMsg'],
                        'errcode' => $output['code'],
                    ];
                    D('SmsCode')->updateById($id, $updateData);
                }
            } else {
                $updateData = [
                    'send_status' => 3,
                    'content' => $msg,
                    'errmsg' => '发送失败',
                    'errcode' => '-1',
                ];
                D('SmsCode')->updateById($id, $updateData);
            }
        } else {
            return show(0, '编辑短信失败');
        }
    }

    function generate_code($length = 6)
    {
        return rand(pow(10, ($length - 1)), pow(10, $length) - 1);
    }

    //提交验证手机号
    public function submitInfo()
    {
        if (!preg_match("/^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/", $_POST['mobile'])) {
            return show(0, '手机格式不正确');
        }
        if (!$_POST['code']) {
            return show(0, '验证码不能为空');
        }
        //判断验证码是否有效
        $codeId = M('sms_code')->where(['user_id' => $this->user['id'], 'create_time' => ['egt', time() - 7200],
            'code' => $_POST['code'], 'status' => 1])->getField('id');
        if (empty($codeId)) {
            return show(0, '验证码不正确或已失效');
        } else {
            D('SmsCode')->updateById($codeId, ['status' => 2]);
        }
        $id = D('User')->updateById($this->user['id'], ['mobile' => $_POST['mobile']]);
        if ($id) {
            return show(1, '验证成功');
        } else {
            return show(0, '验证失败');
        }
    }

    //收货地址
    public function personalDetails()
    {
        $info = M('user_data')->where(['user_id' => $this->user['id']])->field('province,city,area,address,name,mobile')->find();
        return show(1, '', ['info' => $info]);
    }


}