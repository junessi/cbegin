<?php if (!defined('THINK_PATH')) exit();?><link href="/Public/static/ueditormini/themes/default/css/umeditor.min.css" type="text/css" rel="stylesheet">

<script type="text/javascript" charset="utf-8" src="/Public/static/ueditormini/js/umeditor.config.js"></script>

<script type="text/javascript" charset="utf-8" src="/Public/static/ueditormini/js/umeditor.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/static/ueditormini/js/lang/zh-cn/zh-cn.js"></script>
<script type="text/plain" name="<?php echo ($name); ?>" id="<?php echo ($id); ?>" style="width:<?php echo ($width); ?>;height:<?php echo ($height); ?>;"><?php echo ($default); ?></script>




<?php if($config == ''): ?><script>
    $(function(){
    var um = UM.getEditor('<?php echo ($id); ?>',{toolbar:[
        'source | bold italic underline | forecolor backcolor | ',
        'insertorderedlist | fontsize' ,
        '| justifyleft justifycenter justifyright justifyjustify |',
        'link emotion image video  | map']});
    })
     </script>
    <?php else: ?>
<script>
    $(function(){
    var config='{<?php echo ($config); ?>}';
    var um = UM.getEditor('<?php echo ($id); ?>',config);
    })
</script><?php endif; ?>