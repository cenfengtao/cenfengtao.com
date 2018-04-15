<?php
/**
 *文章分类管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class ArticleCateController extends CommonController
{
    public function cateList()
    {
        $list = D('ArticleCate')->getList();
        $this->assign('cateList', $list);
        $this->display();
    }

    public function getCate()
    {
        if (!$_POST['id'] || !is_numeric($_POST['id'])) {
            return show(0, 'id参数错误');
        }
        try {
            $cate = D('ArticleCate')->find($_POST['id']);
            if ($cate) {
                return show(1, '获取成功', $cate);
            } else {
                return show(0, '找不到该数据');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function addCate()
    {
        if ($_POST) {
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '分类名称不能为空');
            }
            $data = $_POST;
            if ($data['id'] || !empty($data['id'])) {
                if (!$data['image'] || empty($data['image'])) {
                    unset($data['image']);
                }
                return $this->save($data);
            }
            try {
                $data['token'] = $this->token;
                $id = D('ArticleCate')->insert($data);
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

    public function editCate()
    {
        if (!$_GET['id'] || !is_numeric($_GET['id'])) {
            $this->error("ID参数错误");
        }
        try {
            $cate = D('ArticleCate')->find($_GET['id']);
            if (!$cate || empty($cate)) {
                $this->error('该分类不存在');
            }
            $this->assign('cate', $cate);
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
            $result = D('ArticleCate')->delete($_POST['id']);
            if ($result) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function save($data)
    {
        try {
            $id = D('ArticleCate')->updateById($data['id'], $data);
            if ($id === false) {
                return show(0, '修改失败');
            }
            return show(1, '修改成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
}