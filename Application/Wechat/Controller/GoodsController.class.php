<?php
namespace Wechat\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function index(){
        if(I('get.goods_name')){
            $where['goods_name']=array('LIKE',"%".I('get.goods_name').'%');
        }

        if(I('get.start')||I('get.end')){//价格区间搜索
            $start=I('get.start','','float');
            $end=I('get.end','','float');
            $where['goods_price']=array_merge($start?array(array('gt',$start)):array(),$end?array(array('lt',$end)):array());
        }

        $cate=I('get.cate','','int');//分类搜索
        if($cate){
            $str=implode(",",M('cate')->where(array('cate_parent_id'=>$cate))->getField('cate_id',true));
            $where['goods_cate']=$str?array('in',$str):$cate;
        }
        $sort=I('get.price_sort');
        $order=$sort?$sort=='asc'?'goods_price asc':'goods_price desc':'goods_sort asc,image_sort asc';
        $where['goods_status']=1;
        $where['image_status']=1;
        $num=8;//控制显示条数
//        $limit='0,'.$num;
        $page=I('get.page','','int');
        $limit=$num*$page.','.$num*($page+1);
        $list=D('GoodsView','Logic')->where($where)->order($order)->group('goods_id')->limit($limit)->select();
        if(IS_AJAX){//是否通过ajax请求
            foreach($list as $vo){
                $str.='<li>
                            <div class="image">
                                <a href="'.U('Goods/details',array('goods_id'=>$vo['goods_id'])).'"><img src="'.__ROOT__.'/'.$vo['image_thumb'].'" width="100%"></a>
                            </div>
                            <div class="content">
                                <h2><a href="'.U('Goods/details',array('goods_id'=>$vo['goods_id'])).'">'.$vo['goods_name'].'</a></h2>
                                <div class="sales">销量：1000　　收藏：554</div>
                                <div class="price">'.$vo['goods_price'].'</div>
                                <div class="disc">会员折扣价：'.$vo['goods_price'].'</div>
                            </div>
                        </li>';
            }
            echo $str;exit;
        }
        //商品类型
        $cates=M('cate')->where(array('cate_parent_id'=>0,'cate_status'=>1))->getField('cate_id,cate_name');
        $this->assign('count',ceil(M('goods')->where($where)->count()/$num));//商品总数
        $this->assign('cates',$cates);
        $this->assign('list',$list);
        $this->display();
    }

    //商品详情
    public function details(){
        $id = I('get.goods_id', '', 'int');
        if ($id){
            $field="goods_id,goods_name,goods_price";
            $info = D('Goods', 'Logic')->relation(array('images','dis'))->field($field)->find($id);
            $this->assign('info',$info);
        }

        $this->display();
    }

    //商品简介
    public function introduction(){
        $id = I('get.goods_id', '', 'int');
        if ($id){
            $info = M('param')->where(array('param_type'=>1,'param_status'=>1,'param_info_id'=>$id))->getField('param_content',true);
            $this->assign('info',$info);
        }
        $this->display();
    }
    //图片介绍
    public function graph(){
        $id = I('get.goods_id', '', 'int');
        if ($id){
            $info = M('goods')->where(array('goods_id'=>$id))->getField('goods_details');
            $this->assign('info',$info);
        }
        $this->display();
    }

    //商品评论
    public function discuss(){
        $id = I('get.goods_id', '', 'int');
        if ($id){
            $fields="discuss_id,discuss_uid,discuss_level,discuss_content,discuss_time";
            $info = D('Discuss','Logic')->relation('user')->field($fields)->where(array('discuss_goods_id'=>$id,'discuss_status'=>1))->order('discuss_time desc')->select();
            $this->assign('info',$info);
        }
        $this->display();
    }

    //收藏商品
    public function collGoods(){
        $id=I('get.id','','int');
        if($id){
            $data['collection_uid']=session('id');
            $data['collection_info_id']=$id;
            $data['collection_type']=1;
            $data['collection_status']=1;
            if($info=M('collection')->where(array('collection_info_id'=>$id,'collection_uid'=>session('id'),'collection_type'=>1))->find()){
                $edit['collection_id']=$info['collection_id'];
                $edit['collection_status']=$info['collection_status']==2?1:2;
                $edit['collection_update_time']=time();
                if(M('collection')->save($edit)){
                    $result['code']=1;
                    $result['msg']=$info['collection_status']==1?"取消收藏成功!":'收藏成功';
                }else{
                    $result['code']=0;
                    $result['msg']=$info['collection_status']==1?"取消收藏失败!":'收藏失败';
                }
            }else{
                $data['collection_time']=time();
                if(M('collection')->add($data)){
                    $result['code']=1;
                    $result['msg']="收藏成功!";
                }else{
                    $result['code']=0;
                    $result['msg']="收藏失败!";
                }
            }
        }else{
            $result['code']=0;
            $result['msg']="请求出错!";
        }
        $this->ajaxReturn($result);
    }
    //购物车
    public function cart(){
        $where['cart_uid']=session('id');
        $where['image_status']=1;
        $where['cart_type']=1;
        $cart=D('cartGoodsView','Logic')->group('cart_info_id')->where($where)->order('cart_id desc,image_sort asc')->select();
        $this->assign('cart',$cart);
        $this->display();
    }

    //加入购物车
    public function cartAdd(){
        $id=I('get.id','','int');
        if($id){
            $add['cart_uid']=session('id');//M('user')->getFieldByopenid(cookie('openid'),'id');
            $add['cart_info_id']=$id;
            $add['cart_type']=1;
            if($info=M('cart')->where(array('cart_uid'=>$add['cart_uid'],'cart_info_id'=>$id,'cart_type'=>1))->find()){
                if(M('cart')->where(array('cart_id'=>$info['cart_id']))->setInc('cart_num')){
                    $result['code']=1;
                    $result['msg']="加入购物车成功";
                }else{
                    $result['code']=0;
                    $result['msg']="加入购物车失败";
                }
            }else{
                if(M('cart')->add($add)){
                    $result['code']=1;
                    $result['msg']="加入购物车成功";
                }else{
                    $result['code']=0;
                    $result['msg']="加入购物车失败!";
                }
            }
        }else{
            $result['code']=0;
            $result['msg']="请求出错!";
        }
        $this->ajaxReturn($result);
    }

    //删除购物车
    public function delCart(){
        if(IS_AJAX){
            $id=implode(",",I('post.id'));
            if($id){
                $where['cart_id']=array('in',$id);
                if(M('cart')->where($where)->setInc('cart_num')){
                    $result['code']=1;
                    $result['msg']="删除成功!";
                }else{
                    $result['code']=0;
                    $result['msg']="删除失败!";
                }
            }else{
                $result['code']=0;
                $result['msg']="参数错误!";
            }
        }else{
            $result['code']=0;
            $result['msg']="操作错误!";
        }
        $this->ajaxReturn($result);
    }

    //购物车数量加减
    public function numCart(){
        if(IS_AJAX){
            $id=I('post.id','','int');
            $status=I('post.status','','int');
            if($id){
                if($status){
                    $num=M('cart')->getFieldBycart_id($id,'cart_num');
                    if($num>1){
                        M('cart')->where(array('cart_id'=>$id))->setDec('cart_num');
                    }else{
                        echo '呵呵';
                    }
                }else{
                    M('cart')->where(array('cart_id'=>$id))->setInc('cart_num');
                }
            }else{
                $result['code']=0;
                $result['msg']="参数错误!";
            }
        }else{
            $result['code']=0;
            $result['msg']="操作错误!";
        }
        $this->ajaxReturn($result);
    }
    //确认购买
    public function waitPay(){
        $this->display();
    }
}