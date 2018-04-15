<?php
namespace Admin\Controller;
use Think\Controller;
class ParentingCateController extends CommonController {
	public function index(){
		$m = D('ParentingCate');
    	$list = $m->getList();
        $this->assign('list',$list);
        $this->display();
	}

	public function addCate()
	{
		if ($_POST) {
			if (!$_POST['cate_title'] || empty($_POST['cate_title'])) {
				return show(0, '分类名称不能为空');
			}
			$data = $_POST;
			if ($data['id'] || !empty($data['id'])) {
				return $this->save($data);
			}
			try {
				$id = D('ParentingCate')->insert($data);
				if ($id) {
					return show(1, '添加成功');
				} else {
					return show(0, '添加失败');
				}
			} catch (Exception $e) {
				return show(0, $e->getMessage());
			}
		} else {
			$this->display();
		}
	}

	public function editCate()
	{
		if (!$_GET['id'] || !is_numeric($_GET['id'])) {
			$this->error("ID参数错误");
		}
		try {
			$cate = D('ParentingCate')->find($_GET['id']);
			if (!$cate || empty($cate)) {
				$this->error('该分类不存在');
			}
			$this->assign('cate', $cate);
			$this->display();
		} catch (Exception $e) {
			$this->error($e->getMessage());
		}
	}

	public function delete()
	{
		if (!$_POST['id'] || empty($_POST['id'])) {
			return show(0, '参数错误');
		}
		try {
			$result = D('ParentingCate')->delete($_POST['id']);
			if ($result) {
				return show(1, '删除成功');
			} else {
				return show(0, '删除失败');
			}
		} catch (Exception $e) {
			return show(0, $e->getMessage());
		}
	}

	public function save($data)
	{
		try {
			$id = D('ParentingCate')->updateById($data['id'], $data);
			if ($id === false) {
				return show(0, '修改失败');
			}
			return show(1, '修改成功');
		} catch (Exception $e) {
			return show(0, $e->getMessage());
		}
	}

}