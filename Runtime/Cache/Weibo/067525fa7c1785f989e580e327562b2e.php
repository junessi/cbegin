<?php if (!defined('THINK_PATH')) exit();?><div class="row" id="weibo_<?php echo ($weibo["id"]); ?>">
    <div>
        <div class="col-md-12 col-sm-8 col-xs-12 " >
            <div id="weibo_content1">
                <div class="col-md-12 weibo_content" style="padding: 0;position:relative;">
                    <?php if(is_administrator(is_login()) || $weibo['user']['uid'] == is_login() || check_auth('deleteWeibo') || check_auth('setWeiboTop')){ ?>

                    <span class="">

                      <span class="weibo_admin_btn">
                          <img src="/Public/Core/images/mark-aw1.png"/>
                      </span>

                        <div class="mark_box" style="display: none">
                            <ul class="nav text-center mark_aw">
                                <!--  <li><a>收藏</a></li>-->


                                <?php if(is_administrator() OR check_auth('setWeiboTop')): ?><li class="weibo-set-post cpointer" data-weibo-id="<?php echo ($weibo["id"]); ?>"><a>
                                        <?php if(($weibo["is_top"]) == "1"): ?>取消置顶
                                            <?php else: ?>
                                            设为置顶<?php endif; ?>
                                    </a>
                                    </li><?php endif; ?>
                                <?php if($weibo['can_delete']): ?><li class="weibo-comment-del cpointer" data-weibo-id="<?php echo ($weibo["id"]); ?>"><a>删除微博</a>
                                    </li><?php endif; ?>
                            </ul>
                        </div>
                        </span>

                    <?php } ?>
                    <div class="" style="padding: 10px 10px 5px 10px">
                        <div class="col-md-2 col-sm-2 col-xs-12 text-center" style="position: relative;padding: 0px">
                            <a class="s_avatar" href="<?php echo ($weibo["user"]["space_url"]); ?>" ucard="<?php echo ($weibo["user"]["uid"]); ?>">
                                <img src="<?php echo ($weibo["user"]["avatar64"]); ?>"
                                     class="avatar-img"
                                     style="width: 64px;"/>
                            </a>
                        </div>
                        <div class="col-md-10"style="padding: 5px">
                            <?php if(($weibo["is_top"]) == "1"): ?><div class="ribbion-green">

                                </div><?php endif; ?>

                            <p>
                                <?php if(modC('SHOW_TITLE',1)): ?><small class="font_grey">【<?php echo ($weibo["user"]["title"]); ?>】</small><?php endif; ?>
                                <a ucard="<?php echo ($weibo["user"]["uid"]); ?>"
                                   href="<?php echo ($weibo["user"]["space_url"]); ?>" class="user_name">
                                    <?php echo (htmlspecialchars($weibo["user"]["nickname"])); ?>
                                </a>
                                <?php echo ($weibo["user"]["icons_html"]); ?>
                                <?php if(is_array($weibo['user']['rank_link'])): $i = 0; $__LIST__ = $weibo['user']['rank_link'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i; if($vl['is_show']): ?><img src="<?php echo ($vl["logo_url"]); ?>" title="<?php echo ($vl["title"]); ?>" alt="<?php echo ($vl["title"]); ?>"
                                             class="rank_html"/><?php endif; endforeach; endif; else: echo "" ;endif; ?>



                            </p>
                            <div class="weibo_content_p">
                                <?php echo ($weibo["fetchContent"]); ?>
                    <span>
                        <a
                                href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['id']));?>"><?php echo (friendlydate($weibo["create_time"])); ?></a> </span>
                                &nbsp;&nbsp;<span>来自
                               <?php if($weibo['from'] == ''): ?>网站端
                                   <?php else: ?>
                                   <strong><?php echo ($weibo["from"]); ?></strong><?php endif; ?>
                            </span>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12 weibo_content_bottom">
                        <!--"<?php echo U('bboard/Index/tmldetail',array('topic_id'=>$vo['topic_id']));?>"-->


                        <div class="col-md-12"style="padding: 0px;text-align: center" data-weibo-id="<?php echo ($weibo["id"]); ?>">


                            <?php $weiboCommentTotalCount = $weibo['comment_count']; ?>
                            <div class="col-xs-4"style="padding: 0px"><?php echo Hook('support',array('table'=>'weibo','row'=>$weibo['id'],'app'=>'Weibo','uid'=>$weibo['uid']));?></div>
<?php echo Hook('repost',array('weiboId'=>$weibo['id']));?>
<div class=" col-xs-4" style="padding: 0px"><span class="weibo-comment-link cpointer " data-weibo-id="<?php echo ($weibo["id"]); ?>">
    评论 <?php echo ($weiboCommentTotalCount); ?>
</span></div>

                        </div>

                    </div>
                </div><div class="row weibo-comment-list" style="display: none;" data-weibo-id="<?php echo ($weibo["id"]); ?>">
                <div class="col-xs-12">
                    <div class="light-jumbotron" style="padding: 1em 2em;">
                        <div class="weibo-comment-container">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>



    </div>

</div>
<script>
    ucard();
    bindSupport();
    bind_weibo_managment();
    lastId = '<?php echo ($lastId); ?>';

    bind_weibo_popup();

    $(document).ready(function () {

        $("#weibo_<?php echo ($weibo['id']); ?> img.lazy").lazyload({effect: "fadeIn", threshold: 200, failure_limit: 100});
    });

</script>