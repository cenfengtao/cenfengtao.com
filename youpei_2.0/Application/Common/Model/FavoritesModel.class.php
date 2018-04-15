<?php
namespace Common\Model;


class FavoritesModel extends BaseModel
{
	public function favoriteOrgani($userid){
		$rd = array('status'=>-1);
		$id = (int)I('id');
		//检测机构是否存在
		$sql = "select id from __PREFIX__organization where id=".$id;
		$rs = $this->query($sql);
		if(!empty($rs)){
			$data = array();
			$data['userid'] = $userid;
			$data['favoriteType'] = 1;
			$data['targetId'] = $id;
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

	/**
	 * 判断是否已关注
	 */
	public function checkFavorite($id,$type,$userId){
		$sql = "select id from __PREFIX__favorites where favoriteType=".$type." and targetId=".$id." and userid=".$userId;
	    $rs = $this->queryRow($sql);
	    return empty($rs)?0:$rs['id'];
	}

	/**
	 * 取消关注
	 */
	public function cancelFavorite($type,$userId){
		$rd = array('status'=>-1);
		$id = (int)I('id');
		$rs = $this->where('favoriteType='.$type." and id=".$id." and userId=".$userId)->delete();
		if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	}

	public function getorgFollow($userId){
		$sql="select o.token from __PREFIX__favorites f left join __PREFIX__organization o on f.targetId = o.id  where f.userid=".$userId;
		return $this->query($sql);
	}
}