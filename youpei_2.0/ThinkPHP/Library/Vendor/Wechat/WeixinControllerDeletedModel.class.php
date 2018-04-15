<?php
/**
 * 源拼音中已删除的function
 * @author lpdx111
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerDefaultModel extends WeixinControllerModel {
	public function _reply() {}
	// 审核
	function shenhe($name) {
		$name = implode ( '', $name );
		if (empty ( $name )) {
			return '正确的审核帐号方式是：审核+帐号';
		} else {
			$user = M ( 'Users' )->field ( 'id' )->where ( array (
					'username' => $name
			) )->find ();
			if ($user == false) {
				return "您还没注册吧\n正确的审核帐号方式是：审核+帐号,不含+号";
			} else {
				$up = M ( 'users' )->where ( array (
						'id' => $user ['id']
				) )->save ( array (
						'status' => 1,
						'viptime' => strtotime ( "+1 day" )
				) );
				if ($up != false) {
					return '您的帐号已经审核,您现在可以登陆平台测试功能啦!';
				} else {
					return '服务器繁忙请稍后再试';
				}
			}
		}
	}
	// 淘宝（已取消）
	function taobao($name) {
		$name = array_merge ( $name );
		$data = M ( 'Taobao' )->where ( array (
				'token' => $this->token
		) )->find ();
		if ($data != false) {
			if (strpos ( $data ['keyword'], $name )) {
				$url = $data ['homeurl'] . '/search.htm?search=y&keyword=' . $name . '&lowPrice=&highPrice=';
			} else {
				$url = $data ['homeurl'];
			}
			return array (
					array (
							array (
									$data ['title'],
									$data ['keyword'],
									$data ['picurl'],
									$url
							)
					),
					'news'
			);
		} else {
			return '商家还未及时更新淘宝店铺的信息,回复帮助,查看功能详情';
		}
	}
	// 抽奖
	function choujiang($name) {
		$data = M ( 'lottery' )->field ( 'id,keyword,info,title,starpicurl' )->where ( array (
				'token' => $this->token,
				'status' => 1,
				'wecha_id' => $this->data ['FromUserName'],
				'type' => 1
		) )->order ( 'id desc' )->find ();
		if ($data == false) {
			return array (
					'暂无抽奖活动',
					'text'
			);
		}
		$pic = $data ['starpicurl'] ? $data ['starpicurl'] : rtrim ( C ( 'site_url' ), '/' ) . '/themes/User/default/common/images/img/activity-lottery-start.jpg';
		$url = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Lottery/index', array (
				'type' => 1,
				'token' => $this->token,
				'id' => $data ['id'],
				'wecha_id' => $this->data ['FromUserName']
		) );
		return array (
				array (
						array (
								$data ['title'],
								$data ['info'],
								$pic,
								$url
						)
				),
				'news'
		);
	}
	
	// 股票
	function gupiao($name) {
		$name = array_merge ( $name );
		$url = "http://api2.sinaapp.com/search/stock/?appkey=0020130430&appsecert=fa6095e113cd28fd&reqtype=text&keyword=" . $name [0];
		$json = Http::fsockopenDownload ( $url );
		if ($json == false) {
			$json = file_get_contents ( $url );
		}
		$json = json_decode ( $json, true );
		$str = $json ['text'] ['content'];
		return $str;
	}
}

?>