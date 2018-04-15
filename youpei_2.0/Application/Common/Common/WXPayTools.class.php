<?php
namespace Common\Common;
class WXPayTools
{
    /**
     * 红包
     *
     * @author lpdx111
     * 开发日期 2015-4-28 下午2:48:14
     *
     */
    public static function redPacket($openid, $amount, $wishing = '恭喜你获得一个红包', $act_name = '活动', $act_type = '', $act_id = 0, $remark = '点击领取红包')
    {
        import("@.ORG.WxPay");
        $data = array();
        $data['open_id'] = $openid;
        $data['create_time'] = NOW_TIME;
        $data['act_type'] = $act_type;
        $data['act_id'] = $act_id;
        $data['act_title'] = act_title;
        $data['pay_uid'] = session('?uid') ? session('uid') : 0;
        $data['status'] = 0;
        $data['errcode'] = 0;
        $data['errmsg'] = '';
        $data['order_no'] = '';
        $data['amount'] = $amount;
        $payout_id = M('wxpayout_history')->add($data);
        Tools::log(array('sql' => M('wxpayout_history')->_sql(), 'data' => $data, 'payout_id' => $payout_id), __FILE__ . __LINE__);
        if ($payout_id) {
            $appInfo = get_app_info('g232238gc959', 'appid,partnerId,partnerKey,appsecret,wxpay_version,cert_file,sslkey_path,wxname,is_wxpay');
            $wxpay = WxPay::init($appInfo);
            Tools::log(array('appinfo' => $appInfo), __FILE__ . LINE__);
            if ($wxpay) {
                try {
                    $res = $wxpay->sendRedpacket($openid, $amount, $act_name, $remark, $wishing, $appInfo['wxname']);
                    Tools::log(array('RES' => $res), __FILE__ . __LINE__);
                    if ($res['code'] == 1) {
                        $data['status'] = 1;
                        $data['errcode'] = 0;
                        $data['errmsg'] = '成功';
                        $data['order_no'] = $res['order_no'];
                        $data['pay_id'] = $res['id'];
                    } else if ($res['code'] == 4) {
                        $data['status'] = 4;
                        $data['errcode'] = 0;
                        $data['errmsg'] = '查询结果';
                        $data['order_no'] = $res['order_no'];
                        $data['pay_id'] = $res['id'];
                        $result = $wxpay->fetchRedPacketStatus($res['order_no']);
                        if ($result['return_code']) {
                            $result['payout_id'] = $payout_id;
                            M('wxpayout_query_status')->add($result);
                        }
                    } else if ($res['err'] == '请求已受理，请稍后使用原单号查询发放结果') {
                        $data['status'] = 4;
                        $data['errcode'] = 0;
                        $data['errmsg'] = '查询结果';
                        $data['order_no'] = $res['order_no'];
                        $data['pay_id'] = $res['id'];
                        $res['code'] = 4;
                        $result = $wxpay->fetchRedPacketStatus($res['order_no']);
                        if ($result['return_code']) {
                            $result['payout_id'] = $payout_id;
                            M('wxpayout_query_status')->add($result);
                        }
                    } else {
                        $data['status'] = 2;
                        $data['errcode'] = $res['code'];
                        $data['errmsg'] = $res['err'];
                        $data['order_no'] = $res['order_no'];
                        $data['pay_id'] = $res['id'];
                    }
                    M('wxpayout_history')->where(array('id' => $payout_id))->save($data);
                    return $res;
                } catch (Exception $e) {
                    $data['status'] = 2;
                    $data['errcode'] = $e->getCode();
                    $data['errmsg'] = $e->getMessage();
                    $data['order_no'] = '';
                    M('wxpayout_history')->where(array('id' => $payout_id))->save($data);
                    return array('code' => 0, 'err' => $e->getMessage());
                }
            }
            return array('code' => 0, 'err' => '未开启微信支付功能或者支付api版本不正确!');
        }
        return array('code' => 0, 'err' => '保存支付记录出错');
    }

    /**
     * 转账
     */
    public static function transferAccounts($openid, $amount, $act_name = '活动', $act_type = '', $act_id = 0, $remark = '')
    {
        import("@.ORG.WxPay");
        $data = array();
        $data['open_id'] = $openid;
        $data['create_time'] = NOW_TIME;
        $data['act_type'] = $act_type;
        $data['act_id'] = $act_id;
        $data['act_title'] = $act_name;
        $data['amount'] = $amount;
        $data['pay_uid'] = session('?uid') ? session('uid') : 0;
        $data['status'] = 0;
        $data['errcode'] = 0;
        $data['errmsg'] = '';
        $data['order_no'] = '';
        $data['pay_type'] = 1;// 转账
        $payout_id = M('wxpayout_history')->add($data);
        if ($payout_id) {
            // $appInfo=get_app_info($token,'token,appid,partnerId,partnerKey,appsecret,wxpay_version,cert_file,sslkey_path,wxname,is_wxpay');
            $appInfo = get_app_info('g232238gc959', 'appid,partnerId,partnerKey,appsecret,wxpay_version,cert_file,sslkey_path,wxname,is_wxpay');
            $wxpay = WxPay::init($appInfo);
            if ($wxpay) {
                $res = $wxpay->transferAccounts($openid, $amount, $remark);
                if ($res['code'] == 1) {
                    $data['status'] = 1;
                    $data['errcode'] = 0;
                    $data['errmsg'] = '成功';
                    $data['order_no'] = $res['order_no'];
                    $data['pay_id'] = $res['id'];
                } else {
                    $data['status'] = 2;
                    $data['errcode'] = $res['code'];
                    $data['errmsg'] = $res['err'];
                    $data['order_no'] = $res['order_no'];
                    $data['pay_id'] = $res['id'];
                }
                M('wxpayout_history')->where(array('id' => $payout_id))->save($data);
                return $res;
            }
            return array('code' => 0, 'err' => '未开启微信支付功能或者支付api版本不正确!');
        }
        return array('code' => 0, 'err' => '保存支付记录出错');
    }

    // public static function fetchRedPacketStatus($token,$orderNo){
    // 	$appInfo=get_app_info($token,'token,appid,partnerId,partnerKey,appsecret,wxpay_version,cert_file,sslkey_path,wxname,is_wxpay');
    // 	$wxpay=WxPay::init($appInfo);
    // 	$status=$wxpay->fetchRedPacketStatus($orderNo);
    // 	return $status;
    // }
    public static function fetchRedPacketStatus($orderNo)
    {
        $appInfo = get_app_info('g232238gc959', 'appid,partnerId,partnerKey,appsecret,wxpay_version,cert_file,sslkey_path,wxname,is_wxpay');
        $wxpay = WxPay::init($appInfo);
        $status = $wxpay->fetchRedPacketStatus($orderNo);
        return $status;
    }
}
