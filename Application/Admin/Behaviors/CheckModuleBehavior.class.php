<?php
namespace Admin\Behaviors;
class CheckModuleBehavior{
    //行为执行入口
    public function run(&$return){
        echo CONTROLLER_NAME;
        dump();
        dump($return);
        return 123123123123123;
        echo 123;exit;
    }

    //获取头部标签链接
    private function getNav(){
        return M('nav')->where(array('level'=>1))->getField('upper(url)',true);
    }
}