<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class QrcodeModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('qrcode');
    }

    public function getList($token)
    {
        $list = $this->_db->where(array('token' => $token))->order('create_time desc')->select();
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

    public function isSceneId($sceneId, $token)
    {
        $id = $this->_db->where(array('scene_id' => $sceneId, 'token' => $token))->getField('id');
        return $id;
    }

    public function getNewestSceneId($token)
    {
        $maxTime = $this->_db->where(array('token' => $token))->max('create_time');
        $sceneId = $this->_db->where(array("token" => $token, 'create_time' => $maxTime))->getField('scene_id');
        return $sceneId ?: false;
    }

    //获取当前活动
    public function getActionQrcode($token)
    {
        $result = $this->_db->where(array('token' => $token, 'is_action' => 2))->find();
        return $result ?: false;
    }
}
