<?php
/**
 * 团购
 * @author jxiao
 */
import("@.Model.Home.WeixinControllerModel");

class WeixinControllerCMDModel extends WeixinControllerModel {
	private $execute;
	public function setExecute($execute){
		$this->execute=$execute;
	}
	private $wecha_id;
	public function _reply() {
		$this->wecha_id=$this->data['FromUserName'];
		if($this->execute){
			$this->isDone = true;
			if($this->params['keyWord']=='退出'||'q'==strtolower($this->params['keyWord'])){
				$this->data['module']='NOCRM';
				$this->cancel();
				return array('已退出查询','text');
			}
			$data=call_user_method($this->execute, $this);
			return array($data,'text');		
		}else{
			if($this->data['Content'] == 'OYEpay') {
				return $this->testpay();
			}
			$array=array(
					'天气'=>'tianqi',
					'糗事'=>'qiushi',
					'计算'=>'jisuan',
					'朗读'=>'langdu',
					'健康'=>'jiankang',
					'快递'=>'kuaidi',
					'客服'=>'kefu',
					'笑话'=>'xiaohua',
					'聊天'=>'liaotian',
					'翻译'=>'fanyi',
					'梦见'=>'mengjian',
					'公交'=>'gongjiao',
					'火车'=>'mengjian',
					'身份证'=>'shenfenzheng',
					'手机'=>'shouji',
					'音乐'=>'yinyue',
					'算命'=>'suanming',
					'百科'=>'baike',
					'彩票'=>'caipiao',
					'歌词'=>'geci',
					'域名'=>'yuming',
					'退出'=>'cancel');
			if($array[$this->data['Content']]){
				$this->data['module']='pre-keyword';
				$function=$array[$this->data['Content']];
				$data= $this->$function();
				if($data){
					$this->isDone = true;
				    return array($data,'text');
				}
				return false;
			}else{
				return false;
			}
		}
	}
	
	/* 支付测试 */
	private function testpay(){
		$this->isDone = true;
		$where['token'] = $this->token;
		$theme = M('Wxuser')->where($where)->getField('product_theme');
		if(empty($theme) || $theme == 'default') {
			$module = "Goods";
			$url = C ( 'site_url' ) . '/testpay/user.php?g=Wap&m=Goods&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'];
		} else {
			$module = "Product";
			$url = C ( 'site_url' ) . '/testpay/user.php?g=Wap&m=Product&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'];
		}
		
		$pro = M ( 'ReplyRule' )->where ( array (
				'module' 	=> $module,
				'group'		=> 'Wap',
				'action'	=> 'index',
				'token' => $this->token
		) )->find ();
		if($pro) {
			$data['title']	= $pro['title'];
			$data['info']	= strip_tags ( htmlspecialchars_decode ( $pro ['description'] ) );
			$data['picurl'] = $pro['image'];
		} else {
			$pro = M ( 'reply_info' )->where ( array (
					'infotype' => 'Shop',
					'token' => $this->token
			) )->find ();
			$data['title']	= $pro['title'];
			$data['info']	= strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) );
			$data['picurl'] = $pro['picurl'];
				
		}
		
		return array (
				array (
						array (
								$data['title'],
								strip_tags ( htmlspecialchars_decode ( $data ['info'] ) ),
								$data ['picurl'],
								$url
						)
				),
				'news'
		);
	}
	
	/**
	 * 天气
	 * @return string
	 */
	private function tianqi(){
		
		if(!MCache::get('__CMD__'.$this->wecha_id)||$this->params['keyWord']=='天气'){
			MCache::set('__CMD__'.$this->wecha_id, 'tianqi',120);
			return "请输入城市名称:\n比如:北京\n退出查询请输入\"退出\"或\"q\"";
		}else{
			$this->data['module']='NOCRM';
			$str = 'http://v.juhe.cn/weather/index?cityname='.$this->params['keyWord'].'&key=da75eb8b5b9e1cbb0a0ed39978dbe87a';
			$data=ihttp_get($str,false);
			$json = json_decode ( $data['content'],true );
			MCache::set('__CMD__'.$this->wecha_id, 'tianqi',120);
			if($json['error_code']==0&&$json['resultcode']==200){
				$today=$json['result']['today'];
				$sk=$json['result']['sk'];
				$data="城市:{$today['city']}\n";
				$data.="日期:{$today['date_y']} {$today['week']}\n";
				$data.="温度:{$today['temperature']}\n";
				$data.="天气:{$today['weather']}\n";
				$data.="{$today['wind']} {$sk['wind_direction']} {$sk['wind_strength']}\n";
				$data.="\n";
				$data.="\n";
				$data.="退出查询请输入\"退出\"或\"q\"\n";
				$data.="继续查询请输入城市名称\n";
				$data.="\n";
				return $data;
			}else{
				return $json['reason']."\n你输入的城市名是\"{$this->params['keyWord']}\"";
			}
		}
	}
	private function qiushi(){
	}
	/**
	 * 计算
	 * @return string
	 */
	private function jisuan(){
		if(!MCache::get('__CMD__'.$this->wecha_id)||$this->keyword=='计算'){
			MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
			return "请输入公式:\n比如:1+2*3\n退出查询请输入\"退出\"或\"q\"";
		}else{
			$this->data['module']='NOCRM';
			MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
			if(preg_match("/^[0-9\+\-\*\/\(\)]*$/i",   $this->keyword))
			{
				$result='';
				eval('$result='.$this->keyword.';');
				return $result;
			}else{
				return "请输入公式:\n比如:1+2*3\n退出查询请输入\"退出\"或\"q\"";
			}
		}
	}
	private function langdu(){
	}
	private function jiankang(){
	}
	
	
	private function _getKefuList(){
		$list = M('KefuSet')->where(array('token'=>$this->token))->order('sort asc')->select();
		$data = array();
		foreach ($list as $row) {
			$data[$row['sort']] = $row;
		}
		return $data;
	}
	//
	private function kefu(){
		$kefuList = $this->_getKefuList();
		$exp_time = 2400;
		$fun_cache_key  = '__CMD__'.$this->wecha_id;
		$kefu_cache_key = '__CMD__KEFU__'.$this->wecha_id;
		$this->setTimeout('客服','', 1800);
		if(!MCache::get($fun_cache_key)||$this->params['keyWord']=='客服'){
			MCache::set($fun_cache_key, __FUNCTION__,$exp_time);
			MCache::delete($kefu_cache_key);
			$data= "请输入序号选择客服人员:\n  \n";
			foreach ($kefuList as $k) {
				$data .= "{$k['sort']}:   {$k['name']}  {$k['desc']}\n";
			}
			$data.=" \n \n \n退出查询请输入\"退出\"或\"q\"";
			return $data;
		}else{
			$this->data['module']='NOCRM';
			// 判断选择的快递公司
			$no=MCache::get($kefu_cache_key);
			$name='';
			error_log(__FILE__.__LINE__);
			if(!$no){
				error_log(__FILE__.__LINE__);
				$exp=trim($this->keyword);
				$kefu = $kefuList[$exp];
				
				$no = $kefu['uid'];
				// 如果找到客服
				if($kefu){
					error_log(__FILE__.__LINE__);
					$name = $kefu['name'];
					MCache::set($fun_cache_key, __FUNCTION__,$exp_time);
					MCache::set($kefu_cache_key, $no, 0);
					M('fans')->where(array('from_user'=>$this->wecha_id))->setField('last_kefu_id', $no);
					$data="你选择的客服人员是\"$name\"\n";
					$data.="请输入需要咨询的问题\n \n";
					$data.="退出咨询请输入\"退出\"或\"q\"\n";
					return $data;
				}else{
					error_log(__FILE__.__LINE__);
					// 没有找到提示重新选择
					MCache::set($fun_cache_key, __FUNCTION__,$exp_time);
					MCache::delete($kefu_cache_key);
					$data= "请输入序号选择客服人员:\n \n";
					foreach ($kefuList as $k) {
						$data .= "{$k['sort']}:   {$k['name']}  {$k['desc']}\n";
					}
					$data.=" \n \n \n退出查询请输入\"退出\"或\"q\"";
					return $data;
				}
			}else{
				return '';
			}
		}
	}
	
	private function setTimeout($name,$cache_keys, $time = 1800) {
		$fun_cache_key = '__CMD__'.$this->wecha_id;
		if(is_array($cache_keys)) {
			$cache_keys[] = $fun_cache_key;
			$cache_key = implode(',', $cache_keys);
		} elseif($cache_keys) {
			$cache_key = $fun_cache_key.','.$cache_keys;
		} else {
			$cache_key = $fun_cache_key;
		}
		$timeout['token']		= $this->token;
		$timeout['wecha_id']	= $this->wecha_id;
		$timeout['cache_key']	= $cache_key;
		$timeout['name']		= $name;
		$timeout['expire_time']	= time() + $time;
		M('timeout')->add($timeout,array(),true);
	}
	
	/**
	 * 快递
	 * @return string
	 */
	private function kuaidi(){
			$express = array (
					1=>array (
							'com' => '顺丰',
							'no' => 'sf'
					),
					2=>array (
							'com' => '申通',
							'no' => 'sto'
					),
					3=>array (
							'com' => '圆通',
							'no' => 'yt'
					),
					4=>array (
							'com' => '韵达',
							'no' => 'yd'
					),
					5=>array (
							'com' => '天天',
							'no' => 'tt'
					),
					6=>array (
							'com' => 'EMS',
							'no' => 'ems'
					),
					7=>array (
							'com' => '中通',
							'no' => 'zto'
					),
					8=>array (
							'com' => '汇通',
							'no' => 'ht'
					)
			);
			
		// 输入快递	
			
		if(!MCache::get('__CMD__'.$this->wecha_id)||$this->params['keyWord']=='快递'){
			MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
			MCache::delete('__CMD__KUAIDI__'.$this->wecha_id);
			$data= "请选择快递名称:\n ";
			
			
			$data.="\n1   顺丰\n";
			$data.="2   申通\n";
			$data.="3   圆通\n";
			$data.="4   韵达\n";
			$data.="5   天天\n";
			$data.="6   EMS\n";
			$data.="7   中通\n";
			$data.="8   汇通\n";
			
			$data.=" \n \n \n退出查询请输入\"退出\"或\"q\"";
			return $data;
			
		}else{
			$this->data['module']='NOCRM';
			// 判断选择的快递公司
			
				$no=MCache::get('__CMD__KUAIDI__'.$this->wecha_id);
				$name='';
			
			if(!$no){
				$exp=$this->keyword;
				switch ($exp){
					case '1':
					case '顺丰':
						$no=$express[1]['no'];
						$name=$express[1]['com'];
							break;
					case '2':
					case '申通':
						$no=$express[2]['no'];
						$name=$express[2]['com'];
						break;
					case '3':
					case '圆通':
						$no=$express[3]['no'];
						$name=$express[3]['com'];
						break;
					case '4':
					case '韵达':
						$no=$express[4]['no'];
						$name=$express[4]['com'];
							break;
					case '5':
					case '天天':
						$no=$express[5]['no'];
						$name=$express[5]['com'];
						break;
					case '6':
					case 'EMS':
						$no=$express[6]['no'];
						$name=$express[6]['com'];
						break;
					case '7':
					case '中通':
						$no=$express[7]['no'];
						$name=$express[7]['com'];
						break;
					case '8':
					case '汇通':
						$no=$express[8]['no'];
						$name=$express[8]['com'];
						break;
					default:
				}
				// 如果找到物流公司
				if($no){
					MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
					MCache::set('__CMD__KUAIDI__'.$this->wecha_id,$no,120);
					$data="你选择的物流公司是\"$name\"\n";
					$data.="请输入物流编号\n\n";
					$data.="\n或输入\"快递\"重新选择物流公司\n";
					$data.=" \n";
					$data.=" \n";
					$data.=" \n";
					$data.="退出查询请输入\"退出\"或\"q\"\n";
					return $data;
				}else{
					// 没有找到提示重新选择
					MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
					MCache::delete('__CMD__KUAIDI__'.$this->wecha_id);
					$data= "请选择快递名称:\n ";
					$data.="\n1   顺丰\n";
					$data.="2   申通\n";
					$data.="3   圆通\n";
					$data.="4   韵达\n";
					$data.="5   天天\n";
					$data.="6   EMS\n";
					$data.="7   中通\n";
					$data.="8   汇通\n";
						
					$data.=" \n \n \n退出查询请输入\"退出\"或\"q\"";
					return $data;
				}
			}else{
				// 输入了物流编号
					MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
					MCache::set('__CMD__KUAIDI__'.$this->wecha_id,$no,120);
				$url = 'http://v.juhe.cn/exp/index?key=8644c695fcc81022c6b57ee8051925f8&dtype=json&com=' . $no . '&no=' . $this->keyword;
				$data = file_get_contents ( $url );
				$data = json_decode ( $data, true );
				if ($data ['resultcode'] == 200) {
					$str = "物流公司:{$data['result']['company']}\n物流编号:{$data['result']['no']}\n ";
					$list = $data ['result'] ['list'];
					if (empty ( $list )) {
						$str .= "暂无物流信息,请确认物流公司与物流编号是否正确";
					} else {
						$str .= "物流信息如下:\n";
					}
					foreach ( $list as $value ) {
						$str .= "时间:{$value['datetime']} \n 备注:{$value['remark']}\n ___________\n";
					}
					return $str;
				} else {
					return '查询失败';
				}
			}
		}
	}
	private function xiaohua(){
	}
	private function liaotian(){
	}
	
	
	/**
	 * 公交
	 */
	private function gongjiao(){


		if(!MCache::get('__CMD__'.$this->wecha_id)||$this->keyword=='公交'){
			MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
			return "请输入城市+线路:\n比如:大连101\n退出查询请输入\"退出\"或\"q\"";
		}else{
			$this->data['module']='NOCRM';
			MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
			preg_match ( "/^([^\d]+?)(\d+)$/", $this->keyword, $input );
			if($input&&$input[1]&&$input[2]){
				$json = file_get_contents ( "http://www.twototwo.cn/bus/Service.aspx?format=json&action=QueryBusByLine&key=5da453b2-b154-4ef1-8f36-806ee58580f6&zone={$input[1]}&line={$input[2]}" );
				$data = json_decode ($json,true );
				if($data['Response']['Error']){
					$str="【城市】{$input[1]} \n";
					$str.="【线路】{$input[2]}\n";
					$str.="{$data['Response']['Error']['ErrorTips']['#cdata-section']}\n";
					return $str;
				}else{
					$str="【城市】{$input[1]}\n";
					$str.="【线路】{$input[2]}\n";
					$xianlu = $data['Response']['Head']['XianLu'];
				$shijian=	str_replace(array('|',' '), array("\n【时间】","\n【时间】"), $xianlu['ShouMoBanShiJian']['#cdata-section']);
					$str.="【时间】{$shijian}\n";
// 					$str.="      {$shijian[1]}\n";
					$str.="【票价】{$xianlu['PiaoJia']['#cdata-section']}\n";
					$str.="【公司】{$xianlu['GongJiaoGongSi']['#cdata-section']}\n";
					$str .= "【本公交途经】\n";
					$xianlu = $data['Response']['Main']['Item']['FangXiang'][0]['ZhanDian'];
					for($i = 0; $i < count ( $xianlu ); $i ++) {
						$str .= "\t".trim ( $xianlu [$i]['ZhanDianMingCheng'] )."\n" ;
					}
					return $str;
				}
			}else{
				MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
				return "请输入城市+线路:\n比如:大连101\n退出查询请输入\"退出\"或\"q\"";
			}
		}
	}
	
	
	/**
	 * 翻译
	 * @return string
	 */
	private function fanyi(){
		
		

		if(!MCache::get('__CMD__'.$this->wecha_id)||$this->keyword=='翻译'){
			MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
			return "请输入英文单词或中文词语:\n比如:我爱你\n退出查询请输入\"退出\"或\"q\"";
		}else{
			$this->data['module']='NOCRM';
			MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
			$url = "http://openapi.baidu.com/public/2.0/bmt/translate?client_id=kylV2rmog90fKNbMTuVsL934&q=" . $this->keyword . "&from=auto&to=auto";
			$json = file_get_contents ( $url );
			$json = json_decode ( $json,true);
			$data = $json['trans_result'];
			if(!$data[0]['dst']){
				return $this->error_msg ( $this->keyword );
			}else{
				$str="【源】{$data[0]['src']} \n";
				$str.="【翻译】{$data[0]['dst']} \n";
				return $str;
			}
		}
		if ($str [0]->dst == false)
			return $this->error_msg ( $data [0] );
		$mp3url = 'http://www.apiwx.com/aaa.php?w=' . $str [0]->dst;
		return array (
				array (
						$str [0]->src,
						$str [0]->dst,
						str_replace ( ' ', '', $mp3url ),
						str_replace ( ' ', '', $mp3url )
				),
				'music'
		);
		
		
	}
	private function mengjian(){
	}
	private function huoche(){
	}
	/**
	 * 身份证
	 * @return string
	 */
	private function shenfenzheng(){

		if(!MCache::get('__CMD__'.$this->wecha_id)||$this->keyword=='身份证'){
			MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
			return "请输入你的身份证号:\n退出查询请输入\"退出\"或\"q\"";
		}else{
			$this->data['module']='NOCRM';
			MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
			$str1 = file_get_contents ( 'http://apis.juhe.cn/idcard/index?key=05fcc2ef11ce14414a0f12e316fb5a29&dtype=json&cardno=' .$this->keyword );
			$data = json_decode ( $str1, true );
			if ($data ['resultcode'] == 200) {
				$str = "【身份证】 {$this->keyword} \n";
				$str.= "【地址】 {$data ['result'] ['area']} \n";
				$str.= "【生日】 {$data ['result'] ['birthday']} \n" ;
				$str.= "【性别】{$data ['result'] ['sex']}" ;
				return $str;
			} else if ($data ['resultcode'] == 203) {
				
				$str = $data ['reason'] . "\n\n" . 
				$str.= "【身份证】 {$this->keyword} \n";
				$str.= "【地址】 {$data ['result'] ['area']} \n";
				$str.= "【生日】 {$data ['result'] ['birthday']} \n" ;
				$str.= "【性别】{$data ['result'] ['sex']}" ;
				return $str;
			} else if ($data ['resultcode'] == 201) {
				return $data ['reason'];
			} else {
				return '查询失败';
			}
		}
	}
	/**
	 * 手机
	 * @return string
	 */
	private function shouji(){
		if(!MCache::get('__CMD__'.$this->wecha_id)||$this->keyword=='手机'){
			MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
			return "请输入你的手机号:\n退出查询请输入\"退出\"或\"q\"";
		}else{
			$this->data['module']='NOCRM';
			MCache::set('__CMD__'.$this->wecha_id, __FUNCTION__,120);
			$url = 'http://apis.juhe.cn/mobile/get?key=7dc9e7b19beaa27922cd52393e467ac3&dtype=json&phone=' . $this->keyword;
			$json = json_decode ( file_get_contents ( $url ), true );
			if ($json ['resultcode'] == 200) {
				$str= "【号码】{$this->keyword} \n";
				$str.="【归属】{$json['result']['province']}{$json['result']['city']}\n";
				$str.="【区号】{$json['result']['areacode']}\n ";
				$str.="【邮政编码】{$json['result']['zip']} \n ";
				$str.="【公司】{$json['result']['company']} \n";
				$str.="【卡类型】{$json['result']['card']}";
				return $str;
			} else {
				return '查询失败，请确认号码正确';
			}
		}
	}
	private function yinyue(){
	}
	private function suanming(){
	}
	private function baike(){
	}	
	private function caipiao(){
	}
	private function geci(){
	}
	private function yuming(){
	}
	private function cancel(){
		MCache::delete('__CMD__'.$this->wecha_id);
		MCache::delete('__CMD__KUAIDI__'.$this->wecha_id);
		M('timeout')->where(array('wecha_id'=>$this->wecha_id))->delete();
	}
}

?>