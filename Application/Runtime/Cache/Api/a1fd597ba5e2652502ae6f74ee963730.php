<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN" style="height:100%">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>API | <?php echo C('APP_PROJECT');?>项目</title>
    <link rel="icon" type="image/x-icon" href="/qz/Public/images/api/favicon.ico">
    <link href="/qz/Public/css/api/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/qz/Public/js/api/html5shiv.min.js"></script>
    <script src="/qz/Public/js/api/respond.min.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
    <style>
        .col-md-3{width:23%}
    </style>
    <![endif]-->
    <link href="/qz/Public/css/api/style.css" rel="stylesheet" type="text/css" />
</head>

<body style="height:100%">
<div class="container-fluid" style="background:white;height:100%;">
    <div class="row" style="height:100%;">
        <!--左侧导航start-->
        <div class="col-md-3" style="position:relative;background:#f5f5f5;padding:10px;height:100%;border-right:#ddd 1px solid;overflow-y:auto">
            <div style="height:50px;font-size:30px;line-height:50px;">
                <a style="color:#000000;text-shadow:1px 0px 1px #666;text-decoration: none" href="/qz/api.php"> <span class="glyphicon glyphicon-random" aria-hidden="true" style="width:40px;"></span>&nbsp; <span style="position: relative;top:-3px;"><?php echo C('APP_PROJECT');?>项目 API<span style="font-size:12px;position:relative;top:-13px;">&nbsp;<?php echo C('APP_VERSION');?></span>
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
                                    <a href="/qz/api.php/Category/addCategory"><span class="glyphicon glyphicon-menu-right" aria-hidden="true">新增分类</span>
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
                                    <?php if($_GET['cid']!= $rs['id']): ?>src="/qz/Public/images/on.png"
                                        <?php else: ?>
                                        src="/qz/Public/images/off.png"<?php endif; ?> width="24px" height="24px" id="display_<?php echo ($rs["id"]); ?>" /></a>
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
        <div class="textshadow" style="font-size:16px;widht:100%;height:60px;line-height:60px;padding:0 16px 0 16px;;border-bottom:#ddd 1px solid"> <span> <a href="/qz">Home</a> > <?php echo ((isset($title) && ($title !== ""))?($title):'嗨, 欢迎光临'); ?></span>
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
<div class="info_api" style="border:1px solid #ddd;margin-bottom:20px;" id="info_api_">
    <div style="background:#f5f5f5;padding:20px;position:relative">
        <div class="textshadow" style="position: absolute;right:0;top:4px;right:8px;">&nbsp;
        </div>
        <h3 class="textshadow">
        返回码说明
        </h3>
        <p> <b>编号&nbsp;&nbsp;:&nbsp;&nbsp;
        <span style="color:red">
        00001
        </span></b>
        </p>
        <div> <kbd>
        基础支持
        </kbd>　<kbd>
        描述：使用须知
        </kbd>
        </div>
    </div>
    <div class="info">
    No.1 token 除登录、注册外, 其他都要带上它 (GET 方式);<br/>
    No.2 token 每次使用后刷新其最后有效时间; 重新登录或异地登录则更改 token<br/>
    No.3 每次调用接口时, 可能获得正确或错误的返回码，开发者可以根据返回码信息调试接口, 排查错误。
    </div>
    
    <div class="form-group" style="padding:20px;">
        <h4>参照表</h4>
        <table class="table">
            <thead>
                <tr>
                    <th class="col-md-3"> </th>
                    <th class="col-md-3">返回值</th>
                    <th class="col-md-2">简要说明</th>
                    <th class="col-md-2"> </th>
                </tr>
            </thead>
            <tbody id="return_value">
                <tr>
                    <td> </td>
                    <td>errcode</td>
                    <td>系统返回码，00001 代表成功，00002 代表失败</td>
                    <td> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td>errinfo</td>
                    <td>系统返回信息</td>
                    <td> </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="background:#ffffff;padding:20px;">
        <h4 class="textshadow"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> 后记</h4>
        <pre style="background:honeydew">
        
        </pre>
    </div>
</div>
<!--接口详细列表end-->
<!-- 加载尾部 -->
</div>
<!--主窗口end-->
</div>
</div>
</div>
<script src="/qz/Public/js/api/jquery.min.js"></script>
<script src="/qz/Public/css/api/bootstrap-3.3.4/js/bootstrap.min.js"></script>
<script src="/qz/Public/Admin/lib/layer/1.9.3/layer.js"></script>
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
        window.location.href = "/qz/api.php/Category/editCategory/id/"+ obj;
    }
    // 查看接口
    function showRecord(obj) {
        var isshow = $('#son_' + obj).css('display');
        if ('none' != isshow) {
            $('#son_' + obj).css('display', 'none');
            $('#display_' + obj).attr('src', '/qz/Public/images/on.png');
        } else {
            $('#son_' + obj).css('display', 'block');
            $('#display_' + obj).attr('src', '/qz/Public/images/off.png');
        }
    }
</script>
<!--jquery模糊查询end-->