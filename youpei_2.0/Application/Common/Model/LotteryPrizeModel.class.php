<?php
namespace Common\Model;

class LotteryPrizeModel extends BaseModel
{
    public function getPrizelist($token)
    {
        $sql = "select * from __PREFIX__lottery_prize where token = '$token' and istemporary = '0'  order by id asc";
        return $this->query($sql);
    }

    public function get()
    {
        return $this->where("id=" . (int)I('id'))->find();
    }

    public function insertPrize($token)
    {
        $rd = array('status' => -1);
        $cou = $this->where(array('token' => $token))->count();
        if ($cou >= 6) {
            $rd['msg'] = '最多添加6条';
            return $rd;
        }
        $data['token'] = $token;
        $data["type"] = I("formselect");
        $data["amount"] = I("amount");
        $data["title"] = I("title");
        $data["weight"] = I("weight");
        $data["pic"] = I("adFile");
        $data["count"] = (int)I("count");
        $data['istemporary'] = 0;
        $data['activityid'] = 0;
        if ($this->checkEmpty($data)) {
            $data["explain"] = I("explain");
            $rs = $this->add($data);
            if (false !== $rs) {
                $rd['status'] = 1;
            }
        }
        return $rd;
    }

    public function editPrize($id, $token)
    {
        $rd = array('status' => -1);
        $data['token'] = $token;
        $data["type"] = I("formselect");
        $data["amount"] = I("amount");
        $data["title"] = I("title");
        $data["weight"] = I("weight");
        $data["pic"] = I("adFile");
        $data["count"] = (int)I("count");
        $data['istemporary'] = 0;
        $data['activityid'] = 0;
        if ($this->checkEmpty($data)) {
            $data["explain"] = I("explain");
            $rs = $this->where("id=" . $id)->save($data);
            if (false !== $rs) {
                $rd['status'] = 1;
            }
        }
        return $rd;
    }

    /**
     * 删除
     */
    public function del()
    {
        $rd = array('status' => -1);
        $rs = $this->delete((int)I('id'));
        if (false !== $rs) {
            $rd['status'] = 1;
        }
        return $rd;
    }

    public function getactivityPrize()
    {
        $rd = array('status' => -1);
    }

    public function gettemporaryPrizelist($token)
    {
        $sql = "select * from __PREFIX__lottery_prize where token = '$token' and istemporary = '1' and activityid = " . (int)I('activityid', 0) . " order by id asc";
        return $this->query($sql);
    }

    public function insertactivityPrize($token)
    {
        $rd = array('status' => -1);
        $cou = $this->where(array('token' => $token, 'istemporary' => 1, 'activityid' => (int)I('activityid', 0)))->count();
        if ($cou >= 6) {
            $rd['msg'] = '最多添加6条';
            return $rd;
        }
        $data['token'] = $token;
        $data["type"] = I("formselect");
        $data["amount"] = I("amount");
        $data["title"] = I("title");
        $data["weight"] = I("weight");
        $data["pic"] = I("adFile");
        $data["count"] = (int)I("count");
        $data['istemporary'] = 1;
        $data['activityid'] = (int)I('activityid', 0);
        if ($this->checkEmpty($data)) {
            $rs = $this->add($data);
            if (false !== $rs) {
                $rd['status'] = 1;
            }
        }
        return $rd;
    }

    public function editactivityPrize($id, $token)
    {
        $rd = array('status' => -1);
        $data['token'] = $token;
        $data["type"] = I("formselect");
        $data["amount"] = I("amount");
        $data["title"] = I("title");
        $data["weight"] = I("weight");
        $data["pic"] = I("adFile");
        $data["count"] = (int)I("count");
        $data['istemporary'] = 1;
        $data['activityid'] = (int)I('activityid', 0);
        if ($this->checkEmpty($data)) {
            $rs = $this->where("id=" . $id)->save($data);
            if (false !== $rs) {
                $rd['status'] = 1;
            }
        }
        return $rd;
    }

    public function updateById($id, $data)
    {
        if (!isset($id) || !is_numeric($id)) {
            throw_exception('ID不合法');
        }
        if (!isset($data) || !is_array($data)) {
            throw_exception('更新数据不合法');
        }
        return M('lottery_prize')->where('id=' . $id)->save($data);
    }

    public function find($id)
    {
        $comment = M('lottery_prize')->where("id={$id}")->find();
        return $comment;
    }

    public function insert($data)
    {
        if (!$data || !is_array($data)) {
            throw_exception('添加数据不合法');
        }
        return M('lottery_prize')->add($data);
    }

    public function delete($id)
    {
        $id = M('lottery_prize')->where("id={$id}")->delete();
        return $id;
    }
}