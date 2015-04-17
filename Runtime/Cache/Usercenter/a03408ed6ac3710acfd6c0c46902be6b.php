<?php if (!defined('THINK_PATH')) exit(); if($uid == is_login()): ?><script type="text/javascript" src="/Public/Usercenter/js/expandinfo-form.js"></script>
    <form action="<?php echo U('Config/edit_expandinfo');?>" method="post" class="ajax-form">
        <input type="hidden" name="profile_group_id" value="<?php echo ($profile_group_id); ?>">
        <div>
            <?php if(is_array($info_list)): $i = 0; $__LIST__ = $info_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><dl>
                    <?php echo W('InputRender/inputRender',array($vl,'personal'));?>
                </dl><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php if($info_list != null): ?><input type="submit" value="保存" id="submit_btn"
                   class="btn btn-primary expandinfo-sumbit">
            <?php else: ?>
            <span class="expandinfo-noticeinfo">该扩展信息分组没有信息！</span><?php endif; ?>
    </form>
    <?php else: ?>
    <div>
        <?php if(is_array($info_list)): $i = 0; $__LIST__ = $info_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vll): $mod = ($i % 2 );++$i;?><dl>
                <?php echo W('InputRender/inputRender',array($vll,'other'));?>
            </dl><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php if($info_list == null): ?><span class="expandinfo-noticeinfo">该扩展信息分组没有信息！</span><?php endif; ?>
    </div><?php endif; ?>