<?php
/**
 *用户管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class UserController extends CommonController
{
    public function userList()
    {
        /*
         * 分页操作逻辑
         * */
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
        try {
            if ($this->isSuper) {
                $list = D('User')->getListForAdmin('', $page, $pageSize, 'id,username,headimgurl,mobile,integral,money,last_login_time,last_ip');
            } else {
                $list = D('User')->getListForAdmin("token={$this->token}", $page, $pageSize, 'id,username,headimgurl,mobile,integral,money,last_login_time,last_ip');
            }
            foreach ($list as $k => $v) {
                $list[$k]['child_count'] = D('User')->getChildCount($v['id']);
            }
            $count = D('User')->getCount();
            $res = new Page($count, $pageSize);
            $page = $res->show();
            $this->assign('userList', $list)->assign('page', $page);
            $this->display();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function userIntegralRecord()
    {
        if (!$_REQUEST['id'] || !is_numeric($_REQUEST['id'])) {
            $this->error('ID不能为空');
        }
        try {
            $recordList = D('IntegralRecord')->getListByUserId($_REQUEST['id']);
            $username = D('User')->getNameById($_REQUEST['id']);
            foreach ($recordList as $k => $v) {
                $recordList[$k]['username'] = $username;
            }
            $totalGetIntegral = D('IntegralRecord')->totalGetByUserId($_REQUEST['id']);
            $totalUseIntegral = D('IntegralRecord')->totalUseByUserId($_REQUEST['id']);
            $nowIntegral = D('User')->getIntegralById($_REQUEST['id']);
            $this->assign('recordList', $recordList)->assign('totalGetIntegral', $totalGetIntegral)
                ->assign('totalUseIntegral', $totalUseIntegral)->assign('nowIntegral', $nowIntegral)->assign('userId', $_REQUEST['id']);
            $this->display();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function myChildGroup()
    {
        if (!$_GET['user_id'] || !is_numeric($_GET['user_id'])) {
            $this->error('用户ID参数错误');
        }
        try {
            $childList = D('User')->getChildList($_GET['user_id']);
            $this->assign('childList', $childList);
            $this->display();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function delete()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('User')->delete($_POST['id']);
            if ($result) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    //搜索分页
    public function search()
    {
        if (!$_GET['name'] || empty($_GET['name'])) {
            $pageList = '';
            $page = '';
            $this->assign('userList', $pageList)->assign('page', $page);
        }
        try {
            if ($this->isSuper) {
                $list = M('user')->where(array('username' => array('like', '%' . $_GET['name'] . '%')))->select();
            } else {
                $list = M('user')->where(array('username' => array('like', '%' . $_GET['name'] . '%'), 'token' => $this->token))->select();
            }
            foreach ($list as $k => $v) {
                $list[$k]['child_count'] = D('User')->getChildCount($v['id']);
                $list[$k]['user_name'] = D('User')->getAllUsername($v['id'], $_GET['name']);
                if (!$list[$k]['user_name'] || empty($list[$k]['user_name'])) {
                    unset($list[$k]);
                }
            }
            /*
               * 分页操作逻辑
               * */
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
            $offset = ($page - 1) * $pageSize;
            $pageList = array_slice($list, $offset, $pageSize);
            $count = count($list);
            $res = new Page($count, $pageSize);
            $page = $res->show();
            $this->assign('userList', $pageList)->assign('page', $page);
            $this->display();
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function addUserIntegral()
    {
        if ($_POST) {
            if (!$_POST['user_id']) {
                return show(0, '用户ID不能为空');
            }
            if (!$_POST['integral']) {
                return show(0, '积分不能为空');
            }
            try {
                $userId = M('user')->where(array('id' => $_POST['user_id']))->setInc('integral', $_POST['integral']);
                if ($userId) {
                    $data = [
                        'user_id' => $_POST['user_id'],
                        'token' => $this->token,
                        'integral' => $_POST['integral'],
                        'create_time' => time(),
                        'status' => 1,
                        'type' => 2,
                        'integral_type' => 10,
                        'desc' => $_POST['desc']
                    ];
                    $integralRecordId = D('IntegralRecord')->insert($data);
                    if ($integralRecordId) {
                        return show(1, '添加成功');
                    } else {
                        return show(0, '添加积分成功，添加积分记录失败');
                    }
                } else {
                    return show(0, '添加积分失败，请返回页面刷新再重新添加');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            if (!$_GET['user_id']) {
                return show(0, '用户ID不能为空');
            }
            $username = D('User')->getNameById($_GET['user_id']);
            $this->assign('userId', $_GET['user_id'])->assign('username', $username);
            $this->display();
        }
    }

}