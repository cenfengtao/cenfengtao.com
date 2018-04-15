<?php
/**
 *地图地址管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class MapController extends CommonController
{
    public function index()
    {
        $list = M('map')->select();
        $this->assign('list', $list);
        $this->display();
    }

    public function addAddress()
    {
        if ($_POST) {
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '标题不能为空');
            }
            if (!$_POST['address'] || empty($_POST['address'])) {
                return show(0, '地址不能为空');
            }
            if (!$_POST['mobile'] || empty($_POST['mobile'])) {
                return show(0, '联系方式不能为空');
            }
            $_POST['create_time'] = time();
            if ($_POST['id'] && !empty($_POST['id'])) {
                return $this->save($_POST);
            }
            try {
                $id = D('Map')->insert($_POST);
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

    public function editAddress()
    {
        if (!$_GET['id'] || !is_numeric($_GET['id'])) {
            return show(0, 'ID参数不能为空');
        }
        $address = D('Map')->find($_GET['id']);
        $this->assign('address', $address);
        $this->display();
    }

    public function save($data)
    {
        try {
            $id = D('Map')->updateById($data['id'], $data);
            if ($id === false) {
                return show(0, '修改失败');
            }
            return show(1, '修改成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function delete()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('Map')->delete($_POST['id']);
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