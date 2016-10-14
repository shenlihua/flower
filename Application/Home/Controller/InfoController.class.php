<?php
namespace Home\Controller;
use Think\Controller\RestController;
class InfoController extends RestController{
    public function rest(){
        switch($this->_method){
            case 'get':
                if($this->_type=='html'){

                }elseif($this->_type=='xml'){

                }
                echo 'get';
            break;
            case 'put'://put请求代码
                echo 'put';
                break;
            case 'post':
                echo 'post';
                break;
        }
    }
}