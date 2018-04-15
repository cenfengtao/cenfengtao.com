<?php
class CliDownloadModel {
	function pluginlnlxc($data,$argv){
		$aid = $argv['id'];
		/*
		$where = array (
				'c.aid' => $aid,
		);
		$m = D('CommonView');
		$m->viewFields = array(
				'plugin_ln_lxc_user'=>array('id','username','ctime','money','tel','num','aid','_type'=>'left','_as'=>'c'),
				'wxproxy_base_fans'=>array('nickname','_type'=>'left','_as'=>'o','_on'=>'c.wecha_id=o.openid'),
		);*/
		$where['aid'] = $aid;
		$m = M('plugin_ln_lxc_user');
		//$column	['id']			= 'id';
		//$column ['nickname'] 	= '昵称';
		$column ['username'] 	= '姓名';
		$column ['tel'] 		= '电话';
		$column ['money'] 		= '助力金额';
		$column ['num'] 		= '助力次数';

		$path = $this->getPath();
		$filename = $this->_outColumn($column, $path);
		$i = 0;
		$limit = 10000;
		while(true) {
			$begin = $i * $limit;
			$list = $m->where($where)->order('money desc')->limit($begin.','.$limit)->select();
			if($list) {
				$this->_outData($column, $list, $filename, $path);
			} else {
				break;
			}
			$i++;
		}
		$file      = $path.$filename;
		//file_put_contents($file, 'end,end,end,', FILE_APPEND);
		return $filename;
	}
	
	protected function getPath(){
		$path = '';
		if(defined('CLI_PATH')) {
			$path = '';
			$path = CLI_PATH;
		} else {
			$path = $_SERVER['DOCUMENT_ROOT'];
		}
		return $path;
	}
	
	protected function _outColumn($column,$path) {
		$file_name = '/uploads/download/'.NOW_TIME.'_'.mt_rand(1000, 9999).'.csv';
		$file      = $path.$file_name;
		
		foreach ($column as $k=>$v) {
			$column [$k] = iconv ( "UTF-8", "GB2312//IGNORE", $v );
		}
		
		$str = implode ( ',', array_values ( $column ) ) . "\r\n";
		file_put_contents($file, $str, FILE_APPEND);
		return $file_name;
	}
	
	protected function _outData($column,$data,$file_name,$path){
		$file      = $path.$file_name;
		
		$keys = array_keys ( $column );
		
		foreach ( $data as $v ) {
			$str = '';
			foreach ( $keys as $k ) {
				$v [$k] = str_replace(',', '', $v [$k]);
				$str .= iconv ( "UTF-8", "GB2312//IGNORE", $v [$k] . ',' );
			}
			file_put_contents($file, $str."\r\n", FILE_APPEND);
		}
		return $file_name;
	}
}