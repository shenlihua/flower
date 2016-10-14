<?php if (!defined('THINK_PATH')) exit();?><aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />

	<div class="menu_dropdown bk_2">
        <?php if(is_array($menu['child'])): $i = 0; $__LIST__ = $menu['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
			<dt><i class="Hui-iconfont">&#xe616;</i> <?php echo ($vo['title']); ?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
                    <?php if(is_array($vo['child'])): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i;?><li><a _href="<?php echo U($ch['url']);?>" data-title="<?php echo ($ch['title']); ?>"><?php echo ($ch['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

				</ul>
			</dd>
		</dl><?php endforeach; endif; else: echo "" ;endif; ?>

	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>