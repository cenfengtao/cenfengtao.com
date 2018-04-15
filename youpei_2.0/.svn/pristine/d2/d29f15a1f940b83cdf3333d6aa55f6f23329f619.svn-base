<?php
/**
 * 摇一摇
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerShakeModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		
		$shakeInfo = M ( 'EventShakeInfo' )->where ( array (
				'token' => $this->token
		) )->find ();
		
		
		
		return array (
				array (
						array (
								$shakeInfo ['title'],
								$shakeInfo ['keyword'],
								$shakeInfo ['picurl'],
								C ( 'site_url' ) . '/user.php?g=Wap&m=Shake&a=yao_random&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName']
						)
				),
				'news'
		);
	}
}

?>