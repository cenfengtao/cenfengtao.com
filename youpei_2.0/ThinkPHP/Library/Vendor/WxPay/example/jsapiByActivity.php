<?php
ini_set('date.timezone', 'Asia/Shanghai');
//error_reporting(E_ERROR);
require_once __DIR__ . "/../lib/WxPay.Api.php";
require_once __DIR__ . "/WxPay.JsApiPay.php";
require_once __DIR__ . '/log.php';

//初始化日志
$logHandler = new CLogFileHandler("../logs/" . date('Y-m-d') . '.log');
$log = LogByWx::Init($logHandler, 15);

if (!$_GET['orderId'] || !is_numeric($_GET['orderId'])) {
    $this->error('订单ID参数错误');
}
//获取订单
$order = D('Order')->find($_GET['orderId']);
if ($order['status'] != 0) {
    $this->error('订单状态已发生改变，请重新下单');
}
$activity = D("OrganizationActivity")->find($order['activity_id']);
$record = D('PayRecord')->getRecordByOrderId($order['id']);
if ($order['real_price'] < 0) {
    $this->ajaxReturn(array('status' => 0, 'msg' => '支付参数不合法'));
}

//判断订单的优惠券是否还有效
if (!empty($order['coupon_id'])) {
    $coupon = M('coupon')->where("id={$order['coupon_id']}")->find();
    $offer = D('CouponOffer')->find($coupon['offer_id']);
    if (time() > $offer['end_time'] || !in_array($coupon['status'], [1, 2])) {
        D('Order')->updateById($order['id'], array('status' => 2, 'end_time' => time()));
        $this->error('优惠券已失效，请重新下单');
    }
}
//判断代金券是否还有效
if (!empty($order['cash_coupon_id'])) {
    $cashCouponIds = explode(',', $order['cash_coupon_id']);
    foreach ($cashCouponIds as $val) {
        $coupon = M('coupon')->where("id={$val}")->find();
        $offer = D('CouponOffer')->find($coupon['offer_id']);
        if (time() > $offer['end_time'] || !in_array($coupon['status'], [1, 2])) {
            D('Order')->updateById($order['id'], array('status' => 2, 'end_time' => time()));
            $this->error('优惠券已失效，请重新下单');
        }
    }
}

if ($order['real_price'] > 0) {
    if (!$record) {
        //插入支付记录表
        $recordData = [
            'user_id' => $this->user['id'],
            'out_trade_no' => rand(1000, 9999) . '-' . date("YmdHis") . '-' . $this->user['id'],
            'title' => '优培圈商城支付',
            'body' => '优培圈商城支付',
            'fee' => $order['real_price'],
            'status' => 0,
            'type' => 1,
            'create_time' => time(),
            'pay_type' => 2,
            'order_id' => $order['id'],
            'token' => $order['token'],
        ];
        $recordId = D('PayRecord')->insert($recordData);
        $record = D('PayRecord')->find($recordId);
    }
    //生成支付 ①、获取用户openid
    $tools = new JsApiPay();
    $openId = $this->user['open_id'];
//②、统一下单
    $input = new WxPayUnifiedOrder();
    $input->SetBody($record['body']);
    $input->SetAttach($record['title']);
    $input->SetOut_trade_no($record['out_trade_no']);
    $input->SetTotal_fee($record['fee'] * 100);
    $input->SetTime_start(date("YmdHis"));
    $input->SetTime_expire(date("YmdHis", time() + 600));
    $input->SetGoods_tag("test");
    $input->SetNotify_url("http://" . $_SERVER['HTTP_HOST'] . "/index.php/WxPay/notify");
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
    <link href="/Public/Home/css/common.css" rel="stylesheet" type="text/css">
    <link href="/Public/Home/css/index.css" rel="stylesheet" type="text/css">
    <style>
        * {
            color: black;
        }

        body {

            margin: 0 auto;
        }

        .order-content ul li::before {
            color: #000;
            content: "·";
            float: left;
            font-size: 2rem;
            line-height: 3rem;
            list-style-position: inside;
            list-style-type: disc;
            margin-right: .3rem;
            position: relative;
            text-align: center;
        }

        .order-content ul li {
            list-style: none;
            font-size: 1.1em;
            line-height: 3rem;
            border-bottom: .5px solid #bbbbbb;
            width: 90%;
            color: #3d3d3d;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .order-content ul li span {
            font-weight: bold;
            color: #4e4e4e;
        }

        .order-content ul li:nth-child(1) span {
            color: #356887;

        }

        .order-content ul li:nth-child(6) span {
            color: #356887;

        }

        .img-logo {
            margin-top: 2rem;
            width: 100%;
            height: 130px;
            background: url(../../../../../Public/images/logo.jpg) no-repeat center center;
            background-size: 80%;
        }
          [data-ty-target], [data-ty-url], [class*="btn"] {
            cursor: auto;
        }
         .twobtn {
            margin-top: 2rem;
            border-top: 5px solid #d9d9d9;
            background: #f1f1f1;
            width: 100%;
        }
        .twobtn1 {
            background: #f1f1f1;
            width: 100%;
        }
        .qr-submit {
            margin: 1rem auto;
            background-color: #ef3f56;
            padding: 5px 50px;
            font-size: 1.6rem;
            letter-spacing: 2px;
            text-decoration: none;
            border: 2px solid #c03143;
            border-radius: 5px;
            color: #ffffff;
            display: inline-block;
            cursor: pointer;
            text-align: center;
            font-weight: bold;
            width: auto;
        }

        .qx-submit {
            margin: 1rem auto;
            background-color: #bbbbbb;
            padding: 5px 50px;
            font-size: 1.6rem;
            letter-spacing: 2px;
            text-decoration: none;
            border: 2px solid #bbbbbb;
            border-radius: 5px;
            color: #ffffff;
            display: inline-block;
            cursor: pointer;
            text-align: center;
            font-weight: bold;
            width: auto;
        }
    </style>

</head>
<body>
<div class="kap-top ty-menu-top">
    <div id="tools_msg" class="ty-tools ty-tools-inner ty-tools-current">
        <span class="title">优培圈<span class="num"></span></span>
        <a href="javascript:void(0);" onclick="history.go(-1);" class="btn left btn-user" title="返回" data-icon="ɒ"></a>

    </div>
</div>
<input type="hidden" id="out_no" value="<?php echo $record['out_trade_no']; ?>">
<div class="img-logo"></div>
<div class="order-content">
    <ul>
        <li>商品名称：&nbsp;<span><?php echo $activity['title'] ?></span></li>
        <li>商品数量：&nbsp;<span><?php echo $order['amount'] . '人'; ?></span></li>
        <li>商品总价：&nbsp;<span>￥<?php echo $order['total_price']; ?> 元</span></li>
        <li>代金券抵扣：&nbsp;<span>￥<?php echo $order['cash_coupon_price']; ?></span><span> 元</span></li>
        <li>优惠券抵扣：&nbsp;<span>￥<?php echo $order['coupon_price']; ?></span><span> 元</span></li>
        <li>积分抵扣：&nbsp;<span>￥<?php echo $order['integral']/100; ?></span><span> 元</span></li>
        <li>支付总额：&nbsp;￥<span id="need_pay"><?php echo $order['real_price']; ?></span><span> 元</span></li>
    </ul>
</div>
<div align="center" class="twobtn">
    <button type="button" class="qr-submit" onclick="callpay()">立即支付
    </button>
</div>
<div align="center" class="twobtn1"> 
    <button type="button" class="qx-submit" onclick="cancelOrder()">
        取消订单
    </button>
    <input type="hidden" id="order_id" value="<?php echo $order['id']; ?>">
    <input type="hidden" id="out_no" value="<?php echo $record['out_trade_no'] ? $record['out_trade_no'] : ''; ?>">
</div>
<script type="text/javascript" src="../../../../../Public/js/jquery-1.10.2.min.js"></script>
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
            $.post("http://" + window.location.host + "/index.php/WxPay/finishByCoupon", {orderId: orderId}, function (result) {
                if (result.status == 1) {
                    alert(result.msg);
                    window.location.href = "http://" + window.location.host + "/index.php/Orders/queryDeliveryByPage";
                } else {
                    alert(result.msg);
                    window.location.href = "http://" + window.location.host + "/index.php/Orders/queryPayByPage";
                }
            }, 'json');
        }
    }

    var begin = window.setInterval("check()", 5000);
    function check() {
        var out_no = $("#out_no").val();
        if (out_no == '') {
            return window.clearInterval(begin);
        }
        $.post("http://" + window.location.host + "/index.php/WxPay/check",
            {out_trade_no: out_no}, function (result) {
                if (result.status == 0) {
                    alert(result.msg);
                    window.history.go(-1);
                }
                if (result.status == 1) {
                    alert(result.msg);
                    window.clearInterval(begin);
                    window.location.href = "http://" + window.location.host + "/index.php/Orders/queryDeliveryByPage";
                }
            }, 'json')
    }

    function cancelOrder() {
        if (confirm("是否确认取消订单？")) {
            var orderId = $("#order_id").val();
            $.post("http://" + window.location.host + "/index.php/Orders/cancelOrder", {
                order_id: orderId
            }, function (result) {
                if (result.status == 0) {
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
            }, 'json')
        }
    }
</script>
</body>
</html>