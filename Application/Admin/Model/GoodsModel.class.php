<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model
{
    protected $tableName='goods';

    protected $_validate=array(
        array('name','1,200','商品名称只能在1-200字符内',1, 'length'),
        array('price','/^\d{0,10}(\.\d{0,2})?$/','价格只能是正实数且只有两位小数',1),
        array('introduction','1,200','商品简介只能在1-200字符内', 1, 'length'),
//        array('information','1,200','商品简介只能在200字符内','length',1),
        array('cate_id','checkCate','请选择商品分类', 1, 'callback'),
    );

    protected $_auto=array(
        array('introduction','trim',3,'function'),
        array('information','trim',3,'function'),
        array('params','getParams',3,'callback'),
        array('img','getImg',3,'callback'),
        array('cate_id','getCate',3,'callback'),
        array('create_time',NOW_TIME,1),
        array('update_time',NOW_TIME,3),
    );

    public function checkCate()
    {
        $cate_one=I('cate_one','','intval');
        $cate_two=I('cate_two','','intval');
        if(!$cate_one && !$cate_two){
            return false;
        }else{
            return true;
        }
    }

    public function getParams()
    {
        return implode(",",I('params'));
    }

    public function getImg()
    {
        return implode(",",I('img'));
    }

    public function getCate()
    {
        return  I('cate_two')?I('cate_two'):I('cate_one');
    }
}