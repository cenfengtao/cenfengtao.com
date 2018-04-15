<?php
/**
 * 3D相册
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerPhotoModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		$photo = M ( 'Photo' )->where ( array (
				'token' => $this->token,
				'status' => 1 
		) )->find ();
		$data ['title'] = $photo ['title'];
		$data ['keyword'] = $photo ['info'];
		$data ['url'] = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Photo/index', array (
				'token' => $this->token,
				'wecha_id' => $this->data ['FromUserName'] 
		) );
		$data ['picurl'] = $photo ['picurl'] ? $photo ['picurl'] : rtrim ( C ( 'site_url' ), '/' ) . '/themes/Static/images/yj.jpg';
		return array (
				array (
						array (
								$data ['title'],
								$data ['keyword'],
								$data ['picurl'],
								$data ['url'] 
						) 
				),
				'news' 
		);
	}
}

?>