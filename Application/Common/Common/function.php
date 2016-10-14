<?php

/*
 * 随机数
 * */
function getNum()
{
    $numbers = range (1,10);
    srand ((float)microtime()*1000000);
    shuffle ($numbers);
    $str='';
    return $numbers[0].$numbers[1].$numbers[2].$numbers[3];
}


function pwd_encrypt($pwd)
{
    $pwd=$pwd?$pwd:I('password');
    return md5(md5($pwd.'qz').$pwd);
}


/*
 * 调整数据数据
 * */
function changeData($data)
{
    $arr=array();
    foreach($data as $vo){
        if(in_array($vo['level'],array_keys($arr))){
            $arr[$vo['level']]['child'][]=$vo;
        }else{
            $arr[$vo['id']]=$vo;
        }

    }
    return $arr;
}

/*
 * 上传七牛图片
 * @param $name文件名
 * */
function qiniu_uploads($name, $exts=array('jpg', 'gif', 'png', 'jpeg'))
{
    if ($_FILES[$name]) {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
//        $upload->saveName =md5(time().'_'.mt_rand().C('_ext'));
        $upload->exts =$exts;// 设置附件上传类型
        $upload->subName='';
        $upload->saveName=md5(time().mt_rand().C('_ext'));
//    $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录    // 上传单个文件
        $info = $upload->uploadOne($_FILES[$name]);
        if (!$info) {// 上传错误提示错误信息
            $data['code']=1;
            $data['msg']=$upload->getError();
        } else {// 上传成功 获取上传文件信
            $data['code']=0;
            $data['msg']=$info['savename'];
        }
    }else{
        $data['code']=1;
        $data['msg']='请上传文件';
    }
    return $data;
}

/*
 * 调整数据样式
 * */
function delimiter($string, $delimiter=',')
{
    if($string){
        return '['.str_replace($delimiter,']    [',$string).']';
    }
    return;
}

/*
 * 调整图片样式
 * */
function img_style($string, $delimiter="," , $style='?imageView2/0/w/50/h/30')
{
    $arr=explode($delimiter,$string);
    $str='';
    foreach($arr as $key=>$vo){
        //缩略图
        $url='http://'.C('UPLOAD_TYPE_CONFIG.domain').$vo.$style;
        //原图
        $layer_url='http://'.C('UPLOAD_TYPE_CONFIG.domain').$vo;
        $str.='<img  layer-pid="'.$key.'" layer-src='.$layer_url.' src='.$url.' width="50px" height=30px/> &nbsp;&nbsp;';
    }
    return $str;
}

/*
 * 输出图片
 * */
function image($img, $key='', $style='?imageView2/0/w/50/h/30')
{
    if($img){
        //缩略图
        $url='http://'.C('UPLOAD_TYPE_CONFIG.domain').$img.$style;
        $layer_url='http://'.C('UPLOAD_TYPE_CONFIG.domain').$img;
        return '<img  layer-pid="'.$key.'" layer-src='.$layer_url.' src='.$url.' width="50px" height=30px/> &nbsp;&nbsp;';
    }
    return;
}
