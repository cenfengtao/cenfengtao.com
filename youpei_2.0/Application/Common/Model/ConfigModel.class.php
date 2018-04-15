<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class ConfigModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('config');
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

      public function getrule($token){
        return $this->_db->where("token='{$token}'")->find();
       
    }

      public function add_user_integral($userid,$integral,$max_integral){
      // 今天已经获得的分数
       $fetched = $this->_db->where(array(
            'user_id' => $userid,
            'type' => 2,
            'create_time' => strtotime(date('Y-m-d'))
            ))->sum('integral');

        if ($max_integral == 0) {
             $data['integral'] = $integral;
         } else{
            $data['integral'] = min($integral, $max_integral - $fetched);
         }
      return $data;
    }
}
