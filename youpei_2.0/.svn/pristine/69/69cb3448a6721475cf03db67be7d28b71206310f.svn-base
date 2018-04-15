<?php
namespace Common\Model;

 class WxpayoutLimitModel extends BaseModel {
    public function querywxpayoutLimit(){
    	  $sql = "select * from __PREFIX__wxpayout_limit order by sort asc";
	      return $this->query($sql);
    }

 public function insertRedPacket(){
 	$rd = array('status'=>-1);
    $data = array();
    $data["title"] = I("title");
    $data["start_time"] = strtotime(I("single_cal3"));
    $data["end_time"] = strtotime(I("single_cal1"));
    $data["total_money"] = I("total_money");
    $data["current_money"] = I("current_money");
    $data["sort"] = (int)I("sort");
    $data["status"] = (int)I("status");
    $data["create_time"] = time();
    if ($data["start_time"]>$data["end_time"]) {
        $rd['msg'] = '结束时间不能小于开始时间';
        return $rd;
    }
    if($this->checkEmpty($data)){
    	$rs = $this->add($data);
	    if(false !== $rs){
			$rd['status']= 1;
		}
    }
    return $rd;
 } 
 
    public function get(){
       return $this->where("id=".(int)I('id'))->find();
    }

  public function editRedPacket(){
 	$rd = array('status'=>-1);
    $data = array();
    $data["title"] = I("title");
    $data["start_time"] = strtotime(I("single_cal3"));
    $data["end_time"] = strtotime(I("single_cal1"));
    $data["total_money"] = I("total_money");
    $data["current_money"] = I("current_money");
    $data["sort"] = (int)I("sort");
    $data["status"] = (int)I("status");
    $data["create_time"] = time();
    if ($data["start_time"]>$data["end_time"]) {
        $rd['msg'] = '结束时间不能小于开始时间';
        return $rd;
    }
    if($this->checkEmpty($data)){
    	$rs = $this->where("id=".(int)I('id',0))->save($data);
	    if(false !== $rs){
			$rd['status']= 1;
		}
    }
    return $rd;
 } 

      /**
	  * 删除
	  */
	 public function del(){
	    $rd = array('status'=>-1);
	    $rs = $this->delete((int)I('id'));
		if(false !== $rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
}