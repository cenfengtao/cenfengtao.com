<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class IntegralRecordModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('integral_record');
    }

    public function getList()
    {
        $list = $this->_db->order('create_time desc')->select();
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

    public function getListByUserId($userId)
    {
        $list = $this->_db->where("user_id={$userId}")->select();
        return $list;
    }

    public function totalGetByUserId($userId)
    {
        $result = $this->_db->where(array("user_id" => $userId, 'type' => 2))->sum('integral');
        return $result;
    }

    public function totalUseByUserId($userId)
    {
        $result = $this->_db->where(array("user_id" => $userId, 'type' => 1))->sum('integral');
        return $result;
    }

    public function totalGetIntegral($userId,$integral_type,$type){
        $result = $this->_db->where(array("user_id" => $userId, 'integral_type'=>$integral_type, 'type' => $type))->sum('integral');
        return $result;
    }

    public function querysignintime($userId)
    {
        $data = strtotime(date('Y-m-d 00:00:00')); //时间戳
        $res = $this->_db->where(array('user_id'=>$userId,'create_time'=>array('gt',$data),'integral_type'=>1))->find();
        return $res ?1:0;
    }

    public function addintegralRecord($userId, $token)
    {    $rd = array('status' => -1);
        $config = M('Config')->where("token='{$token}'")->find();
    
        $data = array();
        $data['user_id'] = $userId;
        $data['integral'] = $config['task_sign_integral'];
        $data['status'] = 1;
        $data['type'] = 2;
        $data['integral_type'] = 1;
        $data['desc'] = '签到赠送积分';
        $data["create_time"] = time();
        $data['token'] = $token;
        $rs = $this->_db->add($data);
        if (false !== $rs) {
            $re = array(
                'lottery_count' => array('exp', '`lottery_count`+1'),
                'integral' => array('exp', '`integral`+' . $config['task_sign_integral']));
            M('user')->where(array('id' => $userId))->setInc($re);
            $rd['status'] = 1;
        }
        return $rd;
    }

    public function nowGetIntegral($userId)
    {
        //获取当天0点时间戳
        $dayTime = strtotime(date('Y-m-d'));
        $sum = $this->_db->where(array('user_id' => $userId, 'status' => 1, 'create_time' => array('EGT', $dayTime)))->sum('integral');
        return $sum;
    }

    //转发任务
    public function isShareArticle($userId)
    {
        $dayTime = strtotime(date('Y-m-d'));
        $result = $this->_db->where(array('user_id' => $userId, 'integral_type' => 5, 'create_time' => array('EGT', $dayTime)))->find();
        return $result ? true : false;
    }

    //阅读任务
    public function isReadByTask($userId)
    {
        $dayTime = strtotime(date('Y-m-d'));
        $result = $this->_db->where(array('user_id' => $userId, 'integral_type' => 6, 'create_time' => array('EGT', $dayTime)))->find();
        return $result ? true : false;
    }

    //评论任务
    public function isCommentByTask($userId)
    {
        $dayTime = strtotime(date('Y-m-d'));
        $result = $this->_db->where(array('user_id' => $userId, 'integral_type' => 7, 'create_time' => array('EGT', $dayTime)))->find();
        return $result ? true : false;
    }

    //邀请任务
    public function isInviteByTask($userId)
    {
        $dayTime = strtotime(date('Y-m-d'));
        $result = $this->_db->where(array('user_id' => $userId, 'integral_type' => 8, 'create_time' => array('EGT', $dayTime)))->find();
        return $result ? true : false;
    }
}
