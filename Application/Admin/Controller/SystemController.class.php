<?php
namespace Admin\Controller;
use Think\Auth;
use Think\Controller;

class SystemController extends CommonController{

    public function index(){

        $this->display();

    }

    //设置会员等级
    public function level(){
        $where['type']=1;
        $where['status']=array('neq',0);
        $field='level_id,level_name,level_time,status,`default`';
        $list=M('level')->field($field)->where($where)->order('`default` asc,level_time asc')->select();
        $this->assign('list',$list);
        $this->assign('status',array('1'=>'启用','2'=>'停用'));
        $this->display();
    }

    //添加会员等级
    public function levelAdd(){
        $id=I('get.id','','int');
        if($id){
            $info=M('level')->find($id);
            $this->assign('info',$info);
        }
        $this->display();
    }

    //添加会员等级表单操作
    public function levelAddAction(){
        $db=D('Level');
        if(!$db->create()){
            $this->error($db->getError());
        }else{
            if($db->level_id){
                if($db->save()){
                    $this->success('更新成功',U('System/level'));
                }else{
                    $this->error('更新失败');
                }
            }elseif($db->add()){
                $this->success('保存成功',U('System/level'));
            }else{
                $this->error('保存失败');
            }
        }
    }

    //启用和停用等级
    public function levelStatus(){
        $id=I('get.id','','int');
        if($id){
            $model=M();
            if($model->execute("update __LEVEL__ set `status`=if(`status`=1,2,1) where level_id=".$id)){
                $result['code']=1;
                $result['msg']="操作成功";
            }else{
                $result['code']=0;
                $result['msg']="操作失败!!";
            }
        }else{
            $result['code']=1;
            $result['msg']="请求参数出错";
        }
        $this->ajaxReturn($result);
    }

    //删除操作
    public function delLevel(){
        $id=I('get.id','','int');
        if($id){
            if(M('level')->where(array('level_id'=>$id))->setField('status',0)){
                $result['code']=1;
                $result['msg']="操作成功";
            }else{
                $result['code']=0;
                $result['msg']="操作失败!!";
            }
        }else{
            $result['code']=1;
            $result['msg']="请求参数出错";
        }
        $this->ajaxReturn($result);
    }

    /*
     * 2016年8月6日 15:46:58
     * 管理员列表
     * */
    public function manageList(){
        $result=D('Manage')->_list();
        $this->assign("roles",D("Role")->_getList());
        $this->assign('list',$result['list']);
        $this->assign('page',$result['page']);
        $this->display();
    }

    /*
     * 2016年8月6日 18:12:42
     * 启用/禁止管理员
     * */
    public function operateManage(){
        $id=I('get.id','','int');
        $db=D('Manage');
        $info=$db->_getOneInfo($id);
        $data['id']=$id;
        $data['status']=$info['status']==2?1:2;
        parent::operateDataBase($db,$data);
    }

    /*
     * 2016年8月6日 16:47:19
     * 管理员添加页面
     * */
    public function manageAdd(){
        $id=I('get.id','','int');
        if($id){
            $info=D('Manage')->_getOneInfo($id);
            $this->assign('info',$info);
        }

        $roles=D("Role")->_getList();
        $this->assign('roles',$roles);
        $this->display();
    }

    /*
     * 2016年8月6日 16:53:13
     * 添加管理员操作
     * */
    public function manageAddAction(){
        $db=D('Manage');
        $data=$db->create();
        if(!$data){
            $this->error($db->getError());
        }else{
            if(!I('password'))  unset($data['password']);
            parent::addEditOperate($db,$data,'manageList');
        }
    }

    /*
     * 2016年8月6日 18:32:42
     * 删除管理员数据
     * */
    public function delManage(){
        $id=I('get.id','','int');
        $db=D('Manage');
        $where['id']=$id;
        parent::operateDataBase($db,$where,1);
    }
    /*
     *
     * 2016年8月6日 16:27:48
     * 角色列表
     * */
    public function roleList(){
        $list=D("Role")->_list();

        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);

        $this->display();
    }

    /*
     * 2016年8月6日 16:32:20
     * 角色添加页面
     * */
    public function roleAdd(){
        $rid=I('get.rid','','int');
        if($rid){
            $info=M('role')->where(array('rid'=>$rid))->find();
            $this->assign('info',$info);
        }
        $this->display();
    }
    /*
     * 2016年8月6日 16:17:11
     * 添加角色
     * */
    public function roleAddAction(){
        $db=D("Role");
        $data=$db->create();
        if(!$data){
            $this->error($db->getError());
        }else{
            parent::addEditOperate($db,$data,'roleList');
        }
    }

    /*
     * 2016年8月6日 16:35:57
     * 删除角色
     * */
    public function delRole(){
        $id=I('get.id','','int');
        $where['rid']=$id;
        parent::operateDataBase(D("Role"),$where,1);
    }

    /*
     *2016年8月6日 19:12:13
     * 添加节点页面
     * */
    public function authNodesAdd(){
        $nav=M('nav')->where(array('level'=>1))->getField('nid,title');
        $this->assign('nav',$nav);
        $this->display();
    }

    /*
     * 2016年8月6日 19:27:09
     * 获取节点
     * */
    public function getNodes(){
        $nav=M('nav')->where(array('mid'=>I('get.mid')))->getField('nid,title');
        $str="<option value=''>请选择</option>";
        foreach($nav as $key=>$vo){
            $str.="<option value='".$key."'>".$vo."</option>";
        }
        echo $str;
    }
    /*
     * 2016年8月6日 19:12:25
     * 添加节点操作
     * */
    public function authNodesAddAction(){
        $data['title']=I('post.title');
        $data['url']=I('post.url');
        $data['sort']=I('post.sort');
        if(I('post.action') && !I('post.operate')){
            $data['level']=3;
            $data['mid']=I('post.action');
            $content="添加三级节点成功";
        }elseif(I('post.operate')){
            $data['level']=4;
            $data['mid']=I('post.operate');
            $content="添加页面节点成功";
        }else{
            $data['level']=2;
            $data['mid']=I('post.module');
            $content="添加二级节点成功";
        }
        if(M('nav')->add($data)){
            $result['code']=1;
            $result['msg']=$content;
        }else{
            $result['code']=0;
            $result['msg']="操作失败";
        }
        $this->ajaxReturn($result);
    }
    /*
     * 2016年8月9日 11:12:08
     * 获取节点列表
     * */
    public function authAdd(){
        $rid=I('get.rid','','int');
        if($rid){
            $info=D('Role')->_getOneInfo($rid);
            $info['rules']=explode(",",$info['rules']);
            $this->assign('info',$info);
        }

        $nodes=parent::getNodes();
        $this->assign('nodes',$nodes);
        $this->display();
    }
    /*
     * 2016年8月9日 13:53:26
     * 权限赋予角色
     * */
    public function authAddAction(){
        $data['rid']=I('get.id','','int');
        foreach(I('post.parent') as $vo){
            $arr=explode("_",$vo);
            $auth[]=$arr[0];
            if(!in_array($arr[1],$auth)){
                $auth[]=$arr[1];
            }
        }
        I('post.sun') && $auth=array_merge($auth?$auth:array(),I('post.sun')?I('post.sun'):array());
        $data['rules']=implode(",",$auth);
        $data['update_time']=NOW_TIME;
        parent::operateDataBase(M('role'),$data);
    }
}