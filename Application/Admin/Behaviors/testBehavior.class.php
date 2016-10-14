<?php
namespace Admin\Behaviors;
class testBehavior extends \Think\Behavior{
    //行为执行入口
    public function run(&$param){
//语法
//preg_replace(find,replace,string,count)
//
//preg_replace -- 执行正则表达式的搜索和替换
//mixed preg_replace ( mixed pattern, mixed replacement, mixed subject [, int limit])
//在 subject 中搜索 pattern 模式的匹配项并替换为 replacement。如果指定了 limit，则仅替换 limit 个匹配，如果省略 limit 或者其值为 -1，则所有的匹配项都会被替换。
//        echo MODULE_NAME;
//        echo CONTROLLER_NAME;
//        echo ACTION_NAME;exit;
//        dump($param);
//        echo MODULE_NAME;
//        $controller=strtoupper(CONTROLLER_NAME);//控制器
//        $action=strtoupper(ACTION_NAME);//操作
//        $str=$controller.'/'.$action;
//
//        $header_nav=$this->getNav();
//
//        if(!strpos($action,'ACTION') && !in_array($str,$header_nav) && !in_array($controller,C('no_check_module')) && preg_match_all('/<a.+<\/a>/',$param,$match)){
//            foreach($match[0] as $vo){
//                if(!strpos($vo,'删除')){
//                    $param=str_replace($vo,'',$param);
//                }
//            }
//        }
//        $param=preg_replace('/\s<div class="dislpayArrow[^~]+>/','', $param);
////        $param=str_replace('<a style="text-decoration:none" onClick="member_stop(this,11)" href="javascript:;" title="停用">停用</a>','',$param);
//        dump($param);
//        exit;
    }

    //获取头部标签链接
    private function getNav(){
        return M('nav')->where(array('level'=>1))->getField('upper(url)',true);
    }
}