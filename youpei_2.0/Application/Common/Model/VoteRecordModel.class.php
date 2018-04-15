<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class VoteRecordModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('vote_record');
    }

    public function getList($where = [], $field = '*')
    {
        $list = $this->_db->where($where)->field($field)->order('id desc')->select();
        return $list;
    }

    public function find($id, $where = [])
    {
        $result = $this->_db->where("id={$id}")->where($where)->find();
        return $result;
    }

    public function insert($data)
    {
        if (!$data || !is_array($data)) {
            throw_exception('添加数据不合法');
        }
        return $this->_db->add($data);
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

    public function delete($id)
    {
        $id = $this->_db->where("id={$id}")->delete();
        return $id;
    }

    //查询每日是否已经获得票数
    public function everydayCount($userId)
    {
        $start_time = strtotime(date('Y-m-d', time()));
        $end_time = $start_time + 3600 * 24;
        $result = $this->_db->where(array('user_id' => $userId, 'type' => 1, 'is_expend' => 2,
            'create_time' => array(array('EGT', $start_time), array('ELT', $end_time), 'and')))->find();
        return $result ? 2 : 1;
    }
    
}
