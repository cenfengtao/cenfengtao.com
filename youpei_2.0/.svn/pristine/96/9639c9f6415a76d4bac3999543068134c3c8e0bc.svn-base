<?php
/**
 * 愿望单
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class HopeController extends CommonController
{
    public function hopeList()
    {
        $list = D('Hope')->getList();
        foreach ($list as $key => $val) {
            $list[$key]['username'] = D('User')->getNameById($val['user_id']);
            $classTime = json_decode($val['class_time'], true);
            $tranClassTime = '';
            foreach ($classTime as $k => $v) {
                $tranClassTime .= $v['class_time_day'] . ' ' . $v['class_start_hour'] . '-' . $v['class_end_hour'] . ' &nbsp;&nbsp;&nbsp;';
            }
            $list[$key]['class_time'] = $tranClassTime;
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function delete()
    {
        if (!$_POST['id'] || !is_numeric($_POST['id'])) {
            return show(0, 'ID参数错误');
        }
        try {
            $id = D('Hope')->delete($_POST['id']);
            if ($id) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function readHope()
    {
        if (!$_GET['id'] || empty($_GET['id'])) {
            return show(0, 'ID参数错误');
        }
        try {
            $hope = D('Hope')->find($_GET['id']);
            $hope['username'] = D('User')->getNameById($hope['user_id']);
            $classTime = json_decode($hope['class_time'], true);
            $tranClassTime1 = '';
            $tranClassTime2 = '';
            $tranClassTime1 .= $classTime[1]['class_time_day'] . ' ' . $classTime[1]['class_start_hour'] . '-' . $classTime[1]['class_end_hour'] . ' &nbsp;&nbsp;&nbsp;';
            $tranClassTime2 .= $classTime[2]['class_time_day'] . ' ' . $classTime[2]['class_start_hour'] . '-' . $classTime[2]['class_end_hour'] . ' &nbsp;&nbsp;&nbsp;';
            $hope['class_time1'] = $tranClassTime1;
            $hope['class_time2'] = $tranClassTime2;
            $this->assign('hope', $hope);
            $this->display();
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
}