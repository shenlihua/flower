<?php
namespace Wechat\Controller;

class IndexController extends CommonController {

    public function index(){
        $field='img_id,url, img,title';
        $image=M('image')->field($field)->where(array('status'=>1,'img_type'=>0))->order('sort asc')->select();

        $this->assign('image',$image);
        $this->display();
    }
    public function about(){
        $content=M('tip')->where('type=2')->order('id desc')->getField('content');
        $this->assign("content",$content);
    	$this->display();
    }
}