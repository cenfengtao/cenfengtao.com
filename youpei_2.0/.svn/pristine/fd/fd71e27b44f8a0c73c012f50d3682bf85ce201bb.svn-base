<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class ActivityInviteModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('activity_invite');
    }

    public function getList($where = [], $field = '*')
    {
        $list = $this->_db->field($field)->where($where)->select();
        return $list;
    }

    public function find($id)
    {
        $result = $this->_db->where("id={$id}")->find();
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
