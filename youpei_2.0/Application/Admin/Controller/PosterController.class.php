<?php
/**
 * 广告位管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class PosterController extends CommonController
{
    public function index()
    {
        //首页
        $indexList = M('poster')->where(['location' => 1])->order('sort asc')->select();
        //发现页
        $discoverList = M('poster')->where(['location' => 2])->order('sort asc')->select();
        //投票页
        $voteList = M('poster')->where(['location' => 3])->order('sort asc')->select();
        //单页
        $page = M('poster')->where(['location' => 4])->order('sort asc')->select();
        foreach ($indexList as $k => $v) {
            if ($v['type'] == 1) {
                $article = M('article')->where(['id' => $v['type_id']])->field('title,image')->find();
                $indexList[$k]['title'] = $article['title'];
                $indexList[$k]['image'] = $article['image'];
            } else if ($v['type'] == 2) {
                $product = M('product')->where(['id' => $v['type_id']])->field('title,pic_url')->find();
                $indexList[$k]['title'] = $product['title'];
                $indexList[$k]['image'] = $product['pic_url'];
            } else {
                $indexList[$k]['title'] = $v['type_id'];
            }
        }
        foreach ($discoverList as $k => $v) {
            if ($v['type'] == 1) {
                $article = M('article')->where(['id' => $v['type_id']])->field('title,image')->find();
                $discoverList[$k]['title'] = $article['title'];
                $discoverList[$k]['image'] = $article['image'];
            } else if ($v['type'] == 2) {
                $product = M('product')->where(['id' => $v['type_id']])->field('title,pic_url')->find();
                $discoverList[$k]['title'] = $product['title'];
                $discoverList[$k]['image'] = $product['pic_url'];
            } else {
                $discoverList[$k]['title'] = $v['type_id'];
            }
        }
        foreach ($voteList as $k => $v) {
            if ($v['type'] == 1) {
                $article = M('article')->where(['id' => $v['type_id']])->field('title,image')->find();
                $voteList[$k]['title'] = $article['title'];
                $voteList[$k]['image'] = $article['image'];
            } else if ($v['type'] == 2) {
                $product = M('product')->where(['id' => $v['type_id']])->field('title,pic_url')->find();
                $voteList[$k]['title'] = $product['title'];
                $voteList[$k]['image'] = $product['pic_url'];
            } else {
                $voteList[$k]['title'] = $v['type_id'];
            }
        }
        foreach ($page as $k => $v) {
            if ($v['type'] == 1) {
                $article = M('article')->where(['id' => $v['type_id']])->field('title,image')->find();
                $page[$k]['title'] = $article['title'];
                $page[$k]['image'] = $article['image'];
            } else if ($v['type'] == 2) {
                $product = M('product')->where(['id' => $v['type_id']])->field('title,pic_url')->find();
                $page[$k]['title'] = $product['title'];
                $page[$k]['image'] = $product['pic_url'];
            } else {
                $page[$k]['title'] = $v['type_id'];
            }
        }
        $this->assign('indexList', $indexList)->assign('discoverList', $discoverList)->assign('voteList', $voteList)
            ->assign('page', $page);
        $this->display();
    }

    public function addPoster()
    {
        if ($_POST) {
            if (!$_POST['location']) {
                return show(0, '位置参数错误');
            }
            if (!$_POST['type'] || !is_numeric($_POST['type'])) {
                return show(0, '类型不能为空');
            }
            if (($_POST['type'] == 1 && !$_POST['art_id']) || ($_POST['type'] == 2 && !$_POST['pro_id']) || ($_POST['type'] == 3 && empty($_POST['url']))) {
                return show(0, '请填写内容');
            }
            if($_POST['location'] == 4){
                $isHave = M('poster')->where(['location' => 4])->find();
                if ($isHave) {
                    return show(0, '你已经添加过了，请返回列表查看');
                }
            }
            $insertData = [
                'location' => $_POST['location'],
                'type' => $_POST['type'],
                'type_id' => $_POST['type'] == 1 ? $_POST['art_id'] : ($_POST['type'] == 2 ? $_POST['pro_id'] : $_POST['url']),
                'image' => $_POST['image'] ?: '',
                'sort' => $_POST['sort'] ?: 0,
            ];
            $id = D('Poster')->insert($insertData);
            if ($id) {
                return show(1, '添加成功');
            } else {
                return show(0, '添加失败');
            }
        } else {
            $articleList = D('Article')->getArticleByToken($this->token, 'id,title');
            $productList = M('Product')->where(array('status' => 1, 'token' => $this->token))->field('title,id')->select();
            $isHave = M('poster')->where(['location' => 4])->find();
            if ($isHave) {
                $onePage = 1;
            } else {
                $onePage = 2;
            }
            $this->assign('articleList', $articleList)->assign('productList', $productList)->assign('onePage', $onePage);
            $this->display();
        }
    }

    public function editPoster()
    {
        if ($_POST) {
            if (!$_POST['id']) {
                return show(0, '参数错误');
            }
            if (!$_POST['location']) {
                return show(0, '位置参数错误');
            }
            if (!$_POST['type'] || !is_numeric($_POST['type'])) {
                return show(0, '类型不能为空');
            }
            if (($_POST['type'] == 1 && !$_POST['art_id']) || ($_POST['type'] == 2 && !$_POST['pro_id']) || ($_POST['type'] == 3 && empty($_POST['url']))) {
                return show(0, '类型ID不能为空');
            }
            $updateData = [
                'location' => $_POST['location'],
                'type' => $_POST['type'],
                'type_id' => $_POST['type'] == 1 ? $_POST['art_id'] : ($_POST['type'] == 2 ? $_POST['pro_id'] : $_POST['url']),
                'sort' => $_POST['sort'] ?: 0,
            ];
            if (!empty($_POST['image'])) {
                $updateData['image'] = $_POST['image'];
            }
            $id = D('Poster')->updateById($_POST['id'], $updateData);
            if ($id === false) {
                return show(0, '修改失败');
            } else {
                return show(1, '修改成功');
            }
        } else {
            if (!$_GET['id']) {
                $this->error('参数错误');
            }
            $isHave = M('poster')->where(['location' => 4])->find();
            if ($isHave) {
                $onePage = 1;
            } else {
                $onePage = 2;
            }
            $poster = D('Poster')->find($_GET['id']);
            $articleList = D('Article')->getArticleByToken($this->token, 'id,title');
            $productList = M('Product')->where(array('status' => 1, 'token' => $this->token))->field('title,id')->select();
            $this->assign('poster', $poster)->assign('articleList', $articleList)->assign('productList', $productList)
                ->assign('onePage', $onePage);
            $this->display();
        }
    }

    public function deletePoster()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('Poster')->delete($_POST['id']);
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