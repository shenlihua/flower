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
	<form class="form form-horizontal" id="form">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品名称：</label>
			<div class="formControls col-xs-4 col-sm-4">
				<input type="text" class="input-text"  placeholder="商品名称"  name="name" value="<?php echo ($info['name']); ?>">
			</div>
			<div class="formControls col-xs-4 col-sm-6"></div>
		</div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品分类：</label>
            <div class="formControls col-xs-4 col-sm-4">
                <div class="col-xs-6 col-sm-6" style="padding-left: 0px;padding-right: 0px;">
                <select name="cate_one" class="select-box">
                    <option value="">请选择</option>
                    <?php if(is_array($cates)): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ct): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo $cate_one==$key?'selected':'';?>><?php echo ($ct); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                </div>
                <div class=" col-xs-6 col-sm-6">
                    <select name="cate_two" class="select-box">
                        <option value="">请选择</option>
                        <?php if(is_array($cate_two)): $i = 0; $__LIST__ = $cate_two;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$two): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo $info['cate_id']==$key?'selected':'';?>><?php echo ($two); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品价格：</label>
            <div class="formControls col-xs-4 col-sm-4">
                <input type="text" class="input-text"  placeholder="商品价格"  name="price" value="<?php echo ($info['price']); ?>">
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品参数：</label>
            <div class="formControls col-xs-4 col-sm-4">
                <a class="btn btn-primary radius mb-5" id="add_param"><i class="iconfont">&#xf0020;</i> 新增参数</a>
                <?php if($info): if(is_array($info['params'])): $i = 0; $__LIST__ = $info['params'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ps): $mod = ($i % 2 );++$i;?><input type="text" class="input-text"  placeholder="商品参数"  name="params[]" value="<?php echo ($ps); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
                    <input type="text" class="input-text"  placeholder="商品参数"  name="params[]" value=""><?php endif; ?>

            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品简介：</label>
            <div class="formControls col-xs-4 col-sm-4">
                <textarea class="textarea" name="introduction"><?php echo ($info['introduction']); ?></textarea>
            </div>
            <div class="formControls col-xs-4 col-sm-6"></div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品图片：</label>
            <div class="formControls col-xs-5 col-sm-5">

                <input id="file-Portrait" type="file" class="file" multiple>
            </div>

            <div class="formControls col-xs-3 col-sm-2">
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品说明：</label>
            <div class="formControls col-xs-7 col-sm-7">
                <!-- 加载编辑器的容器 -->
                <script id="container" name="information" type="text/plain"><?php echo (htmlspecialchars_decode($info['information'])); ?></script>
            </div>
            <div class="formControls col-xs-1 col-sm-3"></div>
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
<!-- 配置文件 -->
<script type="text/javascript" src="/flower/Public/Admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/flower/Public/Admin/lib/ueditor/1.4.3/ueditor.all.js"></script>

<!--上传图片-->
<script type="text/javascript" src="/flower/Public/Admin/lib/bootstrap-fileinput-master/js/fileinput.min.js"></script>
<script type="text/javascript" src="/flower/Public/Admin/lib/bootstrap-fileinput-master/js/fileinput_locale_zh.js"></script>
<link rel='stylesheet' type="text/css" href="/flower/Public/Admin/lib/bootstrap-fileinput-master/css/fileinput.min.css"/>
<link href="/flower/Public/Admin/lib/bootstrap-fileinput-master/css/bootstrap.min.css" rel="stylesheet">


<script>


    var img="<?php echo $info['img']?$info['img']:'';?>";
    var url="<?php echo 'http://'.C('UPLOAD_TYPE_CONFIG.domain');?>";
    img=img.split(",");

    //是否存在图片
    if(img){
        var image=[];
//        img?"<img src='"+img+"' class='file-preview-image'><input type='hidden' name='img[]' value='"+img+"'/>":'';
        for(var i=0;i<img.length;i++){
            if(img[i]){
                image.push("" +
                        "<img src='"+url+img[i]+"' class='file-preview-image'>" +
                        "<input type='hidden' name='img[]' value='"+img[i]+"'/>" +
                        '<div class="file-actions">' +
                        '<div class="file-footer-buttons">' +
                        '<button type="button" class="kv-file-remove btn btn-xs btn-default shut-remove" title="Remove file"><i class="glyphicon glyphicon-trash text-danger"></i></button>' +
                        '</div>' +
                        '</div>'+
                        "");
//                str+="<img src='"+url+img[i]+"' class='file-preview-image'><input type='hidden' name='img[]' value='"+img[i]+"'/>"+",";
            }
        }
    }

    //初始化fileinput控件（第一次初始化）
    $('#file-Portrait').fileinput({
        language: 'zh', //设置语言
        uploadUrl: "<?php echo U('Common/uploadImg');?>", //上传的地址
        allowedFileExtensions : ['jpg', 'png','gif','jpeg'],//接收的文件后缀,
        maxFilesNum: 2,
        autoReplace: true,
        enctype: 'multipart/form-data',
        showUpload: true, //是否显示上传按钮
        showCaption: false,//是否显示标题
        browseClass: "btn btn-primary", //按钮样式
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
        // for image files
        initialPreview: image,

    });

    $('#file-Portrait').on('fileuploaded', function(event, data, previewId, index) {
        var form = data.form, files = data.files, extra = data.extra,
                response = data.response, reader = data.reader;
        //插入要长传的数据
        if(!response.code){
            //上传成功
            $("#"+previewId).append("<input type='hidden' name='img[]' value='"+response.msg+"'/>");
        }else{
            //上传失败
            layer.msg(response.msg);
        }
    });


    $(function () {
        var ue = UE.getEditor('container', {
            serverUrl:"<?php echo U('Ueditor/manager');?>",
            toolbars: [
                ['fullscreen', 'source', 'undo', 'redo','bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist','simpleupload']
            ],
            initialFrameWidth:750,
            initialFrameHeight:390,

        });



        $("select[name='cate_one']").change(function () {
            $.get("<?php echo U('getDownCate');?>", {id: $(this).val()}, function (result) {
                $("select[name='cate_two']").html(result);
            });
        });

        $("#add_param").click(function(){
            $(this).parent().append(($(this).next().clone()));
        });

        $("#submit").click(function(){
            $.post("<?php echo U('addAction');?>", $("#form").serialize(), function(result){
                layer.msg(result['msg']);
               /* if(!result['code']){
                    setTimeout(function(){window.history.back()},1500);
                }*/
            });
        });

        $('.shut-remove').click(function(){
            $(this).parents(".file-preview-frame").remove();
        });
    });
</script>