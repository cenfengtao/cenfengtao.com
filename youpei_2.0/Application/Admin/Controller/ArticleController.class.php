<?php
/**
 *文章管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class ArticleController extends CommonController
{
    public function artList()
    {
        /*
         * 分页操作逻辑
         * */
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
        try {
            if ($this->isSuper) {
                $list = D('Article')->getListForAdmin(array(), $page, $pageSize,
                    'title,id,create_time,image,cate_id,read_count,sort,token,status,err_msg');
                $count = D('Article')->getCount();
            } else {
                $list = D('Article')->getListForAdmin(array('token' => $this->token), $page, $pageSize,
                    'title,id,create_time,image,cate_id,read_count,sort,token,status,err_msg');
                $count = D('Article')->getCount(array('token' => $this->token));
            }
            foreach ($list as $key => $val) {
                $list[$key]['org_name'] = D('Organization')->getOrgnameByToken($val['token']);
            }
            $res = new Page($count, $pageSize);
            $page = $res->show();
            $this->assign('artList', $list)->assign('page', $page);
            $this->display();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    //精选育儿
    public function rearHotList()
    {
        $cate = M('Article_cate')->where("title='育儿'")->getField('id');
        $list = D('Article')->getHotList(array('is_hot' => 2, 'cate_id' => $cate));
        foreach ($list as $k => $v) {
            $list[$k]['org_name'] = D('Organization')->getOrgnameByToken($v['token']);
        }
        $this->assign('artList', $list);
        $this->display();
    }

    //精选福利
    public function boonHotList()
    {
        $cate = M('Article_cate')->where("title='福利'")->getField('id');
        $list = D('Article')->getHotList(array('is_hot' => 2, 'cate_id' => $cate));
        foreach ($list as $key => $val) {
            $list[$key]['org_name'] = D('Organization')->getOrgnameByToken($val['token']);
        }
        $this->assign('artList', $list);
        $this->display();
    }

    //活动文章
    public function activityList()
    {
        $list = M('Article')->where(array('is_hot' => 1,'is_activity'=>2,'token'=>$this->token))->select();
        foreach ($list as $key => $val) {
            $list[$key]['org_name'] = D('Organization')->getOrgnameByToken($val['token']);
        }
        $this->assign('list', $list);
        $this->display();
    }

    //添加活动文章
    public function addActivityArticle()
    {
        if ($_POST) {
            if (!$_POST['id'] || empty($_POST['id'])) {
                return show(0, 'ID不能为空');
            }
            $id = D('Article')->updateById($_POST['id'], array('is_activity' => 2));
            if($id){
                return show(1,'添加成功');
            }else{
                return show(0,'添加失败');
            }

        } else {
            $where = array('token' => $this->token, 'is_hot' => 1, 'show_liability' => 1,'is_activity'=>1);
            $cateList = D('Article')->getRearArticleByToken($where);
            $this->assign('cateList', $cateList);
            $this->display();
        }
    }

    //取消活动文章
    public function cancelActivity()
    {
        if (!$_POST['id'] || !is_numeric($_POST['id'])) {
            return show(0, 'ID参数错误');
        }
        $id = D('Article')->updateById($_POST['id'], array('is_activity' => 1));
        if ($id) {
            return show(1, '取消成功');
        } else {
            return show(0, '取消失败');
        }
    }

    public function addArticle()
    {
        if ($_POST) {
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '标题不能为空');
            }
            if (!$_POST['cate_id'] || !is_numeric($_POST['cate_id'])) {
                return show(0, '分类不能为空');
            }
            if (!$_POST['read_count'] || !is_numeric($_POST['read_count'])) {
                $_POST['read_count'] = 0;
            }
            if (!$_POST['finger'] || !is_numeric($_POST['finger'])) {
                $_POST['finger'] = 0;
            }
            if (!$_POST['image'] || empty($_POST['image'])) {
                unset($_POST['image']);
            }
            $insertData = $_POST;
            $insertData['token'] = $this->token;
            if ($insertData['id'] && !empty($insertData['id'])) {
                $insertData['modify_time'] = time();
                return $this->save($insertData);
            }
            try {
                $insertData['create_time'] = time();
                $id = D('Article')->insert($insertData);
                if ($id) {
                    return show(1, '添加成功，请等待审核');
                } else {
                    return show(0, '添加失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            $cateList = D('ArticleCate')->getList();
            $this->assign('cateList', $cateList);
            $this->display();
        }
    }

    public function editArticle()
    {
        if (!$_GET['id'] || !is_numeric($_GET['id'])) {
            $this->error('ID参数错误');
        }
        try {
            $article = D('article')->find($_GET['id']);
            $cateList = D('ArticleCate')->getList();
            $this->assign('article', $article)->assign('cateList', $cateList);
            $this->display();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function save($data)
    {
        $data['status'] = 1;
        try {
            $id = D('Article')->updateById($data['id'], $data);
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
            $result = D('Article')->delete($_POST['id']);
            if ($result) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    //添加育儿文章
    public function addRearArticle()
    {
        if ($_POST) {
            if (!$_POST['id'] || empty($_POST['id'])) {
                return show(0, '精选文章不能为空');
            }
            //判断有否精选课程数
            $count = M('Article')->where(array('is_hot' => 2, 'cate_id' => 1))->count();
            if ($count >= 3) {
                return show(0, '精选文章不能超过3篇');
            }
            $updateData = [
                'id' => $_POST['id'],
                'is_hot' => 2
            ];
            $this->save($updateData);

        } else {
            $where = array('token' => $this->token, 'cate_id' => 1, 'is_hot' => 1, 'show_liability' => 1);
            $cateList = D('Article')->getRearArticleByToken($where);
            $this->assign('cateList', $cateList);
            $this->display();
        }
    }

    public function editRearArticle()
    {
        if (!$_GET['id'] || !is_numeric($_GET['id'])) {
            $this->error('ID参数错误');
        }
        try {
            $article = D('Article')->find($_GET['id']);
            $this->assign('article', $article);
            $this->display();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    //添加福利文章
    public function addBoonArticle()
    {
        if ($_POST) {
            if (!$_POST['id'] || empty($_POST['id'])) {
                return show(0, '精选文章不能为空');
            }
            //判断有否精选课程数
            $count = M('Article')->where(array('is_hot' => 2, 'cate_id' => 9))->count();
            if ($count >= 3) {
                return show(0, '精选文章不能超过3篇');
            }
            $updateData = [
                'id' => $_POST['id'],
                'is_hot' => 2
            ];
            $this->save($updateData);
        } else {
            $where = array('token' => $this->token, 'cate_id' => 9, 'is_hot' => 1, 'show_liability' => 1);
            $cateList = D('Article')->getRearArticleByToken($where);
            $this->assign('cateList', $cateList);
            $this->display();
        }
    }

    public function editBoonArticle()
    {
        if (!$_GET['id'] || !is_numeric($_GET['id'])) {
            $this->error('ID参数错误');
        }
        try {
            $article = D('Article')->find($_GET['id']);
            $this->assign('article', $article);
            $this->display();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    //取消精选
    public function cancelHot()
    {
        if (!$_POST['id'] || !is_numeric($_POST['id'])) {
            return show(0, 'ID参数错误');
        }
        $id = D('Article')->updateById($_POST['id'], array('is_hot' => 1));
        if ($id) {
            return show(1, '取消成功');
        } else {
            return show(0, '取消失败');
        }
    }


    //搜索分页
    public function search()
    {
        if (!$_GET['title'] || empty($_GET['title'])) {
            $pageList = '';
            $page = '';
            $this->assign('upList', $pageList)->assign('page', $page);
        }
        try{
            if ($this->isSuper) {
                $list = M('Article')->field('title,id,create_time,image,cate_id,read_count,sort,token,status')->order('create_time desc')->select();
            } else {
                $list = M('Article')->where(array('token'=>$this->token))->field('title,id,create_time,image,cate_id,read_count,sort,token,status')->order('create_time desc')->select();
            }
            foreach ($list as $k => $v) {
                $list[$k]['org_name'] = D('Organization')->getOrgnameByToken($v['token']);
                $list[$k]['new_title'] = M('Article')->where(array('id'=>$v['id'],'title'=>array('like','%'.$_GET['title'].'%')))->getField('title');
                if (!$list[$k]['new_title'] || empty($list[$k]['new_title'])) {
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
            $this->assign('artList', $pageList)->assign('page', $page);
            $this->display();
        }catch(Exception $e){
            return show(0,$e->getMessage());
        }
    }

    //重新审核
    public function regainCheck()
    {
        if (!$_POST['id']) {
            return show(0, '参数错误');
        }
        try {
            $id = D('Article')->updateById($_POST['id'], array('status' => 1, 'err_msg' => ''));
            if ($id) {
                return show(1, '成功发起审核');
            } else {
                return show(0, '发起审核失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

}