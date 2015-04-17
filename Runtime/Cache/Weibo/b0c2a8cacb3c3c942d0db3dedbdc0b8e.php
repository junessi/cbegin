<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="<?php echo getRootUrl();?>Addons/Rank_checkin/Css/rank.css">
<div class="check_rank ">
    <?php if(count($rank) == 0): ?><div class="default" style="text-align: center">虚位以待，赶紧签到。</div>
        <?php else: ?>
        <ul class="check_rank_list" style="margin-bottom: 10px;padding-top: 10px">
            <?php if(is_array($rank)): $i = 0; $__LIST__ = $rank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="row">
                    <div class="paiming col-md-2">
                        <?php switch($i): case "1": ?>1<?php break;?>
                            <?php case "2": ?>2<?php break;?>
                            <?php case "3": ?>3<?php break;?>
                            <?php case "4": ?>4<?php break;?>
                            <?php case "5": ?>5<?php break;?>
                            <?php default: ?>
                            <?php echo ($i); endswitch;?>
                    </div>
                    <div class="list col-md-6">
                        <img class="avatar-img" style="width: 32px" src="<?php echo ($v["userInfo"]["avatar32"]); ?>">
                        <a ucard="<?php echo ($v["uid"]); ?>" class="text-more " style="width: 50%;vertical-align: middle" href="<?php echo ($v["userInfo"]["space_url"]); ?>">
                            <?php echo ($v["userInfo"]["nickname"]); ?></a>
                    </div>

                    <div class="col-md-4 check_date">
                        <?php echo date('H:i:s',$v[ctime]);?>
                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul><?php endif; ?>
    <div class="col-xs-12" style="text-align:center;margin-bottom: 2px;border-top: 1px rgb(240, 240, 240) dashed;">
        <a href="<?php echo U('people/index/ranking');?>" style="padding: 0;color:rgb(51, 51, 51);">
            <span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;查看签到排行</a>
    </div>
    <div class="clearfix"></div>
</div>
<div style="margin-bottom: 12px"></div>