<?php
namespace Common\Model;

 class AreasModel extends BaseModel {
  public function queryByAreasList($parentId){
	 return $this->where('areaFlag=1 and isShow = 1 and parentId='.(int)$parentId)->select();
	  }

 }
