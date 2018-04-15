<?php

namespace Common\Model;

use Think\Model;

class CollectModel extends Model
{
    private $_db = '';

    //type 1：机构 2：课程 3：商品 4：活动 5：文章
    public function __construct()
    {
        $this->_db = M('Collect');
    }

    public function getList($where = array())
    {
        $list = $this->_db->where($where)->select();
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

    public function getTitleById($title)
    {
        $cate = $this->_db->where("title='{$title}'")->find();
        if (!$cate || empty($cate)) {
            throw_exception('没有找到该分类');
        }
        return $cate;
    }

    public function getListById($userId, $type)
    {
        if (empty($type) || !isset($type)) {
            $list = $this->_db->order('create_time desc')->where("user_id='{$userId}'")->limit(0,10)->select();
        } else {
            $list = $this->_db->order('create_time desc')->where(array('user_id' => $userId, 'type' => $type))->limit(0,10)->select();
        }
        return $list;
    }

    public function getListByPage($userId,$npage,$type)
    {
        if(empty($type) || !isset($type)){
            $list = $this->_db->where(array('user_id'=>$userId))->order('create_time desc')->limit($npage,6)->select();
        }else{
            $list = $this->_db->where(array('user_id'=>$userId,'type'=>$type))->order('create_time desc')->limit($npage,6)->select();
        }
        return $list;
    }

    public function isCollectById($userId, $typeId, $type)
    {
        $id = $this->_db->where(array('user_id' => $userId, 'type_id' => $typeId, 'type' => $type))->getField('id');
        return $id ?: false;
    }

    public function deleteCollectById($userId, $typeId, $type)
    {
        $id = $this->_db->where(array('user_id' => $userId, 'type_id' => $typeId, 'type' => $type))->delete();
        return $id;
    }

    public function getPageByType($typeId, $type)
    {
        $num = $this->_db->where(array('type_id' => $typeId, 'type' => $type))->count();
        return $num;
    }
}
