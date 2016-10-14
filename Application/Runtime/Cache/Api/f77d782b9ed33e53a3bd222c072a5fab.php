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
        <h4>编辑接口<span style="font-size:12px;padding-left:20px;color:#a94442">(注：接口编号、名称、请求地址为必填项)</span></h4>
        <div style="margin-left:20px;">
            <form action="" method="post" id="form">
                <h5>基本信息</h5>
                <div class="form-group has-error">
                    <div class="input-group">
                        <div class="input-group-addon">接口编号</div>
                        <input type="text" class="form-control" name="num" placeholder="接口编号" value="<?php echo ($interfaceData["interface_code"]); ?>" required="required">
                    </div>
                </div>
                <div class="form-group has-error">
                    <div class="input-group">
                        <div class="input-group-addon">接口名称</div>
                        <input type="text" class="form-control" name="name" placeholder="接口名称" value="<?php echo ($interfaceData["interface_name"]); ?>" required="required">
                    </div>
                </div>
                <div class="form-group has-error">
                    <div class="input-group">
                        <div class="input-group-addon">请求地址</div>
                        <input type="text" class="form-control" name="url" placeholder="请求地址" value="<?php echo ($interfaceData["interface_url"]); ?>" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="des" class="form-control" placeholder="简要描述"><?php echo ($interfaceData["interface_detail"]); ?></textarea>
                </div>
                <div class="form-group">
                    <h5>请求参数</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-md-3">参数名</th>
                                <th class="col-md-2">是否必须</th>
                                <th class="col-md-2">传输方式</th>
                                <th class="col-md-2">排序</th>
                                <th class="col-md-4">描述</th>
                                <th class="col-md-1">
                                    <button type="button" class="btn btn-success" onclick="add()">新增</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="parameter">
                            <?php if(is_array($paramData)): $i = 0; $__LIST__ = $paramData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$param): $mod = ($i % 2 );++$i;?><tr>
                                <td class="form-group has-error">
                                    <input type="text" class="form-control" name="p[name][]" placeholder="参数名" value="<?php echo ($param["param_name"]); ?>" required="required">
                                </td>
                                <td>
                                    <select class="form-control" name="p[type][]">
                                        <option value="1" <?php if($param['param_needs'] == 1): ?>selected='selected'<?php endif; ?> >YES</option>
                                        <option value="2" <?php if($param['param_needs'] == 2): ?>selected='selected'<?php endif; ?> >NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="p[mode][]">
                                        <option value="0" <?php if($param['param_type'] == 0): ?>selected='selected'<?php endif; ?> >POST/GET</option>
                                        <option value="1" <?php if($param['param_type'] == 1): ?>selected='selected'<?php endif; ?> >POST</option>
                                        <option value="2" <?php if($param['param_type'] == 2): ?>selected='selected'<?php endif; ?> >GET</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="p[order][]" value="<?php echo ($param["param_rank"]); ?>" placeholder="排序值(0),越大越靠前">
                                </td>
                                <td class="form-group has-error">
                                    <textarea name="p[des][]" rows="1" class="form-control" placeholder="描述, 含缺省值说明"><?php echo ($param["param_detail"]); ?></textarea>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="del(this)">删除</button>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <h5>返回结果<span style="font-size:12px;padding-left:20px;color:#a94442">(注：返回格式为 json/jsonp)</span></h5>
                    <?php $textCount=count(explode("\n",$interfaceData["return_value"])); ?>
                    <textarea name="re" rows="<?php echo $textCount?$textCount:3;?>" class="form-control" id="re" ><?php echo ($interfaceData["return_value"]); ?></textarea>
                </div>
                <div class="form-group">
                    <h5>返回值说明</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-md-3">返回参数</th>
                                <th class="col-md-2">简要说明</th>
                                <th class="col-md-2">排序</th>
                                <th class="col-md-1">
                                    <button type="button" class="btn btn-success" onclick="addReturn()">新增</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="return_value">
                            <?php if(is_array($returnData)): $i = 0; $__LIST__ = $returnData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$return): $mod = ($i % 2 );++$i;?><tr>
                                <td class="form-group has-error">
                                    <input type="text" class="form-control" name="r[value][]" value="<?php echo ($return["return_name"]); ?>" placeholder="返回参数">
                                </td>
                                <td class="form-group has-error">
                                    <input type="text" class="form-control" name="r[detail][]" value="<?php echo ($return["return_detail"]); ?>" placeholder="简要说明">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="r[order][]" value="<?php echo ($return["return_rank"]); ?>" placeholder="排序值(0),越大越靠前">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="delReturn(this)">删除</button>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <h5>备注</h5>
                    <textarea name="memo" rows="3" class="form-control" placeholder="备注信息"><?php echo ($interfaceData["ext"]); ?></textarea>
                </div>
                <input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>" />
                <button type="button" class="btn btn-success" id="submitbutton">Update !</button>
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

<script type='text/javascript'>
var editor = new Simditor({   textarea: $('#re') });
</script>
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
        if ('' == $("input[name='num']").val()) {
            layer.msg('提示：接口编号不能为空！');
            return false;
        }
        if ('' == $("input[name='name']").val()) {
            layer.msg('提示：接口名称不能为空！');
            return false;
        }
        if ('' == $("input[name='url']").val()) {
            layer.msg('提示：请求地址不能为空！');
            return false;
        }
        if ('' == $("input[name='des']").val()) {
            layer.msg('提示：简要描述不能为空！');
            return false;
        }
        if ('' == $("input[name='re']").val()) {
            layer.msg('提示：返回结果不能为空！');
            return false;
        }
        return true;
    }
    // 提交ajax
    function checkSubmit() {
        $.ajax({
            url: "<?php echo U('Interface/editInterfaceAction');?>",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "text",
            success: function(re) {
                if ('success' != re) {
                    layer.alert(re);
                } else {
                    location.href = "<?php echo U('Interface/interfaceInfo',array('id'=>$_GET['id'],'cid'=>$_GET['cid']));?>";
                }   
            }
        });
        return true;
    }
    // 增加参数
    function add() {
        var $html = '<tr>' 
        + '<td class="form-group has-error" ><input type="text" class="form-control has-error" name="p[name][]" placeholder="参数名" required="required"></td>' 
        + '<td>' 
        + '<select class="form-control" name="p[type][]">' 
        + '<option value="1">YES</option> <option value="2">N0</option>' 
        + '</select >' 
        + '</td>' 
        + '<td>' 
        + '<select class="form-control" name="p[mode][]">' 
        + '<option value="0">POST/GET</option> <option value="1">POST</option> <option value="2">GET</option>' 
        + '</select >' 
        + '</td>'
        + '<td>' 
        + '<input type="text" class="form-control" name="p[order][]" placeholder="排序值(0),越大越靠前"></td>' 
        + '<td class="form-group has-error">' 
        + '<textarea name="p[des][]" rows="1" class="form-control" placeholder="描述"></textarea>' 
        + '</td>' 
        + '<td>' 
        + '<button type="button" class="btn btn-danger" onclick="del(this)">删除</button>' 
        + '</td>' 
        + '</tr >';
        $('#parameter').append($html);
    }
    // 删除参数
    function del(obj) {
        $(obj).parents('tr').remove();
    }
    // 增加返回参数
    function addReturn() {
        var $html = '<tr>' 
        + '<td class="form-group has-error" ><input type="text" class="form-control" name="r[value][]" placeholder="返回参数"></td>' 
        + '<td class="form-group has-error">' 
        + '<input type="text" class="form-control" name="r[detail][]" placeholder="简要说明"></td>'  
        + '<td>'
        + '<input type="text" class="form-control" name="r[order][]" placeholder="排序值(0),越大越靠前"></td>'  
        + '<td>'
        + '<button type="button" class="btn btn-danger" onclick="delReturn(this)">删除</button>' 
        + '</td>' 
        + '</tr >';
        $('#return_value').append($html);
    }
    // 删除返回参数
    function delReturn(obj) {
        $(obj).parents('tr').remove();
    }
</script>