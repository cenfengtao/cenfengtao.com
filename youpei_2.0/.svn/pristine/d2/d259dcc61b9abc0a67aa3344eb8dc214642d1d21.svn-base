<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 10:55
 */

namespace Common\Model;

use Think\Model;

class OrganizationActivityModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('organization_activity');
    }

    public function getList($token, $field = "*")
    {
        $list = $this->_db->where(array('token' => $token))->field($field)->select();
        return $list;
    }

    public function delete($id)
    {
        $id = $this->_db->where("id={$id}")->delete();
        return $id;
    }

    public function insert($data)
    {
        if (!$data || !is_array($data)) {
            throw_exception('添加数据不合法');
        }
        return $this->_db->add($data);
    }

    public function find($id)
    {
        $result = $this->_db->where("id={$id}")->find();
        return $result;
    }

    public function updateById($id, $data)
    {
        if (!isset($id) || !is_numeric($id)) {
            throw_exception('ID不合法');
        }
        if (!isset($data) || !is_array($data)) {
            throw_exception('更新数据不合法');
        }
        return $this->_db->where('id=' . $id)->save($data);
    }

    //现在进行中的活动
    public function getNowActivityList($token, $page = 0, $field = '*')
    {
        $list = $this->_db->field($field)->where(array('token' => $token, 'start_time' => array('ELT', time()),
            'end_time' => array('GT', time()), 'check_status' => 2))->limit($page, 3)->select();
        foreach ($list as $k => $v) {
            $nowCount = M('order')->where(array('status' => array(array('eq', 1), array('eq', 4), 'or'),
                'activity_id' => $v['id']))->count();
            if ($nowCount >= $v['max_people']) {
                unset($list[$k]);
            }
        }
        return $list;
    }
}