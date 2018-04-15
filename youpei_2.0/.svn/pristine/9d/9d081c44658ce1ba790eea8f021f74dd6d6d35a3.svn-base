<?php
/**
 * 拼音过滤处理
 * @author jxiao
 */
import("Vendor.Wechat.WeixinControllerModel");
use Common\Controller\Wechat;

class WeixinControllerPinyinModel extends WeixinControllerModel
{
    public function _reply()
    {
        $weixin = new Wechat ($this->token);
        $data = $this->data;
        $key = $data ['Content'];
        // 查询关键字
        import("Vendor.Wechat.WeixinControllerKeyWordsModel");
        $model = new WeixinControllerKeyWordsModel ();
        $model->setToken($this->token);
        $model->setParams("keyWord", $key);
        $model->reply($data);
        if ($model->isDone()) {
            $this->isDone = true;
            $this->data['module'] = "keyword";
            return $model->getResult();
        }
    }


    // 快递
    function kuaidi($key, $data)
    {
        preg_match("/[0-9]+/", $key, $data);
        $name = preg_replace('[快递|\d]', '', $key);
        import("@.Model.Home.WeixinControllerExpressModel");
        $model = new WeixinControllerExpressModel ();
        $model->setToken($this->token);
        $model->setParams("keyWord", $key);
        $model->setParams("express_name", $name);
        $model->setParams("express_no", $data[0]);
        $data = $model->reply($data);
        if ($data ['resultcode'] == 200) {
            $str = "物流公司:{$data['result']['company']}\n 物流编号:{$data['result']['no']}\n ";
            $list = $data ['result'] ['list'];
            if (empty ($list)) {
                $str .= " 暂无物流信息";
            } else {
                $str .= " 物流信息如下:\n";
            }
            foreach ($list as $value) {
                $str .= "时间:{$value['datetime']} \n 备注:{$value['remark']}\n ___________\n";
            }
            return $str;
        } else {
            return '查询失败';
        }
        //return $r;
    }

    // 朗读
    function langdu($data)
    {
        $data = implode('', $data);
        $mp3url = 'http://www.apiwx.com/aaa.php?w=' . urlencode($data);
        return array(
            array(
                $data,
                '点听收听',
                $mp3url,
                $mp3url
            ),
            'music'
        );
    }

    // 健康
    function jiankang($data)
    {
        if (empty ($data))
            return '主人，' . $this->my . "提醒您\n正确的查询方式是:\n健康+身高,+体重\n例如：健康170,65";
        $height = $data [1] / 100;
        $weight = $data [2];
        $Broca = ($height * 100 - 80) * 0.7;
        $kaluli = 66 + 13.7 * $weight + 5 * $height * 100 - 6.8 * 25;
        $chao = $weight - $Broca;
        $zhibiao = $chao * 0.1;
        $res = round($weight / ($height * $height), 1);
        if ($res < 18.5) {
            $info = '您的体形属于骨感型，需要增加体重' . abs($chao) . '公斤哦!';
            $pic = 1;
        } elseif ($res < 24) {
            $info = '您的体形属于圆滑型的身材，需要增加体重' . abs($chao) . '公斤哦!';
        } elseif ($res > 24) {
            $info = '您的体形属于肥胖型，需要减少体重' . abs($chao) . '公斤哦!';
        } elseif ($res > 28) {
            $info = '您的体形属于严重肥胖，请加强锻炼，或者使用我们推荐的减肥方案进行减肥';
        }
        return $info;
    }

    // 附近
    function fujin($keyword)
    {
        $keyword = implode('', $keyword);
        if ($keyword == false) {
            return "正确使用方法是:输入【附近+关键词】当" . $this->my . '提醒您输入地理位置的时候就OK啦';
        }
        $data = array();
        $data ['time'] = time();
        $data ['token'] = $this->token;
        $data ['keyword'] = $keyword;
        $data ['uid'] = $this->data ['FromUserName'];
        $re = M('Nearby_user');
        $user = $re->where(array(
            'token' => $this->token,
            'uid' => $data ['uid']
        ))->find();
        if ($user == false) {
            $re->data($data)->add();
        } else {
            $id ['id'] = $user ['id'];
            $re->where($id)->save($data);
        }
        return "已接受到您的指令\n1.点击左下方\"小键盘\"\n2.点击右下方\"+\"号键\n3.点击\"位置\"图标4.完成定位后点击\"发送\"";
    }

    // 算命
    function suanming($name)
    {
        $name = implode('', $name);
        if (empty ($name)) {
            return '主人' . $this->my . '提醒您正确的使用方法是[算命+姓名]';
        }
        $data = require_once(CONF_PATH . 'suanming.php');
        $num = mt_rand(0, 80);
        return $name . "\n" . trim($data [$num]);
    }

    // 音乐
    function yinle($name)
    {
        $name = implode('', $name);
        $url = 'http://httop1.duapp.com/mp3.php?musicName=' . $name;
        $str = file_get_contents($url);
        $obj = json_decode($str);
        return array(
            array(
                $name,
                $name,
                $obj->url,
                $obj->url
            ),
            'music'
        );
    }

    // 歌词
    function geci($n)
    {
        $name = implode('', $n);
        @$str = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg=' . urlencode('歌词' . $name);
        $json = json_decode(file_get_contents($str));
        $str = str_replace('{br}', "\n", $json->content);
        $str = str_replace('mzxing_com', 'ai9me', $str);
        return str_replace('菲菲', 'AI9', $str);
    }

    // 域名
    function yuming($n)
    {
        $name = implode('', $n);
        @$str = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg=' . urlencode('域名' . $name);
        $json = json_decode(file_get_contents($str));
        $str = str_replace('{br}', "\n", $json->content);
        $str = str_replace('mzxing_com', 'ai9me', $str);
        $str = str_replace('mzxing.com', 'www.ai9.me', $str);
        return str_replace('菲菲', 'AI9', $str);
    }

    // 天气
    function tianqi($n)
    {
        $name = implode('', $n);
        @$str = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg=' . urlencode('天气' . $name);
        $json = json_decode(file_get_contents($str));
        $str = str_replace('{br}', "\n", $json->content);
        return str_replace('菲菲', 'AI9', $str);
    }

    // 手机
    function shouji($n)
    {
        $name = implode('', $n);
        /*
         * @$str = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg=' .
         * urlencode ( '归属' . $name ); $json = json_decode ( file_get_contents (
         * $str ) ); $str = str_replace ( '{br}', "\n", $json->content ); $str =
         * str_replace ( '菲菲', $this->my, str_replace ( '提示：', $this->my .
         * '提醒您:', str_replace ( '{br}', "\n", $str ) ) ); return str_replace (
         * '菲菲', 'AI9', $str );
         */
        $url = 'http://apis.juhe.cn/mobile/get?key=7dc9e7b19beaa27922cd52393e467ac3&dtype=json&phone=' . $name;
        $json = json_decode(file_get_contents($url), true);
        if ($json ['resultcode'] == 200) {
            return "号码:$name \n 归属：{$json['result']['province']}{$json['result']['city']}\n 区号:{$json['result']['areacode']}\n 邮政编码:{$json['result']['zip']} \n 公司:{$json['result']['company']} \n 卡类型:{$json['result']['card']}";
        } else {
            return '查询失败，请确认号码正确';
        }
    }

    // 身份证
    function shenfenzheng($n)
    {
        $n = implode('', $n);
        if (count($n) > 1) {
            $this->error_msg($n);
            return false;
        };
        $str1 = file_get_contents('http://apis.juhe.cn/idcard/index?key=05fcc2ef11ce14414a0f12e316fb5a29&dtype=json&cardno=' . $n);
        $data = json_decode($str1, true);
        if ($data ['resultcode'] == 200) {
            $str = '【身份证】 ' . $n . "\n" . '【地址】' . $data ['result'] ['area'] . "\n 【该身份证主人的生日】" . $data ['result'] ['birthday'] . "\n 性别:" . $data ['result'] ['sex'];
            return $str;
        } else if ($data ['resultcode'] == 203) {

            $str = $data ['reason'] . "\n\n" . ' 【身份证】 ' . $n . "\n" . '【地址】' . $data ['result'] ['area'] . "\n 【该身份证主人的生日】" . $data ['result'] ['birthday'] . "\n 性别:" . $data ['result'] ['sex'];
            return $str;
        } else if ($data ['resultcode'] == 201) {
            return $data ['reason'];
        } else {
            return '查询失败';
        }
        // $array = explode ( ':', $str1 );
        // $array [2] = rtrim ( $array [4], ",'gender'" );
        // $str = trim ( $array [3], ",'birthday'" );
        // if ($str !== iconv ( 'UTF-8', 'UTF-8', iconv ( 'UTF-8', 'UTF-8', $str
        // ) ))
        // $str = iconv ( 'GBK', 'UTF-8', $str );
        // $str = '【身份证】 ' . $n . "\n" . '【地址】' . $str . "\n 【该身份证主人的生日】" .
        // str_replace ( "'", '', $array [2] );
        return $str;
    }

    // 公交
    function gongjiao($data)
    {
        $data = array_merge($data);
        if (count($data) != 2) {
            $this->error_msg();
            return false;
        }
        $json = file_get_contents("http://www.twototwo.cn/bus/Service.aspx?format=json&action=QueryBusByLine&key=5da453b2-b154-4ef1-8f36-806ee58580f6&zone=" . $data [0] . "&line=" . $data [1]);
        $data = json_decode($json);
        $xianlu = $data->Response->Head->XianLu;
        $xdata = get_object_vars($xianlu->ShouMoBanShiJian);
        $xdata = $xdata ['#cdata-section'];
        $piaojia = get_object_vars($xianlu->PiaoJia);
        $xdata = $xdata . ' -- ' . $piaojia ['#cdata-section'];
        $main = $data->Response->Main->Item->FangXiang;
        $xianlu = $main [0]->ZhanDian;
        $str = "【本公交途经】\n";
        for ($i = 0; $i < count($xianlu); $i++) {
            $str .= "\n" . trim($xianlu [$i]->ZhanDianMingCheng);
        }
        return $str;
    }

    // 火车
    function huoche($data, $time = '')
    {
        $data = array_merge($data);
        $data [2] = date('Y', time()) . $time;
        if (count($data) != 3) {
            $this->error_msg($data [0] . '至' . $data [1]);
            return false;
        }
        $time = empty ($time) ? date('Y-m-d', time()) : date('Y-', time()) . $time;
        $json = file_get_contents("http://www.twototwo.cn/train/Service.aspx?format=json&action=QueryTrainScheduleByTwoStation&key=5da453b2-b154-4ef1-8f36-806ee58580f6&startStation=" . $data [0] . "&arriveStation=" . $data [1] . "&startDate=" . $data [2] . "&ignoreStartDate=0&like=1&more=0");
        if ($json) {
            $data = json_decode($json);
            $main = $data->Response->Main->Item;
            if (count($main) > 10) {
                $conunt = 10;
            } else {
                $conunt = count($main);
            }
            for ($i = 0; $i < $conunt; $i++) {
                $str .= "\n 【编号】" . $main [$i]->CheCiMingCheng . "\n 【类型】" . $main [$i]->CheXingMingCheng . "\n【发车时间】:　" . $time . ' ' . $main [$i]->FaShi . "\n【耗时】" . $main [$i]->LiShi . ' 小时';
                $str .= "\n----------------------";
            }
        } else {
            $str = '没有找到 ' . $data [0] . ' 至 ' . $data [1] . ' 的列车';
        }
        return $str;
    }

    // 翻译
    function fanyi($name)
    {
        $name = array_merge($name);
        $url = "http://openapi.baidu.com/public/2.0/bmt/translate?client_id=kylV2rmog90fKNbMTuVsL934&q=" . $name [0] . "&from=auto&to=auto";
        $json = Http::fsockopenDownload($url);
        if ($json == false) {
            $json = file_get_contents($url);
        }
        $json = json_decode($json);
        $str = $json->trans_result;
        if ($str [0]->dst == false)
            return $this->error_msg($name [0]);
        $mp3url = 'http://www.apiwx.com/aaa.php?w=' . $str [0]->dst;
        return array(
            array(
                $str [0]->src,
                $str [0]->dst,
                str_replace(' ', '', $mp3url),
                str_replace(' ', '', $mp3url)
            ),
            'music'
        );
    }

    // 彩票
    function caipiao($name)
    {
        $name = array_merge($name);
        $url = "http://api2.sinaapp.com/search/lottery/?appkey=0020130430&appsecert=fa6095e113cd28fd&reqtype=text&keyword=" . $name [0];
        $json = Http::fsockopenDownload($url);
        if ($json == false) {
            $json = file_get_contents($url);
        }
        $json = json_decode($json, true);
        $str = $json ['text'] ['content'];
        return $str;
    }

    // 梦见
    function mengjian($name)
    {
        $name = array_merge($name);
        if (empty ($name))
            return '周公睡着了,无法解此梦,这年头神仙也偷懒';
        $data = M('Dream')->field('content')->where("`title` LIKE '%" . $name [0] . "%'")->find();
        if (empty ($data))
            return '周公睡着了,无法解此梦,这年头神仙也偷懒';
        return $data ['content'];
    }

    function getmp3($data)
    {
        $obj = new getYu ();
        $ContentString = $obj->getGoogleTTS($data);
        $randfilestring = 'mp3/' . time() . '_' . sprintf('%02d', rand(0, 999)) . ".mp3";
        return rtrim(C('site_url'), '/') . $randfilestring;
    }

    // 笑话
    function xiaohua($n)
    {
        $name = implode('', $n);
        @$str = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg=' . urlencode('笑话' . $name);
        $json = json_decode(file_get_contents($str));
        $str = str_replace('{br}', "\n", $json->content);
        $str = str_replace('mzxing_com', 'ai9me', $str);
        return str_replace('菲菲', 'AI9', $str);
    }

    // 聊天
    function liaotian($name)
    {
        $name = array_merge($name);
        $this->chat($name [0]);
    }

    // 聊天
    function chat($name)
    {
        $this->requestdata('textnum');
        $check = $this->user('connectnum');
        if ($check ['connectnum'] != 1) {
            return C('connectout');
        }
        // if ($name == "你叫什么" || $name == "你是谁") {
        // return '咳咳，我是聪明与智慧并存的美女，主淫你可以叫我' . $this->my . ',人家刚交男朋友,你不可追我啦';
        // } elseif ($name == "你父母是谁" || $name == "你爸爸是谁" || $name == "你妈妈是谁") {
        // return '主淫,' . $this->my . '是AI9创造的,所以他们是我的父母,不过主人我属于你的';
        // } elseif ($name == '糗事') {
        // $name = '笑话';
        // } elseif ($name == '网站' || $name == '官网' || $name == '网址' || $name ==
        // '3g网址') {
        // return "【AI9官网网址】\WWW.ai9.me\n【AI9服务理念】\n化繁为简,让菜鸟也能使用强大的系统!";
        // }
        $str = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg=' . urlencode($name);
        $json = json_decode(file_get_contents($str));
        $str = str_replace('菲菲', $this->my, str_replace('提示：', $this->my . '提醒您:', str_replace('{br}', "\n", $json->content)));
        $str = str_replace('mzxing_com', 'ai9me', $str);
        $str = str_replace('菲菲', 'AI9', $str);
        if (strlen($str) > 0) {
            return $str;
        } else {
            return '我也不知道说啥呀!!';
        }
    }

    function error_msg($data)
    {
        if ($data) {
            return '没有找到' . $data . '相关的数据';
        } else {
            return '没有找到相关的数据';
        }
    }

    function baike($name)
    {
        $name = implode('', $name);
        $name_gbk = iconv('utf-8', 'gbk', $name);
        $encode = urlencode($name_gbk);
        $url = 'http://baike.baidu.com/list-php/dispose/searchword.php?word=' . $encode . '&pic=1';
        $get_contents = $this->httpGetRequest_baike($url);
        $get_contents_gbk = iconv('gbk', 'utf-8', $get_contents);
        preg_match("/URL=(\S+)'>/s", $get_contents_gbk, $out);
        $real_link = 'http://baike.baidu.com' . $out [1];
        $get_contents2 = $this->httpGetRequest_baike($real_link);
        preg_match('#"Description"\scontent="(.+?)"\s\/\>#is', $get_contents2, $matchresult);
        if (isset ($matchresult [1]) && $matchresult [1] != "") {
            return htmlspecialchars_decode($matchresult [1]);
        } else {
            return "抱歉，没有找到与“" . $name . "”相关的百科结果。";
        }
    }

    function httpGetRequest_baike($url)
    {
        $headers = array(
            "User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1",
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
            "Accept-Language: en-us,en;q=0.5",
            "Referer: http://www.baidu.com/"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($ch);
        curl_close($ch);
        if ($output === FALSE) {
            return "cURL Error: " . curl_error($ch);
        }
        return $output;
    }

    function xiangce()
    {
        $model_name = "WeixinControllerPhotoModel";
        return $this->executeModel($model_name);
    }

    function executeModel($model_name)
    {
        import("@.Model." . $model_name);
        if (class_exists($model_name)) {
            $model_obj = new $model_name ();
            $model_obj->setToken($this->token);
            $model_obj->reply($this->data);
            if ($model_obj->isDone()) {
                return $model_obj->getResult();
            }
        }
        return false;
    }
}

?>