<?php if (!defined('THINK_PATH')) exit(); if(!empty($config['type'])){ ?>



<div id="center_weibo">
    <div class="row">
        <div class="col-xs-12">
            <h4 onclick="center_toggle('weibo')"><i class="glyphicon glyphicon-lock"></i>&nbsp;绑定微博
                <a class="pull-right" id="toggle_weibo"
                        >
                    编辑
                    <i id="weibo_toggle_right" title="展开" class="center_arrow_right"></i>
                    <i id="weibo_toggle_bottom" title="收起" class="center_arrow_bottom"
                       style="display: none"></i>
                </a>
            </h4>
            <hr class="center_line"/>
            </h4>
        </div>
    </div>
    <div id="weibo_panel" class="center_panel" style="display: none">






        <div class="col-md-9 col-sm-8 col-xs-11" style="padding-left:10px;padding-right: 0;">


            <div class="uc_config_info clearfix col-xs-12 "
                 style="padding-top:20px;padding-bottom: 20px;">


                <div class="other_login_link" style="margin: 0">
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p>
                            <span class="col-xs-4">  <a href="javascript:" class="other_login other_login_<?php echo ($vo['name']); ?>"></a></span>
                            <span class="col-xs-6"><?php if($vo['is_bind']): ?>已绑定 &nbsp; [<a href="<?php echo ($vo["info"]["profile_url"]); ?>" target="_blank"><?php echo ($vo["info"]["nick"]); ?></a>]<?php else: ?>未绑定<?php endif; ?> </span>
<span class="">
    <?php if($vo['is_bind']): ?><a href="javascript:" class="btn btn-primary unbind" data-type="<?php echo ($vo["name"]); ?>"  data-url="<?php echo addons_url('SyncLogin://Ucenter/unbind');?>">取消绑定</a>
        <?php else: ?>
        <a href="<?php echo addons_url('SyncLogin://Base/login',array('type'=>$vo['name']));?>" class="btn btn-primary ">点击绑定</a><?php endif; ?>
</span>

                        </p><?php endforeach; endif; else: echo "" ;endif; ?>

                </div>

            </div>

        </div>






    </div>
</div>

<!--<li>
    <a href="<?php echo addons_url('SyncLogin://Ucenter/bind');?>" >
        绑定微博
    </a>
</li>-->



<script>
    $(function () {
        var $sidebar = $('#usercenter-sidebar-td');
        var $sidebar_xs = $('#usercenter-sidebar-xs');
        var $sidebar_sm = $('#usercenter-sidebar-sm');
        var $content = $('#usercenter-content-td');

        function trigger_resp() {
            var width = $(window).width();
            if (width < 768) {
                on_xs();
            } else {
                on_sm();
            }
        }

        function on_xs() {
            $sidebar_xs.append($sidebar);
            $content.css({'padding-left': 0, 'padding-right': 0});
        }

        function on_sm() {
            $sidebar_sm.prepend($sidebar);
            $content.css({'padding-left': 0, 'padding-right': 0});
        }

        trigger_resp();

        $(window).resize(function () {
            trigger_resp();
        })
        $('.unbind').click(function(){
            if(confirm('确定要取消绑定么？')){
                var obj = $(this);
                var type =obj.attr('data-type');
                var url =  obj.attr('data-url');
                $.post(url,{type:type},function(res){
                    handleAjax(res);
                })
            }

        })


    })
</script>
<?php } ?>