<?php
/**
 *公众号回复管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class ReplyController extends CommonController
{
    //文字回复列表
    public function textList()
    {
        $list = D("Text")->getList($this->token);
        $this->assign("list", $list);
        $this->display();
    }

    //添加文字回复
    public function addText()
    {
        if ($_POST) {
            if (!$_POST['keyword'] || empty($_POST['keyword'])) {
                return show(0, '关键字不能为空');
            }
            if (!$_POST['text'] || empty($_POST['text'])) {
                return show(0, '回复内容不能为空');
            }
            //判断是否有重复关键字
            $reply = D('Keyword')->getReplyByKey($_POST['keyword']);
            if ($reply && !empty($reply) && !$_POST['id']) {
                return show(0, '关键字不能重复');
            }
            if ($_POST['id'] && !empty($_POST['id'])) {
                return $this->save($_POST, 'Text');
            }
            try {
                $_POST['create_time'] = time();
                $_POST['token'] = $this->token;
                $id = D('Text')->insert($_POST);
                if ($id) {
                    //添加到关键字表
                    $keywordData = [
                        'keyword' => $_POST['keyword'],
                        'type' => 'Text',
                        'type_id' => $id,
                    ];
                    D('Keyword')->insert($keywordData);
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

    public function editText()
    {
        if (!$_GET['id'] || empty($_GET['id'])) {
            $this->error('ID参数错误');
        }
        $text = D('Text')->find($_GET['id']);
        $this->assign('text', $text);
        $this->display();
    }

    public function deleteText()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('Text')->delete($_POST['id']);
            if ($result) {
                D('Keyword')->deleteByTypeId($_POST['id'], 'Text');
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    //图文回复列表
    public function imgList()
    {
        $list = D("Img")->getList(array('token'=>$this->token));
        $this->assign("list", $list);
        $this->display();
    }

    //添加文字回复
    public function addImg()
    {
        if ($_POST) {
            if (!$_POST['keyword'] || empty($_POST['keyword'])) {
                return show(0, '关键字不能为空');
            }
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '标题不能为空');
            }
            if (!$_POST['url'] || empty($_POST['url'])) {
                return show(0, '链接不能为空');
            }
            if (!$_POST['pic'] || empty($_POST['pic'])) {
                unset($_POST['pic']);
            }
            //判断是否有重复关键字
            $reply = D('Keyword')->getReplyByKey($_POST['keyword']);
            if ($reply && !empty($reply) && !$_POST['id']) {
                return show(0, '关键字不能重复');
            }
            if ($_POST['id'] && !empty($_POST['id'])) {
                return $this->save($_POST, 'Img');
            }
            try {
                $_POST['create_time'] = time();
                $_POST['token'] = $this->token;
                $id = D('Img')->insert($_POST);
                if ($id) {
                    //添加到关键字表
                    $keywordData = [
                        'keyword' => $_POST['keyword'],
                        'type' => 'Img',
                        'type_id' => $id,
                    ];
                    D('Keyword')->insert($keywordData);
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

    public function editImg()
    {
        if (!$_GET['id'] || empty($_GET['id'])) {
            $this->error('ID参数错误');
        }
        $img = D('Img')->find($_GET['id']);
        $this->assign('img', $img);
        $this->display();
    }

    public function deleteImg()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('Img')->delete($_POST['id']);
            if ($result) {
                D('Keyword')->deleteByTypeId($_POST['id'], 'Img');
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
    //默认回复
    public function editDefault()
    {
        if ($_POST) {
            if (!$_POST['default_reply'] || empty($_POST['default_reply'])) {
                return show(0, '回复内容不能为空');
            }
            $orgId = M('organization')->where("token='{$this->token}'")->getField('id');
            $this->save(array('id' => $orgId, 'default_reply' => $_POST['default_reply']), 'Organization');
        } else {
            $defaultReply = M('organization')->where("token='{$this->token}'")->getField('default_reply');
            $this->assign('defaultReply', $defaultReply);
            $this->display();
        }
    }

    //关注回复
    public function editSubscribe()
    {
        if ($_POST) {
            if (!$_POST['subscribe_reply'] || empty($_POST['subscribe_reply'])) {
                return show(0, '关注内容不能为空');
            }
            $orgId = M('organization')->where("token='{$this->token}'")->getField('id');
            $this->save(array('id' => $orgId, 'subscribe_reply' => $_POST['subscribe_reply']), 'Organization');
        } else {
            $subscribe_reply = M('organization')->where("token='{$this->token}'")->getField('subscribe_reply');
            $this->assign('subscribe_reply', $subscribe_reply);
            $this->display();
        }
    }

    public function save($data, $module)
    {
        try {
            $id = D($module)->updateById($data['id'], $data);
            if ($id === false) {
                return show(0, '修改失败');
            }
            return show(1, '修改成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
}