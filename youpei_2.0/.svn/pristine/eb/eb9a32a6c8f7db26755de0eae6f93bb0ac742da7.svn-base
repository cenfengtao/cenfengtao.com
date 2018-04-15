<?php
/**
 *审核管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class CheckController extends CommonController
{
    public function artList()
    {
        $list = M('article')->where(array('status' => 1))->field('content', true)->select();
        foreach ($list as $k => $v) {
            $list[$k]['org_name'] = D('Organization')->getOrgnameByToken($v['token']);
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function checkArticle()
    {
        if (!$_GET['id']) {
            $this->error('ID参数错误');
        }
        $article = D('Article')->find($_GET['id']);
        $cateList = D('ArticleCate')->getList();
        $this->assign('article', $article)->assign('cateList', $cateList);
        $this->display();
    }

    public function submitCheckForArticle()
    {
        if (!$_POST['status']) {
            return show(0, '审核参数错误');
        }
        if (!$_POST['artId']) {
            return show(0, '文章ID参数错误');
        }
        try {
            $updateData = [
                'status' => $_POST['status'],
                'err_msg' => $_POST['errMsg']
            ];
            $id = D('Article')->updateById($_POST['artId'], $updateData);
            if ($id) {
                _getDiscoverInfo();
                _getIndexInfo();
                return show(1, '审核设置成功');
            } else {
                return show(0, '审核设置失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function proUpList()
    {
        $list = M('product')->where(array('check_status' => 1))->select();
        foreach ($list as $k => $v) {
            $list[$k]['org_name'] = D('Organization')->getOrgnameByToken($v['token']);
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function checkProduct()
    {
        if (!$_GET['id']) {
            return show(0, '参数错误');
        }
        $product = D('Product')->find($_GET['id']);
        $orgName = M('organization')->where(array('token' => $product['token']))->getField('org_name');
        $classTitle = M('product_class')->where("id={$product['class_id']}")->getField('title');
        $bookTime = json_decode($product['book_time'], true);
        $classTime = json_decode($product['class_time'], true);
        $price = json_decode($product['price'], true);
        $this->assign('book_time', $bookTime)->assign('class_time', $classTime)
            ->assign('price', $price);
        $this->assign('product', $product)->assign('orgName', $orgName)->assign('classTitle', $classTitle);
        $this->display();
    }

    public function checkRealProduct()
    {
        if (!$_GET['id']) {
            return show(0, '参数错误');
        }
        $product = D('Product')->find($_GET['id']);
        $orgName = M('organization')->where(array('token' => $product['token']))->getField('org_name');
        $classTitle = M('product_class')->where("id={$product['class_id']}")->getField('title');
        $price = json_decode($product['price'], true);
        $this->assign('product', $product)->assign('orgName', $orgName)->assign('classTitle', $classTitle)->assign('price', $price);
        $this->display();
    }

    public function submitCheckForProduct()
    {
        if (!$_POST['status']) {
            return show(0, '审核参数错误');
        }
        if (!$_POST['proId']) {
            return show(0, '商品ID参数错误');
        }
        try {
            $updateData = [
                'check_status' => $_POST['status'],
                'err_msg' => $_POST['errMsg']
            ];
            $id = D('Product')->updateById($_POST['proId'], $updateData);
            if ($id) {
                _getDiscoverInfo();
                _getIndexInfo();
                return show(1, '审核设置成功');
            } else {
                return show(0, '审核设置失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function regainCheckProduct()
    {
        if (!$_POST['id']) {
            return show(0, '参数错误');
        }
        try {
            $id = D('Product')->updateById($_POST['id'], array('check_status' => 1, 'err_msg' => ''));
            if ($id) {
                return show(1, '成功发起审核');
            } else {
                return show(0, '发起审核失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    //机构活动
    public function parUpList()
    {
        $list = M('Parenting')->where(array('check_status' => 1))->select();
        foreach ($list as $k => $v) {
            $list[$k]['org_name'] = D('Organization')->getOrgnameByToken($v['token']);
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function checkParenting()
    {
        if (!$_GET['id']) {
            return show(0, '参数错误');
        }
        $parenting = D('Parenting')->find($_GET['id']);
        $parenting['org_name'] = M('organization')->where(array('id' => $parenting['org_id']))->getField('org_name');
        $parenting['cate_title'] = M('parentingCate')->where(array('id' => $parenting['cate_id']))->getField('cate_title');
        $this->assign('parenting', $parenting);
        $this->display();
    }

    public function submitCheckForParenting()
    {
        if (!$_POST['check_status']) {
            return show(0, '审核参数错误');
        }
        if (!$_POST['parId']) {
            return show(0, '商品ID参数错误');
        }
        try {
            $updateData = [
                'check_status' => $_POST['check_status'],
                'err_msg' => $_POST['errMsg']
            ];
            $id = D('Parenting')->updateById($_POST['parId'], $updateData);
            if ($id) {
                return show(1, '审核设置成功');
            } else {
                return show(0, '审核设置失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function regainCheckParenting()
    {
        if (!$_POST['id']) {
            return show(0, '参数错误');
        }
        try {
            $id = D('Parenting')->updateById($_POST['id'], array('check_status' => 1, 'err_msg' => ''));
            if ($id) {
                return show(1, '成功发起审核');
            } else {
                return show(0, '发起审核失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function groupList()
    {
        $list = M('group_product')->where(array('check_status' => 1))->field('description,cost', true)->select();
        foreach ($list as $k => $v) {
            $list[$k]['org_name'] = D('Organization')->getOrgnameByToken($v['token']);
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function checkGroup()
    {
        if (!$_GET['id']) {
            return show(0, '参数错误');
        }
        $product = D('GroupProduct')->find($_GET['id']);
        $classTime = json_decode($product['class_time'], true);
        $classList = D('ProductClass')->getList();
        $this->assign('product', $product)->assign('class_time', $classTime)
            ->assign('class_time_count', count($classTime))->assign('class_list', $classList);
        $this->display();
    }

    public function submitCheckForGroup()
    {
        if (!$_POST['status']) {
            return show(0, '审核参数错误');
        }
        if (!$_POST['proId']) {
            return show(0, '商品ID参数错误');
        }
        try {
            $updateData = [
                'check_status' => $_POST['status'],
                'err_msg' => $_POST['errMsg']
            ];
            $id = D('GroupProduct')->updateById($_POST['proId'], $updateData);
            if ($id) {
                _getDiscoverInfo();
                _getIndexInfo();
                return show(1, '审核设置成功');
            } else {
                return show(0, '审核设置失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function regainCheckGroup()
    {
        if (!$_POST['id']) {
            return show(0, '参数错误');
        }
        try {
            $id = D('GroupProduct')->updateById($_POST['id'], array('check_status' => 1, 'err_msg' => ''));
            if ($id) {
                return show(1, '成功发起审核');
            } else {
                return show(0, '发起审核失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function activityList()
    {
        $list = M('organization_activity')->where(array('check_status' => 1))->field('description,cost', true)->select();
        foreach ($list as $k => $v) {
            $list[$k]['org_name'] = D('Organization')->getOrgnameByToken($v['token']);
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function checkActivity()
    {
        if (!$_GET['id'] || !is_numeric($_GET['id'])) {
            return show(0, 'ID参数不能为空');
        }
        $activity = D('OrganizationActivity')->find($_GET['id']);
        $orgName = D('Organization')->getOrgnameByToken($activity['token']);
        $this->assign('activity', $activity)->assign('orgName', $orgName);
        $this->display();
    }

    public function submitCheckForActivity()
    {
        if (!$_POST['status']) {
            return show(0, '审核参数错误');
        }
        if (!$_POST['activityId']) {
            return show(0, '活动ID参数错误');
        }
        try {
            $updateData = [
                'check_status' => $_POST['status'],
                'err_msg' => $_POST['errMsg']
            ];
            $id = D('OrganizationActivity')->updateById($_POST['activityId'], $updateData);
            if ($id) {
                return show(1, '审核设置成功');
            } else {
                return show(0, '审核设置失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function regainCheckActivity()
    {
        if (!$_POST['id']) {
            return show(0, '参数错误');
        }
        try {
            $id = D('OrganizationActivity')->updateById($_POST['id'], array('check_status' => 1, 'err_msg' => ''));
            if ($id) {
                return show(1, '成功发起审核');
            } else {
                return show(0, '发起审核失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    //投票
    public function voteList()
    {
        $list = D('Vote')->getList(['check_status' => 1]);
        foreach ($list as $k => $v) {
            $list[$k]['org_name'] = M('organization')->where(['id' => $v['type_id']])->getField('org_name');
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function checkVote()
    {
        if (!$_GET['id'] || !is_numeric($_GET['id'])) {
            return show(0, 'ID参数不能为空');
        }
        $vote = D('Vote')->find($_GET['id']);
        $this->assign('vote', $vote);
        $this->display();
    }
    
    public function submitCheckForVote()
    {
        if (!$_POST['status']) {
            return show(0, '审核参数错误');
        }
        if (!$_POST['voteId']) {
            return show(0, '投票ID参数错误');
        }
        try {
            $updateData = [
                'check_status' => $_POST['status'],
                'err_msg' => $_POST['errMsg']
            ];
            $id = D('Vote')->updateById($_POST['voteId'], $updateData);
            if ($id) {
                return show(1, '审核设置成功');
            } else {
                return show(0, '审核设置失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function regainCheckVote()
    {
        if (!$_POST['id']) {
            return show(0, '参数错误');
        }
        try {
            $id = D('Vote')->updateById($_POST['id'], array('check_status' => 1, 'err_msg' => ''));
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