<?php
namespace Wechat\Model;
use Think\Model\RelationModel;
class ServerExpandModel extends RelationModel{
    protected $tableName='server_expand';
    protected $_validate=array(
        array('server_id','/^\d+$/','请选择服务',1),
        array('expand_name','require','名称必须填写',1),
        array('expand_phone','/^\d{11}$/','请输入正确的手机号码',1),
    );

    protected $_auto=array(
        array('expand_time','time',1,'function'),
        array('expand_update_time','time',3,'function'),
        array('expand_name','trim',3,'function'),
        array('expand_addr','trim',3,'function'),
        array('expand_content','trim',3,'function'),

        array('server_name','getServerName',3,'callback'),//获取服务名称
        array('server_price','getServerPrice',3,'callback'),//获取服务价格
        array('server_content','getServerContent',3,'callback'),//获取服务内容
        array('expand_server_time','getTime',3,'callback'),
        array('expand_server_id','getServerId',3,'callback'),//服务ID
        array('expand_server_uid','getUid',3,'callback'),//用户ID
        array('expand_status','1',1),

    );

    public function getUid(){
        $id=session('id');
        return $id;
    }

    public function getServerId(){
        return I('post.server_id');
    }
    public function getTime(){
        return strtotime(I('post.expand_server_time'));
    }

    public function getServerName(){
        return M('server')->getFieldByserver_id(I('post.server_id'),'server_name');
    }

    public function getServerPrice(){
        return M('server')->getFieldByserver_id(I('post.server_id'),'server_price');
    }

    public function getServerContent(){
        return M('server')->getFieldByserver_id(I('post.server_id'),'server_content');
    }


}