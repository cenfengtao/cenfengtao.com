<?php
/**
 * 砍价记录
 * Date: 2017/9/05
 */

namespace Common\Model;

use Think\Model;

class BargainRecordModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('bargain_record');
    }

    public function getList($where = array())
    {
        $list = $this->_db->where($where)->select();
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

    //帮助砍价人数
    public function bargainHelpByUser($userId, $bargainId, $startTime, $endTime)
    {
        $result = $this->_db->where(array('share_user_id' => $userId, 'bargain_id' => $bargainId,
            'create_time' => array(array('GT', $startTime), array('LT', $endTime), 'and')))->select();
        return $result;
    }

    //帮助砍价金额
    public function bargainHelpByPrice($userId, $bargainId, $startTime, $endTime)
    {
        $result = $this->_db->where(array('share_user_id' => $userId, 'bargain_id' => $bargainId,
            'create_time' => array(array('GT', $startTime), array('LT', $endTime), 'and')))->sum('price');
        return $result;
    }

}