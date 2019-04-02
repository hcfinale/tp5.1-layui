<?php
/**
* 	配置账号信息
*/

//相关内容内容可以参考

class WxPayConfig
{
	//=======【基本信息设置】=====================================
	const APPID = 'wx92dedc49b3405e25';
	const MCHID = '1404807102';
	const KEY = 'b41d509aeb649377332c032cc00b7b09';
	const APPSECRET = 'b41d509aeb649377332c032cc00b7b09';
	
	//=======【证书路径设置】=====================================
	const SSLCERT_PATH = '../cert/apiclient_cert.pem';
	const SSLKEY_PATH = '../cert/apiclient_key.pem';
	
	//=======【curl代理设置】===================================
	const CURL_PROXY_HOST = "0.0.0.0";//"10.152.18.220";
	const CURL_PROXY_PORT = 0;//8080;
	
	//=======【上报信息配置】===================================
	const REPORT_LEVENL = 1;
}
