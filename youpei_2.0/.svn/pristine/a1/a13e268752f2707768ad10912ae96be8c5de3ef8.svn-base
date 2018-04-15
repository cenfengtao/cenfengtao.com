<?php
/**
 *活动邀约
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class ActivityInviteController extends CommonController
{
    public function index()
    {
        $list = D('ActivityInvite')->getList();
        $this->assign('list', $list);
        $this->display();
    }

    public function addInvite()
    {
        if ($_POST) {
            if (!$_POST['title']) {
                return show(0, '标题不能为空');
            }
            if (empty($_POST['image'])) {
                unset($_POST['image']);
            }
            $data = $_POST;
            if ($_POST['id']) { //修改
                $id = D('ActivityInvite')->updateById($data['id'], $data);
                if ($id === false) {
                    return show(0, '修改失败');
                } else {
                    return show(1, '修改成功');
                }
            } else { //新增
                $data['create_time'] = time();
                $id = D('ActivityInvite')->insert($data);
                if ($id) {
                    return show(1, '添加成功');
                } else {
                    return show(0, '添加失败');
                }
            }
        } else {
            $this->display();
        }
    }

    public function editInvite()
    {
        if (!$_GET['id']) {
            $this->error('参数错误');
        }
        $invite = D('ActivityInvite')->find($_GET['id']);
        $this->assign('invite', $invite);
        $this->display();
    }
    
    public function deleteInvite()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('ActivityInvite')->delete($_POST['id']);
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