<?php
namespace Admin\Model;
use Think\Model;
class LoginModel extends  Model{
    protected $tableName='admin';
    protected $_validate=array(
        array('account','require','用户名不能为空',1),
        array('password','require','密码不能为空',1),
        array('verify','checkVerify','验证码不正确',1,'callback'),
        array('name','checkSubmitLogin','用户名或密码错误',1,'callback'),
        );
    public function checkVerify(){
        $verify=new \Think\Verify;
        return $verify->check(I('post.verify'));
    }
    public function checkSubmitLogin(){
        $where['account']=I('post.account');
        $where['password']=pwd_encrypt(I('password'));
        if($info=$this->where($where)->find()){
//保存用户信息
            session('auth',$info);
            return true;
        }else{
            return false;
        }
    }
}