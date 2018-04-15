<?php
import("@.Model.Home.WeixinControllerModel");

/**
 * 二维码扫描出来(菜单键扫一扫)
 */
class WeixinControllerScanQrcodeModel extends WeixinControllerModel
{

    function _reply()
    {
        $this->data['module'] = 'NOCRM';
        $return = array("你的扫描结果:\n" . $this->data['ScanResult'], 'text');
        $this->isDone = true;
        return $return;
    }
}