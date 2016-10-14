<?php
namespace Admin\Controller;
use QzApi\Controller\IndexController;

class UserController extends CommonController{
    public function index(){
        $this->display();
    }

    public function userList(){
        $obj=new \Admin\Event\UserEvent;
        $result=$obj->info();
//        dump($result);
        $this->assign('sex',array('1'=>'男','2'=>'女',''=>'未知'));
        $this->assign('auth',array('0'=>'未认证','1'=>'已认证'));
        $this->assign('status',array('1'=>'正常','2'=>'冻结'));
        $this->assign('level',M('level')->where('`status`=1')->getField('level_id,level_name'));
        $this->assign('list',$result['list']);
        $this->assign('page',$result['page']);
        $this->display();
    }

    //用户认证或取消认证操作
    public function authAction(){
        $id=I('get.id','','int');
        if($id){
            $Model=M(); // 实例化一个model对象 没有对应任何数据表
            if($Model->execute("update __USER__ set user_auth=if(user_auth=0,1,0) where user_id=".$id)){
                $result['code']=1;
                $result['msg']='操作成功!';
            }else{
                $result['code']=0;
                $result['msg']='操作失败!';
            }
        }else{
            $result['code']=0;
            $result['msg']='操作异常!';
        }
        $this->ajaxReturn($result);
    }

    //会员停用或启用
    public function stopAction(){
        $id=I('get.id','','int');
        if($id){
            $Model=M(); // 实例化一个model对象 没有对应任何数据表
            if($Model->execute("update __USER__ set user_status=if(user_status=1,2,1) where user_id=".$id)){
                $result['code']=1;
                $result['msg']='操作成功!';
            }else{
                $result['code']=0;
                $result['msg']='操作失败!';
            }
        }else{
            $result['code']=0;
            $result['msg']='操作异常!';
        }
        $this->ajaxReturn($result);
    }




}