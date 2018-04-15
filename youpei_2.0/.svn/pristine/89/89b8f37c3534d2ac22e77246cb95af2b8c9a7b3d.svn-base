<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class AppealModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('appeal');
    }

    public function getList($where)
    {
        $list = $this->_db->where($where)->field('content',true)->order('create_time desc,status desc')->select();
        return $list;
    }

    public function find($id)
    {
        $comment = $this->_db->where("id={$id}")->find();
        return $comment;
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

    public function isAppealByOrderId($orderId, $userId)
    {
        $result = $this->_db->where(array('order_id' => $orderId, 'user_id' => $userId, 'status' => 1))->getField('id');
        return $result ?: false;
    }

    public function getListForAppeal($where, $page, $pageSize = 10)
    {
        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($where)->field('content',true)->limit($offset, $pageSize)->order('id desc')->select();
        return $list;
    }

    public function getCount($where = array())
    {
        return $this->_db->where($where)->order('id desc')->count();
    }
}
