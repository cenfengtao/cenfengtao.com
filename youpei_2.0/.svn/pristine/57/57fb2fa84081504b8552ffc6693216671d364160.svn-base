<?php
/**
 *二维码管理
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class QrcodeController extends CommonController
{
    //二维码列表
    public function qrcodeList()
    {
        if ($this->isSuper) {
            $qrcodeList = M('Qrcode')->order('create_time desc')->select();
        } else {
            $qrcodeList = D('Qrcode')->getList($this->token);
        }
        foreach ($qrcodeList as $key => $val) {
            $qrcodeList[$key]['scan_count'] = D('QrcodeRecord')->getCountBySceneId($val['scene_id']);
            $qrcodeList[$key]['org_name'] = D('Organization')->getOrgnameByToken($val['token']);
        }
        $this->assign('qrcodeList', $qrcodeList);
        $this->display();
    }

    public function addQrcode()
    {
        if ($_POST) {
            if (!$_POST['scene_id'] || !is_numeric($_POST['scene_id']) || $_POST['scene_id'] > 9999 || $_POST['scene_id'] < 1) {
                return show(0, '场景ID不在范围内');
            }
            if (!$_POST['title'] || empty($_POST['title'])) {
                return show(0, '标题不能为空');
            }
            //判断是否有同一个场景id
            $isSceneId = D('Qrcode')->isSceneId($_POST['scene_id'], $this->token);
            if ($isSceneId) {
                return show(0, '场景id不能重复');
            }
            try {
                $_POST['create_time'] = time();
                $_POST['token'] = $this->token;
                $id = D('Qrcode')->insert($_POST);
                if ($id) {
                    $updateId = $this->getQrcodeBySceneId($id, $_POST['scene_id']);
                    if ($updateId) {
                        return show(1, '添加成功');
                    } else {
                        return show(0, '添加失败');
                    }
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

    public function delete()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('Qrcode')->delete($_POST['id']);
            if ($result) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function getQrcodeBySceneId($id, $scene_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create";
        $body = array(
            'action_name' => 'QR_LIMIT_SCENE',
            'action_info' => array(
                'scene' => array(
                    'scene_id' => $scene_id
                )
            )
        );
        $body = json_encode($body);
        //生成结果返回
        $wxuser = get_wxuser($this->token);
        $result = post_weixin_curl($wxuser, $url, $body);
        //成功后返回index
        if (!$result ['ticket']) {
            D('Qrcode')->delete($id);
            error_log("QRCODE:" . print_r($result, 1));
            return show(0, '添加失败，请重试');
        } else {
            //把地址保存公众号表中
            $updateId = D('Qrcode')->updateById($id, array('url' => 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . $result ['ticket']));
            return $updateId;
        }
    }

    //扫码记录
    public function recordList()
    {
        /*
         * 分页操作逻辑
         * */
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
        if ($this->isSuper) {
            $recordList = D('QrcodeRecord')->getListForQrcode(array(), $page, $pageSize);
            $count = D('QrcodeRecord')->getCount();
        } else {
            $recordList = D('QrcodeRecord')->getListForQrcode(array('token' => $this->token), $page, $pageSize);
            $count = D('QrcodeRecord')->getCount(array('token' => $this->token));
        }

        $res = new Page($count, $pageSize);
        $page = $res->show();
        foreach ($recordList as $key => $val) {
            $recordList[$key]['username'] = D('User')->getNameById($val['user_id']);
            $recordList[$key]['username'] = $recordList[$key]['username'] ?: '';
        }
        $this->assign('recordList', $recordList)->assign('page', $page);
        $this->display('Qrcode:recordList');
    }

    //设置回复信息
    public function setReply()
    {
        if ($_POST) {
            if (!$_POST['scan_reply'] || empty($_POST['scan_reply'])) {
                return show(0, '回复内容不能为空');
            }
            if (!$_POST['image'] || empty($_POST['image'])) {
                unset($_POST['image']);
            }
            if (!$_POST['id'] || empty($_POST['id'])) {
                $_POST['token'] = $this->token;
                $id = D('ScanReply')->insert($_POST);
            } else {
                $id = D('ScanReply')->updateById($_POST['id'], $_POST);
            }
            if ($id) {
                return show(1, '设置成功');
            } else {
                return show(0, '设置失败');
            }
        } else {
            if (!$_GET['scene_id'] || !is_numeric($_GET['scene_id'])) {
                $this->error('场景ID参数错误');
            }
            $qrcodeId = M('qrcode')->where(['scene_id' => $_GET['scene_id']])->getField('id');
            $reply = D('ScanReply')->findByToken($this->token, $_GET['scene_id']);
            $this->assign('reply', $reply)->assign('scene_id', $_GET['scene_id'])->assign('qrcodeId', $qrcodeId);
            $this->display();
        }
    }

    public function uploadImage()
    {
        $config = array(
            'maxSize' => 0, //上传的文件大小限制 (0-不做限制)
            'exts' => array('jpg', 'png', 'gif', 'jpeg'), //允许上传的文件后缀
            'rootPath' => './Upload/', //保存根路径
            'driver' => 'LOCAL', // 文件上传驱动
            'subName' => array('date', 'Y-m'),
            'savePath' => I('dir', 'uploads') . "/"
        );
        $dirs = explode(",", C("YP_UPLOAD_DIR"));
        if (!in_array(I('dir', 'uploads'), $dirs)) {
            echo '非法文件目录！';
            return false;
        }

        $upload = new \Think\Upload($config);
        $rs = $upload->upload($_FILES);
        $Filedata = key($_FILES);
        if (!$rs) {
            $this->error($upload->getError());
        } else {
            $images = new \Think\Image();
            $images->open('./Upload/' . $rs[$Filedata]['savepath'] . $rs[$Filedata]['savename']);
            $newsavename = str_replace('.', '_thumb.', $rs[$Filedata]['savename']);
            $vv = $images->thumb(I('width', 640), I('height', 960), 6)->save('./Upload/' . $rs[$Filedata]['savepath'] . $newsavename);
            if (C('YP_M_IMG_SUFFIX') != '') {
                $msuffix = C('YP_M_IMG_SUFFIX');
                $mnewsavename = str_replace('.', $msuffix . '.', $rs[$Filedata]['savename']);
                $mnewsavename_thmb = str_replace('.', "_thumb" . $msuffix . '.', $rs[$Filedata]['savename']);
                $images->open('./Upload/' . $rs[$Filedata]['savepath'] . $rs[$Filedata]['savename']);
                $images->thumb(I('width', 700), I('height', 700))->save('./Upload/' . $rs[$Filedata]['savepath'] . $mnewsavename);
                $images->thumb(I('width', 250), I('height', 250))->save('./Upload/' . $rs[$Filedata]['savepath'] . $mnewsavename_thmb);
            }
            $rs[$Filedata]['savepath'] = "Upload/" . $rs[$Filedata]['savepath'];
            $rs[$Filedata]['savethumbname'] = $newsavename;
            $rs['status'] = 1;
            $this->ajaxReturn($rs, 'JSON');
        }
    }

    //设为当前活动
    public function setAction()
    {
        if (!$_POST['id'] || !is_numeric($_POST['id'])) {
            return show(0, 'ID参数错误');
        }
        if (!$_POST['token'] || empty($_POST['token'])) {
            return show(0, 'TOKEN参数错误');
        }
        try {
            //把已设置当前活动取消
            M('Qrcode')->where(array('token' => $_POST['token']))->save(array("is_action" => 1));
            $id = D('Qrcode')->updateById($_POST['id'], array('is_action' => 2));
            if ($id) {
                return show(1, '设置成功');
            } else {
                return show(0, '设置失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    //预览
    public function preview()
    {
        if (!$_POST['path'] || empty($_POST['path'])) {
            return show(0, '图片地址参数错误');
        }
        $name = uniqid(time()) . '.png';
        $filename = './Upload/' . $name;
        $logo = "http://" . $_SERVER['HTTP_HOST'] . $_POST['path'];
        $qrFilename = $this->qrcodeByPoster('测试二维码', $filename, true, $logo, 9, 'L', 2, true);
        return show(1, '成功', array('path' => $qrFilename));
    }

    function qrcodeByPoster($data, $filename, $picPath = false, $logo = false, $size = '4', $level = 'L', $padding = 2, $saveandprint = false)
    {
        import("Vendor.phpqrcode.phpqrcode");//引入工具包
        // 下面注释了把二维码图片保存到本地的代码,如果要保存图片,用$fileName替换第二个参数false
        $path = $picPath ? $picPath : SITE_PATH . "\\Public\\qrcode"; //图片输出路径
        mkdir($path);

        //在二维码上面添加LOGO
        if (empty($logo) || $logo === false) { //不包含LOGO
            if ($filename == false) {
                \QRcode::png($data, false, $level, $size, $padding, $saveandprint); //直接输出到浏览器，不含LOGO
            } else {
                // $filename=$path.'/'.$filename; //合成路径
                \QRcode::png($data, $filename, $level, $size, $padding, $saveandprint); //直接输出到浏览器，不含LOGO
            }
        } else { //包含LOGO
            if ($filename == false) {
                //$filename=tempnam('','').'.png';//生成临时文件
                die('参数错误');
            } else {
                //生成二维码,保存到文件
                // $filename = $path . '\\' . $filename; //合成路径
            }
            \QRcode::png($data, $filename, $level, $size, $padding);
            $QR = imagecreatefromstring(file_get_contents($filename));
            $logo = imagecreatefromstring(file_get_contents($logo));

            $QR_width = imagesx($QR);
            $QR_height = imagesy($QR);
            imagecopyresampled($logo, $QR, 445, 840, 0, 0, 250, 250, $QR_width, $QR_height);
            if ($saveandprint === true) {
//                $qrFilename = 'Qrcode/images/' . uniqid(time()) . '.png';
                $qrFilename = 'Upload/' . uniqid(time()) . '.png';
                imagepng($logo, $qrFilename);
                return $qrFilename;
            }
        }
        return $filename;
    }

    public function actionList()
    {
        if (!$_GET['scene_id'] || empty($_GET['scene_id'])) {
            return show(0, 'ID参数错误');
        }
        $share_user_id = M('qrcode_record')->where(array('scene_id' => $_GET['scene_id']))->distinct(true)->field('share_user_id')->select();
        $sceneList = [];
        foreach ($share_user_id as $k => $v) {
            if ($v['share_user_id'] != 0) {
                $sceneList[$k]['username'] = D('User')->getNameById($v['share_user_id']);
                $sceneList[$k]['count'] = D('QrcodeRecord')->count(array('share_user_id' => $v['share_user_id'], 'scene_id' => $_GET['scene_id']));
                $sceneList[$k]['scene_id'] = $_GET['scene_id'];
                $sceneList[$k]['user_id'] = $v['share_user_id'];
                $sceneList[$k]['create_time'] = M('qrcode_record')->where(array('user_id' => $v['share_user_id']))->getField('create_time');
            }
        }
        $this->assign('sceneList', $sceneList);
        $this->display();
    }

    public function helpList()
    {
        if (!$_GET['user_id'] || empty($_GET['user_id'])) {
            return show(0, 'USERID参数错误');
        }
        if (!$_GET['scene_id']) {
            return show(0, 'SCENEID参数错误');
        }
        $userList = M('QrcodeRecord')->where(array('share_user_id' => $_GET['user_id'], 'scene_id' => $_GET['scene_id']))->select();
        foreach ($userList as $k => $v) {
            $userList[$k]['username'] = D('User')->getNameById($v['user_id']);
        }
        $this->assign('userList', $userList);
        $this->display();
    }

    public function setSale()
    {
        if (!$_GET['qrcodeId'] || !$_GET['sort']) {
            $this->error('参数错误');
        }
        $list = M('qrcode_sale')->where(['qrcode_id' => $_GET['qrcodeId'], 'template_number' => $_GET['sort']])->select();
        foreach ($list as $key => $val) {
            $product = M('product')->where(['id' => $val['type_id']])->field('title,pic_url')->find();
            $list[$key]['productTitle'] = $product['title'];
            $list[$key]['image'] = $product['pic_url'];
        }
        $this->assign('list', $list)->assign('qrcodeId', $_GET['qrcodeId'])->assign('sort', $_GET['sort']);
        $this->display();
    }

    public function addSale()
    {
        if ($_POST) {
            if (!$_POST['proId'] || !$_POST['qrcodeId'] || !$_POST['sort']) {
                return show(0, '参数错误');
            }
            if (!is_numeric($_POST['price']) || $_POST['price'] <= 0) {
                return show(0, '价钱设置不正确');
            }
            if (!is_numeric($_POST['count']) || $_POST['count'] < 0) {
                return show(0, '库存不能少于0');
            }
            if (!$_POST['key']) {
                return show(0, '请选择规格');
            }
            $insertData = [
                'create_time' => time(),
                'count' => $_POST['count'],
                'type' => 1,
                'type_id' => $_POST['proId'],
                'price' => $_POST['price'],
                'qrcode_id' => $_POST['qrcodeId'],
                'template_number' => $_POST['sort'],
                'key' => $_POST['key']
            ];
            $id = D('QrcodeSale')->insert($insertData);
            if ($id) {
                return show(1, '添加成功');
            } else {
                return show(0, '添加失败');
            }
        } else {
            if (!$_GET['qrcodeId'] || !$_GET['sort']) {
                $this->error('参数错误');
            }
            $productList = M('product')->field('id,title')->where(['status' => 1, 'check_status' => 2, 'type' => 2])->select();
            $this->assign('qrcodeId', $_GET['qrcodeId'])->assign('productList', $productList)->assign('sort', $_GET['sort']);
            $this->display();
        }
    }

    public function editSale()
    {
        if ($_POST) {
            if (!$_POST['id']) {
                return show(0, '参数错误');
            }
            if (!is_numeric($_POST['price']) || $_POST['price'] <= 0) {
                return show(0, '价钱设置不正确');
            }
            if (!is_numeric($_POST['count']) || $_POST['count'] < 0) {
                return show(0, '库存不能少于0');
            }
            $updateData = [
                'price' => $_POST['price'],
                'count' => $_POST['count']
            ];
            $id = D('QrcodeSale')->updateById($_POST['id'], $updateData);
            if ($id === false) {
                return show(0, '修改失败');
            } else {
                return show(1, '修改成功');
            }
        } else {
            if (!$_GET['id']) {
                $this->error('参数错误');
            }
            $sale = D('QrcodeSale')->find($_GET['id']);
            $sale['title'] = M('product')->where(['id' => $sale['type_id']])->getField('title');
            $prices = M('product')->where(['id' => $sale['type_id']])->getField('price');
            $prices = json_decode($prices, true);
            $classNormal = $prices[$sale['key']]['class_normal'];
            $originalPrice = $prices[$sale['key']]['price'];
            $this->assign('sale', $sale)->assign('classNormal', $classNormal)->assign('originalPrice', $originalPrice);
            $this->display();
        }
    }

    public function deleteSale()
    {
        if (!$_POST['id'] || empty($_POST['id'])) {
            return show(0, '参数错误');
        }
        try {
            $result = D('QrcodeSale')->delete($_POST['id']);
            if ($result) {
                return show(1, '删除成功');
            } else {
                return show(0, '删除失败');
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
}