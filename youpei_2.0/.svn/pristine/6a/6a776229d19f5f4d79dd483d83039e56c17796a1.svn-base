<?php
namespace Common\Model;

 class HomeclassifyModel extends BaseModel {

 public function queryPicture(){
    $sql = "select * from __PREFIX__homeclassify order by sort asc";
	 return $this->query($sql);
 }

 public Function insertHomeclassify($token){
 	$rd = array('status'=>-1);
    $data = array();
    $data['title'] = I('title');
    $data['image'] = I('adFile');
    $data['type'] = I('formselect');
    $data['sort'] = (int)I('sort');
    $data['is_show'] = (int)I('is_show');
    $data['token'] = $token;
    if($this->checkEmpty($data)){
      $data["url"] = I("url",'','url');
    	$rs = $this->add($data);
	    if(false !== $rs){
			$rd['status']= 1;
		 }
       }
    return $rd;
 	 }
      
      //修改
   public function editHomeclassify(){
   	$rd = array('status'=>-1);
    $id = (int)I("id",0);
    $data['title'] = I('title');
    $data['image'] = I('adFile');
    $data['type'] = I('formselect');
    $data['sort'] = (int)I('sort');
    $data['is_show'] = (int)I('is_show');
    if($this->checkEmpty($data)){
      $data["url"] = I("url",'','url');
    	$rs = $this->where("id=".$id)->save($data);
	    if(false !== $rs){
			$rd['status']= 1;
		}
    }
    return $rd;
   }


       public function get(){
		return $this->where("id=".(int)I('id'))->find();
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

   public function getHomec(){
     $sql = "SELECT * FROM __PREFIX__homeclassify where is_show ='0' ORDER BY sort ASC";
     $rs = $this->query($sql);
     return $rs;
  }
 }