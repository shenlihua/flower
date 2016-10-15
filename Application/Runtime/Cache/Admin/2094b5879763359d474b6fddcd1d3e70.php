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
	<form enctype="multipart/form-data" class="form form-horizontal" id="form_data">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片标题：</label>
            <div class="formControls col-xs-4 col-sm-4">
                <input type="text" class="input-text" value="<?php echo ($info['title']); ?>" placeholder="图片标题"  name="title">
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>转跳链接：</label>
            <div class="formControls col-xs-4 col-sm-4">
                <input type="text" class="input-text" value="<?php echo ($info['url']); ?>" placeholder="转跳链接" name="url">
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>轮播图：</label>
			<div class="formControls col-xs-4 col-sm-4">
                <div class="row">
                    <input id="file-Portrait" type="file">
                </div>
			</div>
			<div class="formControls col-xs-4 col-sm-6"></div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>排序：</label>
            <div class="formControls col-xs-4 col-sm-4">
                <input type="text" class="input-text" value="<?php echo $info?$info['sort']:100;?>" placeholder="排序"  name="sort" MAXLENGTH="2">
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>状态：</label>
            <div class="formControls col-xs-4 col-sm-4">
                <input type="radio"  name="status" id="radio-1" value="1" <?php echo $info?$info['status']==1?'checked':'':'checked';?> checked><label for="radio-1">开启</label>&nbsp;
                <input type="radio" name="status" id="radio-2" value="2" <?php echo $info['status']==2?'checked':'';?>><label for="radio-2">关闭</label>
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
<script type="text/javascript" src="/flower/Public/Admin/lib/bootstrap-fileinput-master/js/fileinput.min.js"></script>
<script type="text/javascript" src="/flower/Public/Admin/lib/bootstrap-fileinput-master/js/fileinput_locale_zh.js"></script>
<link rel='stylesheet' type="text/css" href="/flower/Public/Admin/lib/bootstrap-fileinput-master/css/fileinput.min.css"/>
<link href="/flower/Public/Admin/lib/bootstrap-fileinput-master/css/bootstrap.min.css" rel="stylesheet">

<script>

    var img="<?php echo $info['img']?'http://'.C('UPLOAD_TYPE_CONFIG.domain').$info['img']:'';?>";
    var title="<?php echo $info['title']?$info['title']:'';?>";
    //是否存在图片
    if(img){
        var image=img?"<img src='"+img+"' class='file-preview-image' alt='"+title+"' title='"+title+"'><input type='hidden' name='img' value='"+img+"'/>":'';
    }
//初始化fileinput控件（第一次初始化）
$('#file-Portrait').fileinput({
    language: 'zh', //设置语言
    uploadUrl: "<?php echo U('Common/uploadImg');?>", //上传的地址
    allowedFileExtensions : ['jpg', 'png','gif','jpeg'],//接收的文件后缀,
    maxFileCount: 1,
    autoReplace: true,
    enctype: 'multipart/form-data',
    showUpload: false, //是否显示上传按钮
    showCaption: false,//是否显示标题
    browseClass: "btn btn-primary", //按钮样式
    previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
    msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
    // for image files
    initialPreview: [
        image
    ],
});

$('#file-Portrait').on('fileuploaded', function(event, data, previewId, index) {
    var form = data.form, files = data.files, extra = data.extra,
            response = data.response, reader = data.reader;
    //插入要长传的数据
    if(!response.code){
        //上传成功
        //删除之前上传的文件
        $("#"+previewId).prev().remove();
        $("#"+previewId).append("<input type='hidden' name='img' value='"+response.msg+"'/>");
    }else{
        //上传失败
        layer.msg(response.msg);
    }
});

$(function(){
    $("#submit").click(function(){
        $.post("<?php echo U('startAddAction');?>",$("#form_data").serialize(),function(result){
            layer.msg(result.msg)
            if(!result.code){
                setTimeout(function(){window.history.back()},1500);
            }
        });
    });
});
</script>