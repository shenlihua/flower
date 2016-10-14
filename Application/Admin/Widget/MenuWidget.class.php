<?php
namespace Admin\Widget;
use Think\Controller;

class MenuWidget extends Controller{
    public function menu(){
//        foreach(session('nodes') as $)
        $key=strtoupper(CONTROLLER_NAME).'/'.strtoupper(ACTION_NAME);
        $menu=$_SESSION['nodes'][$key];
        $this->assign('menu',$menu);
        $this->display('Common/_menu');
    }
}