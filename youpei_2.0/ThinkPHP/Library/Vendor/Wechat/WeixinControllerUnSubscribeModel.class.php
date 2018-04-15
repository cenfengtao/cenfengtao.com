<?php
/**
 * 取消关注
 * @author jxiao
 */
import("Vendor.Wechat.WeixinControllerModel");

class WeixinControllerUnSubscribeModel extends WeixinControllerModel
{
    public function _reply()
    {
        $open_id = substr(json_encode($this->data['FromUserName']),1,strlen(json_encode($this->data['FromUserName']))-2);
        M('user')->where(array('open_id'=>$open_id))->save(array('attention'=>2));
        return array();
    }
}

?>