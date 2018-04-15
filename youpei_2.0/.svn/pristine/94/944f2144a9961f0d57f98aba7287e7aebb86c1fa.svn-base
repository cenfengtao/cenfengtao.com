<?php
namespace Home\Controller;

use Think\Controller;

require_once __DIR__ . '/../../../ThinkPHP/Library/Org/Util/JSDDK.class.php';

class AroundController extends BaseController
{
    public function index()
    {
        $this->title = "亲子列表";
        $cateId = $_GET['cate_id'] ? $_GET['cate_id'] : 0;
        if ($cateId == 0) {
            $list = D('Parenting')->getUpList(10, array('status' => 1, 'check_status' => 2));
        } else {
            $list = D('Parenting')->getUpListById(10, array('status' => 1, 'cate_id' => $cateId, 'check_status' => 2));
        }
        foreach ($list as $k => $v) {
            $tags = explode(' ', $v['tag']);
            $list[$k]['tagA'] = $tags[0] ?: '';
            $list[$k]['tagB'] = $tags[1] ?: '';
            $list[$k]['tagC'] = $tags[2] ?: '';
            $org[$k] = M('organization')->where(array('id' => $v['org_id']))->find();
            $list[$k]['address'] = $org[$k]['city'] . $org[$k]['area'] . $org[$k]['address'];
            $list[$k]['time'] = date('Y-m-d', $v['create_time']);
            $list[$k]['logo'] = $org[$k]['picture'];
        }
        $Homep = D('ParentingCate')->getParentingCate();
        $this->assign('list', $list)->assign('Homep', $Homep)->assign('cateId', $cateId);
        $this->display();
    }

    public function productDetails()
    {
        if ($_POST) {
            if (!$_POST['par_id'] || empty($_POST['par_id'])) {
                return show(0, '活动参数错误');
            }
            if (!$_POST['content'] || empty($_POST['content'])) {
                return show(0, '咨询内容不能为空');
            }
            $insertData = array(
                'parenting_id' => $_POST['par_id'],
                'user_id' => $this->user['id'],
                'create_time' => time(),
                'type' => 1,
                'status' => 1,
                'token' => $this->token,
                'content' => $_POST['content']
            );
            $id = D('ProductComment')->insert($insertData);
            $list = D('ProductComment')->find($id);
            $headImg = M('user')->where("id={$list['user_id']}")->field('headimgurl')->find();
            $list['headImg'] = $headImg['headimgurl'];
            if (!$list || empty($list)) {
                $this->ajaxReturn(array('status' => 0, 'msg' => '咨询失败'));
            } else {
                $this->ajaxReturn(array('status' => 1, 'msg' => '咨询成功', 'data' => $list));
            }
        } else {
            $this->title = "活动名称";
            if (!$_GET['par_id'] || !is_numeric($_GET['par_id'])) {
                $this->error('获取不到该商品信息');
            }
            try {
                $product = D('Parenting')->find($_GET['par_id']);
                //增加浏览记录
                $this->addFootprint(5, $product['id']);
                $productComment = D('ProductComment')->getCommentByFatherParId(0, 0, $_GET['par_id']);
                foreach ($productComment as $k => $v) {
                    $productComment[$k]['child'] = M('ProductComment')->where(array('type_id' => $v['id'], 'parenting_id' => $v['parenting_id'], 'status' => 1))->select();
                    $productComment[$k]['headImg'] = D('user')->getHeadById($v['user_id']);
                    foreach ($productComment[$k]['child'] as $ke => $va) {
                        //回复
                        if ($va['is_gm'] == 2) {
                            //待机构管理员完善之后需修改
                            //客服头像
                            $picture = M('organization')->field('picture')->where(array('token' => $this->token))->find();
                            $productComment[$k]['child'][$ke]['headImg'] = $picture['picture'];
                        } elseif ($va['is_gm'] == 1) {
                            $productComment[$k]['child'][$ke]['headImg'] = D('user')->getHeadById($va['user_id']);
                        }
                        //被回复
                        $userId = M('ProductComment')->where(array('id' => $productComment[$k]['child'][$ke]['father_id']))->find();
                        if ($userId['is_gm'] == 2) {
                            $pictures = M('organization')->field('picture')->where(array('token' => $userId['token']))->find();
                            $productComment[$k]['child'][$ke]['headImgs'] = $pictures['picture'];
                        } else if ($userId['is_gm'] == 1) {
                            $productComment[$k]['child'][$ke]['headImgs'] = D('user')->getHeadById($userId['user_id']);
                        }
                    }
                }
                //标签
                $tags = explode(' ', $product['tag']);
                //机构
                $organization = D('Organization')->find($product['org_id']);
                $this->assign('product', $product)->assign('productComment', $productComment)->assign('tags', $tags)
                    ->assign('organization', $organization);
                //获取ticket
                $wxuser = get_wxuser($this->token);
                $jssdk = new \JSSDK($wxuser['appid'], $wxuser['appsecret']);
                $signPackage = $jssdk->GetSignPackage();
                //分享内容图片和链接地址
                $shareImg = 'http://' . $_SERVER["HTTP_HOST"] . $product['image'];
                $shareUrl = 'http://' . $_SERVER["HTTP_HOST"] . U('Parenting/productDetails', array('share_user_id' =>
                        $this->user['id'], 'par_id' => $_GET['par_id'], 'token' => $this->token));
                //购买商品的所有用户头像
                $productId = $_GET['par_id'];
                $userId = D('Order')->getGroupByParId($productId);
                foreach ($userId as $k => $v) {
                    $headImg[$k]['headImg'] = D('User')->getHeadById($v['user_id']);
                }
                $userCount = sizeof($userId);
                //是否收藏
                $isCollect = D('Collect')->isCollectById($this->user['id'], $_GET['par_id'], '4');
                $this->assign('signPackage', $signPackage)->assign('share_img', $shareImg)->assign('share_url', $shareUrl);
                $this->assign('headImg', $headImg)->assign('userCount', $userCount)->assign('isCollect', $isCollect);
                $this->display();
            } catch (Exception $e) {
                $this->error($e->getMessage());
            }
        }
    }

    public function checkOrderInfo()
    {
        $this->title = "活动详情";
        if (!$_GET['par_id'] || !is_numeric($_GET['par_id'])) {
            $this->error('获取不到该活动信息');
        }
        try {
            $product = D('Parenting')->find($_GET['par_id']);
            $this->assign('product', $product);
            $this->display();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function confirmationInfo()
    {
        if (!$_GET['par_id']) {
            return show(0, '参数错误');
        }
        if (!$_GET['amount'] || $_GET['amount'] < 1) {
            return show(0, '数量参数错误');
        }
        if (!$_GET['name']) {
            return show(0, '联系人不能为空');
        }
        if (!$_GET['mobile']) {
            return show(0, '联系电话不能为空');
        }
        $this->display();
    }

    public function ajaxConfirmationInfo()
    {
        if (!$_GET['par_id']) {
            return show(0, '参数错误');
        }
        if (!$_GET['amount'] || $_GET['amount'] < 1) {
            return show(0, '数量参数错误');
        }
        $parenting = M('parenting')->where(['id' => $_GET['par_id']])->field('desc,cost', true)->find();
        $price = $parenting['price'];
        if ($parenting['count'] < $_GET['amount']){
            return show(0,'数量超出库存范围，请返回上一页刷新之后再选择');
        }
        $couponByUser = M('coupon')->where(['status' => 1, 'user_id' => $this->user['id']])->select();
        $couponList = [];
        $totalPrice = $price * $_GET['amount'];
        foreach ($couponByUser as $key => $val) {
            //判断有否过期
            $offer = M('coupon_offer')->where(['id' => $val['offer_id']])->find();
            if ($offer['end_time'] <= time()) {
                M('coupon')->where(['id' => $val['id']])->save(['status' => 4]);
                continue;
            }
            //判断该商品是否可用
            if ($offer['type'] == 1 && $offer['type_id'] != $parenting['org_id']) {
                continue;
            }
            //判断商品总额，是否可用
            if ($offer['coupon_type'] == 1 && $offer['full'] > $totalPrice) {
                continue;
            }
            $couponList[$key] = [
                'full' => $offer['full'],
                'subtract' => $offer['subtract'],
                'start_time' => date("Y.m.d", $offer['start_time']),
                'end_time' => date("Y.m.d", $offer['end_time']),
                'fee' => $offer['fee'],
                'coupon_type' => $offer['coupon_type'],
                'id' => $val['id']
            ];
        }
        //优惠券排序
        $flag = [];
        foreach ($couponList as $v) {
            $flag[] = $v['coupon_type'];
        }
        array_multisort($flag, SORT_DESC, $couponList);
        //现有积分
        $nowIntegral = M('user')->where("id={$this->user['id']}")->getField('integral');
        if($nowIntegral / 100 > $totalPrice) $nowIntegral = ceil($totalPrice) * 100;
        return show(1, '获取成功', ['couponList' => $couponList, 'totalPrice' => $totalPrice, 'nowIntegral' => $nowIntegral,
            'title' => $parenting['title'], 'image' => $parenting['image']]);
    }


    public function checkOrderInformation()
    {
        if (!$_GET['par_id'] || !is_numeric($_GET['par_id'])) {
            $this->error('获取不到该活动信息');
        }
        try {
            $product = D('Parenting')->find($_GET['par_id']);
            $integral = M('user')->where('id='.$this->user['id'])->getField('integral');
            $this->assign('product', $product)->assign('integral', $integral);
            $this->display();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }


    //滑动加载
    public function loadingParenting()
    {
        $npage = (int)I("npage");
        $cateId = $_POST['cate_id'] ? $_POST['cate_id'] : 0;
        if ($cateId == 0) {
            $list = D('Parenting')->getListByPage($npage);
        } else {
            $list = D('Parenting')->getListByPage($npage, $cateId);
        }
        foreach ($list as $k => $v) {
            $list[$k]['org_name'] = D('Organization')->getOrgNameById($v['cate_id']);
            $tags = explode(' ', $v['tag']);
            $list[$k]['tagA'] = $tags[0] ?: '';
            $list[$k]['tagB'] = $tags[1] ?: '';
            $list[$k]['tagC'] = $tags[2] ?: '';
            $list[$k]['cate_title'] = D('ParentingCate')->getTitleById($v['cate_id']);
            $list[$k]['time'] = date('Y-m-d', $v['create_time']);
            $list[$k]['logo'] = D('Organization')->getImageById($v['org_id']);
            $org[$k] = M('organization')->where(array('id' => $v['org_id']))->find();
            $list[$k]['address'] = $org[$k]['city'] . $org[$k]['area'] . $org[$k]['address'];
        }
        if (!$list || empty($list)) {
            $this->ajaxReturn(array('status' => 0, 'msg' => '没有数据'));
        }
        $this->ajaxReturn(array('status' => 1, 'msg' => '获取成功', 'data' => $list));
    }

    //分享记录
    public function shareRecord()
    {
        $insertData = [
            'create_time' => time(),
            'type' => 3,
            'type_id' => $_POST['par_id'],
            'desc' => '分享活动',
            'user_id' => $this->user['id'],
        ];
        D('ShareRecord')->insert($insertData);
        return show(0, '分享成功');
    }

    //用户之间留言对话
    public function comment()
    {
        if ($_POST) {
            if (!$_POST['parenting_id'] || empty($_POST['parenting_id'])) {
                $this->ajaxReturn(array('status' => 0, 'msg' => 'ID参数错误'));
            }
            if (!$_POST['father_id'] || empty($_POST['father_id'])) {
                $this->ajaxReturn(array('status' => 0, 'msg' => 'FATHER_ID参数错误'));
            }
            if (!$_POST['content'] || empty($_POST['content'])) {
                $this->ajaxReturn(array('status' => 0, 'msg' => '咨询内容不能为空'));
            }
            $data = [
                'user_id' => $this->user['id'],
                'father_id' => $_POST['father_id'],
                'parenting_id' => $_POST['parenting_id'],
                'content' => $_POST['content'],
                'token' => $this->token,
                'type_id' => $_POST['type_id'],
                'status' => 1,
                'type' => 1,
                'create_time' => time()
            ];
            $id = D('ProductComment')->insert($data);
            //评论人头像
            $reply = D('ProductComment')->find($id);
            $headImg = M('user')->where("id={$reply['user_id']}")->field('headimgurl')->find();
            $reply['headImg'] = $headImg['headimgurl'];
            //被评论人头像
            $replys = D('ProductComment')->find($_POST['father_id']);
            $headImgs = M('user')->where("id={$replys['user_id']}")->field('headimgurl')->find();
            $reply['headImgs'] = $headImgs['headimgurl'];
            if (!$reply || empty($reply)) {
                $this->ajaxReturn(array('status' => 0, 'msg' => '评论失败'));
            }
            $this->ajaxReturn(array('status' => 1, 'msg' => '评论成功', 'data' => $reply));
        }
    }


}


?>