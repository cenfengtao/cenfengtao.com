<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 10:55
 */

namespace Common\Model;

use Think\Model;

class OrganizationModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('Organization');
    }

    public function getOrgNameById($id)
    {
        $name = $this->_db->where("id={$id}")->getField('org_name');
        return $name;
    }

    public function getOrgList($field = "*")
    {
        $list = $this->_db->field($field)->order('id desc')->select();
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

    public function isTokenById($token)
    {
        $result = $this->_db->where("token='{$token}'")->select();
        return $result ?: false;
    }

    public function getOrgnameByToken($token)
    {
        $result = $this->_db->where("token='{$token}'")->getField('org_name');
        return $result;
    }

    public function getImageById($id)
    {
        $result = $this->_db->where("id={$id}")->getField('picture');
        return $result;
    }

    public function getCityById($id)
    {
        $result = $this->_db->where("id={$id}")->getField('city');
        return $result;
    }

    public function getAreaById($id)
    {
        $result = $this->_db->where("id={$id}")->getField('area');
        return $result;
    }

    public function getAddById($id)
    {
        $result = $this->_db->where("id={$id}")->getField('address');
        return $result;
    }

    public function findByToken($token)
    {
        $result = $this->_db->where("token='{$token}'")->find();
        return $result;
    }

    public function getOrgByTitle($where)
    {
        $result = $this->_db->where($where)->select();
        return $result;
    }
}