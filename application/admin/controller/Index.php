<?php
namespace app\admin\controller;

use app\common\Alisms;
use app\common\controller\Base;
use think\Config;
use think\Exception;
class Index extends Base {
    public function index(){
        return $this->fetch('index/index');
    }
    public function statistics(){
        $this->assign('countUser',db('AdminUser')->cache(true,'300')->count('*'));
        $this->assign('user',session('user'));
        $this->assign('countColumn',db('column')->cache(true,'300')->count('*'));
        $this->assign('countDetail',db('detail')->cache(true,'300')->count('*'));
        $this->assign('countOrder',db('order')->cache(true,'300')->count('*'));
        return $this->fetch('index/statistics');
    }
    public function form(){
        return $this->fetch('form');
    }
    public function SendMailer(){
        //邮件发送功能实现 990223979
        send_mail("990223979@qq.com","蒋斌","邮箱提醒","蒋斌，你这个傻货的的邮箱已经被盗，快来哄我我给你解封。");
    }
    public function test() {
        dump(\Map::getLngLat('北京昌平沙河地铁'));
        return 'singwa';
    }
    public function map() {
//        $lnglat = \Map::getLngLat('河南大学');
//        dump($lnglat);
        return \Map::staticimage('南京大学');
    }
    /**
     * 发送短信
     *
     * @param string $mobile 手机号码
     * @param string $type 类型：1-用户注册验证码、2-修改密码验证码
     * @param int $create_id 操作人menber_id
     * @return bool 返回状态
     */
    function smsSend($mobile, $type, $create_id, $ParamArr='')
    {
        $aliSms = new Alisms();
        return $aliSms->sendSms($mobile, $type, $create_id, $ParamArr);
    }

    /**
     * 通过CURL获取远程服务器数据
     * @param string $url 远程服务器URL
     * @param json $data POST数据
     * @param mixed $output 返回值
     * @param array $header 传递头部信息
     * @return mixed
     */
    function dbb_curl($curr_url, $data = null, &$output, $header = null)
    {
        $ch = curl_init();
        if (!$header) {
            $header = ["Accept-Charset: utf-8"];
        }
        curl_setopt($ch, CURLOPT_URL, $curr_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_HEADER, true); //获取头部信息
        if (1 == strpos("$".$curr_url, "https://")) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        if (!empty($data)){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        $output     = curl_exec($ch);
        $errorno    = curl_errno($ch);
        curl_close($ch);
        if ($errorno) {
            return $errorno;
        }else{
            return 0;
        }
    }
    public function demo(){
    	// request()->setAction('123hcdex');
    	// dump(request()->action());
    	// dump(cookie('userKey'));
        dump(randOrder());
    }
}
