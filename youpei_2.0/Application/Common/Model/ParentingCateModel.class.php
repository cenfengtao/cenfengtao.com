<?php
namespace Common\Model;

use Think\Model;

class ParentingCateModel extends BaseModel
{

    private $_db = '';

    public function __construct()
    {
        $this->_db = M('parenting_cate');
    }

    public function find($id)
    {
        $article = $this->_db->where("id={$id}")->find();
        return $article;
    }

    public function getList()
    {
        $list = $this->_db->select();
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

    //上架活动列表
    public function getUpList($limit = 0)
    {
        if ($limit == 0) {
            $list = $this->_db->where(array('status' => 1, 'start_time' => array('elt', time()),
                'end_time' => array('egt', time())))->select();
        } else {
            $list = $this->_db->where(array('status' => 1, 'start_time' => array('elt', time()),
                'end_time' => array('egt', time())))->limit($limit)->select();
        }
        return $list;
    }

    public function getOrgList()
    {
        $list = $this->_db->order('id desc')->select();
        return $list;
    }

    public function getOrgNameById($id)
    {
        $name = $this->_db->where("id={$id}")->getField('cate_title');
        return $name;
    }

    public function getTitleById($id)
    {
        $title = $this->_db->where('id=' . $id)->getField('cate_title');
        return $title;
    }

    public function getParentingCate()
    {
        $list = $this->_db->where("is_show=0")->order('sort')->select();
        return $list;
    }
    public function queryPicture()
    {
        $sql = "select * from __PREFIX__parenting_cate order by sort asc";
        return $this->query($sql);
    }

    public function insertParentingCate()
    {
        $rd = array('status' => -1);
        $data = array();
        $data['title'] = I('title');
        $data['sort'] = (int)I('sort');
        $data['is_show'] = (int)I('is_show');
        if ($this->checkEmpty($data)) {
            $rs = $this->add($data);
            if (false !== $rs) {
                $rd['status'] = 1;
            }
        }
        return $rd;
    }

    //修改
    public function editParentingCate()
    {
        $rd = array('status' => -1);
        $id = (int)I("id", 0);
        $data['title'] = I('title');
        $data['sort'] = (int)I('sort');
        $data['is_show'] = (int)I('is_show');
        if ($this->checkEmpty($data)) {
            $rs = $this->where("id=" . $id)->save($data);
            if (false !== $rs) {
                $rd['status'] = 1;
            }

        }
        return $rd;
    }

    public function get()
    {
        return $this->_db->where("id=" . (int)I('id'))->find();
    }

    /**
     * 删除
     */
    public function del()
    {
        $rd = array('status' => -1);
        $rs = $this->_db->delete((int)I('id'));
        if (false !== $rs) {
            $rd['status'] = 1;
        }
        return $rd;
    }
}