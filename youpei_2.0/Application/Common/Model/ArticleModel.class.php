<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class ArticleModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('Article');
    }

    public function getList($id)
    {
        $list = $this->_db->order('sort desc,create_time desc')->where($id)->select();
        return $list;
    }

    public function getArtList($field = "*")
    {
        $list = $this->_db->where('is_hot=1')->field($field)->order('create_time desc')->select();
        return $list;
    }


    public function getHotList($where)
    {
        $list = $this->_db->order('sort desc,create_time desc')->field("title,id,create_time,image,cate_id,read_count,sort,token")->where($where)->select();
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

    public function getArticleByClass($className, $field = "*")
    {
        $class = D('ArticleCate')->getCateByTitle($className, 'id');
        $list = $this->_db->field($field)->order('create_time desc')->where(array('cate_id' => $class['id'], 'is_hot' => 2))->select();
        return $list;
    }

    public function getArticlelist()
    {
        $sql = "SELECT id,image,title,cate_id,create_time,token FROM __PREFIX__article order by sort desc,create_time  desc LIMIT 0,10";
        return $this->_db->query($sql);
    }

    public function getListByPage($npage, $cateId)
    {
        if (!isset($cateId) || !is_numeric($cateId)) {
            $sql = "SELECT id,image,title,cate_id,create_time FROM __PREFIX__article order by create_time desc LIMIT $npage,6";
        } else {
            $sql = "SELECT id,image,title,cate_id,create_time FROM __PREFIX__article WHERE cate_id='{$cateId}' order by create_time desc LIMIT $npage,6";
        }
        $data = $this->_db->query($sql);
        return $data;
    }

    public function getListById($cateId)
    {
        $cateList = $this->_db->order('sort desc,create_time desc')->where("cate_id={$cateId}")->limit(0, 10)->select();
        return $cateList;
    }

    public function getCollectFind($proId)
    {
        $first = $this->_db->where("id={$proId}")->find();
        return $first;
    }

    public function getList10()
    {
        $list = $this->_db->order('sort desc,create_time desc')->limit(0, 10)->select();
        return $list;
    }

    public function getArticleByToken($token, $field = "*", $limit = 'all')
    {
        if ($limit == 'all') {
            $list = $this->_db->where(array('token' => $token))->order('sort desc,create_time desc')->field($field)->select();
        } else {
            $list = $this->_db->where(array('token' => $token))->order('sort desc,create_time desc')->field($field)->limit($limit)->select();
        }
        return $list;
    }

    public function getRearArticleByToken($where, $limit = 'all')
    {
        if ($limit == 'all') {
            $list = $this->_db->where($where)->field('id,title', false)->order('sort desc,create_time desc')->select();
        } else {
            $list = $this->_db->where($where)->field('id,title', false)->order('sort desc,create_time desc')->limit($limit)->select();
        }
        return $list;
    }

    public function getArticleByTokens($token, $page = 0)
    {
        $list = $this->_db->where(array('token' => $token))->order('sort desc,create_time desc')->limit($page, 3)->select();
        return $list;
    }

    public function getListForAdmin($where, $page, $pageSize = 10, $field = '*')
    {
        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($where)->field($field)->limit($offset, $pageSize)->order('sort desc,create_time desc')->select();
        return $list;
    }


    public function getCount($where = array())
    {
        return $this->_db->where($where)->count();
    }

    public function getArticleById($id)
    {
        $id = $this->_db->where("id = {$id}")->find();
        return $id ? true : false;
    }
}
