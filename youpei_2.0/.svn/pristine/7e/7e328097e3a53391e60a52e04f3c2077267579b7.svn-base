<?php
/**
 * 地图
 * @author jxiao
 */
import("Vendor.Wechat.WeixinControllerModel");
use Common\Controller\Wechat;

class WeixinControllerMapModel extends WeixinControllerModel {
	public function _reply() {
		$data = $this->data;
		$key = $data ['Content'];
		if ($this->data ['Location_X']) {
			$this->recordLastRequest ( $this->data ['Location_Y'] . ',' . $this->data ['Location_X'], 'location' );
			$this->isDone = true;
			return $this->map ( $this->data ['Location_X'], $this->data ['Location_Y'] );
		}
		if (! (strpos ( $key, '开车去' ) === FALSE) || ! (strpos ( $key, '坐公交' ) === FALSE) || ! (strpos ( $key, '步行去' ) === FALSE)) {
			$this->isDone = true;
			$this->recordLastRequest ( $key );
			$user_request_model = M ( 'User_request' );
			$loctionInfo = $user_request_model->where ( array (
					'token' => $this->token,
					'msgtype' => 'location',
					'uid' => $this->data ['FromUserName'] 
			) )->find ();
			if ($loctionInfo && intval ( $loctionInfo ['time'] > (time () - 60) )) {
				$latLng = explode ( ',', $loctionInfo ['keyword'] );
				return $this->map ( $latLng [1], $latLng [0] );
			}
			return array (
					'请发送您所在的位置',
					'text' 
			);
		}
	}
}

?>