<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>千艺花卉</title>
    <link rel="stylesheet" href="/flower/Public/Wechat/css/reset.css" />
    <link rel="stylesheet" href="/flower/Public/Wechat/css/style.css?v=<?php echo rand();?>" />
    <link rel="stylesheet" href="/flower/Public/Wechat/css/swiper.css" />
    <script type="text/javascript" src="/flower/Public/Wechat/js/jquery-1.11.0.js" ></script>
    <script type="text/javascript" src="/flower/Public/Wechat/layer/layer.js"></script>
</head>


<body style="background:#f0f0f0;">

<div class="wrap-index">

	<div class="swiper-container mg-10">
		<div class="swiper-wrapper">
			<?php if(is_array($image)): $i = 0; $__LIST__ = $image;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$im): $mod = ($i % 2 );++$i;?><div class="swiper-slide"><img src="http://<?php echo C('UPLOAD_TYPE_CONFIG.domain').$im['img'];?>" width="100%" /></div><?php endforeach; endif; else: echo "" ;endif; ?>
		    </div>
		    <div class="swiper-pagination"></div>
		</div>
		<div class="index-menu clearfix">
			<div class="left">
				<img src="/flower/Public/Wechat/images/reservationService.png" width="100%" onclick="window.location.href='<?php echo U('Service/index');?>'"/>
				<img src="/flower/Public/Wechat/images/shopping.png" width="100%"  onclick="window.location.href='<?php echo U('Goods/index');?>'"/>
			</div>
			<div class="right">
				<img src="/flower/Public/Wechat/images/latstActivities.png" width="100%"  onclick="window.location.href='<?php echo U('Activity/indexx');?>'" />
				<img src="/flower/Public/Wechat/images/aboutStore.png" width="100%"  onclick="window.location.href='<?php echo U('Index/about');?>'" />
				<img src="/flower/Public/Wechat/images/personalCenter.png" width="100%"  onclick="window.location.href='<?php echo U('Center/index');?>'" />
			</div>

		</div>
	</div>

</body>
</html>

<script type="text/javascript" src="/flower/Public/Wechat/js/swiper-3.2.7.min.js" ></script>
<script type="text/javascript">
$(document).ready(function(){
	var mySwiper = new Swiper ('.swiper-container', {
		autoplay: 3000,
	    loop: true,
	    pagination: '.swiper-pagination',
	    paginationClickable: true
	});
});
</script>