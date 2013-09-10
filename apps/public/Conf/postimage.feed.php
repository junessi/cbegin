<feed app='public' type='postimage' info='发图片微博'>
	<title> 
		<![CDATA[{$actor}]]>
	</title>
	<body>
		<![CDATA[ 
			{$body|t|replaceUrl}
			<br/>
			<div class="feed_img_lists" rel='small' >
			<ul class="small">
			<volist name='attachInfo' id='vo'>
				<li ><a href="javascript:void(0)" event-node='img_small'>
					<img class="imgicon" src='{$vo.attach_small}' title='点击放大' width="100" height="100"></a>
				</li> 
			</volist>
			</ul>
			</div>
			<div class="feed_img_lists" rel='big' style='display:none'>
			<ul class="feed_img_list big" >
			<span class='tools'><a href="javascript:void(0)" event-node='img_big' class="ico-pack-up">收起</a></span>
			<volist name='attachInfo' id='vo'>
			<li title='{$vo.attach_url}'>
				<a href='{$vo.attach_url}' target="_blank" class="ico-show-big" title="查看大图" ></a>
				<a href="javascript:void(0)" event-node='img_big'><img class="imgsmall" src='{$vo.attach_middle}' title='点击缩小' ></a>
			</li>
			</volist>
			</ul>
			</div>
		 ]]>
	</body>
	<feedAttr comment="true" repost="true" like="false" favor="true" delete="true" />
</feed>