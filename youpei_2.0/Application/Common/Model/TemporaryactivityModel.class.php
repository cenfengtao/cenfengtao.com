<?php
namespace Common\Model;

class TemporaryactivityModel extends BaseModel
{

    public function Temporaryactivitylist($token)
    {
        $sql = "select * from __PREFIX__temporaryactivity where token ='$token'";
        return $this->query($sql);

    }

    public function editeditActivename($token)
    {
        $rd = array('status' => -1);
        $data = array();
        $data['token'] = $token;
        $data['activityname'] = I("activityname");
        $data["start_time"] = strtotime(I("single_cal3") . "+8 hour");
        $data["end_time"] = strtotime(I("single_cal1") . "+8 hour");
        if ($data['start_time'] == $data['end_time']) {
            $data['end_time'] = strtotime(I('single_cal1') . "+1 day +8 hour");
        }
        if ($data["start_time"] > $data["end_time"]) {
            $rd['msg'] = '结束时间不能小于开始时间';
            return $rd;
        }
        $data['status'] = (int)I("status");
        $data['lotteryrule'] = I("lotteryrule");
        $data['lottery_count'] = I('lottery_count');
        $data["create_time"] = time();
        $data["limit"] = I('limit', 0);
        if ($this->checkEmpty($data)) {
            $rs = $this->where("id=" . I('id', 0))->save($data);
            if (false !== $rs) {
                $rd['status'] = 1;
            }
        }
        return $rd;
    }

    public function inserteditActivename($token)
    {
        $rd = array('status' => -1);
        $row = $this->where(array('activityname' => I("activityname"), 'token' => $token))->find();
        if ($row) {
            $rd['msg'] = '活动名称已存在';
            return $rd;
        }
        $data = array();
        $data['token'] = $token;
        $data['activityname'] = I("activityname");
        $data["start_time"] = strtotime(I("single_cal3"));
        $data["end_time"] = strtotime(I("single_cal1"));
        if ($data['start_time'] == $data['end_time']) {
            $data['end_time'] = strtotime(I('single_cal1') . "+1 day");
        }
        $data['status'] = (int)I("status");
        $data['lotteryrule'] = I("lotteryrule");
        $data['lottery_count'] = I('lottery_count');
        $data["create_time"] = time();
        $data["limit"] = I('limit', 0);
        if ($data["start_time"] > $data["end_time"]) {
            $rd['msg'] = '结束时间不能小于开始时间';
            return $rd;
        }
        if ($this->checkEmpty($data)) {
            $rs = $this->add($data);
            if (false !== $rs) {
                $rd['status'] = 1;
            }
        }
        return $rd;
    }

    public function get()
    {
        return $this->where("id=" . (int)I('id'))->find();
    }

    public function delTemporaryactivity($id, $token)
    {
        $rd = array('status' => -1);
        $m = M('lottery_prize');
        $re = $m->where(array('activityid' => $id))->select();
        if ($re) {
            if ($m->where(array('activityid' => $id, 'token' => $token, 'istemporary' => 1))->delete()) {
                $row = $this->where("id=" . $id)->delete();
                if (false !== $row) {
                    $rd['status'] = 1;
                }
            }

        } else {
            $row = $this->where("id=" . $id)->delete();
            if (false !== $row) {
                $rd['status'] = 1;
            }
        }
        return $rd;
    }

    public function getrule($token, $id)
    {
        $sql = "SELECT lotteryrule FROM __PREFIX__temporaryactivity where token ='$token' and id = '$id'";
        return $this->queryRow($sql);
    }
}