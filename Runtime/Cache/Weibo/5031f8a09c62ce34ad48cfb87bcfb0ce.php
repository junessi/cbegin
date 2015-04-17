<?php if (!defined('THINK_PATH')) exit();?>
    <p class="word-wrap"><?php echo (parse_weibo_content($weibo["content"])); ?></p>

    <div class="triangle sanjiao" style="margin-left: 20px;border-bottom: 10px solid #e8e8e8;"></div>
    <div class="triangle_up sanjiao" style="margin-left: 20px;border-bottom: 10px solid #f1f1f1;"></div>
    <div  style="border: 1px solid #e8e8e8;padding: 10px;margin-bottom: 20px; border-radius: 6px;background: #f1f1f1">
    <?php if($weibo['sourse_weibo']){ ?>

        <div>  <a ucard="<?php echo ($weibo["sourse_weibo"]["user"]["uid"]); ?>"     href="<?php echo ($weibo["sourse_weibo"]["user"]["space_url"]); ?>">@<?php echo (htmlspecialchars($weibo["sourse_weibo"]["user"]["nickname"])); ?></a></div>
        <?php echo ($weibo["sourse_weibo"]["fetchContent"]); ?>
        <span class="text-primary pull-left" style="font-size: 12px;"><a href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['sourse_weibo']['id']));?>"><?php echo (friendlydate($weibo["sourse_weibo"]["create_time"])); ?></a>   </span>
        <span class="text-primary pull-right" style="font-size: 12px;"><a href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['sourse_weibo']['id']));?>"> 原微博转发（<?php echo ($weibo["sourse_weibo"]["repost_count"]); ?>）</a>  </span>
        &nbsp;
<!--        <span class="text-primary pull-right"><a href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['sourse_weibo']['id']));?>"> 查看原微博</a>  </span>-->

<?php }else{ ?>
    原微博已删除
    <?php } ?>
    </div>
<script>
    var html='<a href="<?php echo ($weibo["sourse_weibo"]["user"]["space_url"]); ?>" ucard="<?php echo ($weibo["sourse_weibo"]["user"]["uid"]); ?>" style="position: absolute;margin-top: 32px;margin-left: -32px;"><img src="<?php echo ($weibo["sourse_weibo"]["user"]["avatar32"]); ?>"   class="avatar-img"   style="width: 32px;"/> </a>';
    $('#weibo_<?php echo ($weibo["id"]); ?>').find('.s_avatar').after(html);
</script>