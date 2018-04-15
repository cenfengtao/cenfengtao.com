<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class ProductClassController extends CommonController
{
    public function index()
    {
        $list = D('ProductClass')->getList();
        foreach ($list as $key => $val) {
            if(!empty($val['article_id'])){
                $list[$key]['article_title'] = M('article')->where(['id' => $val['article_id']])->getField('title');
            } else {
                $list[$key]['article_title'] = '';
            }
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function addProductClass()
    {
        if ($_POST) {
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '标题不能为空');
            }
            if ($_POST['id'] && !empty($_POST['id'])) {
                return $this->save($_POST);
            }
            try {
                $id = D('ProductClass')->insert($_POST);
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

    public function editProductClass()
    {
        if (!$_GET['id'] || !is_numeric($_GET['id'])) {
            $this->error('ID参数错误');
        }
        $class = D('ProductClass')->find($_GET['id']);
        $this->assign('class', $class);
        $this->display();
    }

    public function save($data)
    {
        try {
            $id = D('ProductClass')->updateById($data['id'], $data);
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
            $result = D('ProductClass')->delete($_POST['id']);
            if ($result) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function setClassArticle()
    {
        if ($_POST) {
            if (!$_POST['artId'] || !$_POST['classId']) {
                return show(0, '参数错误');
            }
            try {
                $id = D('ProductClass')->updateById($_POST['classId'], ['article_id' => $_POST['artId']]);
                if ($id === false) {
                    return show(0, '设置失败');
                } else {
                    _getIndexInfo();
                    return show(1, '设置成功');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            $list = M('article')->field('title,id')->select();
            $this->assign('list', $list);
            $this->display();
        }
    }
}