<?php
namespace Wechat\Controller;
use Think\Controller;
class CenterController extends CommonController {
    public function index(){
        $this->display();
    }
    public function about(){
    	
    	$this->display();
    }

    //商品收藏
    public function myColGoods(){
        $where['collection_uid']=1;//用户ID
        $where['collection_type']=1;
        $where['collection_status']=1;
        $cols=implode(",",M('collection')->where($where)->order('collection_update_time desc')->getField('collection_id,collection_info_id'));
        if($cols){
            $list=D('Goods','Logic')->where(array('goods_id'=>array('in',$cols)))->relation('image_one')->select();
            $this->assign('list',$list);
        }
        $this->display();
    }
    //收货地址
    public function address(){
        $this->display();
    }
    //新建收货地址
    public function addAddress(){
        $this->display();
    }

    //我的服务订单
    public function myServerOrder(){
        $this->display();
    }

    //我的商品订单
    public function myGoodsOrder(){
        $this->display();
    }
}