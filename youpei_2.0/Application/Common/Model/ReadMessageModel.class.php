<?php
namespace Common\Model;

 class ReadMessageModel extends BaseModel {
 	public function RecordReadMessage($userid,$messagesid){
         //是否已读
		$sql = "select id from __PREFIX__read_message where userid=".$userid." and messagesid=".$messagesid;
		$rs = $this->query($sql);
		if(empty($rs)){
			$data = array();
			$data['messagesid'] = $messagesid;
			$data['userid'] = $userid;
			$data['create_time'] = time();
			if($this->checkEmpty($data)){
				$rs = $this->add($data);
			    if(false !== $rs){
					$rd['status']= 1;
					$rd['id']= $rs;
				}
			}
		}
		return $rd;
 	}

 	public function getReadMessage($userid,$messagesid){
 		//是否已读
		$sql = "select id from __PREFIX__read_message where userid=".$userid." and messagesid=".$messagesid;
		$rs = $this->queryRow($sql);
		return empty($rs)?0:$rs['id'];
 	}

 }