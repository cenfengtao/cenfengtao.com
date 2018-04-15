<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class CommentModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('Comment');
    }

    public function getList($token = '')
    {
        if (empty($token)) {
            $list = $this->_db->order('id desc')->select();
        } else {
            $list = $this->_db->where("token='{$token}'")->select();
        }
        return $list;
    }

    public function getCommentsByArtId($where = array())
    {
        $comments = $this->_db->where($where)->order('create_time desc')->select();
        return $comments;
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

    public function getCountByArtId($artId)
    {
        $count = $this->_db->where("article_id={$artId}")->count();
        return $count;
    }

    function gettoken()
    {
        $plist = D('AdminUser')->getAdminBytoken(session('adminUser')['id']);
        return $plist[0]['token'];
    }

    //每日评论任务
    public function isTodayComment($userId)
    {
        $dayTime = strtotime(date("y-m-d"));
        $result = $this->_db->where(array("user_id" => $userId, 'create_time' => array('EGT', $dayTime)))->find();
        return $result ? true : false;
    }

    public function getListForAdmin($where, $page, $pageSize = 10, $field = '*')
    {
        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($where)->field($field)->limit($offset, $pageSize)->order('create_time desc')->select();
        return $list;
    }

    public function getCount($where = array())
    {
        return $this->_db->where($where)->count();
    }
}
