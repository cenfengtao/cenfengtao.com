<?php
/**
 *用户等级管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class UserLevelController extends CommonController
{
    public function levelList()
    {
        $levelList = D('UserLevel')->getList();
        $this->assign('levelList', $levelList);
        $this->display();
    }
}