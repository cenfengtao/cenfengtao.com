<?php
/**
 * 第三方api
 * @author lpdx111
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerApiModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		$content=$this->data['Content'];
		$apis=explode('-', $content);
		$api=$apis[1];
		$key='';
		if(isset($apis[2])){
			$key=substr($content, strlen('API-'.$api.'-'));
		}
		$this->data['Content']=$key;
		$classname="WeixinController{$api}ApiModel";
		import("@.Model.Home.WeixinController{$api}ApiModel");
		if(class_exists($classname)){
			$model_obj = new $classname ();
			$model_obj->setToken ( $this->token );
			$model_obj->reply ( $this->data );
			if ($model_obj->isDone ()) {
				return $model_obj->getResult ();
			}
		}
		return array (
				'你所访问的API不存在'.$classname,
				'text'
		);
	}
}

?>