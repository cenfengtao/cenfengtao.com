<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class ShareController extends BaseController
{
    public function share()
    {
        $this->ajaxReturn(array('status' => 1, 'add_score' => 0, 'score' => 0, 'coupon_id' => 0));
    }
}