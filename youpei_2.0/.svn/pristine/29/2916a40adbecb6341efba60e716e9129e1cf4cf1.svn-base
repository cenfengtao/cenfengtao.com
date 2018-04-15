<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class SearchRecordModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('search_record');
    }

    public function getList()
    {
        $list = $this->_db->order('create_time desc')->select();
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

    public function isRecordByWord($userId, $word)
    {
        $result = $this->_db->where(array("word" => $word, 'user_id' => $userId))->getField('id');
        return $result ?: false;
    }

    //判断记录有否超过7条，删除最后一条
    public function deleteLastRecord($userId)
    {
        $count = $this->_db->where("user_id={$userId}")->count();
        if ($count > 7) {
            $minCreateTime = $this->_db->where("user_id={$userId}")->min('create_time');
            $this->_db->where(array('user_id' => $userId, 'create_time' => $minCreateTime))->delete();
        }
        return true;
    }

    public function getHistory($userId)
    {
        $list = $this->_db->where("user_id={$userId}")->order('create_time desc')->limit(7)->select();
        return $list;
    }

    public function deleteByUserId($userId)
    {
        $result = $this->_db->where("user_id={$userId}")->delete();
        return $result;
    }
}
