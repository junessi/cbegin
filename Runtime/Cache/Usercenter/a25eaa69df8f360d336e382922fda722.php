<?php if (!defined('THINK_PATH')) exit(); if(($type) == "personal"): ?><div class="form-group">
        <label for="expand_<?php echo ($field_id); ?>" class="col-sm-2 control-label" style="text-align: right;">
            <?php if(($required) == "1"): ?><span style="color: #FF0047;vertical-align: middle;">*&nbsp;&nbsp;</span><?php endif; echo ($field_name); ?>
        </label>

        <div class="col-sm-6">
            <input type="text" onblur="check(this,<?php echo ($field_id); ?>)" require="<?php echo ($required); ?>" min_length="<?php echo ($validation["min"]); ?>" max_length="<?php echo ($validation["max"]); ?>" text_type="<?php echo ($child_form_type); ?>" class="form-control" id="expand_<?php echo ($field_id); ?>" name="expand_<?php echo ($field_id); ?>" value="<?php echo (htmlspecialchars($field_data)); ?>">
            <input type="hidden" class="canSubmit" id="canSubmit_<?php echo ($field_id); ?>" value="<?php echo ($canSubmit); ?>">
            <?php if(($input_tips) != ""): ?><span class="help-block"><?php echo ($input_tips); ?></span><?php endif; ?>
        </div>
        <div class="col-sm-4" >
            <div id="alert_<?php echo ($field_id); ?>" class="alert alert-danger" style="margin-bottom: 0"><label id="label_<?php echo ($field_id); ?>"></label></div>
        </div>
    </div>
<?php else: ?>
    <dt class="expandinfo-dt">
        <?php echo ($field_name); ?>：
    </dt>

    <dd class="expandinfo-dd">
        <?php if(($field_data != null)&&($field_data != '')): echo (htmlspecialchars($field_data)); ?>
            <?php else: ?>
            无<?php endif; ?>
    </dd><?php endif; ?>
<div class="clearfix"></div>