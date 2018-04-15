<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class AccessModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('access');
    }

    public function getAccNameById($id)
    {
        $name = $this->_db->where("id={$id}")->getField('acc_name');
        return $name;
    }

    //获取主菜单列表
    public function getMenuList()
    {
        $list = $this->_db->field('id,acc_name')->where(array('father_id' => 0, 'type' => 0))->select();
        return $list;
    }

    public function insert($data)
    {
        if (!$data || !is_array($data)) {
            throw_exception('添加数据不合法');
        }
        return $this->_db->add($data);
    }

    public function getAccList()
    {
        $list = $this->_db->select();
        return $list;
    }

    public function updateAccById($id, $data)
    {
        if (!isset($id) || !is_numeric($id)) {
            throw_exception('ID不合法');
        }
        if (!isset($data) || !is_array($data)) {
            throw_exception('更新数据不合法');
        }
        return $this->_db->where('id=' . $id)->save($data);
    }

    public function deleteAccById($id)
    {
        $id = $this->_db->where("id={$id}")->delete();
        return $id;
    }

    public function find($id)
    {
        $data = $this->_db->where("id={$id}")->find();
        return $data;
    }

    //检测权限
    public function checkAccess($jbUrl, $roleId)
    {
        $result = $this->_db->join('LEFT JOIN yp_access_auth as auth ON yp_access.id = auth.acc_id')->where(array('auth.type' => '1', 'auth.type_id' => $roleId, 'yp_access.url' => $jbUrl))->getField('auth.id');
        return $result;
    }

    public function isAccessByUrl($url)
    {
        $result = $this->_db->where(array('url' => $url))->getField('id');
        return $result;
    }

    public function isFather($name)
    {
        $fatherId = $this->_db->where("url='{$name}'")->getField('id');
        return $fatherId;
    }

    public function getListFatherId($where)
    {
        $list = $this->_db->where($where)->select();
        return $list;
    }
}
