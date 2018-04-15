<?php
namespace Home\Controller;

use Think\Controller;
use Common\Controller\Wechat;

error_reporting(0);

class WeixinController extends Controller
{
    protected $token;
    protected $fun;
    protected $data = array();
    protected $my = 'OOYYEE';

    public function index()
    {
        $this->token = $_GET['token'];
        $weixin = new Wechat ($this->token);
        $this->data = $weixin->request();
        $data = $this->data;
        $this->my = '优培圈';
        list ($content, $type) = $this->reply($data);
        if ($data['module'] != 'default') {
            if (isset($data['Event']) && 'CLICK' == $data ['Event']) {
                $data['module'] = 'click-keyword';
            }
        }
        $weixin->response($content, $type);
    }

    /**
     * 关键字历史（统计）
     *
     * @param unknown $keyword
     */
    private function history_keyword($keyword)
    {
        /* ------------关键字记录开始-------------- */
        $history_keyword = array();
        $history_keyword ['token'] = $this->token;
        $history_keyword ['keyword'] = $keyword;
        $history_keyword ['create_time'] = time();
        $history_keyword ['wecha_id'] = $this->data ['FromUserName'];
        M('HistoryKeyword')->add($history_keyword);
        /* ------------关键字记录结束-------------- */
    }

    /**
     * 自动加载模块,返回结果
     *
     * @param unknown $model_name
     * @param unknown $data
     */
    private function executeModel($model_name, &$data)
    {
        import("Vendor.Wechat." . $model_name);
        if (class_exists($model_name)) {
            $model_obj = new $model_name ();
            $model_obj->setToken($this->token);
            $model_obj->reply($data);
            if ($model_obj->isDone()) {
                return $model_obj->getResult();
            }
        }
        return false;
    }

    /**
     * 根据文字内容,自动回复消息
     */
    private function replyBySearchWords(&$data)
    {
        return $this->executeModel("WeixinControllerPinyinModel", $data);
    }

    private function reply(&$data)
    {
        if ('CLICK' == $data ['Event']) {
            $data ['Content'] = $data ['EventKey'];
        } else if ('voice' == $data ['MsgType'] && isset ($data ['Recognition'])) {
            $data ['Content'] = $data ['Recognition'];
        } else if ('SCAN' == $data['Event']) {
            $return = $this->executeModel("WeixinControllerScanModel", $data);
            if ($return) {
                return $return;
            }
        } else if ("MASSSENDJOBFINISH" == strtoupper($data ['Event'])) {//群发
            $finish = array();
            $finish['status'] = $data['Status'];
            $finish['total_count'] = $data['TotalCount'];
            $finish['filter_count'] = $data['FilterCount'];
            $finish['sent_count'] = $data['SentCount'];
            $finish['error_count'] = $data['ErrorCount'];
            M('material_push_result')->where(array('msg_id' => $data['MsgID']))->save($finish);
            exit;
        } else if ('LOCATION' == strtoupper($data ['Event'])) { // 定位
            exit;
        }
        $execute = \MCache::get('__CMD__' . $data['FromUserName']);
        if ($execute) {
            import("Vendor.Wechat.WeixinControllerCMDModel");
            $model = new \WeixinControllerCMDModel ();
            $model->setToken($this->token);
            $model->setParams("keyWord", $data['Content']);
            $model->setExecute($execute);
            $model->reply($data);
            if ($model->isDone()) {
                $this->data['module'] = "default";
                $data = $model->getResult();
                return $data;
            }
        }
        $model_name = 'WeixinControllerMapModel';
        // 处理事件
        $event_model_list = array(
            'subscribe' => 'WeixinControllerSubscribeModel',
            'unsubscribe' => 'WeixinControllerUnSubscribeModel',
            'scancode_push' => 'WeixinControllerScanQrcodeModel',
            'scancode_waitmsg' => 'WeixinControllerScanQrcodeModel',
        );
        if (isset ($event_model_list [$data ['Event']])) {
            $model_name = $event_model_list [$data ['Event']];
        }

        if ($model_name) {
            $result = $this->executeModel($model_name, $data);
            if ($result !== false) {
                if ($model_name == 'WeixinControllerMapModel') {
                    $data['module'] = "map";
                }
                return $result;
            }
        }
        $key = $data ['Content'];
        if (strpos($key, 'API-') === 0) {
            $data['module'] = 'api';
            $result = $this->executeModel('WeixinControllerApiModel', $data);
            return $result;
        }

        $keyword_array = array(
            '首页' => 'WeixinControllerHomeModel',
            '主页' => 'WeixinControllerHomeModel',
            'home' => 'WeixinControllerHomeModel',
            '地图' => 'WeixinControllerCompanyMapModel',
            '最近的' => 'WeixinControllerLbsModel',
            '帮助' => 'WeixinControllerHelpModel',
            'help' => 'WeixinControllerHelpModel',
            '会员卡' => 'WeixinControllerMemberModel',
            '会员' => 'WeixinControllerMemberModel',
            '3g相册' => 'WeixinControllerPhotoModel',
            '相册' => 'WeixinControllerPhotoModel',
            '商城' => 'WeixinControllerMallModel',
            '订餐' => 'WeixinControllerMealModel',
            '团购' => 'WeixinControllerCustomerModel',
            '微房产' => 'WeixinControllerHouseModel'
        );
        if (array_key_exists($key, $keyword_array)) {
            // 记录关键字
            $this->history_keyword($key);
            $model_name = $keyword_array [$key];
            $result = $this->executeModel($model_name, $data);
            $data['module'] = "pre-keyword";
            return $result;
        } else {
            return $this->replyBySearchWords($data);
        }
    }

    //
    public function fistMe($data)
    {
        if ('event' == $data ['MsgType'] && 'subscribe' == $data ['Event']) {
            $model = "WeixinControllerHelpModel";
            return $this->executeModel($model, $data);
        }
    }
}
