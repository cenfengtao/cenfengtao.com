<?php
/**
 *扫码员管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
class ScannerController extends CommonController
{
    public function scannerList()
    {
        if($this->isSuper){
            $list = D('Scanner')->getList();
            $orgList = D('Organization')->getOrgList();
        }else{
            $list = M('Scanner')->where(array('token'=>$this->token))->select();
            $orgList = M('Organization')->where(array('token'=>$this->token))->select();
        }
        foreach ($list as $k => $v) {
            $list[$k]['org_name'] = D('Organization')->getOrgNameById($v['org_id']);
        }
        $this->assign('list', $list)->assign('orgList', $orgList);
        $this->display();
    }

    public function delete()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('Scanner')->delete($_POST['id']);
            if ($result) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
}