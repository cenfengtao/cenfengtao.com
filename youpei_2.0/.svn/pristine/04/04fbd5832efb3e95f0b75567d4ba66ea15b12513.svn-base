<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 10:55
 */

namespace Common\Model;

use Think\Model;

class AdminUserModel extends Model
{
    private $_db = '';
    protected $_validate = array(
        array('username', 'require', '用户名不能为空啊', 1, '', 4),
        array('password', 'require', '密码不能为空', 1)
    );

    public function __construct()
    {
        $this->_db = M('AdminUser');
    }

    public function getAdminByUsername($username)
    {
        $result = $this->_db->where("username='{$username}'")->find();
        return $result;
    }

    //记录最后登录信息
    public function setLastLoginData($username)
    {
        $ip = get_client_ip();
        $this->_db->where("username='{$username}'")->save(array('last_ip' => $ip, 'last_login_time' => time()));
    }

    public function updateAdminUserById($id, $data)
    {
        $id = $this->_db->where("id={$id}")->save($data);
        return $id;
    }

    public function getList()
    {
        $list = $this->_db->select();
        return $list;
    }

    public function isRepeatName($name)
    {
        $result = $this->_db->where("username='{$name}'")->find();
        return $result ?: false;
    }

    public function isRepeatMobile($mobile)
    {
        $result = $this->_db->where("mobile='{$mobile}'")->find();
        return $result ?: false;
    }

    public function insert($data = array())
    {
        if (!$data || !is_array($data)) {
            throw_exception('添加数据不合法');
        }
        return $this->_db->add($data);
    }

    public function deleteUserById($id)
    {
        $result = $this->_db->where("id={$id}")->delete();
        return $result;
    }

    public function find($id)
    {
        $user = $this->_db->where("id={$id}")->find();
        return $user;
    }

    public function getAdminBytoken($id)
    {
       $sql ="SELECT token FROM __PREFIX__wxuser WHERE id IN (SELECT wxuser_id FROM __PREFIX__admin_user WHERE  id = $id)";
       return $this->_db->query($sql);
    }

    public function updateUserById($id, $data)
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