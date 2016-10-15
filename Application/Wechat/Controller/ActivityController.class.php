<?php
namespace Wechat\Controller;
use Think\Controller;

class ActivityController extends Controller{
    public function  _empty(){
        $this->redirect("Activity/index");
    }

    public function index(){
        $this->display();
    }

    public function details(){
        $this->display();
    }
}
?>
