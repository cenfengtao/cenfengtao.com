<?php
/**
 *游戏管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class GamesController extends CommonController
{
    public function getList()
    {
        if ($this->isSuper) {
            $list = D('Games')->getList();
        } else {
            $list = D('Games')->getList(array('token' => $this->token));
        }
        foreach ($list as $k => $v) {
            $list[$k]['org_name'] = D('Organization')->getOrgnameByToken($v['token']);
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function getPrizeList()
    {
        if (!$_GET['games_id']) {
            return show(0, 'ID不能为空');
        }
        $list = D('GamesPrize')->getList(array('type' => 1, 'type_id' => $_GET['games_id']));
        $this->assign('list', $list)->assign('games_id', $_GET['games_id']);
        $this->display();
    }

    public function addGames()
    {
        if ($_POST) {
            if (!$_POST['title']) {
                return show(0, '名称不能为空');
            }
            try {
                $_POST['end_time'] = strtotime($_POST['end_time']) + 3600 * 24 - 1;
                $_POST['start_time'] = strtotime($_POST['start_time']);
                $_POST['check_status'] = 2;
                $_POST['token'] = $this->token;
                $id = D('Games')->insert($_POST);
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

    public function editGames()
    {
        if ($_POST) {
            if (!$_POST['title']) {
                return show(0, '名称不能为空');
            }
            if (!$_POST['id']) {
                return show(0, 'ID不能为空');
            }
            if (!$_POST['image']) {
                unset($_POST['image']);
            }
            try {
                $_POST['end_time'] = strtotime($_POST['end_time']) + 3600 * 24 - 1;
                $_POST['start_time'] = strtotime($_POST['start_time']);
                $_POST['check_status'] = 2;
                $id = $this->save($_POST);
                if ($id) {
                    return show(1, '修改成功');
                } else {
                    return show(0, '修改失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            $games = D('Games')->find($_GET['id']);
            $this->assign('games', $games);
            $this->display();
        }
    }

    public function getUserList()
    {
        if (!$_GET['games_id']) {
            return show(0, 'ID参数错误');
        }
        /*
    * 分页操作逻辑
    * */
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
        $offset = ($page - 1) * $pageSize;
        $list = M('games_record')->where(['type_id' => $_GET['games_id']])->order('create_time desc,id desc')->limit($offset, $pageSize)->select();
        $count = M('games_record')->where(['type_id' => $_GET['games_id']])->count();
        $res = new Page($count, $pageSize);
        $page = $res->show();
        foreach ($list as $k => $v) {
            $list[$k]['nickname'] = M('user')->where(['id' => $v['user_id']])->getField('username');
        }
        $this->assign('list', $list)->assign('games_id', $_GET['games_id'])->assign('page', $page);
        $this->display();
    }

    public function updateExpress()
    {
        if (!$_POST['recordId']) {
            return show(0, 'ID参数错误');
        }
        if (!$_POST['express']) {
            return show(0, '快递参数错误');
        }
        if (!$_POST['express_number']) {
            return show(0, '快递单号不能为空');
        }
        $updateData = [
            'express' => $_POST['express'],
            'express_number' => $_POST['express_number'],
            'is_exchange' => 2,
        ];
        $id = D('GamesRecord')->updateById($_POST['recordId'], $updateData);
        if ($id === false) {
            return show(0, '更新失败');
        } else {
            return show(1, '更新成功');
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
            $id = D('Games')->updateById($data['id'], $data);
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
            $result = D('Games')->delete($_POST['id']);
            if ($result) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    //添加奖品
    public function addPrize()
    {
        if ($_POST) {
            if (!$_POST['games_id']) {
                return show(0, '参数错误');
            }
            if (!$_POST['title']) {
                return show(0, '奖品名称不能为空');
            }
            if (!$_POST['status']) {
                return show(0, '请选择分类');
            }
            if (!$_POST['count'] || $_POST['count'] < 0) {
                return show(0, '库存不能少于0');
            }
            if (!$_POST['probability'] || $_POST['probability'] < 0) {
                return show(0, '概率不能少于0');
            }
            if (!$_POST['amount'] || $_POST['amount'] < 0) {
                return show(0, '份额不能少于0');
            }
            $data = [
                'title' => $_POST['title'],
                'count' => $_POST['count'],
                'status' => $_POST['status'],
                'desc' => $_POST['desc'] ?: '',
                'probability' => $_POST['probability'],
                'create_time' => time(),
                'image' => $_POST['image'] ?: '',
                'type' => 1,
                'type_id' => $_POST['games_id'],
                'amount' => $_POST['amount']
            ];
            try {
                $id = D('GamesPrize')->insert($data);
                if ($id) {
                    return show(1, '添加成功');
                } else {
                    return show(0, '添加失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            if (!$_GET['games_id']) {
                return show(0, '参数错误');
            }
            $statusList = [
                ['id' => 1, 'title' => '积分'],
                ['id' => 2, 'title' => '红包'],
                ['id' => 3, 'title' => '优惠券'],
                ['id' => 4, 'title' => '实物'],
                ['id' => 5, 'title' => '线下兑换'],
            ];
            $this->assign('games_id', $_GET['games_id'])->assign('statusList', $statusList);
            $this->display();
        }
    }

    //修改奖品
    public function editPrize()
    {
        if ($_POST) {
            if (!$_POST['prize_id']) {
                return show(0, '参数错误');
            }
            if (!$_POST['title']) {
                return show(0, '奖品名称不能为空');
            }
            if (!$_POST['status']) {
                return show(0, '请选择分类');
            }
            if ($_POST['count'] < 0) {
                return show(0, '库存不能少于0');
            }
            if ($_POST['probability'] < 0) {
                return show(0, '概率不能少于0');
            }
            if ($_POST['amount'] < 0) {
                return show(0, '份额不能少于0');
            }
            $data = [
                'title' => $_POST['title'],
                'count' => $_POST['count'],
                'status' => $_POST['status'],
                'desc' => $_POST['desc'] ?: '',
                'probability' => $_POST['probability'],
                'amount' => $_POST['amount']
            ];
            if (!empty($_POST['image'])) {
                $data['image'] = $_POST['image'];
            }
            try {
                $id = D('GamesPrize')->updateById($_POST['prize_id'], $data);
                if ($id !== false) {
                    return show(1, '修改成功');
                } else {
                    return show(0, '修改失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            if (!$_GET['prize_id']) {
                return show(0, '参数错误');
            }
            $statusList = [
                ['id' => 1, 'title' => '积分'],
                ['id' => 2, 'title' => '红包'],
                ['id' => 3, 'title' => '优惠券'],
                ['id' => 4, 'title' => '实物'],
                ['id' => 5, 'title' => '线下兑换'],
            ];
            $prize = D('GamesPrize')->find($_GET['prize_id']);
            $this->assign('prize', $prize)->assign('statusList', $statusList);
            $this->display();
        }
    }

    public function deletePrize()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('GamesPrize')->delete($_POST['id']);
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