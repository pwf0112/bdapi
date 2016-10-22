<?php
namespace BdApi;

class Common
{
	private static $key;

	public static function init($apiKey)
	{
		self::$key = $apiKey;
	}

	public static function mobile($phone)
	{
		$url = "http://apis.baidu.com/apistore/mobilenumber/mobilenumber?phone={$phone}";

		return self::curl($url);
	}

	public static function pinyin($str)
	{
		$str = urlencode($str);
		$url = "http://apis.baidu.com/xiaogg/changetopinyin/topinyin?str={$str}&type=json&traditional=0&accent=0&letter=0&only_chinese=0";

		return self::curl($url);
	}

	private static function curl($url)
	{
		$ch = curl_init();

		$header = array(
			"apikey: " . self::$key,
		);

		// 添加apikey到header
		curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 执行HTTP请求
		curl_setopt($ch , CURLOPT_URL , $url);
		$res = curl_exec($ch);

		return json_decode($res);
	}
}