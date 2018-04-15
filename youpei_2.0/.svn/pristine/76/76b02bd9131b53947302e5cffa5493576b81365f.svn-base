<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class AssociationController extends CommonController
{
    public function index()
    {
        if ($this->isSuper) {
            $list = D('Association')->getList();
        } else {
            $list = D('Association')->getList(array('token' => $this->token));
        }
        foreach ($list as $k => $v) {
            $list[$k]['org_name'] = D('Organization')->getOrgnameByToken($v['token']);
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function addAssociation()
    {
        if ($_POST) {
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '标题不能为空');
            }
            if (!$_POST['pic_url'] || empty($_POST['pic_url'])) {
                unset($_POST['pic_url']);
            }
            if (!$_POST['qr_code'] || empty($_POST['qr_code'])) {
                unset($_POST['qr_code']);
            }
            if ($_POST['id'] || !empty($_POST['id'])) {
                return $this->save($_POST);
            }
            try {
                $data = $_POST;
                $data['token'] = $this->token;
                $data['create_time'] = time();
                $id = D('Association')->insert($data);
                if ($id) {
                    return show(1, '添加成功');
                } else {
                    return show(0, '添加失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            $cateList = D('ProductClass')->getList();
            $this->assign('cateList', $cateList);
            $this->display();
        }
    }

    public function editAssociation()
    {
        if (!$_GET['id'] || empty($_GET['id'])) {
            return show(0, 'ID参数错误');
        }
        try {
            $find = D('Association')->find($_GET['id']);
            $cateList = D('ProductClass')->getList();
            $this->assign('find', $find)->assign('cateList', $cateList);
            $this->display();
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function save($data)
    {
        try {
            $id = D('Association')->updateById($data['id'], $data);
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
        if (!$_GET['id'] || empty($_GET['id'])) {
            return show(0, 'ID参数错误');
        }
        try {
            $id = D('Association')->delete($_GET['id']);
            if ($id) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function consult()
    {
        if ($this->isSuper) {
            $list = D('Association')->getList(array('is_consult' => 2));
        } else {
            $list = D('Association')->getList(array('is_consult' => 2, 'token' => $this->token));
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function addConsult()
    {
        if ($_POST) {
            if (!$_POST['id'] || empty($_POST['id'])) {
                return show(0, 'ID参数错误');
            }
            //是否已存在，每个机构限制一个
            $is_consult = M('Association')->where(array('is_consult' => 2, 'token' => $this->token))->find();
            if ($is_consult) {
                return show(0, '你已经设置了一个群了');
            }
            $data = [
                'is_consult' => 2
            ];
            $id = D('Association')->updateById($_POST['id'], $data);
            if ($id) {
                return show(1, '添加成功');
            } else {
                return show(0, '添加失败');
            }
        } else {
            if ($this->isSuper) {
                $list = D('Association')->getList(array('is_consult' => 1));
            } else {
                $list = D('Association')->getList(array('is_consult' => 1, 'token' => $this->token));
            }
            $this->assign('list', $list);
            $this->display();
        }
    }

    public function cancel()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            $this->ajaxReturn(array('status' => 0, 'message' => 'ID参数错误'));
        }
        $data = [
            'is_consult' => 1
        ];
        $id = D('Association')->updateById($_POST['id'], $data);
        if ($id) {
            $this->ajaxReturn(array('status' => 1, 'message' => '取消成功'));
        }
        $this->ajaxReturn(array('status' => 0, 'message' => '取消失败'));
    }

}