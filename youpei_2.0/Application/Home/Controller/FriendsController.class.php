<?php
/**
 * 学友团
 */
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class FriendsController extends BaseController
{
    public function index()
    {
        $this->display();
    }

    public function ajaxGetChildren()
    {
        $count = 0;
        $upUser = D('User')->getUpUser($this->user['id']);
        //B级
        $children = D('User')->getChildren($this->user['id'], "id,create_time,username");
        $count += count($children);
        foreach ($children as $k => $v) {
            //C级
            $children[$k]['children'] = D('User')->getChildren($v['id'], "id,create_time,username");
            $children[$k]['child_count'] = count($children[$k]['children']);
            $children[$k]['create_time'] = date("Y-m-d", $v['create_time']);
            $count += $children[$k]['child_count'];
            if (!empty($children[$k]['children'])) {
                foreach ($children[$k]['children'] as $key => $val) {
                    $children[$k]['children'][$key]['create_time'] = date("Y-m-d", $val['create_time']);
                }
            }
        }
        $this->assign('up_user', $upUser)->assign('children', $children)->assign('count', $count);
        $data = [
            'up_user' => $upUser['username'],
            'children' => $children,
            'count' => $count
        ];
        return show(1, '获取成功', $data);
    }
}