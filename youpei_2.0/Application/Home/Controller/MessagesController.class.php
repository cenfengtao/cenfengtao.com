<?php
namespace Home\Controller;

use Think\Controller;

class MessagesController extends BaseController
{
    public function index()
    {

        $this->title = "我的消息";
           $re = D('Favorites')->getorgFollow($this->user['id']);
           $m = D('Messages');
           foreach ($re as $key => $value) {
            if ($value['token']==$this->token) {
                 unset($value['token']);
            }
            //获取关注机构的消息
               $list = $m->getMessagesList($value['token']);
               foreach ($list as $k => $v) {
                   $row[] =  $v;
               }
           }

           //是否已读
        foreach ($row as $key => $value) {
               $row[$key]['Readid'] = D('ReadMessage')->getReadMessage($this->user['id'],$value['id']);
        }
         $this->assign('list',$row);
         //获取本平台的消息
         $platform = $m->getMessagesList($this->token);
        //是否已读
        foreach ($platform as $key => $value) {
           $platform[$key]['Readid'] = D('ReadMessage')->getReadMessage($this->user['id'],$value['id']);
        }

        $this->assign('res',$platform);
        $this->display();
    }

    public function showMessage(){
        $this->title = "消息详情";
        $m=D('ReadMessage');
        $re = $m->RecordReadMessage($this->user['id'],(int)I('id'));

        $m = D('Messages');
        $showMessage = $m->getMessagesdetailed((int)I('id'));
        $this->assign('showMessage',htmlspecialchars_decode($showMessage['msgcontent']));
        $this->display();
    }
}