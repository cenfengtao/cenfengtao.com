<?php
namespace Common\Model;

class GroupRecordModel extends BaseModel
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('group_record');
    }

    public function getList()
    {
        $list = $this->_db->order('id desc')->select();
        return $list;
    }

    public function find($id)
    {
        $article = $this->_db->where("id={$id}")->find();
        return $article;
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

    public function isSameGroup($groupId)
    {
        $result = $this->_db->where(array('status' => array(array('eq', 1), array('eq', 2), 'or'),
            'end_time' => array('gt', time()), 'group_id' => $groupId))->find();
        return $result ?: false;
    }
}