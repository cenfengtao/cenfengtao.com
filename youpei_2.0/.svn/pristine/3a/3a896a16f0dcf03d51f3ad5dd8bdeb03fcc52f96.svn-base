<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class AdminRoleModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('admin_role');
    }

    public function getSuperUserId()
    {
        $roleId = $this->_db->where("title='超级管理员'")->getField('id');
        return $roleId;
    }

    public function getAdminRoleByRoleId($roleId)
    {
        $roleName = $this->_db->where('id=' . $roleId)->getField('title');
        return $roleName;
    }

    public function getRoleList()
    {
        $list = $this->_db->field('id,title,description')->select();
        return $list;
    }

    public function deleteRoleById($id)
    {
        $id = $this->_db->where("id={$id}")->delete();
        return $id;
    }

    public function isRepeatTitle($title)
    {
        $id = $this->_db->where("title='{$title}'")->find();
        return $id ?: false;
    }

    public function insert($data = array())
    {
        if (!$data || !is_array($data)) {
            throw_exception('添加数据不合法');
        }
        return $this->_db->add($data);
    }

    public function find($id)
    {
        $data = $this->_db->where("id={$id}")->find();
        return $data;
    }

    public function getTitleById($id)
    {
        $title = $this->_db->where("id={$id}")->getField('title');
        return $title;
    }

    public function updateRoleById($id, $data)
    {
        if (!isset($id) || !is_numeric($id)) {
            throw_exception('ID不合法');
        }
        if (!isset($data) || !is_array($data)) {
            throw_exception('更新数据不合法');
        }
        return $this->_db->where('id=' . $id)->save($data);
    }
}
