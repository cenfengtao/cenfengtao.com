<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

require_once __DIR__ . '/../../../ThinkPHP/Library/Vendor/ChuanglanSmsHelper/ChuanglanSmsApi.php';

class ActivityInviteController extends BaseController
{
    public function getInvite()
    {
        $this->display();
    }

    public function getInviteNotInfo()
    {
        $this->display();
    }

    public function ajaxGetInvite()
    {
        if (!$_GET['id']) {
            return show(0, '参数错误');
        }
        //判断是否已报名
        $isInvite = M('invite_info')->where(['activity_id' => $_GET['id'], 'user_id' => $this->user['id']])->getField('id');
        $invite = D('ActivityInvite')->find($_GET['id']);
        if (!$invite) {
            return show(0, '找不到任何记录');
        }
        if (!empty($isInvite)) {
            return show(2, '获取成功', ['info_id' => $isInvite, 'invite' => $invite]);
        } else {
            //判断是否还有名额
            $inviteMaxNumber = M('invite_info')->where(['activity_id' => $_GET['id']])->max('number');
            if (($invite['max_people'] <= $inviteMaxNumber) && $invite['max_people'] != 0) {
                return show(3, '名额已经被抢光了，请期待下期活动', ['invite' => $invite]);
            } else {
                return show(1, '获取成功', ['invite' => $invite]);
            }
        }
    }

    public function getCode()
    {
        if (!preg_match("/^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/", $_POST['mobile'])) {
            return show(0, '手机格式不正确');
        }
        //判断手机号码今天是否接收过通知
        $todayTime = strtotime(date("Y-m-d", time()));
        $sendCount = M('sms_code')->where(['mobile' => $_POST['mobile'], 'send_status' => ['neq', 1], 'type' => 1, 'create_time' => ['egt', $todayTime]])->count();
        if ($sendCount >= 5) {
            return show(0, '已经超出今天可用的次数了');
        }
        $code = $this->generate_code(4);
        $codeData = [
            'create_time' => time(),
            'user_id' => $this->user['id'],
            'mobile' => $_POST['mobile'],
            'code' => $code,
            'status' => 1,
            'send_status' => 1,
            'type' => 1,
        ];
        $id = D('SmsCode')->insert($codeData);
        //把之前的验证码改成已失效
        M('sms_code')->where(['user_id' => $this->user['id'], 'status' => 1, 'send_status' => 2, 'type' => 1,
            'id' => ['neq', $id]])->save(['status' => 3]);
        if ($id) {
            //发送短信
            $sms = new \ChuanglanSmsApi();
            $msg = '家长您好！你报名参加的【富力足球嘉年华】验证码：{$var}，输入验证码生成电子入门券，短信有效时间为2分钟。';
            $params = "{$_POST['mobile']},{$code}";
            $result = $sms->sendVariableSMS($msg, $params);
            if (!is_null(json_decode($result))) {
                $output = json_decode($result, true);
                if (isset($output['code']) && $output['code'] == '0') {
                    $updateData = [
                        'send_status' => 2,
                        'content' => $msg,
                    ];
                    D('SmsCode')->updateById($id, $updateData);
                } else {
                    $updateData = [
                        'send_status' => 3,
                        'content' => $msg,
                        'errmsg' => $output['errorMsg'],
                        'errcode' => $output['code'],
                    ];
                    D('SmsCode')->updateById($id, $updateData);
                }
            } else {
                $updateData = [
                    'send_status' => 3,
                    'content' => $msg,
                    'errmsg' => '发送失败',
                    'errcode' => '-1',
                ];
                D('SmsCode')->updateById($id, $updateData);
            }
        } else {
            return show(0, '编辑短信失败');
        }
    }

    function generate_code($length = 6)
    {
        return rand(pow(10, ($length - 1)), pow(10, $length) - 1);
    }

    public function submitInfo()
    {
        if (!$_POST['username']) {
            return show(0, '用户名不能为空');
        }
        if (!preg_match("/^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/", $_POST['mobile'])) {
            return show(0, '手机格式不正确');
        }
        if (!$_POST['school']) {
            return show(0, '学校名称不能为空');
        }
        if (!$_POST['code']) {
            return show(0, '验证码不能为空');
        }
        if (!$_POST['activityId']) {
            return show(0, '活动参数错误');
        }
        //判断验证码是否有效
        $codeId = M('sms_code')->where(['user_id' => $this->user['id'], 'create_time' => ['egt', time() - 7200],
            'code' => $_POST['code'], 'status' => 1])->getField('id');
        if (empty($codeId)) {
            return show(0, '验证码不正确或已失效');
        } else {
            D('SmsCode')->updateById($codeId, ['status' => 2]);
        }
        //判断是否曾经已生成
        $isInvite = M('invite_info')->where(['user_id' => $this->user['id'], 'activity_id' => $_POST['activityId']])->find();
        if ($isInvite) {
            return show(1, '', ['inviteInfo' => $isInvite]);
        }
        //判断是否还有名额
        $inviteMaxPeople = M('activity_invite')->where(['id' => $_POST['activityId']])->getField('max_people');
        $inviteMaxNumber = M('invite_info')->where(['activity_id' => $_POST['activityId']])->max('number');
        if (($inviteMaxPeople <= $inviteMaxNumber) && $inviteMaxPeople != 0) {
            return show(0, '名额已经被抢光了，请期待下期活动');
        }
        $infoData = [
            'create_time' => time(),
            'user_id' => $this->user['id'],
            'activity_id' => $_POST['activityId'],
            'username' => $_POST['username'],
            'mobile' => $_POST['mobile'],
            'school' => $_POST['school'],
            'number' => $inviteMaxNumber + 1,
        ];
        $infoId = D('InviteInfo')->insert($infoData);
        if ($infoId) {
            return show(1, '', ['info_id' => $infoId]);
        } else {
            return show(0, '系统错误，请联系客服');
        }
    }

    public function getTicket()
    {
        if (!$_GET['info_id']) {
            return show(0, '参数错误');
        }
        $inviteInfo = D('InviteInfo')->find($_GET['info_id']);
        $background = imagecreatetruecolor(799, 444); // 背景图片
        $color = imagecolorallocate($background, 255, 255, 255); // 为真彩色画布创建白色背景，再设置为透明
        imagefill($background, 0, 0, $color);
        //判断背景图片类型
        $backgroundImage = "/Public/images/ticket_image.jpg";
        $backgroundPathInfo = pathinfo($backgroundImage);
        switch (strtolower($backgroundPathInfo['extension'])) {
            case 'jpg' :
            case 'jpeg' :
                $gdProductPic = imagecreatefromjpeg('.' . $backgroundImage);
                break;
            case 'png' :
                $gdProductPic = imagecreatefrompng('.' . $backgroundImage);
                break;
            default :
                $productPic = file_get_contents('.' . $backgroundImage);
                $gdProductPic = imagecreatefromstring('.' . $productPic);
        }
        //商品图片位置
        imagecopyresized($background, $gdProductPic, 0, 0, 0, 0, 799, 444, imagesx($gdProductPic), imagesy($gdProductPic));
        //提示
        $number = $inviteInfo['number'];
        $numberLength = strlen($number);
        for ($i = 0; $i < 6 - $numberLength; $i++) {
            $number = '0' . $number;
        }
        imagettftext($background, 18, 0, 300, 165, imagecolorallocate($background, 0, 68, 238), "Font/msyh.ttc", $inviteInfo['username']);
        imagettftext($background, 18, 0, 300, 200, imagecolorallocate($background, 0, 68, 238), "Font/msyh.ttc", $inviteInfo['school']);
        imagettftext($background, 18, 0, 300, 235, imagecolorallocate($background, 0, 68, 238), "Font/msyh.ttc", $number);
        //真正的编号
        imagettftext($background, 18, 0, 60, 376, imagecolorallocate($background, 0, 0, 0), "Font/msyh.ttc", $number);
        $posterDir = "Upload/" . date("Ymd", time()) . '/';
        if (!file_exists($posterDir)) {
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mkdir($posterDir, 0777, true);
        }
        $posterFilename = "Upload/" . date('Ymd', time()) . "/" . uniqid(time()) . '.png';
//        header("content-type:image/png");
//        imagepng($background);
        imagepng($background, $posterFilename);
        return show(1, '', '/' . $posterFilename);
    }
}