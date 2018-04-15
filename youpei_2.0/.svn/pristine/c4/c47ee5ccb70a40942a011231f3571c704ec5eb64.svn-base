<?php
/**
 * 帮助
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerHelpModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		$data = M ( 'Areply' )->where ( array (
				'token' => $this->token
		) )->find ();
		return array (
				preg_replace ( "/(\015\012)|(\015)|(\012)/", "\n", $data ['content'] ),
				'text'
		);
	}
}

?>