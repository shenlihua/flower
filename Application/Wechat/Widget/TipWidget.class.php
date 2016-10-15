<?php
namespace Wechat\Widget;
use Think\Controller;
class TipWidget extends Controller{
    public function content($id=''){
        $content=M('tip')->where('type=1')->order('id desc')->getField('content');
        $arr=explode("\n",$content);
        $str='<div class="title">购买须知</div>
			<div class="content">';
        foreach($arr as $vo){
            $str.='<div>
					<span class="c-black">'.$vo.'</span>
				</div>';
        }
            $str.='</div>';
        echo $str;
    }
}