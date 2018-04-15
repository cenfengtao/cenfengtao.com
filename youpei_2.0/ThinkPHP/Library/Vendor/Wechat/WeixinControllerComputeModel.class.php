<?php
/**
 * 计算
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerComputeModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		$str=str_replace('计算', '', $this->$data['Content']);
		$result='';
		eval('$result='.$str.';');
		return array($result,'text');
	}
}

?>