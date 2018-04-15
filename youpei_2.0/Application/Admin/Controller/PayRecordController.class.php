<?php
/**
 *订单管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class PayRecordController extends CommonController
{
    public function recordList()
    {
        /*
           * 分页操作逻辑
           * */
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
        if($this->isSuper){
            $list = D('PayRecord')->getListForPay(array(), $page, $pageSize);
            $count = D('PayRecord')->getCount();
        }else{
            $list = D('PayRecord')->getListForPay(array('token'=>$this->token), $page, $pageSize);
            $count = D('PayRecord')->getCount(array('token'=>$this->token));
        }
        $res = new Page($count, $pageSize);
        $page = $res->show();
        foreach ($list as $k => $v) {
            $list[$k]['username'] = D('User')->getNameById($v['user_id']);
        }
        $this->assign('recordList', $list)->assign('page',$page);
        $this->display();
    }
}