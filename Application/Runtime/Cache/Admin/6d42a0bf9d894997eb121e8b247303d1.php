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
<script type="text/javascript" src="/flower/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/flower/Public/Admin/lib/layer/2.1/layer.js"></script>
<body>
<article class="page-container">
	<form id="form" class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>选择分类：</label>
			<div class="formControls col-xs-4 col-sm-4">
                <select name="level" class="select">
                    <option value="1">一级分类</option>
                    <?php if(is_array($cates)): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo $key==$info['level']?'selected':'';?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
			</div>
			<div class="formControls col-xs-4 col-sm-6"></div>
		</div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类名称：</label>
            <div class="formControls col-xs-4 col-sm-4">
                <input type="text" class="input-text" placeholder="分类名称"  name="name" value="<?php echo ($info['name']); ?>">
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>排序：</label>
            <div class="formControls col-xs-4 col-sm-4">
                <input type="text" class="input-text" placeholder="排序"  name="sort" value="<?php echo $info['sort']?$info['sort']:100;?>">
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>状态：</label>
            <div class="formControls col-xs-4 col-sm-4">
                <input class="radio" type="radio" name="status" value="1" <?php echo $info?$info['status']==1?'checked':'':'checked';?> id="start"/><label for="start">开启</label>
                <input class="radio" type="radio" name="status" value="2" <?php echo $info['status']==2?'checked':'';?> id="close"/><label for="close">关闭</label>
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <input type="hidden" name="id" value="<?php echo ($info['id']); ?>">
				<button  class="btn btn-primary radius" type="button" id="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
			</div>
		</div>
	</form>
</article>


</body>
</html>

<script>
    $(function(){
        $("#submit").click(function(){
            $.post("<?php echo U('operateCateAction');?>",$("#form").serialize(),function(result){
                layer.msg(result['msg']);
                if(!result['code']){
                    setTimeout(function(){window.history.back()},1500);
                }
            });
        });
    });
</script>