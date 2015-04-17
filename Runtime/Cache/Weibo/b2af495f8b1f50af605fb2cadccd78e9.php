<?php if (!defined('THINK_PATH')) exit();?>
<script src="<?php echo getRootUrl();?>Addons/InsertImage/_static/js/insertImage.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo getRootUrl();?>Addons/InsertImage/_static/css/insertImage.css"/>

<a href="javascript:" id="insert_image" onclick="insert_image.insertImage(this)"><img class="weibo_type_icon" src="<?php echo getRootUrl();?>Addons/InsertImage/_static/image/image.png"/></a>
<input type="hidden" id="box_url" value="<?php echo addons_url('InsertImage://InsertImage/imageBox');?>">

        <!--
<a href="javascript:" onclick="insert_image.insertImage($(this))"><span class="glyphicon glyphicon-picture" ></span></a>-->