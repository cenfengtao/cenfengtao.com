<?php
/**
 * 首页
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerHomeModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		
		$home = M ( 'Home' )->where ( array (
				'token' => $this->token
		) )->find ();
		if ($home == false) {
			return array (
					'商家未做首页配置，请稍后再试',
					'text'
			);
		} else {
			$imgurl = $home ['picurl'];
			if ($home ['apiurl'] == false) {
				$url = rtrim ( C ( 'site_url' ), '/' ) . '/user.php?g=Wap&m=Index&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'];
			} else {
				$url = $home ['apiurl'];
			}
		}
		return array (
				array (
						array (
								$home ['title'],
								$home ['info'],
								$imgurl,
								$url
						)
				),
				'news'
		);
	}
}

?>