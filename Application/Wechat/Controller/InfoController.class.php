<?php
namespace Wechat\Controller;
use Think\Controller;
use Ucpaas\Ucpaas;
class InfoController extends Controller {

    public function index(){
        $this->display();
    }
    //绑定手机号码
    public function phone(){
        $this->display();
    }

    /*绑定手机号码操作*/
    public function bindPhone(){
        $phone=I('post.phone');
        if(preg_match("/^\d{11}$/",$phone)) {//判断手机号码
            if(M('verify')->where(array('status'=>1,'phone'=>$phone,'verify'=>I('post.verify')))->order('id desc')->find()){
                //获取用户信息
                $id=M('user')->getFieldByopenid('ouDeCjs_kUYb6E6eY8WDGMsQ-b3U1','id');
                //添加会员手机号码
                $info['lasttime']=time();
                $info['phone']=$phone;
                if(M('user')->where(array('id'=>$id))->setField($info)){

                    //是该手机号码的所有短信验证码失效
                    M('verify')->where(array('phone'=>$phone))->setField('status',2);
                    $result['code']=1;
                    $result['msg']="绑定成功";
                }else{
                    $result['code']=0;
                    $result['msg']="修改失败";
                }
            }else{
               $result['code']=0;
               $result['msg']="验证码错误!";
            }
        }else{
            $result['code']=0;
            $result['msg']="验证码错误!";
        }
        $this->ajaxReturn($result);
    }

    //获取短信验证码
    public function getVerify(){
        $phone=I('post.phone');
        $time=time();
        if(preg_match("/^\d{11}$/",$phone)){//判断手机号码
            if($info=M('verify')->where(array('phone'=>$phone))->order('id desc')->find()){
                if($time-$info['time']<1800){
                    $result['code']=0;
                    $result['msg']="短信已发送，请查看手机!";
                    $this->ajaxReturn($result);exit;
                }
            }
            $options['accountsid']='028944f5c01568037392d795632348b4';
            $options['token']='7f3c839b78436bf1cf0c0811d80b5d27';
            $ucpass = new Ucpaas($options);
    //        短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
            $appId = "dcaab0c5c12449acb251cf3aa2e48d6f";
            $to = $phone;
            $templateId = "22213";
            srand((double)microtime()*1000000);//create a random number feed.
            $ychar="0,1,2,3,4,5,6,7,8,9";
            $verify='';
            $list=explode(",",$ychar);
            for($i=0;$i<4;$i++){
                $randnum=rand(0,9); // 10+26;
                $verify.=$list[$randnum];
            }

            $param="$verify,30";


            $str=$ucpass->templateSMS($appId,$to,$templateId,$param);
            if (substr($str,21,6) == 000000) {
                $data['phone']=$phone;
                $data['verify']=$verify;//验证码
                $data['time']=$time;
                $data['status']=1;
                $data['receive_status']=0;
                if(M('verify')->add($data)){
                    $result['code']=1;
                    $result['msg']="短信发送成功!";
                }else{
                    $result['code']=0;
                    $result['msg']="短信发送失败!";
                }
            }else{
                $result['code']=0;
                $result['msg']="短信发送失败!";
            }
        }else{
            $result['code']=0;
            $result['msg']="请输入正确的手机号码!";
        }
        $this->ajaxReturn($result);
    }
}