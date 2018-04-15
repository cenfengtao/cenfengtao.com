<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class PayRecordModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('pay_record');
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

    public function getRecordByOrderId($orderId)
    {
        $record = $this->_db->where("order_id={$orderId}")->find();
        return $record;
    }

    public function getRecordByOutNo($outTradeNo)
    {
        $record = $this->_db->where("out_trade_no='{$outTradeNo}'")->find();
        return $record;
    }

    public function getListForPay($where, $page, $pageSize = 10, $field = '*')
    {
        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($where)->field($field)->limit($offset, $pageSize)->order('id desc')->select();
        return $list;
    }

    public function getCount($where = array())
    {
        return $this->_db->where($where)->order('id desc')->count();
    }
}
