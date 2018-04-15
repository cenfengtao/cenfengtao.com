<?php
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerReplyRuleModel extends WeixinControllerModel{
	/* (non-PHPdoc)
	 * @see WeixinControllerModel::_reply()
	 */
	
	public function default_reply_msg($rule){
		$title=$rule['title'];
		$desc=$rule['description'];
		$image=$rule['image'];
		$url=C ( 'site_url' ).U($rule['group'].'/'.$rule['module'].'/'.$rule['action'],array('token'=>$this->token,'wecha_id'=>$this->data ['FromUserName']));
		if($rule['url']){
			$url=$rule['url'];
		}
		return array (
				array (
						array (
								$title,
								$desc,
								$image,
								$url
						)
				),
				'news'
		);
	}
	
	public function shake_reply_msg($rule){
		$title=$rule['title'];
		$desc=$rule['description'];
		$image=$rule['image'];
		
		$where=array('token'=>$this->token,'status'=>array('neq',0));
		$shake=M('EventShake')->where($where)->find();
		if($shake){
			$url=C ( 'site_url' ).U($rule['group'].'/'.$rule['module'].'/'.$rule['action'],array('token'=>$this->token,'wecha_id'=>$this->data ['FromUserName'],'id'=>$shake['id']));
			return array (
					array (
							array (
									$title,
									$desc,
									$image,
									$url
							)
					),
					'news'
			);
		}else{
			return array('请等待主持人发起活动','text');
		}
	}
	
	public function _reply() {
		$this->isDone = true;
		$rule=$this->params['rule'];
		if($rule['module']=='Shake'){
			$function='shake_reply_msg';
		}else{
			$function=$rule['process'].'_reply_msg';
		}
		return $this->$function($rule);
	}

}
?>