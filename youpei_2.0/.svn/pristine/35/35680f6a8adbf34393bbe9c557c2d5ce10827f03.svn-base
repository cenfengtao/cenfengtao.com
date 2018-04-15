<?php
/**
 *商品评论管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class ProductCommentController extends CommonController
{
    //评论列表
    public function commentList()
    {
        /*
         * 分页操作逻辑
         * */
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
        if ($this->isSuper) {
            $commentList = D('ProductComment')->getListForPro(array('type_id' => 0, 'father_id' => 0), $page, $pageSize);
            $count = D('ProductComment')->getCount(array('type_id' => 0, 'father_id' => 0));
        } else {
            $commentList = D('ProductComment')->getListForPro(array('token' => $this->token, 'type_id' => 0, 'father_id' => 0), $page, $pageSize);
            $count = D('ProductComment')->getCount(array('token' => $this->token, 'type_id' => 0, 'father_id' => 0));
        }
        $res = new Page($count, $pageSize);
        $page = $res->show();
        foreach ($commentList as $key => $val) {
            $commentList[$key]['username'] = D('User')->getNameById($val['user_id']);
            if ($val['product_id'] != 0 && $val['product_id'] != null) {
                $commentList[$key]['product_title'] = M('product')->where("id={$val['product_id']}")->getField('title');
            } else if ($val['parenting_id'] != 0 && $val['parenting_id'] != null) {
                $commentList[$key]['product_title'] = M('parenting')->where("id={$val['parenting_id']}")->getField('title');
            } else if ($val['activity_id'] != 0 && $val['activity_id'] != null) {
                $commentList[$key]['product_title'] = M('organization_activity')->where("id={$val['activity_id']}")->getField('title');
            } else if ($val['group_id'] != 0 && $val['group_id'] != null) {
                $commentList[$key]['product_title'] = M('group_product')->where("id={$val['group_id']}")->getField('title');
            }
            $commentList[$key]['product_title'] = mb_substr($commentList[$key]['product_title'], 0, 15) . '...';
        }
        $this->assign('commentList', $commentList)->assign('page', $page);
        $this->display();
    }

    public function hide()
    {
        if (!$_POST['id'] || !is_numeric($_POST['id'])) {
            return show(0, 'ID参数错误');
        }
        try {
            $id = D('ProductComment')->updateById($_POST['id'], array('status' => 2));
            if ($id) {
                return show(1, '修改成功');
            } else {
                return show(0, '修改失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function show()
    {
        if (!$_POST['id'] || !is_numeric($_POST['id'])) {
            return show(0, 'ID参数错误');
        }
        try {
            $id = D('ProductComment')->updateById($_POST['id'], array('status' => 1));
            if ($id) {
                return show(1, '修改成功');
            } else {
                return show(0, '修改失败');
            }
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
            $result = D('ProductComment')->delete($_POST['id']);
            $results = M('ProductComment')->where("type_id={$_POST['id']}")->delete();
            if ($result || $results) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function addReply()
    {
        if ($_POST) {
            if (!$_POST['content'] || empty($_POST['content'])) {
                return show(0, '回复内容不能为空');
            }
            if (!$_POST['id'] || empty($_POST['id'])) {
                return show(0, 'ID不能为空');
            }
            if (!$_POST['father_id'] || empty($_POST['father_id'])) {
                return show(0, 'FATHER_ID不能为空');
            }
            $comment = M('ProductComment')->where("id={$_POST['id']}")->find();
            $data = [
                'content' => $_POST['content'],
                'father_id' => $_POST['father_id'],
                'type' => $comment['type'],
                'type_id' => $_POST['id'],
                'token' => $this->token,
                'product_id' => $comment['product_id'],
                'parenting_id' => $comment['parenting_id'],
                'activity_id' => $comment['activity_id'],
                'is_gm' => 2,
                'user_id' => $this->user['id'],
                'create_time' => time(),
                'group_id' => $comment['group_id'],
                'status' => 1
            ];
            try {
                $id = D('ProductComment')->insert($data);
                if ($id) {
                    return show(1, '添加成功');
                } else {
                    return show(0, '添加失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            if (!$_GET['id'] || !is_numeric($_GET['id'])) {
                return show(0, 'ID参数错误');
            }
            //第一条
            $first = M('ProductComment')->where("id={$_GET['id']}")->find();
            $first['headImg'] = M('user')->where("id={$first['user_id']}")->getField('headimgurl');
            //子评论
            $child = M('ProductComment')->where(array('type_id' => $first['id']))->select();
            foreach ($child as $k => $v) {
                //回复
                if ($v['is_gm'] == 1) {
                    $child[$k]['headImg'] = M('user')->where("id={$v['user_id']}")->getField('headimgurl');
                } elseif ($v['is_gm'] == 2) {
                    //待机构管理员完善之后需修改
                    //客服头像
                    $picture = M('organization')->field('picture')->where(array('token' => $this->token))->find();
                    $child[$k]['headImg'] = $picture['picture'];
                }
                //被回复
                $userId = M('ProductComment')->where(array('id' => $v['father_id']))->find();
                if ($userId['is_gm'] == 1) {
                    $child[$k]['headImgs'] = M('user')->where("id={$userId['user_id']}")->getField('headimgurl');
                } elseif ($userId['is_gm'] == 2) {
                    //待机构管理员完善之后需修改
                    //客服头像
                    $picture = M('organization')->field('picture')->where(array('token' => $userId['token']))->find();
                    $child[$k]['headImgs'] = $picture['picture'];
                }
            }
            //添加阅读记录
            if($first['is_read'] == 1){
                $data = [
                    'is_read'=>2
                ];
                D('ProductComment')->updateById($_GET['id'],$data);
            }
            $this->assign('id', $_GET['id'])->assign('first', $first)->assign('comment', $child);
            $this->display();
        }
    }
    
}