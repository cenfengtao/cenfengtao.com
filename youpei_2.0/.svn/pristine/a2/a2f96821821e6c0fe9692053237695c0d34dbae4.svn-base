<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class PictureController extends CommonController
{
    public function index()
    {
        $list = M('Picture')->order('sort')->select();
        $this->assign('list', $list);
        $this->display();
    }

    public function addPicture()
    {
        if ($_POST) {
            if (!$_POST['image']) {
                unset($_POST['image']);
            }
            if ($_POST['id']) {
                $this->save($_POST);
            }
            try {
                $_POST['create_time'] = time();
                $id = D('Picture')->insert($_POST);
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

    public function editPicture()
    {
        if (!$_GET['id']) {
            return show(0, '参数错误');
        }
        try {
            $picture = D('Picture')->find($_GET['id']);
            $this->assign('picture', $picture);
            $this->display();
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function save($data)
    {
        try {
            $id = D('Picture')->updateById($data['id'], $data);
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
            $result = D('Picture')->delete($_POST['id']);
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