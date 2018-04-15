<?php
/**
 * Created by PhpStorm.
 * User: 新港西余文乐
 * Date: 2017/2/13
 * Time: 17:02
 */

namespace Common\Model;

use Think\Model;

class RegionModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('Region');
    }

    public function getProvinceList()
    {
        $list = $this->_db->where('type=1')->select();
        return $list;
    }

    public function getListByFatherCode($code)
    {
        $list = $this->_db->where('father_code='.$code)->select();
        return $list;
    }
}
