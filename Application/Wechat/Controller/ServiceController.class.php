<?php
namespace Wechat\Controller;
use Think\Controller;

class ServiceController extends CommonController{
    public function  _empty(){
        $this->redirect("Service/index");
    }

    public function index(){
        if(I('get.keyword')){
            $where['keyword']=array('like','%'.I('get.keyword').'%');
        }
        $where['server_status']=1;
        $field="server_id,server_name,server_price,server_thumb,server_thumb_low";
        $list=M('server')->field($field)->where($where)->order('server_sort asc')->select();
        $this->assign('list',$list);
        $this->display();
    }

    public function details(){
        $id=I('get.id','','int');
        if(I('get.id')){
            $field="server_id,server_name,server_price,server_thumb,server_thumb_low,server_content,server_introduction";
            $info=M('server')->field($field)->where(array('server_id'=>$id))->find();
            $this->assign('info',$info);
        }
        $this->display();
    }

    /*添加服务*/
    public function appointment(){
        $this->display();
    }

    /*添加服务表单操作*/
    public function appointmentAction(){
        $db=D("serverExpand");
        if(!$db->create()){
            $result['code']=0;
            $result['msg']=$db->getError();
        }else{
            if($db->add()){
                $result['code']=1;
                $result['msg']="预约成功!!";
            }else{
                $result['code']=0;
                $result['msg']="预约失败!!";
            }
        }
        $this->ajaxReturn($result);
    }
}
?>
