<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class CouponController extends BaseController
{
    //扫码折扣专区
    public function qrcodeSaleArea()
    {
        $this->display();
    }

    public function ajaxQrcodeSaleArea()
    {
        if (!$_GET['qrcodeId'] || !$_GET['sort']) {
            return show(0, '参数错误');
        }
        //判断是否有资格购买该折扣商品
        switch ($_GET['sort']) {
            case 1 :
                $templateTimeStr = 'template_a_times';
                break;
            case 2 :
                $templateTimeStr = 'template_b_times';
                break;
            case 3 :
                $templateTimeStr = 'template_c_times';
                break;
            default:
                return show(0, '参数错误');
        }
        $sceneId = M('qrcode')->where(['id' => $_GET['qrcodeId']])->getField('scene_id');
        $scanQuantity = M('scan_reply')->where(['scene_id' => $sceneId])->getField($templateTimeStr);
        //查询扫码次数
        $scanCount = M('qrcode_record')->where(['scene_id' => $sceneId, 'share_user_id' => $this->user['id']])->count();
        if ($scanCount < $scanQuantity) {
            return show(0, '你的助力次数不足，赶快邀请更多好友吧');
        }
        $isOrder = M('order')->where(['qrcode_id' => $_GET['qrcodeId'], 'template_number' => $_GET['sort'],
            'user_id' => $this->user['id'], 'status' => array(['eq', 0], ['eq', 1], ['eq', 4], 'or')])->getField('id');
        if ($isOrder) {
            return show(2, '你已经购买过了');
        }
        $list = M('qrcode_sale')->where(['qrcode_id' => $_GET['qrcodeId'], 'template_number' => $_GET['sort'], 'count' => ['gt', 0]])->select();
        foreach ($list as $k => $v) {
            $product = M('product')->where(['id' => $v['type_id']])->field('title,f_title,pic_url,price')->find();
            $prices = json_decode($product['price'], true);
            $originalPrice = $prices[$v['key']]['now_price'];
            $list[$k]['title'] = $product['title'];
            $list[$k]['f_title'] = $product['f_title'];
            $list[$k]['image'] = $product['pic_url'];
            $list[$k]['original_price'] = $originalPrice;
        }
        $data = [
            'list' => $list,
        ];
        return show(1, '获取成功', $data);
    }

    public function integralSaleArea()
    {
        $this->display();
    }

    public function ajaxIntegralSaleArea()
    {
        $list = M('bargain')->where(['type' => 4, 'extra' => 1])->select();
        foreach ($list as $k => $v) {
            $product = M('product')->where(['id' => $v['type_id']])->field('title,f_title,pic_url,price')->find();
            $prices = json_decode($product['price'], true);
            $originalPrice = $prices[$v['key']]['now_price'];
            $list[$k]['title'] = $product['title'];
            $list[$k]['f_title'] = $product['f_title'];
            $list[$k]['image'] = $product['pic_url'];
            $list[$k]['original_price'] = $originalPrice;
            $list[$k]['price'] = intval($v['price']);
        }
        $data = [
            'list' => $list,
        ];
        return show(1, '获取成功', $data);
    }
}