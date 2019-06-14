<?php
namespace app\common\model;
use think\Model;
/**
 * 判断是否能发送
 *
 * @param array $data 创建人ID、手机号码、验证码
 * @return int 下次获取等待时间
 */
class sms extends Model{
    public function isSend($mobile)
    {
        $last_create_time = $this->where("mobile='$mobile'")->order('id DESC')->value('create_time');
        if (empty($last_create_time)) {
            return 0;
        }
        $curr_time = time();
        $interval_time = getConfig('interval_time')?getConfig('interval_time'):60;//间隔时间
        $surplus = $curr_time - $last_create_time;
        if ( $surplus > $interval_time ) {
            return 0;
        } else {
            return intval(($interval_time - $surplus));
        }
    }

    /**
     * 发送结果更新
     *
     * @param array $data 创建人ID、手机号码、验证码
     * @return int 下次获取等待时间
     */
    public function sendUpdate($id, $requestid)
    {
        $updata_arr = array('status'=>1, 'requestid'=>$requestid, 'update_time'=>time());
        return $this->where("id=$id")->update($updata_arr);
    }

//============== 以下两个方法本文没使用到，可参考 ==============
    /**
     * 验证码校验
     *
     * @param string $mobile 手机号码
     * @param string $code 验证码
     * @return array 校验结果
     */
    public function check_code($mobile, $code)
    {
        $return_arr = array('status'=>0,'msg'=>'');
        $rs = $this->field('id,is_use,create_time')->where("status=1 AND mobile=$mobile AND code=$code")->order('id DESC')->find();
        if ($rs) {
            if ($rs['is_use']==1) {
                $return_arr['msg'] = '该验证码已经被使用';
            }
            $invalidTime    =    getConfig('code_invalid_time') ? getConfig('code_invalid_time') : 600;
            if ( (time() - $rs['create_time']) > $invalidTime ) {
                $return_arr['msg'] = '该验证码已经失效';
            }
            if (empty($return_arr['msg'])) {
                $return_arr['status'] = 1;
                $return_arr['msg'] = '验证通过';
                $return_arr['id'] = $rs['id'];
            }
        } else {
            $return_arr['msg'] = '验证码错误';
        }
        return $return_arr;
    }

    /**
     * 标记验证码已经被使用
     *
     * @param int $id 验证码ID
     * @return bool
     */
    public function code_use($id)
    {
        $data = array('is_use'=>1, 'update_time'=>time());
        return $this->where('id',$id)->update($data);
    }
}