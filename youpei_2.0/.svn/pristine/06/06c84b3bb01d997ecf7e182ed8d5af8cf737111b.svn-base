<?php
namespace Admin\Controller;
use Think\Controller;
class RedPacketLimitController extends CommonController {
	public function index(){
	    $m = D('WxpayoutLimit');
    	$list = $m->querywxpayoutLimit();
        $this->assign('list',$list);
		$this->display();
	}
	public function RedPacketmanagement(){
		$m = D('WxpayoutLimit');
    	if(I('id',0)>0){
         $object = $m->get();
    	}
      $this->assign('object',$object);
      $this->display();
	}
	public function edit(){
		 $m = D('WxpayoutLimit');
        if(I('id',0)>0){
         $rs = $m->editRedPacket();
        }else{
    	 $rs = $m->insertRedPacket();
    	}
    	$this->ajaxReturn($rs);
	}

	public function del(){
		$m = D('WxpayoutLimit');
		$rs = $m->del();
		$this->ajaxReturn($rs);
	}
}