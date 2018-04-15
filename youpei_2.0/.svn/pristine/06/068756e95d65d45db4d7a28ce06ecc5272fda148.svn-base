<?php
/**
 * 贺卡
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerGreetingCardsModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		$shakeInfo = M ( 'GreetingCards' )->where ( array (
				'token' => $this->token
		) )->find ();
		return array (
				array (
						array (
								$shakeInfo ['title'],
								$shakeInfo ['keyword'],
								$shakeInfo ['picurl'],
								C ( 'site_url' ) . '/user.php?g=User&m=propagandaMobile&a=makeHeka&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName']
						)
				),
				'news'
		);
		
	}
}

?>