<?php
namespace Common\Controller;
class Wechat
{
    private $data = array();
    private $_wxuser = array();
    private $_WxBizMsgCrypt = null;
    private $_isWxMsgCrypt = false;

    public function __construct($token)
    {
        if (IS_GET) {
            echo($_GET ['echostr']);
            exit ();
        } else {
            $xml = file_get_contents("php://input");
            $this->_wxuser = get_app_info($token, 'appid,token,encodingAesKey,wxname');
            $data = $this->xml2Array($xml);
            if ($this->_wxuser['encodingAesKey'] && isset($data['Encrypt'])) {
                $msg = '';
                $errCode = $this->initWxBizMsgCrypt()->decryptMsg($_GET['timestamp'], $_GET['nonce'], $data, $msg);
                if ($errCode == 0) {
                    $data = $this->xml2Array($msg);
                }
                $this->_isWxMsgCrypt = true;
            }
            $this->data = $data;
        }
        if (isset ($_GET ['debug']) && !empty ($_GET ['debug'])) {

        } else {
            if (!$this->auth($token)) {
                error_log("[ERROR_AUTH] [{$_SERVER['HTTP_HOST']}] IP:" . get_client_ip() . print_r($this->data, 1));
                $this->response("微信服务器故障,请重试!");
                //exit ();
            };
        }
    }

    private function xml2Array($xml)
    {
        $xml = new \SimpleXMLElement ($xml);
        if (!$xml) {
            error_log("[ERROR_XML] ");
            exit;
        }
        $data = array();
        foreach ($xml as $key => $value) {
            if ($value->count() > 0) {
                foreach ($value as $k => $v) {
                    $data[$k] = strval($v);
                }
            } else {
                $data[$key] = strval($value);
            }
        }
        return $data;
    }

    public function request()
    {
        return $this->data;
    }

    public function response($content, $type = 'text', $flag = 0)
    {
        $this->data = array(
            'ToUserName' => $this->data ['FromUserName'],
            'FromUserName' => $this->data ['ToUserName'],
            'CreateTime' => NOW_TIME,
            'MsgType' => $type
        );
        $this->$type ($content);
        $this->data ['FuncFlag'] = $flag;
        $xml = new \SimpleXMLElement ('<xml></xml>');
        $this->data2xml($xml, $this->data);
        $xmlString = $xml->asXML();
        if ($this->_isWxMsgCrypt == true) {
            $encryptMsg = '';
            $errCode = $this->initWxBizMsgCrypt()->encryptMsg($xmlString, time(), time() - mt_rand(1000, 100000), $encryptMsg);
            $xmlString = $encryptMsg;
        }
        exit ($xmlString);
    }

    public function http_url($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SAFE_UPLOAD, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            @curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    private function initWxBizMsgCrypt()
    {
        if ($this->_WxBizMsgCrypt === null) {
            $this->_WxBizMsgCrypt = new WXBizMsgCrypt($this->_wxuser['token'], $this->_wxuser['encodingAesKey'], $this->_wxuser['appid']);
        }
        return $this->_WxBizMsgCrypt;
    }

    private function text($content)
    {
        if (!$content) {
            $content = '';
        }
        $this->data ['Content'] = $content;
    }

    private function transfer_customer_service($content)
    {

    }

    private function music($music)
    {
        list ($music ['Title'], $music ['Description'], $music ['MusicUrl'], $music ['HQMusicUrl']) = $music;
        $this->data ['Music'] = $music;
    }

    private function news($news)
    {
        $articles = array();
        foreach ($news as $key => $value) {
            list ($articles [$key] ['Title'], $articles [$key] ['Description'], $articles [$key] ['PicUrl'], $articles [$key] ['Url']) = $value;
            if ($key == 0) {
                if (strpos($articles [$key] ['PicUrl'], 'http://ooyyee-crm-static.qiniudn.com') === 0) {
                    if (strpos($articles [$key] ['PicUrl'], 'http://ooyyee-crm-static.qiniudn.com') === 0) {
                        $articles [$key] ['PicUrl'] = $articles [$key] ['PicUrl'] . '?imageView/1/w/360/h/200';
                    }
                }
            } else {
                if (strpos($articles [$key] ['PicUrl'], 'http://ooyyee-crm-static.qiniudn.com') === 0) {
                    $articles [$key] ['PicUrl'] = $articles [$key] ['PicUrl'] . '?imageView/1/w/200/h/200';
                }
            }
            if ($key >= 9) {
                break;
            }
        }
        $this->data ['ArticleCount'] = count($articles);
        $this->data ['Articles'] = $articles;
    }

    private function voice($voice)
    {
        list ($voice ['MediaId']) = $voice;
        $this->data ['Voice'] = $voice;
    }

    private function video($video)
    {
        list ($video ['MediaId'], $video ['Title'], $video ['Description']) = $video;
        $this->data ['Video'] = $video;
    }

    private function image($image)
    {
        list ($image ['MediaId']) = $image;
        $this->data ['Image'] = $image;
    }

    private function data2xml($xml, $data, $item = 'item')
    {
        foreach ($data as $key => $value) {
            is_numeric($key) && $key = $item;
            if (is_array($value) || is_object($value)) {
                $child = $xml->addChild($key);
                $this->data2xml($child, $value, $item);
            } else {
                if (is_numeric($value)) {
                    $child = $xml->addChild($key, $value);
                } else {
                    $child = $xml->addChild($key);
                    $node = \dom_import_simplexml($child);
                    $node->appendChild($node->ownerDocument->createCDATASection($value));
                }
            }
        }
    }

    private function auth($token)
    {
        $data = array(
            $token,
            $_GET ['timestamp'],
            $_GET ['nonce']
        );
        $sign = $_GET ['signature'];
        sort($data, SORT_STRING);
        $signature = sha1(implode($data));
        $result = ($signature == $sign);
        if (!$result) {
            error_log(error_log("[ERROR_AUTH] " . print_r($_GET, 1)));
        }
        return $result;
    }
}

/**
 * error code 说明.
 * <ul>
 *    <li>-40001: 签名验证错误</li>
 *    <li>-40002: xml解析失败</li>
 *    <li>-40003: sha加密生成签名失败</li>
 *    <li>-40004: encodingAesKey 非法</li>
 *    <li>-40005: appid 校验错误</li>
 *    <li>-40006: aes 加密失败</li>
 *    <li>-40007: aes 解密失败</li>
 *    <li>-40008: 解密后得到的buffer非法</li>
 *    <li>-40009: base64加密失败</li>
 *    <li>-40010: base64解密失败</li>
 *    <li>-40011: 生成xml失败</li>
 * </ul>
 */
class ErrorCode
{
    public static $OK = 0;
    public static $ValidateSignatureError = -40001;
    public static $ParseXmlError = -40002;
    public static $ComputeSignatureError = -40003;
    public static $IllegalAesKey = -40004;
    public static $ValidateAppidError = -40005;
    public static $EncryptAESError = -40006;
    public static $DecryptAESError = -40007;
    public static $IllegalBuffer = -40008;
    public static $EncodeBase64Error = -40009;
    public static $DecodeBase64Error = -40010;
    public static $GenReturnXmlError = -40011;
}

/**
 * PKCS7Encoder class
 *
 * 提供基于PKCS7算法的加解密接口.
 */
class PKCS7Encoder
{
    public static $block_size = 32;

    /**
     * 对需要加密的明文进行填充补位
     * @param $text 需要进行填充补位操作的明文
     * @return 补齐明文字符串
     */
    function encode($text)
    {
        $block_size = PKCS7Encoder::$block_size;
        $text_length = strlen($text);
        //计算需要填充的位数
        $amount_to_pad = PKCS7Encoder::$block_size - ($text_length % PKCS7Encoder::$block_size);
        if ($amount_to_pad == 0) {
            $amount_to_pad = PKCS7Encoder::block_size;
        }
        //获得补位所用的字符
        $pad_chr = chr($amount_to_pad);
        $tmp = "";
        for ($index = 0; $index < $amount_to_pad; $index++) {
            $tmp .= $pad_chr;
        }
        return $text . $tmp;
    }

    /**
     * 对解密后的明文进行补位删除
     * @param decrypted 解密后的明文
     * @return 删除填充补位后的明文
     */
    function decode($text)
    {

        $pad = ord(substr($text, -1));
        if ($pad < 1 || $pad > 32) {
            $pad = 0;
        }
        return substr($text, 0, (strlen($text) - $pad));
    }

}

/**
 * Prpcrypt class
 *
 * 提供接收和推送给公众平台消息的加解密接口.
 */
class Prpcrypt
{
    public $key;

    function Prpcrypt($k)
    {
        $this->key = base64_decode($k . "=");
    }

    /**
     * 对明文进行加密
     * @param string $text 需要加密的明文
     * @return string 加密后的密文
     */
    public function encrypt($text, $appid)
    {

        try {
            //获得16位随机字符串，填充到明文之前
            $random = $this->getRandomStr();
            $text = $random . pack("N", strlen($text)) . $text . $appid;
            // 网络字节序
            $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
            $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
            $iv = substr($this->key, 0, 16);
            //使用自定义的填充方式对明文进行补位填充
            $pkc_encoder = new PKCS7Encoder;
            $text = $pkc_encoder->encode($text);
            mcrypt_generic_init($module, $this->key, $iv);
            //加密
            $encrypted = mcrypt_generic($module, $text);
            mcrypt_generic_deinit($module);
            mcrypt_module_close($module);

            //print(base64_encode($encrypted));
            //使用BASE64对加密后的字符串进行编码
            return array(ErrorCode::$OK, base64_encode($encrypted));
        } catch (Exception $e) {
            //print $e;
            return array(ErrorCode::$EncryptAESError, null);
        }
    }

    /**
     * 对密文进行解密
     * @param string $encrypted 需要解密的密文
     * @return string 解密得到的明文
     */
    public function decrypt($encrypted, $appid)
    {

        try {
            //使用BASE64对需要解密的字符串进行解码
            $ciphertext_dec = base64_decode($encrypted);
            $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
            $iv = substr($this->key, 0, 16);
            mcrypt_generic_init($module, $this->key, $iv);

            //解密
            $decrypted = mdecrypt_generic($module, $ciphertext_dec);
            mcrypt_generic_deinit($module);
            mcrypt_module_close($module);
        } catch (Exception $e) {
            return array(ErrorCode::$DecryptAESError, null);
        }


        try {
            //去除补位字符
            $pkc_encoder = new PKCS7Encoder;
            $result = $pkc_encoder->decode($decrypted);
            //去除16位随机字符串,网络字节序和AppId
            if (strlen($result) < 16)
                return "";
            $content = substr($result, 16, strlen($result));
            $len_list = unpack("N", substr($content, 0, 4));
            $xml_len = $len_list[1];
            $xml_content = substr($content, 4, $xml_len);
            $from_appid = substr($content, $xml_len + 4);
        } catch (Exception $e) {
            //print $e;
            return array(ErrorCode::$IllegalBuffer, null);
        }
        if ($from_appid != $appid)
            return array(ErrorCode::$ValidateAppidError, null);
        return array(0, $xml_content);

    }


    /**
     * 随机生成16位字符串
     * @return string 生成的字符串
     */
    function getRandomStr()
    {

        $str = "";
        $str_pol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($str_pol) - 1;
        for ($i = 0; $i < 16; $i++) {
            $str .= $str_pol[mt_rand(0, $max)];
        }
        return $str;
    }

}


/**
 * SHA1 class
 *
 * 计算公众平台的消息签名接口.
 */
class SHA1
{
    /**
     * 用SHA1算法生成安全签名
     * @param string $token 票据
     * @param string $timestamp 时间戳
     * @param string $nonce 随机字符串
     * @param string $encrypt 密文消息
     */
    public function getSHA1($token, $timestamp, $nonce, $encrypt_msg)
    {
        //排序
        try {
            $array = array($encrypt_msg, $token, $timestamp, $nonce);
            sort($array, SORT_STRING);
            $str = implode($array);
            return array(ErrorCode::$OK, sha1($str));
        } catch (Exception $e) {
            //print $e . "\n";
            return array(ErrorCode::$ComputeSignatureError, null);
        }
    }

}

/**
 * XMLParse class
 *
 * 提供提取消息格式中的密文及生成回复消息格式的接口.
 */
class XMLParse
{

    /**
     * 提取出xml数据包中的加密消息
     * @param string $xmltext 待提取的xml字符串
     * @return string 提取出的加密消息字符串
     */
    public function extract($xmltext)
    {
        try {
            $xml = new DOMDocument();
            $xml->loadXML($xmltext);
            $array_e = $xml->getElementsByTagName('Encrypt');
            $array_a = $xml->getElementsByTagName('ToUserName');
            $encrypt = $array_e->item(0)->nodeValue;
            $tousername = $array_a->item(0)->nodeValue;
            return array(0, $encrypt, $tousername);
        } catch (Exception $e) {
            //print $e . "\n";
            return array(ErrorCode::$ParseXmlError, null, null);
        }
    }

    /**
     * 生成xml消息
     * @param string $encrypt 加密后的消息密文
     * @param string $signature 安全签名
     * @param string $timestamp 时间戳
     * @param string $nonce 随机字符串
     */
    public function generate($encrypt, $signature, $timestamp, $nonce)
    {
        $format = "<xml>
<Encrypt><![CDATA[%s]]></Encrypt>
<MsgSignature><![CDATA[%s]]></MsgSignature>
<TimeStamp>%s</TimeStamp>
<Nonce><![CDATA[%s]]></Nonce>
</xml>";
        return sprintf($format, $encrypt, $signature, $timestamp, $nonce);
    }

}

/**
 * 1.第三方回复加密消息给公众平台；
 * 2.第三方收到公众平台发送的消息，验证消息的安全性，并对消息进行解密。
 */
class WXBizMsgCrypt
{
    private $token;
    private $encodingAesKey;
    private $appId;

    /**
     * 构造函数
     * @param $token string 公众平台上，开发者设置的token
     * @param $encodingAesKey string 公众平台上，开发者设置的EncodingAESKey
     * @param $appId string 公众平台的appId
     */
    public function WXBizMsgCrypt($token, $encodingAesKey, $appId)
    {
        $this->token = $token;
        $this->encodingAesKey = $encodingAesKey;
        $this->appId = $appId;
    }

    /**
     * 将公众平台回复用户的消息加密打包.
     * <ol>
     *    <li>对要发送的消息进行AES-CBC加密</li>
     *    <li>生成安全签名</li>
     *    <li>将消息密文和安全签名打包成xml格式</li>
     * </ol>
     *
     * @param $replyMsg string 公众平台待回复用户的消息，xml格式的字符串
     * @param $timeStamp string 时间戳，可以自己生成，也可以用URL参数的timestamp
     * @param $nonce string 随机串，可以自己生成，也可以用URL参数的nonce
     * @param &$encryptMsg string 加密后的可以直接回复用户的密文，包括msg_signature, timestamp, nonce, encrypt的xml格式的字符串,
     *                      当return返回0时有效
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function encryptMsg($replyMsg, $timeStamp, $nonce, &$encryptMsg)
    {
        $pc = new Prpcrypt($this->encodingAesKey);

        //加密
        $array = $pc->encrypt($replyMsg, $this->appId);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }

        if ($timeStamp == null) {
            $timeStamp = time();
        }
        $encrypt = $array[1];

        //生成安全签名
        $sha1 = new SHA1;
        $array = $sha1->getSHA1($this->token, $timeStamp, $nonce, $encrypt);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }
        $signature = $array[1];

        //生成发送的xml
        $xmlparse = new XMLParse;
        $encryptMsg = $xmlparse->generate($encrypt, $signature, $timeStamp, $nonce);
        return ErrorCode::$OK;
    }


    /**
     * 检验消息的真实性，并且获取解密后的明文.
     * <ol>
     *    <li>利用收到的密文生成安全签名，进行签名验证</li>
     *    <li>若验证通过，则提取xml中的加密消息</li>
     *    <li>对消息进行解密</li>
     * </ol>
     *
     * @param $msgSignature string 签名串，对应URL参数的msg_signature
     * @param $timestamp string 时间戳 对应URL参数的timestamp
     * @param $nonce string 随机串，对应URL参数的nonce
     * @param $postData string 密文，对应POST请求的数据
     * @param &$msg string 解密后的原文，当return返回0时有效
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function decryptMsg($timestamp = null, $nonce, $postData, &$msg)
    {
        if (strlen($this->encodingAesKey) != 43) {
            return ErrorCode::$IllegalAesKey;
        }

        $pc = new Prpcrypt($this->encodingAesKey);

        //提取密文
        /*$ret = $postData['ToUserName'];
        if ($ret != 0) {
            return $ret;
        }*/

        if ($timestamp == null) {
            $timestamp = time();
        }
        $encrypt = $postData['Encrypt'];
        $touser_name = $postData['ToUserName'];

        //验证安全签名
        $sha1 = new SHA1;
        $array = $sha1->getSHA1($this->token, $timestamp, $nonce, $encrypt);
        $ret = $array[0];

        if ($ret != 0) {
            return $ret;
        }
        /*
        $signature = $array[1];
        if ($msgSignature && $signature != $msgSignature) {
            return ErrorCode::$ValidateSignatureError;
        }*/

        $result = $pc->decrypt($encrypt, $this->appId);
        if ($result[0] != 0) {
            return $result[0];
        }
        $msg = $result[1];

        return ErrorCode::$OK;
    }

}

?>