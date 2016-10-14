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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 商品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<!--<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>-->
			<a href="<?php echo U('add');?>" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加商品</a>
		</span>
</div>
<div class="page-container">
	<!--<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{ $dp.$D( \'datemax\') || \'%y-%M-%d\' }' })" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{ $dp.$D( \'datemin\' ) }',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>-->

	<div class=" dataTables_wrapper no-footer">
	<table class="table table-border table-bordered table-hover table-bg table-sort" id="layer-photos">
		<thead>
			<tr class="text-c">
				<th width="120">会员编号</th>
				<th width="120">会员类型</th>
				<th width="120">手机号码</th>
				<th width="120">会员名称</th>
				<th width="40">性别</th>
				<th width="120">用户地址</th>
				<th width="120">认证状况</th>
				<th width="120">状态</th>
				<th width="160">注册时间</th>
				<th width="">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
				<td><?php echo ($vo['user_num']); ?></td>
				<td><?php echo $level[$vo['user_level']];?></td>
				<td><?php echo ($vo['user_phone']); ?></td>
				<td><?php echo ($vo['user_name']); ?></td>
				<td><?php echo $sex[$vo['user_sex']];?></td>
				<td><?php echo ($vo['user_address']); ?></td>
				<td><?php echo $auth[$vo['user_auth']];?></td>
				<td><?php echo $status[$vo['user_status']];?></td>
				<td><?php echo $vo['create_time']?date('Y-m-d H:i:s',$vo['create_time']):'';?></td>

				<td class="td-manage">
					<a style="text-decoration:none" onClick="auth(this,<?php echo ($vo['user_id']); ?>)"><?php echo $vo['user_auth']?'取消认证':'认证';?></a>
					<a style="text-decoration:none" onClick="user_stop(this,<?php echo ($vo['user_id']); ?>)"><?php echo $vo['user_status']==1?'停用':'启用';?></a>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
		<?php echo ($page); ?>
	</div>
</div>
<script type="text/javascript" src="/flower/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/flower/Public/Admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript">

/*用户-停用*/
function auth(obj,id){
	var content=$(obj).text();
	var str=content=='认证'?'取消认证':'认证';
	layer.confirm('确认要'+content+'吗？',function(index){
		$.get("<?php echo U('authAction');?>",{id:id},function(result){
			layer.msg(result['msg']);
			if(result['code']){
				$(obj).text(str);
				content=str=='认证'?'未认证':'认证';
				$(obj).parent().parent().find('td:eq(6)').text(content);
			}
		});

	});
}

/*用户-停用*/
function user_stop(obj,id){
	var content=$(obj).text();
	var str=content=='停用'?'启用':'停用';
	layer.confirm('确认要'+content+'吗？',function(index){
		$.get("<?php echo U('stopAction');?>",{id:id},function(result){
			layer.msg(result['msg']);
			if(result['code']){
				$(obj).text(str);
				content=str=='停用'?'正常':'冻结';
				$(obj).parent().parent().find('td:eq(7)').text(content);
			}
		});

	});
}


/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.get("<?php echo U('delAction');?>",{id:id},function(result){
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