<?php
/**
 * 订餐
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerMealModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		$pro = M ( 'ReplyRule' )->where ( array (
				'module' 	=> "ProductDining",
				'group'		=> 'Wap',
				'action'	=> 'index',
				'token' => $this->token
		) )->find ();
		if($pro) {
			$data['title']	= $pro['title'];
			$data['info']	= strip_tags ( htmlspecialchars_decode ( $pro ['description'] ) );
			$data['picurl'] = $pro['image'];
		} else {
			$pro = M ( 'reply_info' )->where ( array (
					'infotype' => 'Dining',
					'token' => $this->token
			) )->find ();
			$data['title']	= $pro['title'];
			$data['info']	= strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) );
			$data['picurl'] = $pro['picurl'];
				
		}
		
		return array (
				array (
						array (
								$data['title'],
								strip_tags ( htmlspecialchars_decode ( $data ['info'] ) ),
								$data ['picurl'],
								C ( 'site_url' ) . '/user.php?g=Wap&m=ProductDining&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName']
						)
				),
				'news'
		);
	}
}

?>