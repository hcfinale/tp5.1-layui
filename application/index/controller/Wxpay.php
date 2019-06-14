<?php

namespace app\index\controller;

use app\common\model\User;;
use app\common\model\Order;
use wxpay\database\WxPayResults;
use wxpay\database\WxPayUnifiedOrder;
use wxpay\database\WxPayOrderQuery;
use wxpay\NativePay;
use wxpay\WxPayApi;
use wxpay\WxPayConfig;
use Predis;
use PHPQRCode\QRcode;

class Wxpay extends Base{
    protected function initialize(){
        parent::initialize();
        if (!self::islogin()){
            $this->error('您需要登录后在进行操作','user/login');
        }
        $this->Order = new Order();
    }
    public function index(){
        $product_id = (time()+1).createStr(22);
        $notify = new NativePay();
        $input = new WxPayUnifiedOrder();
        $input->setBody("微信支付的东西");
        $input->setAttach("xxx");
        //$input->setOutTradeNo(WxPayConfig::MCHID.date("YmdHis"));
        $input->setOutTradeNo($product_id);
        $input->setTotalFee("1");//以分为单位,一般是要乘100的。
        $input->setTimeStart(date("YmdHis"));
        $input->setTimeExpire(date("YmdHis", time() + 600));
        $input->setGoodsTag("test");
        $input->setNotifyUrl(wxPayConfig::NOTIFY_URL);
        $input->setTradeType("NATIVE");
        //$product_id 为商品自定义id 可用作订单ID
        $input->setProductId($product_id);
        /*
        $data = [
            'order_id'  =>  $input->getOutTradeNo(),
            'uid'   =>  session('uid'),
            'amount'    =>  $input->getTotalFee(),
        ];
        $res = db('order')->insert($data);
        */
        $result = $notify->getPayUrl($input);

        if (empty($result['code_url'])){
            $qrCode_url = '';
        }else{
            $qrCode_url = $this->setQrcode($result['code_url']);
        }
        return $this->fetch('',[
            'qrCode_url' => $qrCode_url,
            'product_id'    =>  $product_id,
        ]);
    }

    /**
     * 查看订单的状态
     */
    public function orderstate(){
        error_reporting(E_ERROR);
        ini_set('date.timezone','Asia/Shanghai');
        $transaction_id = $_REQUEST['transaction_id'];
        $out_trade_no = $_REQUEST['out_trade_no'];
        if(request()->param('transaction_id') != null && request()->param('transaction_id') != ""){
            $input = new WxPayOrderQuery();
            $input->setTransactionId($transaction_id);
            if (WxPayApi::orderQuery($input)['trade_state']==='SUCCESS'){
                db('order')->where('order_id',$transaction_id)->update(['ispay'=>'1']);
            }else{
                // 支付失败
                db('order')->where('order_id',$transaction_id)->update(['ispay'=>'2']);
            }
            return json(WxPayApi::orderQuery($input));
        }

        if(request()->param('out_trade_no') != null && request()->param('out_trade_no') != ""){
            $input = new WxPayOrderQuery();
            $input->setOutTradeNo($out_trade_no);
            if (WxPayApi::orderQuery($input)['trade_state']==='SUCCESS'){
                db('order')->where('order_id',$out_trade_no)->update(['ispay'=>'1']);
            }else{
                db('order')->where('order_id',$out_trade_no)->update(['ispay'=>'2']);
            }
            return json(WxPayApi::orderQuery($input));
        }
    }
    /**
     * 微信支付 回调逻辑处理
     * @return string
     */
    public function notify(){
        $wxData = file_get_contents("php://input");
        //file_put_contents('/tmp/2.txt',$wxData,FILE_APPEND);
        try{
            $resultObj = new WxPayResults();
            $wxData = $resultObj->Init($wxData);
        }catch (\Exception $e){
            $resultObj ->setData('return_code','FAIL');
            $resultObj ->setData('return_msg',$e->getMessage());
            return $resultObj->toXml();
        }

        if ($wxData['return_code']==='FAIL'||
            $wxData['return_code']!== 'SUCCESS'){
            $resultObj ->setData('return_code','FAIL');
            $resultObj ->setData('return_msg','error');
            return $resultObj->toXml();
        }
        // TODO 根据订单号 out_trade_no 来查询订单数据
        $out_trade_no = $wxData['out_trade_no'];
        //此处为举例
        $input = new WxPayUnifiedOrder();
        db('order')->where('order_id',$input->getOutTradeNo())->update(['ispay'=>'1']);
        db('order')->where('order_id',$out_trade_no)->update(['ispay'=>'2']);
        $order = db('order')->where(['order_id' => $out_trade_no])->find();

        if (!$order || $order->status == 1){
            $resultObj ->setData('return_code','SUCCESS');
            $resultObj ->setData('return_msg','OK');
            return $resultObj->toXml();
        }
        //TODO 数据更新 业务逻辑处理 $order
    }
    // redis 的操作
    public function myredis(){
        $client =  new Predis\Client([
            'scheme'    =>  'tcp',
            'host'  =>  config('redis.REDIS_HOST'),
            'port'  =>  config('redis.REDIS_PORT'),
            'password'  =>  config('redis.REDIS_AUTH'),
            'database'  =>  1,
        ]);
        $client->set('han','this is my name');
        $client->rpush('mylist',['one']);
        $client->rpush('mylist',['two']);
        $client->rpush('mylist',['three']);
        $client->rpush('mylist',['fore']);
        // 查看mylist中所有的数据
        $valueAll = $client->lrange('mylist','0','-1');
        // 查找第二个push进去的数据
        $value = $client->lindex('mylist','-2');
        dump($valueAll);
    }
    // 二维码生成
    public function qrcode(){
        if (request()->isGet()){
            $product_id = (time()+1).createStr(22);

            $goodsId = request()->param('did');
            $goodsSum = request()->param('sum');
            $this->Order->addPay($goodsId,$goodsSum,$product_id);
            $id = db('ShopCart')->max('id');
            $pay = db('ShopCart')->where('id',$id)->find();
            if ($pay['is_pay']=='-2'){
                return "当前商品库存不足，订单已经加入购物车中";
            }
            $nidePrice = $pay['price']*$pay['sum']*100;

            $notify = new NativePay();
            $input = new WxPayUnifiedOrder();
            $input->setBody("$pay[name]");
            $input->setAttach("xxx");
            //$input->setOutTradeNo(WxPayConfig::MCHID.date("YmdHis"));
            $input->setOutTradeNo($product_id);
            $input->setTotalFee("$nidePrice");//以分为单位,一般是要乘100的。
            $input->setTimeStart(date("YmdHis"));
            $input->setTimeExpire(date("YmdHis", time() + 600));
            $input->setGoodsTag("test");
            $input->setNotifyUrl(wxPayConfig::NOTIFY_URL);
            $input->setTradeType("NATIVE");
            //$product_id 为商品自定义id 可用作订单ID
            $input->setProductId($product_id);
            $result = $notify->getPayUrl($input);
            if (empty($result['code_url'])){
                $qrCode_url = '';
            }else{
                $qrCode_url = $result["code_url"];
            }
            return $this->fetch('qrcode',[
                'qrCode_url' => $qrCode_url,
                'product_id'    =>  $product_id,
            ]);
        }else{
            return json(['code'=>'1004','data'=>'操作非法']);
        }
    }
    // 这个是购物回调过来的
    public function create(){
        $url = request()->param('qrcodeurl');
        $qrcode = new QRcode();
        //打开缓冲区
        ob_start();
        $qrcode->png("$url",false,'L','7','2');
        //这里就是把生成的图片流从缓冲区保存到内存对象上，使用base64_encode变成编码字符串，通过json返回给页面。
        $imageString = base64_encode(ob_get_contents());
        //关闭缓冲区
        ob_end_clean();
        //把生成的base64字符串返回给前端
        $data = array(
            'code'=>200,
            'data'=>$imageString
        );
        return json($data);
    }
    // 公用二维码生成
    static function setQrcode($url){
        //二维码图片保存路径
        $pathname = date("Ymd",time());
        $pathname = "./public/wxpay/qrcode/" . $pathname;
        if(!is_dir($pathname)) { //若目录不存在则创建之
            mkdir($pathname);
        }
        $qrcode = new QRcode();
        //二维码图片保存路径(若不生成文件则设置为false)
        $filename = $pathname . "/qrcode_" . randOrder() . ".png";
        //二维码容错率，默认L
        $level = "L";
        //二维码图片每个黑点的像素，默认4
        $size = '10';
        //二维码边框的间距，默认2
        $padding = 2;
        //保存二维码图片并显示出来，$filename必须传递文件路径
        $saveandprint = true;
        //生成二维码图片
        $qrcode->png($url,$filename,$level,$size,$padding,$saveandprint);
        //二维码logo
        $logo = "./public/wxpay/images/logo.png";
        $QR = imagecreatefromstring(file_get_contents($filename));
        $logo = imagecreatefromstring(file_get_contents($logo));
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);
        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);
        $logo_qr_width = $QR_width / 5;
        $scale = $logo_width / $logo_qr_width;
        $logo_qr_height = $logo_height / $scale;
        $from_width = ($QR_width - $logo_qr_width) / 2;
        imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        imagepng($QR,$filename);
        return $filename;
    }
}