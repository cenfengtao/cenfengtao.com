<?php
ini_set('date.timezone', 'Asia/Shanghai');
//error_reporting(E_ERROR);
require_once __DIR__ . "/../lib/WxPay.Api.php";
require_once __DIR__ . "/WxPay.JsApiPay.php";
require_once __DIR__ . '/log.php';

//初始化日志
$logHandler = new CLogFileHandler("../logs/" . date('Y-m-d') . '.log');
$log = LogByWx::Init($logHandler, 15);
if (!session($this->user['id'] . '-orderId') || !is_numeric(session($this->user['id'] . '-orderId'))) {
    echo "<script type='text/javascript'>alert('该订单已失效，请重新下单');window.location.href=
    'http://" . $_SERVER['HTTP_HOST'] . "/wechat.php/Shop/index'</script>";
    return;
}
//获取订单
$orderId = session($this->user['id'] . '-orderId');
$order = M('product_order')->where('id=' . $orderId)->find();
$record = M('wxpay_record')->where('pro_order_id=' . $order['id'])->find();
if ($order['total_fee'] < 0) {
    $this->ajaxReturn(array('status' => 0, 'msg' => '支付参数不合法'));
}
//判断订单的使用积分是否还有效
if ($order['use_integral'] > 0) {
    $nowIntegral = M('vip')->where('id=' . $order['vip_id'])->getField('integral');
    if ($order['use_integral'] > $nowIntegral) {
        $this->ajaxReturn(array('status' => 0, 'msg' => '可用积分已发生变动，请重新下单'));
    }
}
if ($order['pay_fee'] > 0) {
    if (!$record) {
        //插入微信支付记录表
        $data['fee'] = $order['pay_fee'];
        $data['title'] = '商城支付';
        $data['body'] = '商城支付';
        $data['vip_id'] = $this->user['id'];
        $data['out_trade_no'] = WxPayConfig::MCHID . '-' . date("YmdHis") . '-' . $this->user['id'];
        $data['type'] = 1;
        $data['pay_type'] = 1;
        $data['create_time'] = time();
        $data['pro_order_id'] = $order['id'];
        $recordId = M('wxpay_record')->data($data)->add();
        $record = M('wxpay_record')->where('id=' . $recordId)->find();
    }
//生成支付 ①、获取用户openid
    $tools = new JsApiPay();
    $openId = $tools->GetOpenid();
//②、统一下单
    $input = new WxPayUnifiedOrder();
    $input->SetBody($record['body']);
    $input->SetAttach($record['title']);
    $input->SetOut_trade_no($record['out_trade_no']);
    $input->SetTotal_fee($record['fee'] * 100);
    $input->SetTime_start(date("YmdHis"));
    $input->SetTime_expire(date("YmdHis", time() + 600));
    $input->SetGoods_tag("test");
    $input->SetNotify_url("http://" . $_SERVER['HTTP_HOST'] . "/wechat.php/Wxpay/notify");
    $input->SetTrade_type("JSAPI");
    $input->SetOpenid($openId);
    $orderByWechat = WxPayApi::unifiedOrder($input);
    $jsApiParameters = $tools->GetJsApiParameters($orderByWechat);
}

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>优培圈</title>
    <style>
        * {
            color: black;
        }

        .order-content ul li {
            list-style: none;
            font-size: 1.1em;
            line-height: 2em;
        }

        .order-content ul li span {
            font-weight: 600;
        }

        .img-logo {
            width: 100%;
            height:130px;
            background: url(../../../../../Public/api/logo.jpg) no-repeat center center;
            background-size: 80%;
        }
    </style>
</head>
<body>
<br/>
<input type="hidden" id="out_no" value="<?php echo $record['out_trade_no']; ?>">
<div class="img-logo"></div>
<!--<img class="img-logo" src="../../../../../Public/api/logo.jpg" alt="">-->
<div class="order-content">
    <ul>
        <li>商品名称：&nbsp;<span><?php echo $order['product_title'] ?></span></li>
        <li>商品数量：&nbsp;<span><?php echo $order['amount']; ?></span></li>
        <li>商品原价：&nbsp;<span><?php echo $order['total_fee']; ?> 元</span></li>
        <li>积分抵扣：&nbsp;<span id="integral_pay"><?php echo round($order['use_integral'] / 100,2); ?></span><span> 元</span></li>
        <li>课程券抵扣：&nbsp;<span><?php echo $order['coupon_fee']; ?></span><span> 元</span></li>
        <li>支付总额：&nbsp;<span id="need_pay"><?php echo $order['pay_fee']; ?></span><span> 元</span></li>
    </ul>
</div>
<div align="center">
    <button
        style="width:210px; height:50px; border-radius: 15px;background-color:#0066FF; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;"
        type="button" onclick="callpay()">立即支付
    </button>
    <button type="button" style="margin-top:10px;margin-bottom:20px;width:210px;height:40px;border-radius: 10px;border:0px #FE6714 solid;background-color:red;cursor: pointer;  color:white;  font-size:14px;" onclick="cancelOrder()">
        取消订单
    </button>
    <input type="hidden" id="order_id" value="<?php echo $order['id']; ?>">
    <input type="hidden" id="out_no" value="<?php echo $record['out_trade_no'] ? $record['out_trade_no'] : ''; ?>">
</div>
<script type="text/javascript" src="../../../../../Public/Static/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
    //调用微信JS api 支付
    function jsApiCall() {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            <?php echo $jsApiParameters ? $jsApiParameters : '0';?>,
            function (res) {
                WeixinJSBridge.log(res.err_msg);
            }
        );
    }

    function callpay() {
        var need_pay = document.getElementById('need_pay').innerHTML;
        var integral = document.getElementById('integral_pay').innerHTML;
        var orderId = $("#order_id").val();
        if (need_pay > 0) {
            if (typeof WeixinJSBridge == "undefined") {
                if (document.addEventListener) {
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                } else if (document.attachEvent) {
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            } else {
                jsApiCall();
            }
        } else {
            if (integral <= 0) {
                return alert('违法参数');
            }
            $.post("http://" + window.location.host + "/wechat.php/Wxpay/finishByIntegral", {
                integral: integral * 100, orderId: orderId
            }, function (result) {
                if (result.status == 1) {
                    alert(result.msg);
                    window.location.href = "http://" + window.location.host + "/wechat.php/Shop/Purchase_record";
                } else {
                    alert(result.msg);
                }
            }, 'json');
        }
    }

    var begin = window.setInterval("check()", 5000);
    function check() {
        var out_no = $("#out_no").val();
        var integral = document.getElementById('integral_pay').innerHTML;
        if (out_no == '') {
            return window.clearInterval(begin);
        }
        $.post("http://" + window.location.host + "/wechat.php/Wxpay/check",
            {out_trade_no: out_no, integral: integral * 100}, function (result) {
                if (result.status == 0) {
                    alert(result.msg);
                    window.history.go(-1);
                }
                if (result.status == 1) {
                    alert(result.msg);
                    window.clearInterval(begin);
                    window.location.href = "http://" + window.location.host + "/wechat.php/Shop/Purchase_record";
                }
            }, 'json')
    }
    
    function cancelOrder() {
        var orderId = $("#order_id").val();
        var out_no = $("#out_no").val();
        $.post("http://" + window.location.host + "/wechat.php/Wxpay/cancelOrder",{orderId:orderId,out_trade_no:out_no},function (result) {
            if(result.status == 0){
                alert(result.msg);
                setTimeout(function () {
                    window.history.go(-1);
                }, 1000);
            } else {
                alert(result.msg);
                setTimeout(function () {
                    window.history.go(-1);
                }, 1000);
            }
        },'json')
    }
</script>
</body>
</html>