<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class UserlotteryController extends CommonController
{
    public function index()
    {
        /*
           * 分页操作逻辑
           * */
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
        $offset = ($page - 1) * $pageSize;
        if ($this->isSuper) {
            $list = M('DrawRecord')->limit($offset, $pageSize)->order('id desc')->select();
            $count = M('DrawRecord')->count();
        } else {
            $list = M('DrawRecord')->where(array('token' => $this->token))->limit($offset, $pageSize)->order('id desc')->select();
            $count = M('DrawRecord')->count();
        }
        $res = new Page($count, $pageSize);
        $page = $res->show();
        foreach ($list as $key => $value) {
            $list[$key]['username'] = D('User')->getNameById($value['userid']);
        }
        $this->assign('list', $list)->assign('page', $page);
        $this->display();
    }

    public function LotteryPrize()
    {
        $re = D('LotteryPrize')->getPrizelist($this->gettoken());
        $this->assign('re', $re);
        $this->display();
    }

    public function editinfo()
    {
        if (I('id', 0) > 0) {
            $object = D('LotteryPrize')->get();
        }
        $this->assign('activityid', I('activityid', 0));
        $this->assign('object', $object);
        $this->display();
    }

    public function edit()
    {
        $m = D('LotteryPrize');
        if (empty(I('activityid'))) {
            if (I('id', 0) > 0) {
                $re = $m->editPrize(I('id', 0), $this->gettoken());
            } else {
                $re = $m->insertPrize($this->gettoken());
            }
        }
        if (!empty(I('activityid'))) {
            if (I('activityid', 0) > 0 && I('id', 0) > 0) {
                $re = $m->editactivityPrize(I('id', 0), $this->token);
            } else {
                $re = $m->insertactivityPrize($this->token);
            }
        }
        $this->ajaxReturn($re);
    }

    public function del()
    {
        $m = D('LotteryPrize');
        $rs = $m->del();
        $this->ajaxReturn($rs);
    }

    public function rule()
    {
        $this->display();
    }

    public function editstatus()
    {
        $m = D('PrizeAddress');
        if (I('id', 0) > 0) {
            $object = $m->get(I('id', 0));
        }
        $this->assign('object', $object);
        $this->display();
    }


    public function cancel_send()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, 'id参数不能为空');
        }
        try {
            $result = D('DrawRecord')->updateById($_POST['id'], array('status' => 0, 'sending_time' => 0));
            if ($result === false) {
                return show(0, '取消失败');
            } else {
                return show(1, '取消成功');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }


    public function Temporaryactivity()
    {
        $m = D('Temporaryactivity');
        $re = $m->Temporaryactivitylist($this->gettoken());
        $this->assign('re', $re);
        $this->display();
    }

    public function editTemporaryactivity()
    {
        $m = D('Temporaryactivity');
        if (I('id', 0) > 0) {
            $object = $m->get();
        }
        $this->assign('object', $object);
        $this->display();
    }

    public function delTemporaryactivity()
    {
        $m = D('Temporaryactivity');
        $id = (int)I('id', 0);
        $rs = $m->delTemporaryactivity($id, $this->gettoken());
        $this->ajaxReturn($rs);
    }

    public function editActivename()
    {
        $m = D('Temporaryactivity');
        if (I('id', 0) > 0) {
            $rs = $m->editeditActivename($this->gettoken());
        } else {
            $rs = $m->inserteditActivename($this->gettoken());
        }

        $this->ajaxReturn($rs);
    }

    public function raffleList()
    {
        $re = D('LotteryPrize')->gettemporaryPrizelist($this->gettoken());
        $this->assign('re', $re);
        $this->assign('id', I('activityid', 0));
        $this->display();
    }

    public function sendPrize()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, 'id参数不能为空');
        }
        try {
            $result = D('DrawRecord')->updateById($_POST['id'], array('status' => 1, 'sending_time' => time()));
            if ($result === false) {
                return show(0, '发送失败');
            } else {
                return show(1, '发送成功');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function prizes_issued()
    {
        /*
           * 分页操作逻辑
           * */
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
        $offset = ($page - 1) * $pageSize;
        if ($this->isSuper) {
            $list = M('prize_address')->limit($offset, $pageSize)->order('id desc')->select();
            $count = M('prize_address')->count();
        } else {
            $list = M('prize_address')->where(array('token' => $this->token))->limit($offset, $pageSize)->order('id desc')->select();
            $count = M('prize_address')->count();
        }
        $res = new Page($count, $pageSize);
        $page = $res->show();
        foreach ($list as $key => $value) {
            $list[$key]['username'] = D('User')->getNameById($value['userid']);
            $list[$key]['title'] = M('lottery_prize')->where(array('id' => $value['prizeid']))->getField('title');
            $list[$key]['org_name'] = D('Organization')->getOrgnameByToken($value['token']);
        }
        $this->assign('list', $list)->assign('page',$page);
        $this->display();
    }

    public function addPrize()
    {
        if ($_POST) {
            if (!$_POST['type'] || empty($_POST['type'])) {
                return show(0, '类型不能为空');
            }
            if (!is_numeric($_POST['amount']) || $_POST['amount'] < 0) {
                return show(0, '数值不能少于0');
            }
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '奖品名称不能为空');
            }
            if (!is_numeric($_POST['weight']) || $_POST['weight'] < 0) {
                return show(0, '概率不能为少于0');
            }
            if (empty($_POST['pic'])) {
                unset($_POST['pic']);
            }
            if (!is_numeric($_POST['count']) || $_POST['count'] < 0) {
                return show(0, '库存不能少于0');
            }
            if ($_POST['id'] && !empty($_POST['id'])) {
                return $this->savePrize($_POST);
            }
            try {
                $insertData = $_POST;
                $insertData['token'] = $this->token;
                $insertData['istemporary'] = 0;
                $insertData['activityid'] = 0;
                $id = D('LotteryPrize')->insert($insertData);
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

    public function editPrize()
    {
        if (!$_GET['id'] || empty($_GET['id'])) {
            $this->error('ID参数错误');
        }
        $prize = D('LotteryPrize')->find($_GET['id']);
        $this->assign('prize', $prize);
        $this->display();
    }

    public function savePrize($data)
    {
        try {
            $id = D('LotteryPrize')->updateById($data['id'], $data);
            if ($id === false) {
                return show(0, '修改失败');
            }
            return show(1, '修改成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function deletePrize()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('LotteryPrize')->delete($_POST['id']);
            if ($result) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function addPrizeForActivity()
    {
        if ($_POST) {
            if (!$_POST['activity_id'] || empty($_POST['activity_id'])) {
                return show(0, '活动ID参数错误');
            }
            if (!$_POST['type'] || empty($_POST['type'])) {
                return show(0, '类型不能为空');
            }
            if (!is_numeric($_POST['amount']) || $_POST['amount'] < 0) {
                return show(0, '数值不能少于0');
            }
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '奖品名称不能为空');
            }
            if (!is_numeric($_POST['weight']) || $_POST['weight'] < 0) {
                return show(0, '概率不能为少于0');
            }
            if (empty($_POST['pic'])) {
                unset($_POST['pic']);
            }
            if (!is_numeric($_POST['count']) || $_POST['count'] < 0) {
                return show(0, '库存不能少于0');
            }
            if ($_POST['id'] && !empty($_POST['id'])) {
                return $this->savePrize($_POST);
            }
            try {
                $insertData = $_POST;
                $insertData['token'] = $this->token;
                $insertData['istemporary'] = 1;
                $insertData['activityid'] = $_POST['activity_id'];
                $id = D('LotteryPrize')->insert($insertData);
                if ($id) {
                    return show(1, '添加成功');
                } else {
                    return show(0, '添加失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            if (!$_GET['activityid'] || empty($_GET['activityid'])) {
                $this->error('ID参数错误');
            }
            $this->assign('activity_id', $_GET['activityid']);
            $this->display();
        }
    }

    public function editPrizeForActivity()
    {
        if (!$_GET['id'] || empty($_GET['id'])) {
            $this->error('ID参数错误');
        }
        $prize = D('LotteryPrize')->find($_GET['id']);
        $this->assign('prize', $prize);
        $this->display();
    }

    public function savestatus()
    {
        $re = D('PrizeAddress')->savestatus();
        $this->ajaxReturn($re);
    }

    public function test()
    {
        $list = M('user')->field('id,username')->select();
        foreach ($list as $k => $v) {
            $username = json_decode($v['username']);
            $tranName = filterEmoji($username);
            D('User')->updateById($v['id'],array('username' => $tranName));
        }
        echo 'yes';exit;
    }
}