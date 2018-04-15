<?php
namespace Common\Model;

 class PrizeAddressModel extends BaseModel {

 	public function editPrizeAddress(){
 		 $rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data = array();
		$data["userid"]=$id;
		$data["receipt_name"] = I("username");
		$data["mobile"] = I("mobile");
		$data["token"] = I("token");
		$data["pid"] = I("pid");
		$data["areaid1"] = (int)I("areaId1");
		$data["areaid2"] = (int)I("areaId2");
		$data["areaid3"] = (int)I("areaId3");
		$data["address"] = I("address");
		$data["prizeid"] = I("prizeid");
		$data["status"] = 0;
		$data["create_time"] = time();
		$rs = $this->add($data);
			if(false !== $rs){
				$addr = array();
				$addr['is_addr'] = 1;
				M('draw_record')->where(array('id'=>I("pid")))->save($addr);
				$rd['status']= 1;
				$rd['msg']="新增成功";
			}
		return $rd;
 	}

 	public function userPrizeAddress($token){
 		$sql = "select u2.title,u1.username, ua.*,a1.areaname areaname1,a2.areaname areaname2,a3.areaname areaname3
	              from __PREFIX__prize_address ua 
	              left join __PREFIX__areas a1 on a1.areaid=ua.areaid1 and a1.isShow=1 and a1.areaFlag=1
	              left join __PREFIX__areas a2 on a2.areaid=ua.areaid2 and a2.isShow=1 and a2.areaFlag=1
	              left join __PREFIX__areas a3 on a3.areaid=ua.areaid3 and a3.isShow=1 and a3.areaFlag=1
	              left join __PREFIX__user u1 on u1.id=ua.userid
                  left join __PREFIX__lottery_prize u2 on u2.id = ua.prizeid

	              where ua.token='$token'";
		 return $this->query($sql);
 	}

 	 public function get($id)
    {
        $sql="SELECT id,status FROM __PREFIX__prize_address where id='$id'";
        return $this->queryRow($sql);
    }

    public function getPrizeinfo($pid){
          $sql = "select u2.title,u1.username, ua.*,a1.areaname areaname1,a2.areaname areaname2,a3.areaname areaname3
	              from __PREFIX__prize_address ua 
	              left join __PREFIX__areas a1 on a1.areaid=ua.areaid1 and a1.isShow=1 and a1.areaFlag=1
	              left join __PREFIX__areas a2 on a2.areaid=ua.areaid2 and a2.isShow=1 and a2.areaFlag=1
	              left join __PREFIX__areas a3 on a3.areaid=ua.areaid3 and a3.isShow=1 and a3.areaFlag=1
	              left join __PREFIX__user u1 on u1.id=ua.userid
                  left join __PREFIX__lottery_prize u2 on u2.id = ua.prizeid

	              where ua.pid='$pid'";
		 return $this->queryRow($sql);
    }

	 public function savestatus(){
		 $id = (int)I('id',0);
		 $data["status"] = I("status");
		 if($this->checkEmpty($data)){
			 $rs = $this->where("id=".$id)->save($data);
			 if(false !== $rs){
				 $rd['status']= 1;
			 }
		 }
		 return $rd;
	 }
 }