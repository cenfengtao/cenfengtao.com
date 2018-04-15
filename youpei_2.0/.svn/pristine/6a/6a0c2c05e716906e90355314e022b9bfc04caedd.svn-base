<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class MenuModel extends Model
{
    private $_db = '';

    protected $_validate = array();

    public function __construct()
    {
        $this->_db = M('menu');
    }

    public function getAdminMenuList()
    {
        $list = $this->_db->where(array('type' => 1, 'father_id' => 0))->order('sort desc')->
        field('id,title,url,sort,pic_url')->select();
        foreach ($list as $key => $item) {
            $list[$key]['child'] = $this->_db->where(array('father_id' => $item['id'], 'type' => 1))->order('sort desc')->select();
        }
        return $list;
    }

    public function manageMenuList()
    {
        $list = $this->_db->where('type = 1')->select();
        return $list;
    }

    public function getTitleById($id)
    {
        $title = $this->_db->where('id=' . $id)->getField('title');
        return $title;
    }

    public function find($id)
    {
        $menu = $this->_db->where('id=' . $id)->find();
        return $menu;
    }

    public function getAdminFatherMenu()
    {
        $fatherList = $this->_db->field('id,title')->where(array('type' => 1, 'father_id' => 0))->select();
        return $fatherList;
    }

    public function insert($data)
    {
        if (!$data || !is_array($data)) {
            throw_exception('添加数据不合法');
        }
        return $this->_db->add($data);
    }

    public function updateById($id,$data)
    {
        if (!isset($id) || !is_numeric($id)) {
            throw_exception('ID不合法');
        }
        if (!isset($data) || !is_array($data)) {
            throw_exception('更新数据不合法');
        }
        return $this->_db->where('id=' . $id)->save($data);
    }

    public function deleteById($id)
    {
        $id = $this->_db->where("id={$id}")->delete();
        return $id;
    }
}
