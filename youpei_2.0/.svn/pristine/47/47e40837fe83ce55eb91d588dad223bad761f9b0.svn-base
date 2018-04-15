<?php
/**
 * 第三方api
 * @author lpdx111
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerAssessApiModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone=true;
		
		$assess=	M('ApiAssess')->where(array('wecha_id'=>$this->data ['FromUserName'] ))->find();
		if($assess){
			return $this->respText("账号：".$assess['no'].PHP_EOL."密码:".$assess['password'].PHP_EOL."网址:http://oa.ooyyee.org");
		}else{
			//调用接口
			$url = 'http://oa.ooyyee.org/account_get.asp';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1');
			$data = curl_exec($ch);
			$status = curl_getinfo($ch);
			$errno = curl_errno($ch);
			curl_close($ch);
			$response = array();
			if ($status['http_code'] == 200) {
				$array=json_decode($data,true);
				$assess['no']=$array['user'];
				$assess['password']=$array['pass'];
				$assess['wecha_id']=$this->data ['FromUserName'];
				$assess['token']=$this->token;
				M('ApiAssess')->add($assess);
				return $this->respText("账号：".$assess['no'].PHP_EOL."密码:".$assess['password'].PHP_EOL."网址:http://oa.ooyyee.org");
			}else{
				return $this->respText("获取账号失败,请稍后再试");
			}
		}
	}
	private function respText($text){
		return array($text,'text');
	}
}

?>