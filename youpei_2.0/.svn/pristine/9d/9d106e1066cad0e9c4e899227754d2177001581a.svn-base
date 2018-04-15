<?php
namespace Common\Model;

 class MessagesModel extends BaseModel {

  public function getMessagesList($token){

      return $this->query("select m.id,m.title,m.create_time,m.msgType,o.org_name from __PREFIX__messages m left join __PREFIX__organization o on m.token = o.token where m.msgType='0' and m.token='$token'");
  }

  public function queryMessagesByid($token){
    return $this->query("select m.id from __PREFIX__messages m left join __PREFIX__organization o on m.token = o.token where m.msgType='0' and m.token='$token'");
  }
  public function getMessagesdetailed($id){
    return $this->queryRow("select msgContent from __PREFIX__messages where id='$id'");
  }

      public function insertmessages($token){
         $rd = array('status'=>-1);
         $data['token'] =$token;
         $data['title'] = I('title');
         $data['msgType'] = 0;
         $data['msgContent'] = I('msgContent');
         $data['create_time'] = time();
         $data['is_send_template'] = (int)I('is_send_template');
         if ($data['is_send_template']==1) {
          $data['template_title'] = I('template_title');
          $data['template_first'] = I('template_first');
          $data['template_second'] = I('template_second');
          $data['template_third'] = I('template_third');
          $data['template_remark'] = I('template_remark');
          $data['template_url'] = I('template_url');
         }
         if($this->checkEmpty($data)){
              $rs = $this->add($data);
          if(false !== $rs){
         if ($data['is_send_template']==1) {
             //发送通知模板
                $first = $data['template_first'];
                $keyword1 = '+0分';
                $keyword2 = '消息';
                $keyword3 = date("Y-m-d H:i:s", time());
                $keyword4 =  '0分';
                $remark = '请点击“详情”查看具体内容';
                $url = "http://{$_SERVER['HTTP_HOST']}/index.php/MemberIntegral/integrallist?token=" . $token;
                $templeFormat = array('__OPENID__', '__URL__', '__FIRST__', '__KEYWORD1__', '__KEYWORD2__', '__KEYWORD3__', '__KEYWORD4__', '__REMARK__');
                $infoFormat = array('oSFV6w2H2TQbvg88T62tjXortsYU', $url, $first, $keyword1, $keyword2, $keyword3, $keyword4, $remark);
                $wxuser = get_wxuser($token);
                $re = execute_public_template('INTEGRAL_CHANGE', $templeFormat, $infoFormat, $wxuser);
              
                  }
          $rd['status']= 1;
          $rd['id']= $rs;
        }
         }
         return $rd;
      }

      public function editmessages($token){

        $rd = array('status'=>-1);
        $id = (int)I("id",0);
         $data['token'] =$token;
         $data['title'] = I('title');
         $data['msgType'] = 0;
         $data['msgContent'] = I('msgContent');
         $data['create_time'] = time();
         $data['is_send_template'] = (int)I('is_send_template');
         if ($data['is_send_template']==1) {
          $data['template_title'] = I('template_title');
          $data['template_first'] = I('template_first');
          $data['template_second'] = I('template_second');
          $data['template_third'] = I('template_third');
          $data['template_remark'] = I('template_remark');
          $data['template_url'] = I('template_url');
         }
         if($this->checkEmpty($data)){
            $rs = $this->where("id=".$id)->save($data);
          if(false !== $rs){
         if ($data['is_send_template']==1) {
             //发送通知模板
                $first = $data['template_first'];
                $keyword1 = '+0分';
                $keyword2 = '消息';
                $keyword3 = date("Y-m-d H:i:s", time());
                $keyword4 =  '0分';
                $remark = '请点击“详情”查看具体内容';
                $url = "http://{$_SERVER['HTTP_HOST']}/index.php/MemberIntegral/integrallist?token=" . $token;
                $templeFormat = array('__OPENID__', '__URL__', '__FIRST__', '__KEYWORD1__', '__KEYWORD2__', '__KEYWORD3__', '__KEYWORD4__', '__REMARK__');
                $infoFormat = array('oSFV6w2H2TQbvg88T62tjXortsYU', $url, $first, $keyword1, $keyword2, $keyword3, $keyword4, $remark);
                $wxuser = get_wxuser($token);
                $re = execute_public_template('INTEGRAL_CHANGE', $templeFormat, $infoFormat, $wxuser);
              
                  }
          $rd['status']= 1;
          $rd['id']= $rs;
           }
         }
         return $rd;
      }

      public function get(){
        return $this->where("id=".(int)I('id'))->find();
      }

      /**
      * 删除
      */
     public function del(){
        $rd = array('status'=>-1);
        $rs = $this->delete((int)I('id'));
        if(false !== $rs){
           $rd['status']= 1;
        }
        return $rd;
     }
 }