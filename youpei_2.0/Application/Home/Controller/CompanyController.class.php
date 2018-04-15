<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class CompanyController extends BaseController
{
    public function introduce()
    {
        $introduce = D('Article')->find(175);
        $this->assign('introduce', $introduce);
        $this->display();
    }

    public function gmIndex()
    {
        $this->display();
    }

    public function gamesIndex()
    {
        $this->display();
    }

    public function votePrizeIndex()
    {
        if ($_POST){
            if(!$_POST['prize_id']){
                return show(0,'ID参数错误');
            }
            if(!$_POST['name']){
                return show(0,'请输入你的用户名');
            }
            if(!$_POST['mobile']){
                return show(0,'请输入你的手机号码');
            }
            if(!$_POST['province'] || !$_POST['city'] || !$_POST['area'] || !$_POST['address']){
                return show(0,'请检查你的收货地址');
            }
            $data = [
                'name'=>$_POST['name'],
                'mobile'=>$_POST['mobile'],
                'province'=>$_POST['province'],
                'city'=>$_POST['city'],
                'area'=>$_POST['area'],
                'address'=>$_POST['address'],
                'message'=>$_POST['message'],
            ];
            $prizeRecordId = D('VotePrizeRecord')->updateById($_POST['prize_id'],$data);
            if($prizeRecordId){
                return show(1,'提交成功，请耐心等待发货');
            }else{
                return show(0,'提交失败，请重新打开页面，或者联系客服');
            }
        }else{
            $this->display();
        }
    }
}