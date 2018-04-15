<?php
/**
 * 资源整合
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerFriendsModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		$Friends = M ( 'Friends' )->where ( array (
				'token' => $this->token
		) )->find ();
		return array (
				array (
						array (
								$Friends ['title'],
								$Friends ['keyword'],
								$Friends ['picurl'],
								C ( 'site_url' ) . '/user.php?g=User&m=FriendsMobile&a=friends&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName']
						)
				),
				'news'
		);
		
	}
}

?>