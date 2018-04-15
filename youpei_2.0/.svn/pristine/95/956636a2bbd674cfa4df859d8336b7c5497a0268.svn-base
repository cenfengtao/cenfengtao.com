<?php
namespace Common\Model;

class UserAddressModel extends BaseModel
{

    /**
     * 获取指定对象
     */
    public function get($id)
    {
        return $this->where("userId=" . $id)->find();
    }

    /**
     * 修改保存用户地址
     * 前期用户只有一个地址
     */
    public function edit()
    {
        $rd = array('status' => -1);
        $id = (int)I("id", 0);
        $data = array();
        $data["userid"] = $id;
        $data["username"] = I("username");
        $data["mobile"] = I("mobile");
        $data["areaid2"] = (int)I("areaId2");
        $data["areaid3"] = (int)I("areaId3");
        $data["address"] = I("address");
        $data["isDefault"] = 1;
        $data["create_time"] = time();
        if ($this->checkEmpty($data, true)) {
            if (I("areaId1")) {
                $data["areaid1"] = (int)I("areaId1");
            } else {
                $sql = "SELECT parentId FROM __PREFIX__areas WHERE areaid='" . $data["areaId2"] . "' AnD areaFlag=1";
                $ars = $this->queryRow($sql);
                $data["areaid1"] = $ars["parentId"];
            }

            $rs = $this->where("userid=" . $id)->find();
            if (empty($rs)) {
                $rs = $this->add($data);
                if (false !== $rs) {
                    $rd['status'] = 1;
                    $rd['msg'] = "新增成功";
                }
            } else {
                $rs = $this->where("userid=" . $id)->save($data);
                if (false !== $rs) {
                    $rd['status'] = 1;
                    $rd['msg'] = "修改成功";
                }
            }
        }
        return $rd;
    }

    /**
     * 新增地址
     */
    // public function insert(){

    // }

    /**
     * 获取列表
     */
    public function queryByList($userId)
    {
        $sql = "select ua.*,a1.areaname areaname1,a2.areaname areaname2,a3.areaname areaname3
	              from __PREFIX__user_address ua 
	              left join __PREFIX__areas a1 on a1.areaid=ua.areaid1 and a1.isShow=1 and a1.areaFlag=1
	              left join __PREFIX__areas a2 on a2.areaid=ua.areaid2 and a2.isShow=1 and a2.areaFlag=1
	              left join __PREFIX__areas a3 on a3.areaid=ua.areaid3 and a3.isShow=1 and a3.areaFlag=1
	              where ua.userId=" . (int)$userId;
        return $this->query($sql);
    }

    /**
     * 删除
     */
    public function del()
    {
        $rd = array('status' => -1);
        $rs = $this->where("addressId=" . (int)I('id'))->delete();
        if (false !== $rs) {
            $rd['status'] = 1;
        }
        return $rd;
    }
}
