<?php
/**
 * 商城
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerMallModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		$where['token'] = $this->token;
		$theme = M('Wxuser')->where($where)->getField('product_theme');
		if(empty($theme) || $theme == 'default') {
			$module = "Goods";
			$url = C ( 'site_url' ) . '/user.php?g=Wap&m=Goods&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'];
		} else {
			$module = "Product";
			$url = C ( 'site_url' ) . '/user.php?g=Wap&m=Product&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'];
		}
		
		$pro = M ( 'ReplyRule' )->where ( array (
				'module' 	=> $module,
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
					'infotype' => 'Shop',
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
						$url
					)
				),
				'news'
		);
	}
}

?>