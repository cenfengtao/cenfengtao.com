<?php
/**
 *管理员角色管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class AdminRoleController extends CommonController
{
    public function roleList()
    {
        $list = D('AdminRole')->getRoleList();
        $this->assign('roleList', $list);
        $this->display();
    }

    public function delete()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('AdminRole')->deleteRoleById($_POST['id']);
            if ($result) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function addRole()
    {
        if ($_POST) {
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '名称不能为空');
            }
            try {
                $insertData = [
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'create_time' => time(),
                    'create_id' => $this->user['id'],
                ];
                if ($_POST['id']) {
                    $insertData['id'] = $_POST['id'];
                    unset($insertData['create_time']);
                    unset($insertData['create_id']);
                    return $this->save($insertData);
                }
                $isRepeat = D('AdminRole')->isRepeatTitle($_POST['title']);
                if ($isRepeat) {
                    return show(0, '角色名称不能重复');
                }
                $id = D('AdminRole')->insert($insertData);
                if ($id) {
                    return show(1, '添加成功');
                } else {
                    return show(0, '添加失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            $this->assign('pageTitle', '添加角色');
            $this->display();
        }
        return false;
    }

    public function editRole()
    {
        if (!$_GET['id'] || !is_numeric($_GET['id'])) {
            return show(0, '参数错误');
        }
        try {
            $role = D('AdminRole')->find($_GET['id']);
            $this->assign('role', $role);
            $this->display();
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function save($data)
    {
        $roleId = $data['id'];
        $data['modify_id'] = $this->user['id'];
        $data['modify_time'] = time();
        unset($data['id']);
        try {
            $id = D('AdminRole')->updateRoleById($roleId, $data);
            if ($id === false) {
                return show(0, '修改失败');
            }
            return show(1, '修改成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
}