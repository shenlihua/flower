<?php
namespace Admin\Controller;
class GoodsController extends CommonController
{
    public function index()
    {
        $this->display();
    }

    /*
     * 商品分类  --- 列表
     * */
    public function cate()
    {
        $cates = $this->getCate(array('status' => array('neq', 0)));
        $cates = changeData($cates);
        $this->assign('cates', $cates);
        $this->display();
    }

    /*
     * 商品分类  --- 添加/编辑
     * */
    public function operateCate()
    {
        $id = I('id', '', 'intval');
        if ($id) {
            $info = $this->getCate(array('id' => $id), 'find');
            $this->assign('info', $info);
        }
        $cates = $this->getCate(array('level' => 1), 'kv');
        $this->assign('cates', $cates);
        $this->display();
    }

    //商品分类  --- 入库操作
    public function operateCateAction()
    {
        parent::addEditOperate(D('Cate'), I('param.'));
    }


    //分类状态  ---- 开关
    public function switchStatus()
    {
        parent::dataStatusSwitch(M('cate'), I('param.'));
    }

    //分类删除
    public function del()
    {
        parent::operateDataBase(M('cate'), I('param.'), 1);
    }

    //获取二级分类
    public function getDownCate()
    {
        $id = I('id');
        $str = '<option value="">请选择</option>';
        if ($id) {
            $cates = $this->getCate(array('level' => $id), 'kv');
            foreach ($cates as $key => $vo) {
                $str .= '<option value="' . $key . '">' . $vo . '</option>';
            }
        }
        echo $str;
    }

    /*
     * 获取分类
     * @param $style kv     键值对
     *               find   获取一条记录
     *
     * */
    protected function getCate($where, $style = '')
    {
        if ($style == 'kv') {
            $cates = M('cate')->where($where)->where(array('status' => 1))->getField('id,name');
        } elseif ($style == 'find') {
            $cates = M('cate')->where($where)->where(array('status' => 1))->find();
        } else {
            $cates = M('cate')->field('id,level,name,sort,status')->where($where)->order('level asc,sort asc')->select();
        }
        return $cates;
    }

    /*---------------------------------------------商品列表操作----------------------------------------------------------*/
    //商品列表
    public function goodsList()
    {
        $this->assign('cates',$this->getCate('','kv'));
        parent::lists(M('goods'), array('status' => array('neq', 0)), 'id,name,cate_id,price,params,img,introduction,status,update_time');
    }

    //商品添加
    public function add()
    {
        $id=I('id','','intval');
        if($id){
            $info=M('goods')->find($id);
            $info['params']=explode(",",$info['params']);
            $info['img']=explode(",",$info['img']);
//            dump($info);
            //获取分类
            $cate_info=$this->getCate(array('id'=>$info['cate_id']),'find');
            $cate_one  = $cate_info['level']==1?$cate_info['id']:$cate_info['level'];
            $cate_two = $this->getCate(array('level'=>$cate_one),'kv');

            $this->assign('cate_one',$cate_one);
            $this->assign('cate_two',$cate_two);
            $this->assign('info',$info);
        }
        $cates = $this->getCate(array('level' => 1), 'kv');
        $this->assign('cates', $cates);
        $this->display();
    }

    //商品添加表单操作
    public function addAction()
    {
        parent::addEditOperate(D('Goods'), I('params.'));
    }

    //商品状态  ---- 开关
    public function goodsSwitchStatus()
    {
        parent::dataStatusSwitch(M('goods'), I('param.'));
    }
}