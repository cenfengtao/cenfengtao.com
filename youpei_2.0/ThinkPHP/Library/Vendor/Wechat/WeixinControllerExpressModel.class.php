<?php
/**
 * 摇一摇
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");
class WeixinControllerExpressModel extends WeixinControllerModel {
	
	public function _reply() {
		$name=$this->params['express_name'];	
		$no=$this->params['express_no'];
		$express = array (
				array (
						'com' => '顺丰',
						'no' => 'sf'
				),
				array (
						'com' => '申通',
						'no' => 'sto'
				),
				array (
						'com' => '圆通',
						'no' => 'yt'
				),
				array (
						'com' => '韵达',
						'no' => 'yd'
				),
				array (
						'com' => '天天',
						'no' => 'tt'
				),
				array (
						'com' => 'EMS',
						'no' => 'ems'
				),
				array (
						'com' => '中通',
						'no' => 'zto'
				),
				array (
						'com' => '汇通',
						'no' => 'ht'
				)
		);
		

		$name_no = '';
		foreach ( $express as $key => $value ) {
			if ($value ['com'] == $name) {
				$name_no = $value ['no'];
			}
		}
		if (empty ( $name_no )) {
			return '不支持' . $name . '快递查询';
		}
		$url = 'http://v.juhe.cn/exp/index?key=8644c695fcc81022c6b57ee8051925f8&dtype=json&com=' . $name_no . '&no=' . $no;
		$data = file_get_contents ( $url );
		$data = json_decode ( $data, true );
		return $data;
	}
}

?>