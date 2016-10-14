<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){

        $this->display();
    }
    /*登录操作*/
    public function loginAction(){

        $db=D('Login');
        $data=$db->create();
        if(!$data){
            $this->error($db->getError());
        }else{
            $nav=M('nav')->where(array('level'=>1))->order('sort asc')->getField('url');
            $this->success('登录成功',U($nav));
        }
    }
    /*退出操作*/
    public function out(){
        session('[destroy]');
        $this->redirect('Login/login');
    }

//    /*
//     * 新建ueditor上传操作
//     * */
//    public function ueditor_upload()
//    {
//        require APP_PATH.'../Public/Admin/lib/ueditor/1.4.3/php/controller.php';
//         //得到上传文件所对应的各个参数,数组结构
//         $info=array(
//             "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
//              "url" => "",            //返回的地址
//              "title" => "",          //新文件名
//              "original" => "",       //原始文件名
//              "type" => "",            //文件类型
//              "size" => "",           //文件大小
//          );
//
//
//        /* 返回数据 */
////        echo  json_encode($info);
////        echo 123;exit;
////        $request_img_name=key($_FILES);
////        $result=qiniu_uploads($request_img_name,'');
////        $this->ajaxReturn($result);
//    }

    public function verify(){
        ob_clean();
        $verify = new \Think\Verify();
        $verify->codeSet = '0123456789';
        $verify->length = 4;
        $verify->entry();
    }
}