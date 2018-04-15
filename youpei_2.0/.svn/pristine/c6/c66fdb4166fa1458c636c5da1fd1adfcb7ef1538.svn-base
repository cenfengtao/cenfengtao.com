<?php
/**
 *菜单管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class MenuController extends CommonController
{
    public function manageMenuList()
    {
        $this->display();
    }

    public function getMenu()
    {
        if (!$_POST['id'] || !is_numeric($_POST['id'])) {
            return show(0, 'id不能为空');
        }
        try {
            $menu = D('Menu')->find($_POST['id']);
            if ($menu) {
                return show(1, '获取成功', $menu);
            }
            return show(0, '没有该数据');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function edit()
    {
        if (!$_POST['id'] || !is_numeric($_POST['id'])) {
            return show(0, 'id不能为空');
        }
        if (!$_POST['title'] || empty($_POST['title'])) {
            return show(0, '菜单名称不能为空');
        }
        try {

        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function addMenu()
    {
        if ($_POST) {
            if (!isset($_POST['title']) || empty($_POST['title'])) {
                return show(0, '菜单名称不能为空');
            }
            if ($_POST['id'] && !empty($_POST['id'])) {
                return $this->save($_POST);
            }
            try {
                $id = D('Menu')->insert($_POST);
                if ($id) {
                    return show(1, '添加成功');
                } else {
                    return show(0, '添加失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            $fatherMenuList = D('Menu')->getAdminFatherMenu();
            $this->assign('fatherMenuList', $fatherMenuList);
            $this->display();
        }
    }

    public function save($data)
    {
        try {
            $id = D('Menu')->updateById($data['id'], $data);
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
            $result = D('Menu')->deleteById($_POST['id']);
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