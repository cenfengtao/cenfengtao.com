<?php
/**
 * 相册
 * @author jxiao
 */

import("@.Model.Home.WeixinControllerModel");
class WeixinControllerCompanyMapModel extends WeixinControllerModel {
	public function _reply() {
		$this->isDone = true;
		import ( "Home.Action.MapAction" );
		$mapAction = new MapAction ();
		return $mapAction->staticCompanyMap ();
	}
}

?>