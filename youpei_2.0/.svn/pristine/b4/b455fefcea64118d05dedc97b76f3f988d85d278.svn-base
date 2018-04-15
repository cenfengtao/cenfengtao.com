<?php
/**
 * 个人资料
 */

namespace Common\Model;

use Think\Model;

class UserDataModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('user_data');
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


}
