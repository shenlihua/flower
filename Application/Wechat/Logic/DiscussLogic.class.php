<?php
namespace Wechat\Logic;
use Think\Model\RelationModel;
class DiscussLogic extends RelationModel{
    protected $tableName='discuss';
    protected $_link=array(
        'user'  =>array(
            'mapping_type'  =>  self::BELONGS_TO,
            'class_name'    =>  'user',
            'foreign_key'   =>  'discuss_uid',
            'mapping_fields'=>  'nickname',
            'as_fields'     =>  'nickname',
        ),

    );
}