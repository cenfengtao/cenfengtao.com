<?php
/**
 * 会员卡
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerMemberModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		
		$pro = M ( 'ReplyRule' )->where ( array (
				'module' 	=> 'MemberCard',
				'group'		=> 'Wap',
				'action'	=> 'index',
				'token' => $this->token
		) )->find ();
		if($pro) {
			$data ['picurl']	= $pro ['image'];
			$data ['title']		= $pro ['title'];
			$data ['keyword']	= strip_tags ( htmlspecialchars_decode ( $pro ['description'] ) );
		} else {
			$card = M ( 'member_card_create' )->where ( array (
					'token' => $this->token,
					'wecha_id' => $this->data ['FromUserName']
			) )->find ();
			$cardInfo = M ( 'member_card_set' )->where ( array (
					'token' => $this->token
			) )->find ();
			$cardMsgInfo = M ( 'member_card_msg' )->where ( array (
					'token' => $this->token
			) )->find ();
	
// 			if ($card == false) {
				$data ['picurl']	= $cardMsgInfo ['picurl'];
				$data ['title']		= $cardMsgInfo ['title'];
				$data ['keyword']	= $cardMsgInfo ['keyword'];
// 			} else {
// 				$data ['picurl'] = $cardMsgInfo ['picurl'];
// 				$data ['title'] = $cardMsgInfo ['title'];
// 				$data ['keyword'] = $cardMsgInfo ['keyword'];
// 				$data ['url'] = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/MemberCard/index', array (
// 						'token' => $this->token,
// 						'wecha_id' => $this->data ['FromUserName']
// 				) );
		}
			
		$data ['url'] = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/MemberCard/index', array (
				'token' => $this->token,
				'wecha_id' => $this->data ['FromUserName']
		) );
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