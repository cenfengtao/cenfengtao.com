<?php
/**
 * 后台登录
 */
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    //登录界面
    public function login()
    {
        if (session('adminUser')) {
            if (!session('token')) {
                $this->display();
            } else if (session('token') == 'g232238gc959') {
                redirect(U('Index/index'));
            } else {
                redirect(U('product/proUpList'));
            }
        }
        $this->display();
    }

    //验证登录
    public function loginIn()
    {
        if (!$_POST['username'] || empty($_POST['username'])) {
            return show(0, '用户名不能为空');
        }
        if (!$_POST['password'] || empty($_POST['password'])) {
            return show(0, '密码不能为空');
        }
        try {
            $adminUser = D('AdminUser')->getAdminByUsername($_POST['username']);
            if (!$adminUser || empty($adminUser)) {
                return show(0, '用户不存在');
            }
            if (getMd5Password($_POST['password']) != $adminUser['password']) {
                return show(0, '密码错误');
            }
            //去除密码session
            unset($adminUser['password']);
            //记录最后登录信息
            D('AdminUser')->setLastLoginData($_POST['username']);
            session('adminUser', $adminUser);
            $token = D('Wxuser')->getTokenByWxuserId($adminUser['wxuser_id']);
            if ($token == 'g232238gc959') {
                return show(1, '登录成功', ['isSuper' => 1]);
            } else {
                return show(1, '登录成功', ['isSuper' => 2]);
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    //注销
    public function loginOut()
    {
        session('adminUser', null);
        session('token', null);
        redirect(U('Login/login'));
    }
}