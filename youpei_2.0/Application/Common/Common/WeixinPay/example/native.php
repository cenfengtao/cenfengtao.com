<?php
ini_set('date.timezone', 'Asia/Shanghai');
//error_reporting(E_ERROR);

require_once __DIR__ . "/../lib/WxPay.Api.php";
require_once __DIR__ . "/WxPay.NativePay.php";
require_once __DIR__ . '/log.php';

if (!$_GET['fee'] || $_GET['fee'] <= 0) {
    echo "<script>alert('请输入正确的金额');window.history.go(-1);</script>";
} else {
    //插入微信记录表
    $data['fee'] = $_GET['fee'];
    $data['title'] = '面对面支付';
    $data['body'] = '面对面支付';
    $data['vip_id'] = $this->user['id'];
    $data['out_trade_no'] = WxPayConfig::MCHID . '-' . date("YmdHis") . '-' . $this->user['id'];
    $data['type'] = 2;
    $data['pay_type'] = 1;
    $data['create_time'] = time();
    $data['remark'] = $_GET['detail'] ? $_GET['detail'] : '';
    $recordId = M('wxpay_record')->data($data)->add();
    $record = M('wxpay_record')->where('id=' . $recordId)->find();
    /**
     * 流程：
     * 1、调用统一下单，取得code_url，生成二维码
     * 2、用户扫描二维码，进行支付
     * 3、支付完成之后，微信服务器会通知支付成功
     * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
     */
    $notify = new NativePay();
    $input = new WxPayUnifiedOrder();
    $input->SetBody($record['body']);
    $input->SetAttach($record['title']);
    $input->SetOut_trade_no($record['out_trade_no']);
    $input->SetTotal_fee($record['fee'] * 100);
    $input->SetTime_start(date("YmdHis"));
    $input->SetTime_expire(date("YmdHis", time() + 600));
    $input->SetGoods_tag("test");
    $input->SetNotify_url("http://" . $_SERVER['HTTP_HOST'] . "/wechat.php/Wxpay/notify");
    $input->SetTrade_type("NATIVE");
    $input->SetProduct_id($recordId . time());
    $result = $notify->GetPayUrl($input);
    $url2 = $result["code_url"];
}
//?>
