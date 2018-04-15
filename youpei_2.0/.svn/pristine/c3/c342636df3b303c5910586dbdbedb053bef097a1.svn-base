<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class QrcodeRecordModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('qrcode_record');
    }

    public function getCountBySceneId($sceneId)
    {
        $count = $this->_db->where("scene_id={$sceneId}")->count();
        return $count;
    }

    public function getList()
    {
        $list = $this->_db->order('create_time desc')->select();
        return $list;
    }

    public function insert($data)
    {
        if (!$data || !is_array($data)) {
            throw_exception('添加数据不合法');
        }
        return $this->_db->add($data);
    }

    public function getMaxNumberBySceneId($sceneId)
    {
        $maxNumber = $this->_db->where("scene_id='{$sceneId}'")->max('serial_number');
        return $maxNumber ? $maxNumber : 0;
    }

    public function isScan($token, $userId, $sceneId)
    {
        $result = $this->_db->where(array("token" => $token, 'user_id' => $userId, 'scene_id' => $sceneId))->find();
        return $result;
    }

    public function getMaxNumBySceneId($sceneId)
    {
        $result = $this->_db->where(array('scene_id' => $sceneId))->max('serial_number');
        return $result;
    }

    //获取同一场景下单用户的助力次数
    public function getCountByUserId($sceneId, $shareUserId, $token)
    {
        $count = $this->_db->where(array("scene_id" => $sceneId, 'share_user_id' => $shareUserId, 'token' => $token))->count();
        return $count;
    }

    public function getListForQrcode($where, $page, $pageSize = 10, $field = '*')
    {
        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($where)->field($field)->limit($offset, $pageSize)->order('id desc')->select();
        return $list;
    }

    public function getCount($where = array())
    {
        return $this->_db->where($where)->order('id desc')->count();
    }

    public function getListBySceneId($whrere = array())
    {
        $list = $this->_db->where($whrere)->select();
        return $list;
    }

    public function count($where = array())
    {
        $count = $this->_db->where($where)->count();
        return $count;
    }
}
