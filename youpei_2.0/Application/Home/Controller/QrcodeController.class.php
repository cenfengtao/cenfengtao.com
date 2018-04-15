<?php
namespace Home\Controller;

use Think\Controller;

require_once __DIR__ . '/../../../ThinkPHP/Library/Vendor/phpqrcode/phpqrcode.class.php';

class QrcodeController extends Controller
{
    //添加扫码员
    public function qrcode()
    {
        $org_id = $_GET['org_id'];
        if (!$org_id || empty($org_id)) {
            $this->error('请先选择机构');
        }
        $url = "http://" . $_SERVER['HTTP_HOST'] . '/index.php/Scanner/addScanner?org_id=' . $org_id;
        \QRcode::png($url, false, 'M', 10, 2);
    }

    public function getUserMsg()
    {
        if (!$_GET['user_id'] || empty($_GET['user_id'])) {
            $this->error('用户ID参数错误');
        }
        $url = "http://" . $_SERVER['HTTP_HOST'] . '/index.php/Scanner/scanUser?user_id=' . $_GET['user_id'];
        \QRcode::png($url, false, 'M', 10, 2);
    }

    public function Temporaryactivityqrcode(){
        if (!$_GET['token'] || empty($_GET['token'])) {
            $this->error('用户ID参数错误');
        }
        if (!$_GET['activityid'] || empty($_GET['activityid'])) {
            $this->error('用户ID参数错误');
        }

        $url = "http://" . $_SERVER['HTTP_HOST'] . '/index.php/Lottery/index?token=' . $_GET['token'].'&activityid='. $_GET['activityid'];
        \QRcode::png($url, false, 'M', 10, 2);
     }
}