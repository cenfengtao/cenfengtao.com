<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class ContributionRecordModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('contribution_record');
    }

    public function getList($where = [], $field = '*')
    {
        $list = $this->_db->where($where)->field($field)->order('id desc')->select();
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

    public function uploadStatus($voteId, $userId)
    {
        $result = $this->_db->where(array('vote_id' => $voteId, 'user_id' => $userId))->find();
        return $result;
    }

    public function random($voteId, $workId)
    {
        $Model = M();
        $sql = "SELECT `id`,`path`,`username`,`title`,`vote_id`,`vote_count`,`number` FROM `yp_contribution_record` WHERE `vote_id` = " . $voteId . " AND `id` <> " . $workId . " AND `status` = 2 ORDER BY RAND() LIMIT 0,2";
        return $Model->query($sql);
    }
}
