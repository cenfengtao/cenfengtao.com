<?php
/**
 * 最近
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerLbsModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		$user_request_model = M ( 'User_request' );
		$loctionInfo = $user_request_model->where ( array (
				'token' => $this->_get ( 'token' ),
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

?>