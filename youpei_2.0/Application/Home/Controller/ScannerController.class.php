<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class ScannerController extends BaseController
{
    public function addScanner()
    {
        if ($_POST) {
            if (!$_POST['name'] || empty($_POST['name'])) {
                return show(0, '姓名不能为空');
            }
            if (!$_POST['mobile'] || empty($_POST['mobile'])) {
                return show(0, '手机号码不能为空');
            }
            if (!$_POST['org_id'] || empty($_POST['org_id'])) {
                return show(0, '机构参数有误');
            }
            try {
                $insertData = [
                    'name' => $_POST['name'],
                    'user_id' => $this->user['id'],
                    'mobile' => $_POST['mobile'],
                    'create_time' => time(),
                    'org_id' => $_POST['org_id'],
                    'token' => $this->token
                ];
                $scanner_id = D('Scanner')->insert($insertData);
                if ($scanner_id) {
                    return show(1, '添加成功');
                } else {
                    return show(0, '添加失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            if (!$_GET['org_id'] || empty($_GET['org_id'])) {
                $this->error('机构ID参数错误');
            }
            try {
                $organization = D("Organization")->find($_GET['org_id']);
                $this->assign('organization', $organization);
                $this->display();
            } catch (Exception $e) {
                $this->error($e->getMessage());
            }
        }
    }

    //扫用户二维码
    public function scanUser()
    {
        if (!$_GET['user_id'] || empty($_GET['user_id'])) {
            $this->error('用户ID参数错误');
        }
        //判断是否扫码员
        $isScanner = D('Scanner')->isScanner($this->user['id']);
        if (!$isScanner || empty($isScanner)) {
            $this->error("你还不是扫码员");
        }
        $this->display();
    }
}