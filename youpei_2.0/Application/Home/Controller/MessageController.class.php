<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class MessageController extends BaseController
{
    public function index()
    {
        $this->title = "我的消息";
            $list = M('UserMessage')->where(array('user_id'=>$this->user['id']))->order('create_time desc')->field('id,title,desc,create_time,token,is_read,system_message')->select();
            foreach ($list as $ke =>$va){
                $list[$ke]['create_time'] = date('Y-m-d H:i',$va['create_time']);
                $list[$ke]['org_name'] = M('Organization')->where(array('token'=>$va['token']))->getField('org_name');
            }

        if($_POST){
            if(!$_POST['id'] || empty($_POST['id'])){
                return show(0,'ID参数错误');
            }
            $this->ajaxReturn(array('status'=>1,'message'=>'已读'));
        }
        $this->assign('list',$list);
        $this->display();
    }

    public function messageDetails()
    {
        $this->title = "消息详情";
        if($_GET){
            if(!$_GET['id'] || empty($_GET['id'])){
                return show(0,'ID参数错误');
            }
            $data = D('UserMessage')->find($_GET['id']);
            $data['create_time'] = date('Y-m-d H:i',$data['create_time']);
            $this->assign('data',$data);
            if($data['is_read'] == 1){
                $data = [
                    'is_read'=>2
                ];
                D('UserMessage')->updateById($_GET['id'],$data);
            }
        }
        $this->display();
    }
}