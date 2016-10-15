<?php
namespace Wechat\Logic;
use Think\Model\ViewModel;
class GoodsViewLogic extends ViewModel{
    protected $viewFields=array(
        'Goods'   =>  array('goods_id','goods_name','goods_cate','goods_price','_type'=>'left'),
        'Image'   =>  array('image_url','image_thumb','image_thumb_low','_on'=>'Goods.goods_id=Image.image_info_id'),
//        'Discuss' =>  array('count(discuss_id)'=>'count','sum(discuss_level)'=>'all_level','_on'=>'Goods.goods_id=Discuss.discuss_goods_id'),
    );
}
