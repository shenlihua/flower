<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN" style="height:100%">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>API | <?php echo C('APP_PROJECT');?>项目</title>
    <link rel="icon" type="image/x-icon" href="/Public/images/api/favicon.ico">
    <link href="/Public/css/api/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/Public/js/api/html5shiv.min.js"></script>
    <script src="/Public/js/api/respond.min.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
    <style>
        .col-md-3{width:23%}
    </style>
    <![endif]-->
    <link href="/Public/css/api/style.css" rel="stylesheet" type="text/css" />
</head>

<body style="height:100%">
<div class="container-fluid" style="background:white;height:100%;">
    <div class="row" style="height:100%;">
        <!--左侧导航start-->
        <div class="col-md-3" style="position:relative;background:#f5f5f5;padding:10px;height:100%;border-right:#ddd 1px solid;overflow-y:auto">
            <div style="height:50px;font-size:30px;line-height:50px;">
                <a style="color:#000000;text-shadow:1px 0px 1px #666;text-decoration: none" href="/api.php"> <span class="glyphicon glyphicon-random" aria-hidden="true" style="width:40px;"></span>&nbsp; <span style="position: relative;top:-3px;"><?php echo C('APP_PROJECT');?>项目 API<span style="font-size:12px;position:relative;top:-13px;">&nbsp;<?php echo C('APP_VERSION');?></span>
                </a>
                </span>
            </div>
            <!-- 菜单项 -->
            <div class="form-group">
                <!-- <input type="text" class="form-control" id="searchcate" onkeyup="search(this)" placeholder="搜易点"> -->
                <!-- <?php if($_COOKIE['isLogin']== 1): ?>只有超级管理员才可以添加分类
                    <div style="float:right;margin-right:20px;">
                        <button class="btn btn-success" name="op" value="add" onclick="javascript: location.href ='<?php echo U('Category/addCategory');?>';">新增分类</button>
                    </div><?php endif; ?> -->
            </div>
            <div class="list">
                <!-- 基础支持 -->
                <ul class="list-unstyled">
                    <li class="menu" id="info_1">
                        基础支持(返回码说明)<br/>
                        <!-- 相关接口 -->
                        <ul class="list-unstyled" style="padding:5px">
                            <li class="menu" id="son_1_1">
                                <a href="<?php echo U('Interface/returnCode');?>"> <span class="glyphicon glyphicon-menu-right" aria-hidden="true">返回码说明</span>
                                </a>
                            </li>
                            <li class="menu" id="son_1_1">
                                <form action="<?php echo U('Interface/returnCode');?>" method="get">
                                    <input type="text" name="key" value="" /><button>搜索</button>
                                </form>
                            </li>
                            <?php if(is_array($like)): $i = 0; $__LIST__ = $like;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lk): $mod = ($i % 2 );++$i;?><li class="menu" id="son_1_1">
                                    <a href="<?php echo U('Interface/interfaceInfo',array('id'=>$lk['id'],'cid'=>$lk['cid']));?>"> <span class="glyphicon glyphicon-menu-right" aria-hidden="true"><?php echo ($lk['interface_name']); ?></span>
                                    </a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <?php if($_COOKIE['isLogin']== 1): ?><ul class="list-unstyled" style="padding:5px">
                                <li class="menu" id="son_1_2">
                                    <a href="/api.php/Category/addCategory"><span class="glyphicon glyphicon-menu-right" aria-hidden="true">新增分类</span>
                                    </a>
                                </li>
                            </ul><?php endif; ?>
                    </li>
                </ul>
                <!-- 基础支持End -->
                <?php if(is_array($cateData)): $i = 0; $__LIST__ = $cateData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rs): $mod = ($i % 2 );++$i;?><ul class="list-unstyled">
                        <li class="menu" id="info_<?php echo ($rs["id"]); ?>">
                            <?php echo ($rs["title"]); ?>(<?php echo (mb_substr($rs["detail"],0,20,'utf-8')); ?>)
                            <!--只有超级管理员才可以对分类进行操作-->
                            <div style="float:right;margin-right:13px;">&nbsp;
                                <?php if($_COOKIE['isLogin']== 1): ?><button class="btn btn-info btn-xs" name="ad" value="edit" onclick="addRecord(<?php echo ($rs["id"]); ?>);">add</button>&nbsp;
                                    <button class="btn btn-warning btn-xs" name="ed" value="edit" onclick="editRecord(<?php echo ($rs["id"]); ?>);">edit</button>&nbsp;
                                    <button class="btn btn-danger btn-xs" name="de" value="delete" onclick="delRecord(<?php echo ($rs["id"]); ?>)">delete</button>&nbsp;<?php endif; ?>
                                <a href="javascript: showRecord(<?php echo ($rs["id"]); ?>);"><img
                                    <?php if($_GET['cid']!= $rs['id']): ?>src="/Public/images/on.png"
                                        <?php else: ?>
                                        src="/Public/images/off.png"<?php endif; ?> width="24px" height="24px" id="display_<?php echo ($rs["id"]); ?>" /></a>
                            </div>

                            <!-- 相关接口 -->
                            <div id="son_<?php echo ($rs["id"]); ?>" <?php if($_GET['cid']!= $rs['id']): ?>style="display: none;"<?php endif; ?> >
                            <?php if(is_array($rs['interface'])): $i = 0; $__LIST__ = $rs['interface'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$son): $mod = ($i % 2 );++$i;?><ul class="list-unstyled" style="padding:5px">
                                    <li class="menu" id="api_<?php echo (md5($son["id"])); ?>">
                                        <a href="<?php echo U('Interface/interfaceInfo/id/'.$son['id'].'/cid/'.$rs['id']);?>" id="menu_<?php echo (md5($son["id"])); ?>"> <span class="glyphicon glyphicon-menu-right" aria-hidden="true"><?php echo ($son["interface_name"]); ?></span>
                                        </a>
                                    </li>
                                </ul><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <!-- 相关接口End -->
            </li>
            <!--接口分类关键字(js通过此关健字进行模糊查找)start-->
            <span class="keyword" id="<?php echo (md5($son["id"])); echo ($son["interface_code"]); ?><|-|><?php echo ($son["interface_name"]); ?><|-|><?php echo ($son["interface_detail"]); ?><|-|><?php echo ($son["ext"]); ?><|-|><?php echo ($son["interface_url"]); ?>"></span>
            <!--接口关键字(js通过此关健字进行模糊查找)end-->
            </ul><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <!-- 菜单End -->
    </div>
    <!--左侧导航end-->
    <div class="col-md-9" style="height:100%;background:white;margin:0px;overflow-y:auto;padding:0px;">
        <!--顶部导航start-->
        <div class="textshadow" style="font-size:16px;widht:100%;height:60px;line-height:60px;padding:0 16px 0 16px;;border-bottom:#ddd 1px solid"> <span> <a href="">Home</a> > <?php echo ((isset($title) && ($title !== ""))?($title):'嗨, 欢迎光临'); ?></span>
                    <span style="float:right">
                        <?php if($_COOKIE['isLogin']== 1): ?><a href="<?php echo U('Login/logout');?>">退出&nbsp;&nbsp;<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>
                            <?php else: ?>
                            <a href="<?php echo U('Login/login');?>">登录&nbsp;&nbsp;<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></a><?php endif; ?>
                    </span>
        </div>
        <!--顶部导航end-->
        <!--主窗口start-->
        <div style="padding:16px;">

<!-- 加载头部End -->
<div style="border:1px solid #ddd">
    <div style="background:#f5f5f5;padding:20px;position:relative">
        <h4>编辑分类</h4>
        <div>
            <form action="" method="post" id="form">
                <div class="form-group">
                    <input type="text" class="form-control" name="cname" value="<?php echo ($category["title"]); ?>" placeholder="请填写分类名" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="cdesc" value="<?php echo ($category["detail"]); ?>" placeholder="请填写描述" />
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="order" value="<?php echo ($category["rank"]); ?>" placeholder="排序值越大越靠前" />
                </div>
                <div class="form-group">
                    <input type="checkbox" name="display" id="checkbox_b1" value="1" <?php echo ($category['status'] != 1?:'checked="checked"'); ?> class="chk_2" /><label for="checkbox_b1">显示</label>
                </div>
                <input type="hidden" name="id" value="<?php echo ($category["id"]); ?>" />
                <button type="button" class="btn btn-success" name="op" value="add" id="submitbutton">Submit</button>
            </form>
        </div>
    </div>
</div>
<!-- 加载尾部 -->
</div>
<!--主窗口end-->
</div>
</div>
</div>
<script src="/Public/js/api/jquery.min.js"></script>
<script src="/Public/css/api/bootstrap-3.3.4/js/bootstrap.min.js"></script>
<script src="/Public/Admin/lib/layer/1.9.3/layer.js"></script>
</body>

</html>
<!--jquery模糊查询start-->
<script type="text/javascript">
    // 新增接口
    function addRecord(obj) {
        window.location.href = "<?php echo U('Interface/addInterface/cid/"+ obj +"');?>";
    }
    // 删除分类
    function delRecord(obj) {
        layer.confirm('确定删除该分类吗？<span style="color: red;">删除将直接影响到该分类下的接口无法展示!</span>', function(index){
            window.location.href = "<?php echo U('Category/delCategory/id/"+ obj +"');?>";
            layer.close(index);
        });
    }
    // 编辑分类
    function editRecord(obj) {
        window.location.href = "/api.php/Category/editCategory/id/"+ obj;
    }
    // 查看接口
    function showRecord(obj) {
        var isshow = $('#son_' + obj).css('display');
        if ('none' != isshow) {
            $('#son_' + obj).css('display', 'none');
            $('#display_' + obj).attr('src', '/Public/images/on.png');
        } else {
            $('#son_' + obj).css('display', 'block');
            $('#display_' + obj).attr('src', '/Public/images/off.png');
        }
    }
</script>
<!--jquery模糊查询end-->

<script type="text/javascript">
//加载扩展模块
layer.config({
    extend: 'extend/layer.ext.js'
});
$(function() {
    // 提交表单
    $("#submitbutton").click(function() {
        if (validateForm()) {
            checkSubmit();
        }
    });
})
// 提交检测
function validateForm() {
    if ('' == $("input[name='cname']").val()) {
        layer.msg('提示：分类名不能为空！');
        return false;
    }
    if ('' == $("input[name='cdesc']").val()) {
        layer.msg('提示：描述不能为空！');
        return false;
    }
    return true;
}
// 提交ajax
function checkSubmit() {
    $.ajax({
        url: "<?php echo U('Category/editCategoryAction');?>",
        type: "POST",
        data: $('#form').serialize(),
        dataType: "text",
        success: function(re) {
            if ('success' != re) {
                layer.alert(re);
            } else {
                location.href = "<?php echo U('Index/index');?>";
            }   
        }
    });
    return true;
}
</script>