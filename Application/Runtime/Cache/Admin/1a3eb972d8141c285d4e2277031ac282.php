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
<script type="text/javascript" src="/project/Public/Admin/lib/html5.js"></script>
<script type="text/javascript" src="/project/Public/Admin/lib/respond.min.js"></script>
<script type="text/javascript" src="/project/Public/Admin/lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/project/Public/Admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/project/Public/Admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/project/Public/Admin/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/project/Public/Admin/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/project/Public/Admin/static/h-ui.admin/skin/green/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/project/Public/Admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 会员等级管理 <span class="c-gray en">&gt;</span> 会员等级列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<!--<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{ $dp.$D( \'datemax\') || \'%y-%M-%d\' }' })" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{ $dp.$D( \'datemin\' ) }',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>-->
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<!--<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>-->
			<a href="<?php echo U('levelAdd');?>" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加会员等级</a>
		</span>
	</div>
	<div class="mt-20 dataTables_wrapper no-footer">
	<table class="table table-border table-bordered table-hover table-bg table-sort" id="layer-photos">
		<thead>
			<tr class="text-c">
				<th width="80">序号</th>
				<th width="200">等级名称</th>
				<th width="40">在线时长</th>
				<th width="90">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
				<td><?php echo ($i); ?></td>
				<td><?php echo ($vo['level_name']); ?></td>
				<td><?php echo ($vo['level_time']); ?></td>
				<td><?php echo $status[$vo['status']];?></td>
                <?php if($vo['default']): ?><td class="td-manage">
					<a style="text-decoration:none" onClick="member_stop(this,<?php echo ($vo['level_id']); ?>)" href="javascript:;" title="停用"><?php echo $vo['status']==1?'停用':'启用';?></a>
					<a style="text-decoration:none" href="<?php echo U('levelAdd',array('id'=>$vo['level_id']));?>" title="停用">编辑</a>
					<a title="删除" href="javascript:;" onclick="member_del(this,<?php echo ($vo['level_id']); ?>)" class="ml-5" style="text-decoration:none">删除</a>
				</td>
                <?php else: ?>
                    <td></td><?php endif; ?>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
		<?php echo ($page); ?>
	</div>

<script type="text/javascript" src="/project/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/project/Public/Admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript">
$(function(){
	layer.config({
		extend: 'extend/layer.ext.js'
	})
	//调用示例
	layer.ready(function(){ //为了layer.ext.js加载完毕再执行
		layer.photos({
			photos: '#layer-photos'
		});
	});

});

/*用户-停用*/
function member_stop(obj,id){
	var content=$(obj).text();
	var str=content=='停用'?'启用':'停用';
	layer.confirm('确认要'+content+'吗？',function(index){
		$.get("<?php echo U('levelStatus');?>",{id:id},function(result){
			layer.msg(result['msg']);
			if(result['code']){
				$(obj).text(str);
				$(obj).parent().prev().text(content);
			}
		});

	});
}


/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.get("<?php echo U('delLevel');?>",{id:id},function(result){
			layer.msg(result['msg']);
			if(result['code']){
				$(obj).parents("tr").remove();
			}
		});

	});
}
</script> 
</body>
</html>