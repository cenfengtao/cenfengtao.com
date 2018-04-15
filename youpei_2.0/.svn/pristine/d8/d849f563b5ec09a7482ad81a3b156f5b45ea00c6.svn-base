<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class FingerRecordModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('finger_record');
    }

    public function getCountByCommentId($commentId)
    {
        $count = $this->_db->where(array('type' => 2, 'type_id' => $commentId))->count();
        return $count;
    }

    public function getCountByArtId($commentId)
    {
        $count = $this->_db->where(array('type' => 1, 'type_id' => $commentId))->count();
        return $count;
    }

    public function isFingerByCommentId($userId, $commentId)
    {
        $id = $this->_db->where(array('user_id' => $userId, 'type' => 2, 'type_id' => $commentId))->getField('id');
        return $id ?: false;
    }

    public function isFingerByArtId($userId, $commentId)
    {
        $id = $this->_db->where(array('user_id' => $userId, 'type' => 1, 'type_id' => $commentId))->getField('id');
        return $id ?: false;
    }

    public function deleteByCommentId($userId, $commentId)
    {
        $id = $this->_db->where(array('user_id' => $userId, 'type' => 2, 'type_id' => $commentId))->delete();
        return $id;
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
}
