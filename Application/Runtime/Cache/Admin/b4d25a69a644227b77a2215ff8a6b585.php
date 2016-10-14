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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 分类列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<a href="<?php echo U('operateCate');?>" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a>
		</span>
</div>

<div class="page-container">
	<div class="mt-20 dataTables_wrapper no-footer">
	<table class="table table-border table-bordered table-hover table-bg table-sort" id="layer-photos">
		<thead>
			<tr class="text-c">
				<th width="120">序号</th>
				<th width="180">类型</th>
				<th width="180">二级分类</th>
				<th width="120">排序</th>
				<th width="160">状态</th>
				<th width="">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($cates)): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td rowspan="<?php echo count($vo['child'])+1;?>"><?php echo ($i); ?></td>
                <td rowspan="<?php echo count($vo['child'])+1;?>"> <a href="<?php echo U('operateCate',array('id'=>$vo['id']));?>"><?php echo $vo['name'];?></a></td>
                <?php if(!$vo['child']): ?><td></td>
                    <td><?php echo ($vo['sort']); ?></td>
                    <td><?php echo $vo['status']==1?'启用':'停用';?></td>
                    <td class="td-manage">
                        <a href="<?php echo U('operateCate',array('id'=>$vo['id']));?>">编辑</a>
                        <a style="text-decoration:none" onClick="status_switch(this,<?php echo ($vo['id']); ?>,'<?php echo ($vo['name']); ?>')"><?php echo $vo['status']==1?'停用':'启用';?></a>
                        <a style="text-decoration:none" onClick="del(this,<?php echo ($vo['id']); ?>)">删除</a>
                    </td><?php endif; ?>
            </tr>
            <?php if(is_array($vo['child'])): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i;?><tr class="text-c">
                    <td><?php echo $ch['name'];?></td>
                    <td><?php echo ($ch['sort']); ?></td>
                    <td><?php echo $ch['status']==1?'启用':'停用';?></td>
                    <td class="td-manage">
                        <a href="<?php echo U('operateCate',array('id'=>$ch['id']));?>">编辑</a>
                        <a style="text-decoration:none" onClick="status_switch(this,<?php echo ($ch['id']); ?>,'<?php echo ($ch['name']); ?>')"><?php echo $ch['status']==1?'停用':'启用';?></a>
                        <a style="text-decoration:none" onClick="del(this,<?php echo ($ch['id']); ?>)">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
		<?php echo ($page); ?>
	</div>
</div>
<script type="text/javascript" src="/flower/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/flower/Public/Admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript">


/*用户-停用*/
function status_switch(obj,id,title){
	var content=$(obj).text();
	var str=content=='停用'?'启用':'停用';
	layer.confirm('确认要'+content+title+'吗？',function(index){
		$.get("<?php echo U('switchStatus');?>",{id:id},function(result){
			layer.msg(result['msg']);
			if(!result['code']){
				$(obj).text(str);
				content=str=='停用'?'启用':'停用';
				$(obj).parent().prev().text(content);
			}
		});

	});
}


/*用户-删除*/
function del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.get("<?php echo U('del');?>",{id:id},function(result){
			layer.msg(result['msg']);
			if(!result['code']){
				$(obj).parents("tr").remove();
			}
		});

	});
}
</script> 
</body>
</html>