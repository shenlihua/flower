<?php
namespace Admin\Model;
use Think\Model;

class CateModel extends Model
{
    protected $tableName='cate';

    protected $_validate=array(
        array('level','require','分类必须选择!'),
        array('name','1,25','分类名称只能在1-25个字符',1,'length'),
        array('sort','0,100','排序只能在0-100之间',1,'between'),
        array('status','2,1','显示状态错误',1,'in'),
    );

    protected $_auto=array(
        array('name','trim',3,'function'),
        array('create_time',NOW_TIME,3),
        array('update_time',NOW_TIME,3),
    );
}