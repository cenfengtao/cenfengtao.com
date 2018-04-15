<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;
use \Think\Image;
use Org\Util\ExcelToArray;

require_once __DIR__ . '/../../../ThinkPHP/Library/Org/Util/JSDDK.class.php';
require_once __DIR__ . '/../../../ThinkPHP/Library/Vendor/ChuanglanSmsHelper/ChuanglanSmsApi.php';

class TestController extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = [
            'id' => 7904,
        ];
    }

    public function setSessionTest()
    {
        $_SESSION['openid'] = $_GET['open_id'];
        $_SESSION['token'] = $_GET['token'];
        $this->display();
    }

    public function test()
    {
        if (!$_POST['username']) {
            return show(0, '请输入正确的名字');
        }
        //判断是否生成过
        $isCreate = M('invite_info')->where(['user_id' => $this->user['id'], 'activity_id' => 9999, 'username' => $_POST['username']])->find();
        if ($isCreate) {
            return show(1, '', $isCreate['remark']);
        }
        $imageArray = ['/test/2.png', '/test/3.png', '/test/4.png', '/test/5.png'];
        $background = imagecreatetruecolor(900, 1600); // 背景图片
        $color = imagecolorallocate($background, 255, 255, 255); // 为真彩色画布创建白色背景，再设置为透明
        imagefill($background, 0, 0, $color);
        $gdImage = imagecreatefrompng('.' . $imageArray[array_rand($imageArray, 1)]);
        imagecopyresized($background, $gdImage, 0, 0, 0, 0, 900, 1600, imagesx($gdImage), imagesy($gdImage));
        imagettftext($background, 30, 0, 30, 1130, imagecolorallocate($background, 0, 0, 0), "Font/msyh.ttc", '陈伟霆');
//        header("content-type:image/png");
//        imagepng($background);
        $posterDir = "Upload/" . date("Ymd", time()) . '/';
        if (!file_exists($posterDir)) {
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mkdir($posterDir, 0777, true);
        }
        $posterFilename = "Upload/" . date('Ymd', time()) . "/" . uniqid(time()) . '.png';
        imagepng($background, $posterFilename);
        //添加记录
        $insertData = [
            'create_time' => time(),
            'user_id' => $this->user['id'],
            'activity_id' => 9999,
            'remark' => '/' . $posterFilename,
            'username' => $_POST['username'],
        ];
        D('InviteInfo')->insert($insertData);
        return show(1, '', '/' . $posterFilename);
    }


    function generate_code($length = 6)
    {
        return rand(pow(10, ($length - 1)), pow(10, $length) - 1);
    }

    function deldir($dir)
    {
        //先删除目录下的文件：
        $dh = opendir($dir);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {
                $fullpath = $dir . "/" . $file;
                if (!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    $this->deldir($fullpath);
                }
            }
        }
        closedir($dh);
        //删除当前文件夹：
        if (rmdir($dir)) {
            return true;
        } else {
            return false;
        }
    }

    public function responseExcel()
    {
        $this->success('添加成功', 'Index/index');
    }

    //创建一个读取excel数据，可用于入库
    public function _readExcel($path)
    {
        //引用PHPexcel 类
        include_once(VENDOR_PATH . 'PHPExcel/Classes/PHPExcel.php');
        include_once(VENDOR_PATH . 'PHPExcel/Classes/PHPExcel/IOFactory.php');//静态类
        $type = 'Excel2007';//设置为Excel5代表支持2003或以下版本，Excel2007代表2007版
        $xlsReader = \PHPExcel_IOFactory::createReader($type);
        $xlsReader->setReadDataOnly(true);
        $xlsReader->setLoadSheetsOnly(true);
        $Sheets = $xlsReader->load($path);
        //开始读取上传到服务器中的Excel文件，返回一个二维数组
        $dataArray = $Sheets->getSheet(0)->toArray();
        return $dataArray;
    }


    public function updateCache()
    {
        _getDiscoverInfo();
        _getIndexInfo();
        echo '更新成功';
    }

    public function text()
    {
        $list = D('Vote')->getList();
        foreach ($list as $k => $v) {
            $number = 0;
            $contribution[$k] = M('contribution_record')->where(array('vote_id' => $v['id']))
                ->order('create_time asc')->field('id')->select();
            foreach ($contribution[$k] as $i => $l) {
                $number++;
                D('ContributionRecord')->updateById($l['id'], ['number' => $number]);
            }
        }
    }


}
