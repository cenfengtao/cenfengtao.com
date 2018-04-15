<?php
namespace Admin\Controller;
use Think\Controller;
class HomeclassifyController extends CommonController {
	public function index(){
		$list = M('Homeclassify')->where(array('token' => $this->token))->order('sort')->select();
        $this->assign('list',$list);
		$this->display();
	}

	public function addclassify(){
		$m = D('Homeclassify');
    	if(I('id',0)>0){
         $object = $m->get();
    	}
        $this->assign('object',$object);	
		$this->display();
	}

	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$m = D('Homeclassify');
        if(I('id',0)>0){
         $rs = $m->editHomeclassify();
        }else{
    	 $rs = $m->insertHomeclassify($this->token);
    	}
    	$this->ajaxReturn($rs);
	}

	public function del(){
		$m = D('Homeclassify');
		$rs = $m->del();
		$this->ajaxReturn($rs);
	}
}