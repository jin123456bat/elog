<?php
namespace App\Helper;

class Encrypt
{

	/**
	 * 获取一个唯一的ID，长度为prefix的长度+32位
	 *
	 * @param string $prefix
	 * @return string
	 */
	public static function unique_id($prefix = '')
	{
		mt_srand((double)microtime() * 10000); // optional for php 4.2.0 and up.
		return $prefix . md5(uniqid(mt_rand(), true));
	}

	/**
	 * guid
	 * @return string
	 */
	public static function guid()
	{
		mt_srand((double)microtime() * 10000); // optional for php 4.2.0 and up.
		$charid = strtoupper(md5(uniqid(mt_rand(), true)));
		$hyphen = chr(45);
		$uuid = substr($charid, 0, 8) . $hyphen . substr($charid, 8, 4) . $hyphen . substr($charid, 12, 4) . $hyphen . substr($charid, 16, 4) . $hyphen . substr($charid, 20, 12);
		return $uuid;
	}

	/**
	 * 单向加密
	 * @param string $password
	 * @return string
	 */
	public static function password_hash($password)
	{
		$options = array(
			'cost' => 12,
		);
		return password_hash($password, PASSWORD_BCRYPT, $options);
	}

	/**
	 * 生成随机字符串
	 * 区分大小写
	 * 0-9a-zA-Z
	 * @param int $length 字符串长度
	 * @param string 一个包含number|supper_word|lower_word的字符串，中间用竖线分割，或者数组
	 * @param char[] $skip_content 生成的字符串中不包含的字符
	 */
	public static function random($length, $types = 'number|supper_word|lower_word', $skip_content = array())
	{
		$content = array();

		$types = is_array($types) ? $types : explode('|', $types);

		if (in_array('number', $types)) {
			for ($i = ord('0'); $i <= ord('9'); $i++) {
				if (in_array(chr($i), $skip_content)) {
					continue;
				}
				$content[] = chr($i);
			}
		}
		if (in_array('supper_word', $types)) {
			for ($i = ord('A'); $i <= ord('Z'); $i++) {
				if (in_array(chr($i), $skip_content)) {
					continue;
				}
				$content[] = chr($i);
			}
		}

		if (in_array('lower_word', $types)) {
			for ($i = ord('a'); $i <= ord('z'); $i++) {
				if (in_array(chr($i), $skip_content)) {
					continue;
				}
				$content[] = chr($i);
			}
		}

		$string = '';
		while ($length--) {
			$k = mt_rand(0, count($content) - 1);
			$string .= $content[$k];
		}
		return $string;
	}

	/**
	 * aes加密
	 */
	public static function aes_encrypt($data, $key)
	{
		$data = openssl_encrypt($data, 'AES-128-ECB', $key, 1, '');
		return base64_encode($data);
	}
}