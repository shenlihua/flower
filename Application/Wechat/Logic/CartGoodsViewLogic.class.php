<?php
namespace Wechat\Logic;
use Think\Model\ViewModel;
class CartGoodsViewLogic extends ViewModel{
    protected $viewFields=array(
        'Cart'  =>array('cart_id','cart_uid','cart_info_id','cart_num','_type'=>'left'),
        'Goods' =>array('goods_name','goods_price','_on'=>'Cart.cart_info_id=Goods.goods_id'),
        'Image' =>array('image_thumb','image_thumb_low','_on'=>'Cart.cart_info_id=Image_info_id'),
    );
}