<?php

namespace Admin\Controller;



class PhotoController extends CommonController{

    public function startList(){
        parent::lists(M('image'),array('img_type'=>0,'status'=>array('neq',0)),'img_id,title,url,img,update_time, sort,status','sort asc');

    }

    public function startAdd()
    {
        $id=I('id','','intval');
        if($id){
            $info=M('image')->find($id);
            $this->assign('info',$info);
        }
        $this->display();

    }

    

    public function startAddAction()
    {
        parent::addEditOperate(D('Photo'), I('param.'));
    }




    //停用和启用操作

    public function opAction(){

        $id=I('get.id','','int');

        if($id){

            if($info=M('image')->where(array('img_id'=>$id,'img_type'=>0))->find()){

                if(M('image')->where(array('img_id'=>$id))->setField('status',$info['status']==2?1:2)){

                    $result['code']=1;

                    $result['msg']='操作成功!';

                }else{

                    $result['code']=0;

                    $result['msg']='操作失败!';

                }

            }else{

                $result['code']=0;

                $result['msg']='请求失败!';

            }



        }else{

            $result['code']=0;

            $result['msg']='请求出错!';

        }

        $this->ajaxReturn($result);

    }



    public function delAction(){

        $id=I('get.id','','int');

        if($id){

            if($info=M('image')->where(array('img_id'=>$id,'img_type'=>0))->find()){

                if(M('image')->where(array('img_id'=>$id))->setField('status',0)){

                    $result['code']=1;

                    $result['msg']='操作成功!';

                }else{

                    $result['code']=0;

                    $result['msg']='操作失败!';

                }

            }else{

                $result['code']=0;

                $result['msg']='请求失败!';

            }



        }else{

            $result['code']=0;

            $result['msg']='请求出错!';

        }

        $this->ajaxReturn($result);

    }

    

}