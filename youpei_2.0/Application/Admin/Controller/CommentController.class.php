<?php
/**
 *文章评论管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class CommentController extends CommonController
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
            $commentList = D('Comment')->getListForAdmin(array('type_id' => 0, 'father_id' => 0), $page, $pageSize);
            $count = D('Comment')->getCount(array('type_id' => 0, 'father_id' => 0));
        } else {
            $commentList = D('Comment')->getListForAdmin(array('token' => $this->token,'type_id' => 0, 'father_id' => 0), $page, $pageSize);
            $count = D('Comment')->getCount(array('token' => $this->token,'type_id' => 0, 'father_id' => 0));
        }
        $res = new Page($count, $pageSize);
        $page = $res->show();
        $list = [];
        foreach ($commentList as $key => $val) {
            $id = D('Article')->getArticleById($val['article_id']);
            if ($id) {
                $list[$key]['username'] = D('User')->getNameById($val['user_id']);
                $list[$key]['id'] = $val['id'];
                $list[$key]['content'] = $val['content'];
                $list[$key]['create_time'] = $val['create_time'];
                $list[$key]['article_title'] = M('article')->where("id={$val['article_id']}")->getField('title');
                $list[$key]['article_title'] = mb_substr($list[$key]['article_title'], 0, 15) . '...';
                $list[$key]['status'] = $val['status'];
            }
        }
        $this->assign('commentList', $list)->assign('page', $page);
        $this->display();
    }

    public function hide()
    {
        if (!$_POST['id'] || !is_numeric($_POST['id'])) {
            return show(0, 'ID参数错误');
        }
        try {
            $id = D('Comment')->updateById($_POST['id'], array('status' => 2));
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
            $id = D('Comment')->updateById($_POST['id'], array('status' => 1));
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
            $result = D('Comment')->delete($_POST['id']);
            $results = M('Comment')->where("type_id={$_POST['id']}")->delete();
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
            $comment = M('Comment')->where("id={$_POST['id']}")->find();
            $data = [
                'content' => $_POST['content'],
                'father_id' => $_POST['father_id'],
                'type_id' => $_POST['id'],
                'token' => $this->token,
                'article_id' => $comment['article_id'],
                'is_gm' => 2,
                'user_id' => $this->user['id'],
                'create_time' => time(),
                'status' => 1
            ];
            try {
                $id = D('Comment')->insert($data);
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
            $first = M('Comment')->where("id={$_GET['id']}")->find();
            $first['headImg'] = M('User')->where("id={$first['user_id']}")->getField('headimgurl');
            //子评论
            $child = M('Comment')->where(array('type_id' => $first['id']))->select();
            foreach ($child as $k => $v) {
                //回复
                if ($v['is_gm'] == 1) {
                    $child[$k]['headImg'] = M('User')->where("id={$v['user_id']}")->getField('headimgurl');
                } elseif ($v['is_gm'] == 2) {
                    //待机构管理员完善之后需修改
                    //客服头像
                    $picture = M('organization')->field('picture')->where(array('token' => $this->token))->find();
                    $child[$k]['headImg'] = $picture['picture'];
                }
                //被回复
                $userId = M('Comment')->where(array('id' => $v['father_id']))->find();
                if ($userId['is_gm'] == 1) {
                    $child[$k]['headImgs'] = M('User')->where("id={$userId['id']}")->getField('headimgurl');
                } elseif ($userId['is_gm'] == 2) {
                    //待机构管理员完善之后需修改
                    //客服头像
                    $picture = M('organization')->field('picture')->where(array('token' => $userId['token']))->find();
                    $child[$k]['headImgs'] = $picture['picture'];
                }
            }
            $this->assign('id', $_GET['id'])->assign('first', $first)->assign('comment', $child);
            $this->display();
        }
    }
}