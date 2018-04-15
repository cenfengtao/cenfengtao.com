<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class AssociationController extends BaseController
{
    public function index()
    {
        $this->title = '社群';
        $this->display();
    }

    public function demo()
    {
        $this->display();
    }

    //社群
    public function ajaxIndex()
    {
        try {
            $list = M('association')->where(array('status' => 1))->field('title,theme,tag,pic_url,qr_code,number')
                ->order('create_time desc')->limit(10)->select();
            return show(1, '', ['list' => $list]);
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    //社群滑动加载
    public function loadingIndex()
    {
        if (!$_GET['page']) {
            return show(0, '参数错误');
        }
        try {
            $list = M('association')->where(array('status' => 1))->field('title,theme,tag,pic_url,qr_code,number')
                ->order('create_time desc')->limit($_GET['page'], 6)->select();
            return show(1, '', ['list' => $list]);
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

}