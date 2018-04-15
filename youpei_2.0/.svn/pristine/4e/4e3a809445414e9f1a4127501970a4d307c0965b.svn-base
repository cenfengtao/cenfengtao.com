<?php
namespace Home\Controller;

use Think\Collect;
use Think\Exception;

class CollectController extends BaseController
{
    public function index()
    {
        $this->title = '收藏';
        //所有分类
        $data = array(
            array('id' => 0, 'title' => '最近'),
            array('id' => 1, 'title' => '机构'),
            array('id' => 2, 'title' => '课程'),
            array('id' => 3, 'title' => '商品'),
            array('id' => 4, 'title' => '活动'),
            array('id' => 5, 'title' => '文章')
        );
        $id = $_GET['id'] ? $_GET['id'] : 0;
        $userId = $this->user['id'];
        $artList = array();
        if ($id == 0) {
            $list = D('Collect')->getListById($userId);
            foreach ($list as $k => $v) {
                //type 1：机构 2：课程 3：商品 4：亲子活动 5：文章 6：机构活动
                if ($v['type'] == 1) {
                    $artList[$k] = M('Organization')->field('id,org_name,picture')->where(array('id' => $v['type_id']))->find();
                    $artList[$k]['type_id'] = 1;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = M('Collect')->where(array('type' => 1, 'type_id' => $v['type_id']))->count();
                } elseif ($v['type'] == 2) {
                    $artList[$k] = D('Product')->getCollectFind($v['type_id'], 1);
                    $artList[$k]['type_id'] = 2;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = D('ProductComment')->getCountByProId($artList[$k]['id']);
                } elseif ($v['type'] == 3) {
                    $artList[$k] = D('Product')->getCollectFind($v['type_id'], 2);
                    $artList[$k]['type_id'] = 3;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = D('ProductComment')->getCountByProId($artList[$k]['id']);
                } elseif ($v['type'] == 4) {
                    $artList[$k] = M('parenting')->field('id,title,image')->where(array('id' => $v['type_id']))->find();
                    $artList[$k]['count'] = M('ProductComment')->where("parenting_id={$v['type_id']}")->count();
                    $artList[$k]['type_id'] = 4;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                } elseif ($v['type'] == 5) {
                    $artList[$k] = D('Article')->getCollectFind($v['type_id']);
                    $artList[$k]['type_id'] = 5;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = D('Comment')->getCountByArtId($artList[$k]['id']);
                } elseif ($v['type'] == 6) {
                    $artList[$k] = M('organization_activity')->field('id,title,image')->where(array('id' => $v['type_id']))->find();
                    $artList[$k]['type_id'] = 6;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = M('ProductComment')->where("activity_id={$v['type_id']}")->count();
                }
            }
        } elseif ($id == '1') {
            $list = D('Collect')->getListById($userId, 1);
            foreach ($list as $k => $v) {
                $artList[$k] = M('Organization')->field('id,org_name,picture')->where(array('id' => $v['type_id']))->find();
                $artList[$k]['type_id'] = 1;
                $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                $artList[$k]['count'] = M('Collect')->where(array('type' => 1, 'type_id' => $v['type_id']))->count();
            }
        } elseif ($id == '2') {
            $list = D('Collect')->getListById($userId, 2);
            foreach ($list as $k => $v) {
                if (D('Product')->getCollectFind($v['type_id'], 1)) {
                    $artList[$k] = D('Product')->getCollectFind($v['type_id'], 1);
                    $artList[$k]['type_id'] = 2;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = D('ProductComment')->getCountByProId($artList[$k]['id']);
                }
            }
        } elseif ($id == '3') {
            $list = D('Collect')->getListById($userId, 2);
            foreach ($list as $k => $v) {
                if (D('Product')->getCollectFind($v['type_id'], 2)) {
                    $artList[$k] = D('Product')->getCollectFind($v['type_id'], 2);
                    $artList[$k]['type_id'] = 3;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = D('ProductComment')->getCountByProId($artList[$k]['id']);
                }
            }
        } elseif ($id == '4') {
            $where['type'] = array(4, 6, 'or');
            $list = M('Collect')->order('create_time desc')->where(array('user_id' => $userId, $where))->select();
            foreach ($list as $k => $v) {
                if ($v['type'] == 4) {
                    $artList[$k] = M('parenting')->field('id,title,image')->where(array('id' => $v['type_id']))->find();
                    $artList[$k]['count'] = M('ProductComment')->where("parenting_id={$v['type_id']}")->count();
                } else {
                    $artList[$k] = M('organization_activity')->field('id,title,image')->where(array('id' => $v['type_id']))->find();
                    $artList[$k]['count'] = M('ProductComment')->where("activity_id={$v['type_id']}")->count();
                }
                $artList[$k]['type_id'] = 4;
                $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
            }
        } elseif ($id == '5') {
            $list = D('Collect')->getListById($userId, 5);
            foreach ($list as $k => $v) {
                $artList[$k] = D('Article')->getCollectFind($v['type_id']);
                $artList[$k]['type_id'] = 5;
                $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                $artList[$k]['count'] = D('Comment')->getCountByArtId($artList[$k]['id']);
            }
        }
        $this->assign('data', $data)->assign('id', $id)->assign('artList', $artList);
        $this->display();
    }

    public function loadingCollect()
    {
        $npage = (int)I('npage');
        $userId = $this->user['id'];
        $id = $_POST['cate_id'] ? $_POST['cate_id'] : 0;
        if ($id == 0) {
            $list = D('Collect')->getListByPage($userId, $npage);
            foreach ($list as $k => $v) {
                //type 1：机构 2：课程 3：商品 4：亲子活动 5：文章 6：机构活动
                if ($v['type'] == 1) {
                    $artList[$k] = M('Organization')->field('id,org_name,picture')->where(array('id' => $v['type_id']))->find();
                    $artList[$k]['type_id'] = 1;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = M('Collect')->where(array('type' => 1, 'type_id' => $v['type_id']))->count();
                } elseif ($v['type'] == 2) {
                    $artList[$k] = D('Product')->getCollectFind($v['type_id'], 1);
                    $artList[$k]['type_id'] = 2;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = D('ProductComment')->getCountByProId($artList[$k]['id']);
                } elseif ($v['type'] == 3) {
                    $artList[$k] = D('Product')->getCollectFind($v['type_id'], 2);
                    $artList[$k]['type_id'] = 3;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = D('ProductComment')->getCountByProId($artList[$k]['id']);
                } elseif ($v['type'] == 4) {
                    $artList[$k] = M('parenting')->field('id,title,image')->where(array('id' => $v['type_id']))->find();
                    $artList[$k]['count'] = M('ProductComment')->where("parenting_id={$v['type_id']}")->count();
                    $artList[$k]['type_id'] = 4;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                } elseif ($v['type'] == 5) {
                    $artList[$k] = D('Article')->getCollectFind($v['type_id']);
                    $artList[$k]['type_id'] = 5;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = D('Comment')->getCountByArtId($artList[$k]['id']);
                } elseif ($v['type'] == 6) {
                    $artList[$k] = M('organization_activity')->field('id,title,image')->where(array('id' => $v['type_id']))->find();
                    $artList[$k]['type_id'] = 6;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = M('ProductComment')->where("activity_id={$v['type_id']}")->count();
                }
            }
        } elseif ($id == 1) {
            $list = D('Collect')->getListById($userId, 1);
            foreach ($list as $k => $v) {
                $artList[$k] = M('Organization')->field('id,org_name,picture')->where(array('id' => $v['type_id']))->find();
                $artList[$k]['type_id'] = 1;
                $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                $artList[$k]['count'] = M('Collect')->where(array('type' => 1, 'type_id' => $v['type_id']))->count();
            }
        } elseif ($id == 2) {
            $list = D('Collect')->getListByPage($userId, $npage, 2);
            foreach ($list as $k => $v) {
                if (D('Product')->getCollectFind($v['type_id'], 1)) {
                    $artList[$k] = D('Product')->getCollectFind($v['type_id'], 1);
                    $artList[$k]['type_id'] = 2;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = D('ProductComment')->getCountByProId($artList[$k]['id']);
                }
            }
        } elseif ($id == 3) {
            $list = D('Collect')->getListByPage($userId, $npage, 2);
            foreach ($list as $k => $v) {
                if (D('Product')->getCollectFind($v['type_id'], 2)) {
                    $artList[$k] = D('Product')->getCollectFind($v['type_id'], 2);
                    $artList[$k]['type_id'] = 3;
                    $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                    $artList[$k]['count'] = D('ProductComment')->getCountByProId($artList[$k]['id']);
                }
            }
        } elseif ($id == 4) {
            $where['type'] = array(4, 6, 'or');
            $list = M('Collect')->order('create_time desc')->where(array('user_id' => $userId, $where))->select();
            foreach ($list as $k => $v) {
                if ($v['type'] == 4) {
                    $artList[$k] = M('parenting')->field('id,title,image')->where(array('id' => $v['type_id']))->find();
                    $artList[$k]['count'] = M('ProductComment')->where("parenting_id={$v['type_id']}")->count();
                } else {
                    $artList[$k] = M('organization_activity')->field('id,title,image')->where(array('id' => $v['type_id']))->find();
                    $artList[$k]['count'] = M('ProductComment')->where("activity_id={$v['type_id']}")->count();
                }
                $artList[$k]['type_id'] = 4;
                $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
            }
        } elseif ($id == 5) {
            $list = D('Collect')->getListByPage($userId, $npage, 5);
            foreach ($list as $k => $v) {
                $artList[$k] = D('Article')->getCollectFind($v['type_id']);
                $artList[$k]['type_id'] = 5;
                $artList[$k]['time'] = date('Y年m月d日', $v['create_time']);
                $artList[$k]['count'] = D('Comment')->getCountByArtId($artList[$k]['id']);
            }
        }
        if (!isset($artList) || empty($artList)) {
            $this->ajaxReturn(array('status' => 0, 'msg' => '没有数据'));
        }
        $this->ajaxReturn(array('status' => 1, 'msg' => '获取成功', 'data' => $artList));
    }
}