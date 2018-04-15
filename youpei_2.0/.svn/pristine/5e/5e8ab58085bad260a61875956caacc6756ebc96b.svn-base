<?php
namespace Common\Common;
use Common\Common\WxpayV3\WxPayConfig;
use Common\Common\WxpayV3\WxSendRedpack;
use Common\Common\WxpayV3\WxPayApi;
define ( 'WEB_ROOT_PATH', dirname(__FILE__) . '/');
class WxPay {

	public $_config = null;
	public $_wxpay_version = 0;
	public $api = null;
	public $isInit = false;
	/**
	 * 初始化
	 * @param unknown $config
	 * appid,appsecret,partnerId,partnerKey,cert_file,sslkey_path,token,wxname,is_wxpay
	 * partnerId = mchid
	 * partnerKey = 支付签名
	 * cert_file 	= apiclient_cert.pem
	 * sslkey_path 	= apiclient_key.pem
	 */
	static function init($config){
		/*初始化*/
		if($config['is_wxpay'] !=1) {
			return false;
		}
		$obj = new WxPay();
		$obj->_wxpay_version = $config['wxpay_version'];
		$obj->_config = $config;
		require_once dirname(__FILE__)."/WxpayV3/WxPay.Exception.php";
		require_once dirname(__FILE__)."/WxpayV3/WxPay.Config.php";
		require_once dirname(__FILE__)."/WxpayV3/WxPay.Data.php";
		require_once dirname(__FILE__)."/WxpayV3/WxPay.Api.php";
		$WxPayConfig = new WxPayConfig();
		$WxPayConfig::$APPID 		= $config['appid'];
		$WxPayConfig::$APPSECRET 	= $config['appsecret'];
		$WxPayConfig::$MCHID 		= $config['partnerid'];
		$WxPayConfig::$KEY 			= $config['partnerkey'];
		$WxPayConfig::$SSLCERT_PATH  = WEB_ROOT_PATH.'cert/g232238gc959/'.$config['cert_file'];
		$WxPayConfig::$SSLKEY_PATH   = WEB_ROOT_PATH.'cert/g232238gc959/'.$config['sslkey_path'];
		foreach (array('appid','appsecret','partnerid','partnerkey','cert_file','sslkey_path') as $k) {

			//echo $k.":".$config[$k]."<br/>";
			if(!$config[$k]) {
				return false;
			}
		}
		//echo WxPayConfig::$SSLCERT_PATH ;
		//exit;
		$obj->isInit = true;

		return $obj;
	}
		
	/* 发放红包 */
	/*
	 * 1. 发送频率规则
　		◆　每分钟发送红包数量不得超过1800个；
　		◆　北京时间0：00-8：00不触发红包赠送；（如果以上规则不满足您的需求，请发邮件至wxhongbao@tencent.com获取升级指引）
		2. 红包规则
　		◆　单个红包金额介于[1.00元，200.00元]之间；
　		◆　同一个红包只能发送给一个用户；（如果以上规则不满足您的需求，请发邮件至wxhongbao@tencent.com获取升级指引）
	 */
	function sendRedpacket($openid,$amount,$act_name,$remark,$wishing,$send_name = '',$nick_name = ''){
		if($this->isInit && $this->_config['is_wxpay'] == 1 && $this->_wxpay_version >= 3) {	
			
			$billNo = $this->getBillNo();
			$input 	= new WxSendRedpack();
			$input->setMch_billNo($billNo);
			$input->setRe_openid($openid);
			$amount = $amount * 100;
			$input->SetTotal_amount($amount);
			$send_name = $send_name ? : $this->_config['wxname'];
			$nick_name = $nick_name ? : $send_name;
			$input->SetNick_name($nick_name);
			$input->SetSend_name($send_name);
			$input->SetWishing($wishing);
			$input->SetAct_name($act_name);
			$input->SetRemark($remark);		
			$result = WxPayApi::sendRedPack($input);
			$return = $this->_parseResult($result);
			$id = $this->_log(__FUNCTION__,$openid,$amount,$input->GetValues(),$result,$return);
        
			return array('code'=>$return['code'],'err'=>$return['error'],'id'=>$id,'order_no'=>$result['mch_billno']);
		}
		return array('code'=>0,'err'=>'未3开启微信支付功能或者支付api版本不正确!');
	}
	
	
	function fetchRedPacketStatus($orderNo){
		if($this->isInit && $this->_config['is_wxpay'] == 1 && $this->_wxpay_version >= 3) {
			$input 	= new WxRedpackQuery();
			$input->setMch_billNo($orderNo);
			$input->SetBill_type('MCHT');
			$result = WxPayApi::fetchRedPacketStatus($input);
			return $result;
		}
		return array('code'=>0,'err'=>'未1开启微信支付功能或者支付api版本不正确!');
	}
	
	
	/* 转账  */
	function transferAccounts($openid,$amount,$remark) {
		if($this->isInit && $this->_config['is_wxpay'] == 1 && $this->_wxpay_version >= 3) {
			$billNo =  $this->getBillNo();
			$input = new WxPromotionTtransfersTransfers();
			$input->SetPartner_trade_no($billNo);
			$input->SetOpenid($openid);
			$amount = $amount * 100;
			$input->SetAmount($amount);
			$input->SetDesc($remark);
			$result = WxPayApi::promotionTtransfers($input);
			$return = $this->_parseResult($result);
			$id = $this->_log(__FUNCTION__,$openid,$amount,$input->GetValues(),$result,$return);
			return array('code'=>$return['code'],'err'=>$return['error'],'id'=>$id,'order_no'=>$result['partner_trade_no']);
		}
		return array('code'=>0,'err'=>'未2开启微信支付功能或者支付api版本不正确!');
	}
	
	
	function getBillNo(){
		$WxPayConfig = new WxPayConfig();
		return $WxPayConfig::$MCHID .date('YmdHis').mt_rand(1000, 9999);
	}
	
	protected function _parseResult($result){
// 		Tools::log($result,__FILE__.__LINE__);
		if($result['return_code'] == 'SUCCESS') {
			if($result['result_code'] == 'SUCCESS') {
				return array('code'=>1,'error'=>'');	
			} else {
				if($result['error_code']=='SYSTEMERROR'){
					return array('code'=>4,'error'=>$result['err_code_des']);
				}else{
					return array('code'=>2,'error'=>$result['err_code_des']);
				}
			}
		} else {
			return array('code'=>3,'error'=>$result['return_msg']);
		}
	}
	
	protected function _log($api,$openid,$amount,$body,$result,$return) {
		$data = array();
		$data['api'] 	= $api;
		$data['openid'] = $openid;
		$data['body'] 	= serialize($body);
		$data['result'] 	= serialize($result);
		$data['ctime'] 	= NOW_TIME;
		$data['code'] = $return['code'];
		$data['error'] = $return['error'];
		$data['amount'] = $amount;
		return M('wxpay_api_log')->add($data);
	}
}