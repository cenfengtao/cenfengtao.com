<?php
/**
 * 优惠券管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class CouponController extends CommonController
{
    public function getOfferList()
    {
        $org_id = M('organization')->where(['token' => $this->token])->getField('id');
        $list = D('coupon_offer')->where(['type' => 1, 'type_id' => $org_id, 'start_time' => ['lt', time()],
            'end_time' => ['gt', time()]])->select();
        $this->assign('list', $list);
        $this->display();
    }

    public function addCouponOffer()
    {
        if ($_POST) {
            if (!$_POST['title']) {
                return show(0, '标题不能为空');
            }
            if (!$_POST['start_time']) {
                return show(0, '开始时间不能为空');
            } else {
                $_POST['start_time'] = strtotime($_POST['start_time']);
            }
            if (!$_POST['end_time']) {
                return show(0, '结束时间不能为空');
            } else {
                $_POST['end_time'] = strtotime($_POST['end_time']) + 86399;
            }
            if (!$_POST['full'] || !$_POST['subtract']) {
                return show(0, '满减额度不能为空');
            }
            if (!$_POST['count'] || $_POST['count'] < 0) {
                return show(0, '库存不能为空');
            }
            try {
                $org_id = M('organization')->where(['token' => $this->token])->getField('id');
                if ($_POST['id']) {
                    return $this->save($_POST);
                }
                $data = [
                    'type' => 1,
                    'type_id' => $org_id,
                    'coupon_type' => 1
                ];
                $id = D('CouponOffer')->insert(array_merge($_POST, $data));
                if ($id) {
                    return show(1, '添加成功');
                } else {
                    return show(0, '添加失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            $this->display();
        }
    }

    public function editCouponOffer()
    {
        if (!$_GET['id']) {
            return show(0, '参数错误');
        }
        try {
            $offer = D('CouponOffer')->find($_GET['id']);
            $this->assign('offer', $offer);
            $this->display();
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function save($data)
    {
        try {
            $id = D('CouponOffer')->updateById($data['id'], $data);
            if ($id === false) {
                return show(0, '修改失败');
            }
            return show(1, '修改成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function cancelCouponOffer()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('CouponOffer')->updateById($_POST['id'], ['end_time' => time()]);
            if ($result) {
                return show(1, '取消成功');
            } else {
                return show(0, '取消失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
}