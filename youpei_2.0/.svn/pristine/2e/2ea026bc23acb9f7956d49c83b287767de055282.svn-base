<?php
namespace Common\Model;

use Think\Model;

class SignGiftRecordModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('sign_gift_record');
    }

    public function find($id)
    {
        $article = $this->_db->where("id={$id}")->find();
        return $article;
    }

    public function getList()
    {

        $list = $this->_db->order('create_time desc')->limit(0, 10)->select();
        return $list;
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

    public function getStatus($userId, $days)
    {
        //本月时间戳
        //$days 7:7天 14:14天 30:30天
        $start = strtotime(date('Y-m-d', time() - 3600 * 24 * $days));
        $status = $this->_db->where(array('user_id' => $userId, 'type' => 1, 'typeid' => $days, 'create_time' => array('GT', $start)))->select();
        return $status ? 1 : 0;
    }

}