<?php
/**
 *机构活动管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class OrganizationActivityController extends CommonController
{
    public function activityList()
    {
        if($this->isSuper){
            $list = M('OrganizationActivity')->select();
        }else{
            $list = D('OrganizationActivity')->getList($this->token);
        }

        $this->assign('list', $list);
        $this->display();
    }

    public function addActivity()
    {
        if ($_POST) {
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '活动标题不能为空');
            }
            if (!$_POST['start_time'] || empty($_POST['start_time'])) {
                return show(0, '开始时间不能为空');
            }
            if (!$_POST['end_time'] || empty($_POST['end_time'])) {
                return show(0, '结束时间不能为空');
            }
            if (!$_POST['activity_time'] || empty($_POST['activity_time'])) {
                return show(0, '活动时间不能为空');
            }
            if (!$_POST['max_people'] || $_POST['max_people'] <= 0) {
                return show(0, '参加人数不能少于零');
            }
            if (!$_POST['image'] || empty($_POST['image'])) {
                unset($_POST['image']);
            }
            $data = $_POST;
            $data['start_time'] = strtotime($_POST['start_time']);
            $data['end_time'] = strtotime($_POST['end_time']) + 3600 * 24 - 1;
            $data['activity_time'] = strtotime($_POST['activity_time']);
            $data['create_time'] = time();
            $data['token'] = $this->token;
            if ($data['id'] && !empty($data['id'])) {
                return $this->save($data);
            }
            try {
                $id = D('OrganizationActivity')->insert($data);
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

    public function editActivity()
    {
        if (!$_GET['id'] || !is_numeric($_GET['id'])) {
            return show(0, 'ID参数不能为空');
        }
        $activity = D('OrganizationActivity')->find($_GET['id']);
        $this->assign('activity', $activity);
        $this->display();
    }

    public function save($data)
    {
        $data['check_status'] = 1;
        try {
            $id = D('OrganizationActivity')->updateById($data['id'], $data);
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
            $result = D('OrganizationActivity')->delete($_POST['id']);
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