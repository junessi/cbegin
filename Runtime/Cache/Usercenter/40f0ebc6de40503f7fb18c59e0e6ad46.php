<?php if (!defined('THINK_PATH')) exit();?>

<?php if(($type) == "personal"): ?><div class="form-group">
        <label for="expand_<?php echo ($field_id); ?>" class="col-sm-2 control-label" style="text-align: right;">
            <?php if(($required) == "1"): ?><span style="color: #FF0047;vertical-align: middle;">*&nbsp;&nbsp;</span><?php endif; echo ($field_name); ?>
        </label>
        <?php $importDatetimePicker = true; if(!$field_data){ $field_data = date("Y-m-d"); } ?>
        <div class="col-sm-6">
            <input class="time form-control input-group date form_datetime col-md-5" id="expand_<?php echo ($field_id); ?>" name="expand_<?php echo ($field_id); ?>" size="16" style="position: relative;display: block;" type="text" value="<?php echo ($field_data); ?>"  placeholder="请选择时间" readonly>
            <?php if(($input_tips) != ""): ?><span class="help-block"><?php echo ($input_tips); ?></span><?php endif; ?>
        </div>
    </div>
    <?php else: ?>
    <dt class="expandinfo-dt">
        <?php echo ($field_name); ?>：
    </dt>

    <dd class="expandinfo-dd">
        <?php if(($field_data != null)&&($field_data != '')): echo ($field_data); ?>
            <?php else: ?>
            还未设置<?php endif; ?>
    </dd><?php endif; ?>
<div class="clearfix"></div>

<?php if($importDatetimePicker): ?><link href="/Public/static/datetimepickerV3/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/Public/static/datetimepickerV3/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/Public/static/datetimepickerV3/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="/Public/static/datetimepickerV3/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script>
        /*年月日，小时，分选择
        $('.time').datetimepicker({
            //language:  'fr',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd hh:ii'
        });*/
        $('.time').datetimepicker({
            language:  'zh-CN',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            format: 'yyyy-mm-dd'
        });
        /*小时，分选择
        $('.time').datetimepicker({
            language:  'fr',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 1,
            minView: 0,
            maxView: 1,
            forceParse: 0,
            format: 'yyyy-mm-dd'
        });*/

    </script><?php endif; ?>