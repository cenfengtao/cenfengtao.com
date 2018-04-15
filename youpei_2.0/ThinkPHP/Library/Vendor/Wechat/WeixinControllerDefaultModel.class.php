<?php
/**
 * 默认回复
 * @author lpdx111
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerDefaultModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		$other = M ( 'Other' )->where ( array (
				'token' => $this->token
		) )->find ();
		if ($other == false||(empty($other['info'])&&empty($other['keyword']))) {
			$this->data['module']="default";
			return array (
					'',
					'text'
			);
		} else {
			$this->data['module']="default-reply";
			if (empty ( $other ['keyword'] )) {
				return array (
						$other ['info'],
						'text'
				);
			} else {
				$this->history_keyword ( $other ['keyword'] );
				$img = M ( 'Img' )->field ( 'id,text,pic,url,title' )->limit ( 10 )->order ( 'sort desc' )->where ( array (
						'token' => $this->token,
						'keyword' => array (
								'eq',
								$other ['keyword']
						)
				) )->select ();
				if ($img == false) {
					return array (
							'无此图文信息,请提醒商家，重新设定关键词',
							'text'
					);
				}
				foreach ( $img as $keya => $infot ) {
					if ($infot ['url'] != false) {
						$url = $infot ['url'];
					} else {
						$url = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Img/content', array (
								'token' => $this->token,
								'id' => $infot ['id']
						) );
					}
					$return [] = array (
							$infot ['title'],
							$infot ['text'],
							$infot ['pic'],
							$url
					);
				}
				return array (
						$return,
						'news'
				);
			}
		}
	}
}

?>
