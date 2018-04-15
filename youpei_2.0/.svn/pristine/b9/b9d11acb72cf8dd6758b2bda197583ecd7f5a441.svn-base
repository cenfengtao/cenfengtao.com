<?php
/**
 *公众号菜单管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class WxUserController extends CommonController
{
    public function index()
    {
        $list = D('Wxuser')->getList();
        $this->assign('list',$list);
        $this->display();
    }

    public function addWxUser()
    {
        if ($_POST) {
            if (!$_POST['wxname'] || empty($_POST['wxname'])) {
                return show(0, '公众号名称不能为空');
            }
            if (!$_POST['wxid'] || empty($_POST['wxid'])) {
                return show(0, '公众号原始id不能为空');
            }
            if(!$_POST['weixin'] || empty($_POST['weixin'])){
                return show(0, '微信号不能为空');
            }
            if ($_POST['id'] && !empty($_POST['id'])) {
                $_POST['updatetime'] = time();
                return $this->save($_POST);
            }
            $_POST['createtime'] = time();
            try {
                $id = D('Wxuser')->insert($_POST);
                if ($id) {
                    return show(1, '添加成功');
                } else {
                    return show(0, '添加失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            $this->display();
        }
    }

    public function editWxUser()
    {
        if (!$_GET['id'] || empty($_GET['id'])) {
            $this->error('ID参数错误');
        }
        $find = D('Wxuser')->find($_GET['id']);
        $this->assign('find', $find);
        $this->display();
    }

    public function delete()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('Wxuser')->delete($_POST['id']);
            if ($result) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }


    public function save($data)
    {
        try {
            $id = D("Wxuser")->updateById($data['id'], $data);
            if ($id === false) {
                return show(0, '修改失败');
            }
            return show(1, '修改成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
}