<?php
namespace Wechat\Logic;
use Think\Model\RelationModel;
class GoodsLogic extends RelationModel{
    protected $tableName="goods";
    protected $_link=array(
        'images'=>array(
            'mapping_type'  =>  self::HAS_MANY,
            'class_name'    =>  'image',
            'foreign_key'   =>  'image_info_id',
            'mapping_fields'=>  'image_id,image_info_id,image_url,image_thumb',
            'condition'     =>  'image_status=1',
            'mapping_order' =>  'image_sort asc',
        ),

        'dis'   =>array(
            'mapping_type'  =>  self::HAS_ONE,
            'class_name'    =>  'discuss',
            'foreign_key'   =>  'discuss_goods_id',
            'mapping_fields'=>  'count("discuss_id") as count , sum(discuss_level) as sum_level',
            'as_fields'     =>  'count,sum_level',
        ),

        'image_one'=>array(
            'mapping_type'  =>  self::HAS_ONE,
            'class_name'    =>  'image',
            'foreign_key'   =>  'image_info_id',
            'mapping_fields'=>  'image_url,image_thumb,image_thumb_low',
            'as_fields'     =>  'image_url,image_thumb,image_thumb_low',
            'condition'     =>  'image_status=1',
            'mapping_order' =>  'image_sort asc',
        ),
    );
}