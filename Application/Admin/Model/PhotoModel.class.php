<?php
namespace Admin\Model;
use Think\Model;
class PhotoModel extends Model
{
    protected $tableName='image';

    protected $_validate=array(
        array('title','1,100','标题只能在1-100范围内',1,'length'),
        array('sort','0,100','排序只能在0-100之间',1,'between'),
        array('img','require','请上传图片',1),
        array('status','2,1','显示状态错误',1,'in'),
    );

    protected $_auto=array(
        array('title','trim',3,'function'),
        array('relation_id',0,3),
        array('url','trim',3,'function'),
        array('create_time',NOW_TIME,1),
        array('update_time',NOW_TIME,3),
    );
}