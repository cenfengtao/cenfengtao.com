<?php
/**
 *公众号菜单管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class WxMenuController extends CommonController
{
    public function menuList()
    {
        if($this->isSuper){
            $list = D("WxMenu")->getListByFatherId(0);
        }else{
            $list = M('WxMenu')->where(array('father_id'=>0,'token'=>$this->token))->order('sort desc')->select();
        }
        foreach ($list as $k => $v) {
            $list[$k]['child'] = D('WxMenu')->getListByFatherId($v['id']);
        }
        $this->assign("list", $list);
        $this->display();
    }

    public function addMenu()
    {
        if ($_POST) {
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '菜单名称不能为空');
            }
            if (!$_POST['data'] || empty($_POST['data'])) {
                return show(0, '类型内容不能为空');
            }
            if ($_POST['id'] && !empty($_POST['id'])) {
                return $this->save($_POST);
            }
            try {
                $_POST['token'] = $this->token;
                $id = D('WxMenu')->insert($_POST);
                if ($id) {
                    return show(1, '添加成功');
                } else {
                    return show(0, '添加失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            if($this->isSuper){
                $fatherList = D('WxMenu')->getListByFatherId(0);
            }else{
                $fatherList = M('WxMenu')->where(array('father_id'=>0,'token'=>$this->token))->order('sort desc')->select();
            }
            $this->assign('father_list', $fatherList);
            $this->display();
        }
    }

    public function editMenu()
    {
        if (!$_GET['id'] || empty($_GET['id'])) {
            $this->error('ID参数错误');
        }
        $menu = D('WxMenu')->find($_GET['id']);
        $fatherList = D('WxMenu')->getListByFatherId(0);
        $this->assign('menu', $menu)->assign('father_list', $fatherList);
        $this->display();
    }

    public function delete()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        //判断是否有子菜单
        $isChild = D('WxMenu')->isChild($_POST['id']);
        if ($isChild && $isChild > 0) {
            return show(0, '请先删除该菜单下的子菜单');
        }
        try {
            $result = D('WxMenu')->delete($_POST['id']);
            if ($result) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function createMenu()
    {
        $menu = [];
        $fatherMenu = D('WxMenu')->getListByFatherId(0);
        foreach ($fatherMenu as $key => $val) {
            $father = array();
            $father['name'] = $val['title'];
            $childMenu = D('WxMenu')->getListByFatherId($val['id']);
            if (!$childMenu || empty($childMenu)) {
                $father['type'] = $val['type'] == 1 ? 'view' : 'click';
                if ($father['type'] == 'click') {
                    $father['key'] = $val['data'];
                }
                if ($father['type'] == 'view') {
                    $father['url'] = $val['data'];
                }
            } else {
                $father['sub_button'] = array();
                foreach ($childMenu as $k => $v) {
                    $child = [];
                    $child['type'] = $v['type'] == 1 ? 'view' : 'click';
                    $child['name'] = $v['title'];
                    if ($child['type'] == 'click') {
                        $child['key'] = $v['data'];
                    }
                    if ($child['type'] == 'view') {
                        $child['url'] = $v['data'];
                    }
                    $father['sub_button'][] = $child;
                }
            }
            $menu['button'][] = $father;
        }
        //删除菜单
        $wxuser = get_wxuser($this->token);
        post_weixin_curl($wxuser, 'https://api.weixin.qq.com/cgi-bin/menu/delete');
        //重新创建菜单
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create';
        $menu = cjson_encode($menu);
        $result = post_weixin_curl($wxuser, $url, $menu);
        if ($result) {
            if ($result['errcode'] == 0) {
                return show(1, '操作成功');
            } else {
                $error = $this->error_code($result['errcode']);//失败提示错误信息代码
                if ($result['errcode'] == '40054') {
                    return show(0, '失败,错误码:' . $result['errcode'] . '。请检查菜单内容。菜单内容不正确');
                } elseif ($error) {
                    return show(0, '失败,错误码:' . $result['errcode'] . '(' . $error . ')');
                } else {
                    return show(0, '失败,错误码:' . $result['errcode'] . '请对照全局错误码表参看错误');
                }
            }
        } else {
            return show(0, '操作失败');
        }
    }

    ////失败提示错误信息代码
    public function error_code($code)
    {
        $array = array(
            1 => '系统繁忙',
            0 => '请求成功',
            40001 => '获取access_token时AppSecret错误，或者access_token无效',
            40002 => '不合法的凭证类型',
            40003 => '不合法的OpenID',
            40004 => '不合法的媒体文件类型',
            40005 => '不合法的文件类型',
            40006 => '不合法的文件大小',
            40007 => '不合法的媒体文件id',
            40008 => '不合法的消息类型',
            40009 => '不合法的图片文件大小',
            40010 => '不合法的语音文件大小',
            40011 => '不合法的视频文件大小',
            40012 => '不合法的缩略图文件大小',
            40013 => '不合法的APPID',
            40014 => '不合法的access_token',
            40015 => '不合法的菜单类型',
            40016 => '不合法的按钮个数',
            40017 => '不合法的按钮个数',
            40018 => '不合法的按钮名字长度',
            40019 => '不合法的按钮KEY长度',
            40020 => '不合法的按钮URL长度',
            40021 => '不合法的菜单版本号',
            40022 => '不合法的子菜单级数',
            40023 => '不合法的子菜单按钮个数',
            40024 => '不合法的子菜单按钮类型',
            40025 => '不合法的子菜单按钮名字长度',
            40026 => '不合法的子菜单按钮KEY长度',
            40027 => '不合法的子菜单按钮URL长度',
            40028 => '不合法的自定义菜单使用用户',
            40029 => '不合法的oauth_code',
            40030 => '不合法的refresh_to',
            40031 => '不合法的openid列表',
            40032 => '不合法的openid列表长度',
            40033 => '不合法的请求字符，不能包含\uxxxx格式的字符',
            40035 => '不合法的参数',
            40038 => '不合法的请求格式',
            40039 => '不合法的URL长度',
            40050 => '不合法的分组id',
            40051 => '分组名字不合法',
            41001 => '缺少access_token参数',
            41002 => '缺少appid参数',
            41003 => '缺少refresh_token参数',
            41004 => '缺少secret参数',
            41005 => '缺少多媒体文件数据',
            41006 => '缺少media_id参数',
            41007 => '缺少子菜单数据',
            41008 => '缺少oauthcode',
            41009 => '缺少openid',
            42001 => 'access_token超时',
            42002 => 'refresh_token超时',
            42003 => 'oauth_code超时',
            43001 => '需要GET请求',
            43002 => '需要POST请求',
            43003 => '需要HTTPS请求',
            43004 => '需要接收者关注',
            43005 => '需要好友关系',
            44001 => '多媒体文件为空',
            44002 => 'POST的数据包为空',
            44003 => '图文消息内容为空',
            44004 => '文本消息内容为空',
            45001 => '多媒体文件大小超过限制',
            45002 => '消息内容超过限制',
            45003 => '标题字段超过限制',
            45004 => '描述字段超过限制',
            45005 => '链接字段超过限制',
            45006 => '图片链接字段超过限制',
            45007 => '语音播放时间超过限制',
            45008 => '图文消息超过限制',
            45009 => '接口调用超过限制',
            45010 => '创建菜单个数超过限制',
            45015 => '回复时间超过限制',
            45016 => '系统分组，不允许修改',
            45017 => '分组名字过长',
            45018 => '分组数量超过上限',
            46001 => '不存在媒体数据',
            46002 => '不存在的菜单版本',
            46003 => '不存在的菜单数据',
            46004 => '不存在的用户',
            47001 => '解析JSON/XML内容错误',
            48001 => 'api功能未授权',
            50001 => '用户未授权该api'
        );
        if (array_key_exists($code, $array)) {
            return $array [$code];
        } else {
            return false;
        }
    }

    public function save($data)
    {
        try {
            $id = D("WxMenu")->updateById($data['id'], $data);
            if ($id === false) {
                return show(0, '修改失败');
            }
            return show(1, '修改成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
}