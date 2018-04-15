<?php
namespace Common\Model;
use Think\Model;

class ParentingModel extends Model{
    public function __construct()
    {
        $this->_db = M('parenting');
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

    public function getList($where = array())
    {
        $list = $this->_db->order('create_time desc')->field('id,cate_id,title,image,create_time,original_price,price,tag,is_voucher,is_coupon,org_id,check_status,err_msg')->where($where)->select();
        return $list;
    }

    //上架活动列表
    public function getUpList($limit = 0,$where=array())
    {
        if ($limit == 0) {
            $list = $this->_db->where($where)->order('create_time desc')->field('id,cate_id,title,image,create_time,original_price,price,tag,is_voucher,is_coupon,org_id,city,area,address')->select();
        } else {
            $list = $this->_db->where($where)->order('create_time desc')->field('id,cate_id,title,image,create_time,original_price,price,tag,is_voucher,is_coupon,org_id,city,area,address')->limit($limit)->select();
        }
        return $list;
    }

    public function getUpListById($limit = 0,$where = array())
    {
        if ($limit == 0) {
            $list = $this->_db->order('create_time desc')->field('id,cate_id,title,image,create_time,original_price,price,tag,is_voucher,is_coupon,org_id,city,area,address')->where($where)->select();
        } else {
            $list = $this->_db->order('create_time desc')->field('id,cate_id,title,image,create_time,original_price,price,tag,is_voucher,is_coupon,org_id,city,area,address')->where($where)->limit($limit)->select();
        }
        return $list;
    }

    //下架产品列表
    public function getDownList()
    {
        $list = $this->_db->where(array('status' => 2))->select();
        return $list;
    }

    //下架产品
    public function soldOutById($id)
    {
        $id = $this->_db->where("id={$id}")->save(array('status' => 2));
        return $id;
    }

    //上架活动
    public function putAwayById($id)
    {
        $id = $this->_db->where("id={$id}")->save(array('status' => 1));
        return $id;
    }

    public function getListByPage($npage,$cateId)
    {
        if($cateId == 0 || empty($cateId)){
            $list = $this->_db->order('create_time desc')->field('id,cate_id,title,image,create_time,original_price,price,tag,is_voucher,is_coupon,org_id')->where(array('status' => 1))->limit($npage,6)->select();
        }else{
            $list = $this->_db->order('create_time desc')->field('id,cate_id,title,image,create_time,original_price,price,tag,is_voucher,is_coupon,org_id')->where(array('status' => 1,'cate_id' => $cateId))->limit($npage,6)->select();
        }
        return $list;
    }
}