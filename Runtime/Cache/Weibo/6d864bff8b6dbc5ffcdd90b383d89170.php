<?php if (!defined('THINK_PATH')) exit();?><div class="weibo_post_box">


<!--回复框-->
<div class="row ">
    <div class="col-xs-12">
        <!--输入框-->
        <p>
            <input type="hidden" id="weibo-comment-to-comment-id" name="reply_id" value="0"/>
            <textarea placeholder="说点什么吧～" id="text_<?php echo ($weiboId); ?>"
                      class="form-control weibo-comment-content comment_text_inputor"></textarea>
        </p>
        <a href="javascript:" onclick="insertFace($(this))"><img src="/Public/static/image/bq.png"/></a>

        <!--评论按钮-->
        <p class="pull-right">
            <button class="btn btn-primary weibo-comment-commit" type="submit" id="btn_<?php echo ($weiboId); ?>"
                    data-weibo-id="<?php echo ($weiboId); ?>">评论 Ctrl+Enter
            </button>
        </p>
    </div>

</div>
<div id="emot_content" class="emot_content" style="float: left"></div>
<!--评论列表-->
</div>
<div id="show_comment_<?php echo ($weiboId); ?>">
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><hr style="margin: 5px 0px;"/>
    <div class="row weibo_comment">
        <div class="col-xs-12">
            <div class="pull-left" style="width: 32px;">
                <a href="<?php echo ($comment["user"]["space_url"]); ?>" ucard="<?php echo ($comment["user"]["uid"]); ?>"><img src="<?php echo ($comment["user"]["avatar32"]); ?>"
                                                                                     class="avatar-img"/></a>
            </div>
            <div class="" style="overflow: hidden; padding-left: 15px; padding-top: 5px;">
                <span class="text-muted pull-right">&nbsp;<?php echo (friendlydate($comment["create_time"])); ?>&nbsp;&nbsp;<a
                        data-weibo-id="<?php echo ($weiboId); ?>" onclick="weibo_reply(this,<?php echo ($comment["id"]); ?>,'<?php echo ($comment["user"]["nickname"]); ?>')"><i
                        class="glyphicon glyphicon-comment"></i></a>
                        <?php if($comment['can_delete']): ?><a data-weibo-id="<?php echo ($weiboId); ?>" onclick="comment_del(this,<?php echo ($comment["id"]); ?>)"><i
                                    style="margin-left: 0.2em" class="glyphicon glyphicon-trash"></i></a><?php endif; ?>
                </span>
                <a href="<?php echo ($comment["user"]["space_url"]); ?>" ucard="<?php echo ($comment["user"]["uid"]); ?>"><?php echo (htmlspecialchars($comment["user"]["nickname"])); ?></a><?php echo ($comment["user"]["icons_html"]); ?>：<?php echo (parse_comment_content($comment["content"])); ?>
            </div>
        </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<?php if($weiboCommentTotalCount>5){ ?>
<div style="width: 100%;height: 40px;text-align: center;line-height: 40px;">
    <a id="btn_showall"  href="javascript:" onclick="show_all_comment('<?php echo ($weiboId); ?>');">查看全部回复>></a>
</div>

<?php } ?>


<script>
    function show_all_comment(weiboId){
        $.post("<?php echo U('Weibo/Index/commentlist');?>",{weibo_id:weiboId},function(res){
                 $('#show_comment_'+weiboId).html(res);
                  $('#btn_showall').hide()
        },'json');
    }
</script>

<script>ucard();</script>
<div class="operation" style="display: none;">
    <div class="col-xs-4"style="padding: 0px"><?php echo Hook('support',array('table'=>'weibo','row'=>$weibo['id'],'app'=>'Weibo','uid'=>$weibo['uid']));?></div>
<?php echo Hook('repost',array('weiboId'=>$weibo['id']));?>
<div class=" col-xs-4" style="padding: 0px"><span class="weibo-comment-link cpointer " data-weibo-id="<?php echo ($weibo["id"]); ?>">
    评论 <?php echo ($weiboCommentTotalCount); ?>
</span></div>
</div>
<script>
    bindSupport();
    $(function () {

        var weiboid = '<?php echo ($weiboId); ?>';
        $('#text_' + weiboid + '').keypress(function (e) {
            if (e.ctrlKey && e.which == 13 || e.which == 10) {
                $('#btn_' + weiboid + '').click();
            }
        });

        var $inputor = $('.comment_text_inputor').atwho(atwho_config);
    });
</script>