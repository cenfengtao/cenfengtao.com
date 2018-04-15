<?php
namespace Home\Controller;

use Think\Controller;

class MemberIntegralController extends BaseController
{
    public function integrallist()
    {
        $this->title = "积分账单";
        $integral['now'] = $this->user['integral'];
        $integral['totalGet'] = D('IntegralRecord')->totalGetByUserId($this->user['id']);
        $integral['totalUse'] = D('IntegralRecord')->totalUseByUserId($this->user['id']);
        //签到
        $integral['singIntegral'] = D('IntegralRecord')->totalGetIntegral($this->user['id'],1,2);
        //妆发
        $integral['shareIntegral'] = D('IntegralRecord')->totalGetIntegral($this->user['id'],5,2);
        //兑换红包
        $integral['exchangeRedIntegral'] = D('IntegralRecord')->totalGetIntegral($this->user['id'],2,1);
        $this->assign('integral', $integral);
        $this->display();
    }
}