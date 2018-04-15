<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class ArticleCateModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('ArticleCate');
    }

    public function getList($limit = 0)
    {
        if ($limit != 0) {
            $list = $this->_db->order('sort desc')->limit($limit)->select();
        } else {
            $list = $this->_db->order('sort desc')->select();
        }
        return $list;
    }

    public function find($id)
    {
        $cate = $this->_db->where("id={$id}")->find();
        return $cate;
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

    public function getCateByTitle($title, $field = '*')
    {
        $cate = $this->_db->field($field)->where("title='{$title}'")->find();
        if (!$cate || empty($cate)) {
            throw_exception('没有找到该分类');
        }
        return $cate;
    }

    public function getTitleById($id)
    {
        $title = $this->_db->where("id={$id}")->getField('title');
        return $title;
    }
}
