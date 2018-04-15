<?php
/**
 * 预约管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class BookController extends CommonController
{
    public function bookList()
    {
        /*
        * 分页操作逻辑
        * */
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
        $offset = ($page - 1) * $pageSize;
        try {
            if ($this->isSuper) {
                $list = M('book_record')->order('create_time desc')->limit($offset, $pageSize)->select();
            } else {
                $list = M('book_record')->where(array("token" => $this->token))->order('create_time desc')
                    ->limit($offset, $pageSize)->select();
            }
            foreach ($list as $key => $val) {
                $list[$key]['org_name'] = D('Organization')->getOrgnameByToken($val['token']);
                $list[$key]['pro_title'] = M('Product')->where(array("id" => $val['type_id']))->getField('title');
                $list[$key]['username'] = M('User')->where("id={$val['user_id']}")->getField('username');
            }
            $res = new Page(count($list), $pageSize);
            $page = $res->show();
            $this->assign('bookList', $list)->assign('page', $page);
            $this->display();
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function changeStatus()
    {
        if (!$_POST['id']) {
            return show(0, 'ID不能为空');
        }
        if (!$_POST['status']) {
            return show(0, '状态不能为空');
        }
        try {
            $id = D('BookRecord')->updateById($_POST['id'], array('status' => $_POST['status']));
            if ($id !== false) {
                return show(1, '修改成功');
            } else {
                return show(0, '修改失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
}