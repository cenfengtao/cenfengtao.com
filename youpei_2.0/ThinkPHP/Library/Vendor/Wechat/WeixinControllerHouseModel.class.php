<?php
/**
 * 微房产
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerHouseModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		$Estate = M('Estate')->where(array(
				'token' => $this->token
		))->find();
		return array(
				array(
					array(
						$Estate['title'],
						str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
						$Estate['cover'],
						C('site_url') . '/user.php?g=Wap&m=Estate&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
					)
				),
				'news'
		);
	}
}

?>