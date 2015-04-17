<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="<?php echo getRootUrl();?>Addons/Retopic/Css/Retopic.css">
<div class="hot-topic common_block_border">
    <div class="common_block_title">推荐话题</div>
    <ul>
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
        	<p><a href="<?php echo U('Weibo/Topic/index',array('topk'=>urlencode($vo['name'])));?>"><?php echo ($vo["name"]); ?></a>（<?php echo ($vo["reCount"]); ?>）</p>
        	<div class="topic-tips"><div class="hot-topic-info"><?php echo ((isset($vo["intro"]) && ($vo["intro"] !== ""))?($vo["intro"]):话题推荐); ?></div></div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>