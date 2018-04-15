<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class AccessAuthModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('access_auth');
    }

    public function isAccess($accId, $roleId)
    {
        $result = $this->_db->where(array('type' => '1', 'type_id' => $roleId, 'acc_id' => $accId))->find();
        return $result;
    }

    public function deleteByRoleId($roleId)
    {
        $result = $this->_db->where(array('type' => '1', 'type_id' => $roleId))->delete();
        return $result;
    }

    public function addAuth($accId, $roleId)
    {
        $result = $this->_db->add(array('type' => 1, 'type_id' => $roleId, 'acc_id' => $accId));
        return $result;
    }

    public function getAccessIdByRoleId($roleId)
    {
        $list = $this->_db->where(array('type' => 1, 'type_id' => $roleId))->field('acc_id')->select();
        $list = array_column($list, 'acc_id');
        return $list;
    }
}
