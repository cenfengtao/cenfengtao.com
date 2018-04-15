<?php
namespace Org\Util;
/**
 * 安全处理类.
 */
class Secure
{
	/**
	 * DES加密处理.
	 * @access public
	 * @static
	 * @param string $key 密钥.
	 * @param string $proclaim 明文.
	 * @param string $base64 密文是否采用Base64格式.
	 * @return string 密文.
	 */
	public static function DesEncrypt ($key, $proclaim, $base64 = false)
	{
		//md5加密
	    $morph = md5 ($key, true);
	    //获取加密后字符串的0-8截取出来
	    $key = substr ($morph, 0, 8);
	    //获取加密后字符串的0-8截取出来
	    $iv = substr ($morph, 8, 8);
		//获取指定加密算法的密钥大小
	    $size = mcrypt_get_block_size (MCRYPT_DES, MCRYPT_MODE_CBC);
	    //函数返回字符串 "Shanghai" 的长度//php取余数用%
	    $pad = $size - (strlen ($proclaim) % $size);
	    $str = $proclaim.str_repeat (chr ($pad), $pad);//str_repeat把字符串 $pad 重复 $pad 次：
	    //mcrypt_cbc的加密解密
	    $cipher = mcrypt_cbc (MCRYPT_DES, $key, $str, MCRYPT_ENCRYPT, $iv);
		// 函数:base64_encode(编码)
		return ($base64 ? base64_encode ($cipher) : $cipher);
	}

	/**
	 * DES解密处理.
	 * @access public
	 * @static
	 * @param string $key 密钥.
	 * @param string $cipher 密文.
	 * @param string $base64 密文是否采用Base64格式.
	 * @return string 明文.
	 */
	public static function DesDecrypt ($key, $cipher, $base64 = false)
	{
	    $morph = md5 ($key, true);
	    $key = substr ($morph, 0, 8);
	    $iv = substr ($morph, 8, 8);

		$str = ($base64 ? base64_decode ($cipher) : $cipher);
	    $str = mcrypt_cbc (MCRYPT_DES, $key, $str, MCRYPT_DECRYPT, $iv);
	    $pad = ord ($str[strlen ($str) - 1]);
	    if ($pad > strlen ($str))
	    	return (false);
	    if (strspn ($str, chr ($pad), strlen ($str) - $pad) != $pad)
	    	return (false);
	    $proclaim = substr ($str, 0, -1 * $pad);
	    return ($proclaim);
	}

	/**
	 * 编码认证信息.
	 * [版本号, 认证类型, "用户标识", "用户口令"].
	 * @access public
	 * @static
	 * @param string $akey 授权密钥.
	 * @param string $atype 认证类型.
	 * @param string $user 用户标识.
	 * @param string $password 用户口令.
	 * @return string 认证信息.
	 */
	public static function EncodeCert ($akey, $atype, $user, $password)
	{
		$data = array (1, $atype, $user, $password);
		$json = json_encode ($data);
		$cert = self::DesEncrypt ($akey, $json, true);
		
		return ($cert);
	}
    public static function DecodeCert($akey,$cert){
		if (empty ($cert))
			return (false);
		$json = self::DesDecrypt ($akey, $cert, true);
		$data = json_decode ($json, true);
		if (count ($data) < 4 || $data[0] !== 1)
			return (false);
		return $data;
	}

	/**
	 * 解码认证信息.
	 * @access public
	 * @static
	 * @param string $akey 授权密钥.
	 * @param string $cert 认证信息.
	 * @param string $atype 输出的认证类型.
	 * @param string $user 输出的用户标识.
	 * @param string $password 输出的用户口令.
	 * @return boolean 解码是否成功.
	 */
	public static function DecodeCert1 ($akey, $cert, &$atype, &$user, &$password)
	{
		if (empty ($cert))
			return (false);
		
		$json = self::DesDecrypt ($akey, $cert, true);
		$data = json_decode ($json, true);
		if (count ($data) != 4 || $data[0] !== 1)
			return (false);
		
		$atype = $data[1];
		$user = $data[2];
		$password = $data[3];
		
		return (true);
	}

    /**
     * 编码令牌证据.
     * @access public
     * @static
     * @param string $tkey 令牌密钥.
     * @param string $userid 用户标识.
     * @param time $expire 到期时间.
     * @return string 令牌证据.
     */
    public static function EncodeSeal ($tkey, $user, $expire)
    {
        $data = array ($user, $expire);
        $json = json_encode ($data);
        $seal = self::DesEncrypt ($tkey, $json, true);
        
        return ($seal);
    }

    /**
     * 解码令牌证据.
     * @access public
     * @static
     * @param string $tkey 令牌密钥.
     * @param string $seal 令牌证据.
     * @param string $user 输出的用户标识.
     * @param time $expire 输出的到期时间.
     * @return boolean 解码是否成功.
     */
    public static function DecodeSeal ($tkey, $seal, &$user, &$expire)
    {
        if (empty ($seal))
            return (false);

        $json = self::DesDecrypt ($tkey, $seal, true);
        $data = json_decode ($json, true);
        if (count ($data) != 2)
            return (false);
        
        $user = $data[0];
        $expire = $data[1];
        
        return (true);
    }

    /**
     * 编码用户令牌.
     * @access public
     * @static
     * @param string $code 授权代码.
     * @param string $seal 令牌证据.
     * @return string 用户令牌.
     */
    public static function EncodeToken ($code, $seal)
    {
        $data = array ($code, $seal);
        $json = json_encode ($data);
        $token = base64_encode ($json);
        
        return ($token);
    }

    /**
     * 解码用户令牌.
     * @access public
     * @static
     * @param string $token 用户令牌.
     * @param string $code 输出的授权代码.
     * @param string $seal 输出的令牌证据.
     * @return boolean 解码是否成功.
     */
    public static function DecodeToken ($token, &$code, &$seal)
    {
        if (empty ($token))
            return (false);

        $json = base64_decode ($token);
        $data = json_decode ($json);
        if (count ($data) != 2)
            return (false);

        $code = $data[0];
        $seal = $data[1];
        return (true);
    }

	/**
	 * 编码确认信息.
	 * [元素数量, "用户令牌", 生存秒数].
	 * @access public
	 * @static
	 * @param string $akey 授权密钥.
	 * @param string $token 用户令牌.
	 * @param int $span 生存秒数.
	 * @return string 确认信息.
	 */
	public static function EncodeAck ($akey, $token, $span)
	{
		$data = array (3, $token, $span);
		$json = json_encode ($data);
		echo $json;
		$ack = self::DesEncrypt ($akey, $json, true);
		
		return ($ack);
	}

	/**
	 * 解码确认信息.
	 * @access public
	 * @static
	 * @param string $akey 授权密钥.
	 * @param string $ack 确认信息.
	 * @param string $token 输出的用户令牌.
	 * @param int $span 输出的生存秒数.
	 * @return boolean 解码是否成功.
	 */
	public static function DecodeAck ($akey, $ack, &$token, &$span)
	{
		if (empty ($ack))
			return (false);

		$json = self::DesDecrypt ($akey, $ack, true);
		$data = json_decode ($json, true);
		if (count ($data) < 3 || count ($data) !== $data[0])
			return (false);
		
		$token = $data[1];
		$span = $data[2];
		
		return (true);
	}

	/**
	 * 获得签名信息.
	 * @access public
	 * @static
	 * @param string $akey 授权密钥.
	 * @param string $data 数据.
	 * @return string 签名信息.
	 */
	public static function Signature ($akey, &$data)
	{
		$md5 = md5 ($data);
		$sign = self::DesEncrypt ($akey, $md5, true);
		
		return ($sign);
	}
	
	/**
	 * 验证签名信息.
	 * @access public
	 * @static
	 * @param string $akey 授权密钥.
	 * @param string $sign 签名信息.
	 * @param string $data 数据.
	 * @return boolean 验证是否通过.
	 */
	public static function VerifySign ($akey, $sign, &$data)
	{
		$mds = self::DesDecrypt ($akey, $sign, true);
		$mdt = md5 ($data);
		return (strcasecmp ($mds, $mdt) == 0);
	}
}
?>