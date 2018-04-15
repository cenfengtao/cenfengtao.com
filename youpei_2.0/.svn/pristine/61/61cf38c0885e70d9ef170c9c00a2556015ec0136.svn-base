<?php
namespace Admin\Controller;
use Think\Controller;

class PersonalbackgroundController extends CommonController {
    public function index(){
		$list = M('PersonalBackground')->where(array('token'=>$this->token))->find();
        $this->assign('object',$list);
       $this->display();
    }

     /**
	 * 新增/修改操作
	 */
	public function edit(){
		 $m = D('PersonalBackground');
        if(I('id',0)>0){
         $rs = $m->editbackground();
        }else{
    	 $rs = $m->insertbackground($this->token);
    	}
    	$this->ajaxReturn($rs);
	}

	public function del(){
		$m = D('PersonalBackground');
		$rs = $m->del();
		$this->ajaxReturn($rs);
	}
}