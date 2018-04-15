<?php
/**
 *用户设置
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class UserConfigController extends CommonController
{
    public function index()
    {
        if ($_POST) {
            if (!$_POST['over_adv'] || empty($_POST['over_adv'])) {
                unset($_POST['over_adv']);
            }
            if(!$_POST['sign_image'] || empty($_POST['sign_image'])){
                unset($_POST['sign_image']);
            }
            try {
                $id = D('Config')->updateById($_POST['id'], $_POST);
                if ($id !== false) {
                    return show(1, '修改成功');
                } else {
                    return show(0, '修改失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            $config = M('Config')->where(array('token' => $this->token))->find();
            if (!$config) {
                $config = D('Config')->insert(array('token' => $this->token));
            }
            $this->assign('config', $config);
            $this->display();
        }
    }
}