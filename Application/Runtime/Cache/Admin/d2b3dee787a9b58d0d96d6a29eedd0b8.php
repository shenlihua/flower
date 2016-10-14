<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/flower/Public/Admin/lib/html5.js"></script>
<script type="text/javascript" src="/flower/Public/Admin/lib/respond.min.js"></script>
<script type="text/javascript" src="/flower/Public/Admin/lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/flower/Public/Admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/flower/Public/Admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/flower/Public/Admin/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/flower/Public/Admin/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/flower/Public/Admin/static/h-ui.admin/skin/green/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/flower/Public/Admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<body>
<article class="page-container">
	<form id="form" class="form form-horizontal">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>：选择模块 </label>
			<div class="formControls col-xs-4 col-sm-4">
				<select class="select" name="module">
                    <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
			</div>
			<div class="formControls col-xs-4 col-sm-6"></div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>：选择控制器 </label>
            <div class="formControls col-xs-4 col-sm-4">
                <select class="select" name="action">
                    <option value="">请选择</option>
                </select>
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>：操作 </label>
            <div class="formControls col-xs-4 col-sm-4">
                <select class="select" name="operate">
                    <option value="">请选择</option>
                </select>
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>：操作名称 </label>
            <div class="formControls col-xs-4 col-sm-4">
                <input type="text" class="input-text"  placeholder="操作名称"  name="title" >
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>：操作URL </label>
            <div class="formControls col-xs-4 col-sm-4">
                <input type="text" class="input-text"  placeholder="操作URL"  name="url" >
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>：排序 </label>
            <div class="formControls col-xs-4 col-sm-4">
                <input type="text" class="input-text"  placeholder="排序"  name="sort" >
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" type="button" id="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
			</div>
		</div>
	</form>
</article>


</body>
</html>
<script type="text/javascript" src="/flower/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/flower/Public/Admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript">

    $(function(){
        $("#submit").click(function(){
            $.post("<?php echo U('authNodesAddAction');?>",$("#form").serialize(),function(result){
                layer.msg(result['msg']);
            });
        });

        $("select[name='module']").change(function(){
            $.get("<?php echo U('getNodes');?>",{mid:$(this).val()},function(result){
                $("select[name='action']").html(result);
            });
        });

        $("select[name='action']").change(function(){
            $.get("<?php echo U('getNodes');?>",{mid:$(this).val()},function(result){
                $("select[name='operate']").html(result);
            });
        });
    });
</script>