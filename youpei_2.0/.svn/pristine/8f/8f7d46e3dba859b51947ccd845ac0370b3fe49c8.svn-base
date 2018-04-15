<?php
/**
 *平台消息模板管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class TerraceController extends CommonController
{
    public function index()
    {
        $list = D('Terrace')->getList(array('token' => $this->token,'system_message'=>1));
        foreach ($list as $k => $v) {
            $status = M('MessageRecord')->where(array('type' => 2, 'type_id' => $v['id']))->field('status,max(create_time)')->group('status')->find();
            $list[$k]['status'] = $status['status'];
            $list[$k]['create_time'] = $status['max(create_time)'];
        }
        $this->assign('list', $list);
        $this->display();
    }
    //公众号模板消息
    public function TerList()
    {
        $list = D('Terrace')->getList(array('token' => $this->token,'system_message'=>2));
        foreach ($list as $k => $v) {
            $status = M('MessageRecord')->where(array('type' => 2, 'type_id' => $v['id']))->field('status,max(create_time)')->group('status')->find();
            $list[$k]['status'] = $status['status'];
            $list[$k]['create_time'] = $status['max(create_time)'];
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function addMessage()
    {
        if ($_POST) {
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '标题不能为空');
            }
            if (!$_POST['desc'] || empty($_POST['desc'])) {
                return show(0, '描述不能为空');
            }
            if (!$_POST['content'] || empty($_POST['content'])) {
                return show(0, '内容不能为空');
            }
            $_POST['create_time'] = time();
            $_POST['token'] = $this->token;
            if ($_POST['id'] && !empty($_POST['id'])) {
                return $this->save($_POST);
            }
            try {
                $id = D('Terrace')->insert($_POST);
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

    public function editMessage()
    {
        if (!$_GET['id'] || empty($_GET['id'])) {
            return show(0, 'ID参数错误');
        }
        try {
            $list = D('Terrace')->find($_GET['id']);
            $this->assign('list', $list);
            $this->display();
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function save($data)
    {
        try {
            $id = D('Terrace')->updateById($data['id'], $data);
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
            return show(0, 'ID参数错误');
        }
        try {
            $id = D('Terrace')->delete($_POST['id']);
            if ($id) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function sendMessage()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            $this->ajaxReturn(array('status' => 0, 'message' => 'ID参数错误'));
        }
        $data = D('Terrace')->find($_POST['id']);
        $orgId = M('organization')->where(array('token' => $data['token']))->getField('id');
        $userId = D('Collect')->getList(array('type' => 1,'type_id'=>$orgId));
        foreach ($userId as $k => $v) {//记录平台消息发送用户记录
            $user = [
                'title' => $data['title'],
                'desc' => $data['desc'],
                'content' => $data['content'],
                'token' => $data['token'],
                'create_time' => time(),
                'user_id' => $v['user_id']
            ];
            D('UserMessage')->insert($user);
        }
        //记录每次平台发送消息
        $arr = [
            'token' => $data['token'],
            'create_time' => time(),
            'type' => 2,
            'type_id' => $data['id'],
            'status' => 2
        ];
        $re = D('MessageRecord')->insert($arr);
        if ($re) {
            $this->ajaxReturn(array('status' => 1, 'message' => '发送成功'));
        } else {
            $arr = [
                'token' => $data['token'],
                'create_time' => time(),
                'type' => 2,
                'type_id' => $data['id'],
                'status' => 1
            ];
            D('MessageRecord')->insert($arr);
            $this->ajaxReturn(array('status' => 0, 'message' => '发送失败'));
        }
    }

    public function addAllMessage()
    {
        if ($_POST) {
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '标题不能为空');
            }
            if (!$_POST['desc'] || empty($_POST['desc'])) {
                return show(0, '描述不能为空');
            }
            if (!$_POST['content'] || empty($_POST['content'])) {
                return show(0, '内容不能为空');
            }
            $_POST['create_time'] = time();
            $_POST['token'] = $this->token;
            if ($_POST['id'] && !empty($_POST['id'])) {
                return $this->save($_POST);
            }
            try {
                $id = D('Terrace')->insert($_POST);
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

    public function sendAllMessage()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            $this->ajaxReturn(array('status' => 0, 'message' => 'ID参数错误'));
        }
        $data = D('Terrace')->find($_POST['id']);
        $userId = D('User')->getList("id");
        foreach ($userId as $k => $v) {//记录平台消息发送用户记录
            $user = [
                'title' => $data['title'],
                'desc' => $data['desc'],
                'content' => $data['content'],
                'token' => $data['token'],
                'create_time' => time(),
                'user_id' => $v['id'],
                'system_message' => 2
            ];
            D('UserMessage')->insert($user);
        }
        //记录每次平台发送消息
        $arr = [
            'token' => $data['token'],
            'create_time' => time(),
            'type' => 2,
            'type_id' => $data['id'],
            'status' => 2,
            'system_message'=>2
        ];
        $re = D('MessageRecord')->insert($arr);
        if ($re) {
            $this->ajaxReturn(array('status' => 1, 'message' => '发送成功'));
        } else {
            $arr = [
                'token' => $data['token'],
                'create_time' => time(),
                'type' => 2,
                'type_id' => $data['id'],
                'status' => 1,
                'system_message'=>2
            ];
            D('MessageRecord')->insert($arr);
            $this->ajaxReturn(array('status' => 0, 'message' => '发送失败'));
        }
    }

}