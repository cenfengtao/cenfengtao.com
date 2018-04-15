<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends CommonController
{
    public function index()
    {
        $userCount = M('User')->count();
        $integralCount = M('User')->sum('integral');
        $shareCount = M('share_record')->count();
        $todayDate = strtotime(date("Y-m-d", time()));
        $todayCount = M('User')->where(array('last_login_time' => array('egt', $todayDate)))->count();
        $this->assign('userCount', $userCount)->assign('integralCount', $integralCount)->assign('shareCount', $shareCount)
            ->assign('todayCount', $todayCount);
        $dates = [
            'first_day' => [
                'date' => date("m-d", strtotime("-6 day")),
                'new_user' => M('User')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d",
                    strtotime("-6 day")))), array('lt', strtotime(date("Y-m-d", strtotime("-6 day"))) + 24 * 3600 - 1))))->count(),
                'login_user' => M('User')->where(array('last_login_time' => array(array('egt', strtotime(date("Y-m-d",
                    strtotime("-6 day")))), array('lt', strtotime(date("Y-m-d", strtotime("-6 day"))) + 24 * 3600 - 1))))->count(),
            ],
            'second_day' => [
                'date' => date("m-d", strtotime("-5 day")),
                'new_user' => M('User')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d",
                    strtotime("-5 day")))), array('lt', strtotime(date("Y-m-d", strtotime("-5 day"))) + 24 * 3600 - 1))))->count(),
                'login_user' => M('User')->where(array('last_login_time' => array(array('egt', strtotime(date("Y-m-d",
                    strtotime("-5 day")))), array('lt', strtotime(date("Y-m-d", strtotime("-5 day"))) + 24 * 3600 - 1))))->count(),
            ],
            'third_day' => [
                'date' => date("m-d", strtotime("-4 day")),
                'new_user' => M('User')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d",
                    strtotime("-4 day")))), array('lt', strtotime(date("Y-m-d", strtotime("-4 day"))) + 24 * 3600 - 1))))->count(),
                'login_user' => M('User')->where(array('last_login_time' => array(array('egt', strtotime(date("Y-m-d",
                    strtotime("-4 day")))), array('lt', strtotime(date("Y-m-d", strtotime("-4 day"))) + 24 * 3600 - 1))))->count(),
            ],
            'fourth_day' => [
                'date' => date("m-d", strtotime("-3 day")),
                'new_user' => M('User')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d",
                    strtotime("-3 day")))), array('lt', strtotime(date("Y-m-d", strtotime("-3 day"))) + 24 * 3600 - 1))))->count(),
                'login_user' => M('User')->where(array('last_login_time' => array(array('egt', strtotime(date("Y-m-d",
                    strtotime("-3 day")))), array('lt', strtotime(date("Y-m-d", strtotime("-3 day"))) + 24 * 3600 - 1))))->count(),
            ],
            'fifth_day' => [
                'date' => date("m-d", strtotime("-2 day")),
                'new_user' => M('User')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d",
                    strtotime("-2 day")))), array('lt', strtotime(date("Y-m-d", strtotime("-2 day"))) + 24 * 3600 - 1))))->count(),
                'login_user' => M('User')->where(array('last_login_time' => array(array('egt', strtotime(date("Y-m-d",
                    strtotime("-2 day")))), array('lt', strtotime(date("Y-m-d", strtotime("-2 day"))) + 24 * 3600 - 1))))->count(),
            ],
            'yesterday' => [
                'date' => date("m-d", strtotime("-1 day")),
                'new_user' => M('User')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d",
                    strtotime("-1 day")))), array('lt', strtotime(date("Y-m-d", strtotime("-1 day"))) + 24 * 3600 - 1))))->count(),
                'login_user' => M('User')->where(array('last_login_time' => array(array('egt', strtotime(date("Y-m-d",
                    strtotime("-1 day")))), array('lt', strtotime(date("Y-m-d", strtotime("-1 day"))) + 24 * 3600 - 1))))->count(),
            ],
            'today' => [
                'date' => date("m-d", time()),
                'new_user' => M('User')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d", time())))
                , array('lt', strtotime(date("Y-m-d", time())) + 24 * 3600 - 1))))->count(),
                'login_user' => M('User')->where(array('last_login_time' => array(array('egt', strtotime(date("Y-m-d", time())))
                , array('lt', strtotime(date("Y-m-d", time())) + 24 * 3600 - 1))))->count(),
            ],
        ];
        $dates = json_encode($dates);
        if ($this->isSuper) {
            $super = 1;
        } else {
            $super = 2;
        }
        $this->assign('datesData', $dates)->assign('isSuper', $super);
        $this->display();
    }

    //用户登录和增加记录
    public function userLoginRecord()
    {
        $monthData = [];
        $monthDay = 30;
        for ($i = 0; $i < $monthDay; $i++) {
            $monthData[$i]['date'] = date("m-d", strtotime("-{$i} day"));
            $monthData[$i]['new_user'] = M('User')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d",
                strtotime("-{$i} day")))), array('lt', strtotime(date("Y-m-d", strtotime("-{$i} day"))) + 24 * 3600 - 1))))->count();
            $monthData[$i]['login_user'] = M('User')->where(array('last_login_time' => array(array('egt', strtotime(date("Y-m-d",
                strtotime("-{$i} day")))), array('lt', strtotime(date("Y-m-d", strtotime("-{$i} day"))) + 24 * 3600 - 1))))->count();
        }
        krsort($monthData);
        $monthData = array_merge($monthData);
        $monthData = json_encode($monthData);
        $yearData = [];
        $yearDay = 180;
        for ($i = 0; $i < $yearDay; $i++) {
            $yearData[$i]['date'] = date("m-d", strtotime("-{$i} day"));
            $yearData[$i]['new_user'] = M('User')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d",
                strtotime("-{$i} day")))), array('lt', strtotime(date("Y-m-d", strtotime("-{$i} day"))) + 24 * 3600 - 1))))->count();
            $yearData[$i]['login_user'] = M('User')->where(array('last_login_time' => array(array('egt', strtotime(date("Y-m-d",
                strtotime("-{$i} day")))), array('lt', strtotime(date("Y-m-d", strtotime("-{$i} day"))) + 24 * 3600 - 1))))->count();
        }
        krsort($yearData);
        $yearData = array_merge($yearData);
        $yearData = json_encode($yearData);
        $this->assign('yearData', $yearData)->assign('monthData', $monthData);
        $this->display();
    }

    //积分领取和使用情况
    public function userIntegralRecord()
    {
        $monthData = [];
        $monthDay = 30;
        for ($i = 0; $i < $monthDay; $i++) {
            $monthData[$i]['date'] = date("m-d", strtotime("-{$i} day"));
            //支出
            $disburse[$i] = M('integral_record')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d",
                strtotime("-{$i} day")))), array('lt', strtotime(date("Y-m-d", strtotime("-{$i} day"))) + 24 * 3600 - 1)), 'status' => 1, 'type' => 1))->sum('integral');
            if ($disburse[$i] == null) {
                $monthData[$i]['disburse'] = 0;
            } else {
                $monthData[$i]['disburse'] = $disburse[$i];
            }
            //收入
            $income[$i] = M('integral_record')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d",
                strtotime("-{$i} day")))), array('lt', strtotime(date("Y-m-d", strtotime("-{$i} day"))) + 24 * 3600 - 1)), 'status' => 1, 'type' => 2))->sum('integral');
            if ($income[$i] == null) {
                $monthData[$i]['income'] = 0;
            } else {
                $monthData[$i]['income'] = $income[$i];
            }
        }
        krsort($monthData);
        $monthData = array_merge($monthData);
        $monthData = json_encode($monthData);
        $yearData = [];
        $yearDay = 180;
        for ($i = 0; $i < $yearDay; $i++) {
            $yearData[$i]['date'] = date("m-d", strtotime("-{$i} day"));
            //支出
            $disburse[$i] = M('integral_record')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d",
                strtotime("-{$i} day")))), array('lt', strtotime(date("Y-m-d", strtotime("-{$i} day"))) + 24 * 3600 - 1)), 'status' => 1, 'type' => 1))->sum('integral');
            if ($disburse[$i] == null) {
                $yearData[$i]['disburse'] = 0;
            } else {
                $yearData[$i]['disburse'] = $disburse[$i];
            }
            //收入
            $income[$i] = M('integral_record')->where(array('create_time' => array(array('egt', strtotime(date("Y-m-d",
                strtotime("-{$i} day")))), array('lt', strtotime(date("Y-m-d", strtotime("-{$i} day"))) + 24 * 3600 - 1)), 'status' => 1, 'type' => 2))->sum('integral');
            if ($income[$i] == null) {
                $yearData[$i]['income'] = 0;
            } else {
                $yearData[$i]['income'] = $income[$i];
            }
        }
        krsort($yearData);
        $yearData = array_merge($yearData);
        $yearData = json_encode($yearData);
        $this->assign('yearData', $yearData)->assign('monthData', $monthData);
        $this->display();
    }

}