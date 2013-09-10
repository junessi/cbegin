<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
.post-tag-input {border: 0 none; margin: 0; outline: medium none; padding: 0;color:#777;}
</style>
<div class="profession-title">请选择或手动输入您的个人标签，每个人最多可拥有<em><?php echo ($tag_num); ?></em>个个人标签，已选择<em id="selected_nums"><?php echo ($nums); ?></em>个</div>
<input type="hidden" name="tag_num" id="tag_num" value="<?php echo ($tag_num); ?>">
<div class="profession-type clarfix">
<?php if(is_array($categoryTree)): ?><?php $i = 0;?><?php $__LIST__ = $categoryTree?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$vo): ?><?php ++$i;?><?php $mod = ($i % 2 )?><dl>
		<dt><?php echo ($vo["title"]); ?>：</dt>
		<dd>
		<?php if(is_array($vo["child"])): ?><?php $i = 0;?><?php $__LIST__ = $vo["child"]?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$v): ?><?php ++$i;?><?php $mod = ($i % 2 )?><?php if(!in_array($v['id'], $selectedIds)) { ?>
			<a id="user_category_<?php echo ($v['id']); ?>" href="javascript:;" onclick="return tagsTs.add('<?php echo ($v['title']); ?>');" class="btn-cancel"><span><?php echo ($v["title"]); ?></span></a>
			<?php } ?><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
		</dd>
	</dl><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
</div>
<div class="profession-type clearfix">
	<dl>
		<dt>个人标签：</dt>
        <dd><div id="post-tag" class="tag-lists" style="width:<?php echo ($width); ?>">
	<div class="Tag_list02">
		<div class="tag-lists">
		<ul id="post_tag_list" class="taglist">
			<?php if(is_array($tags)): ?><?php $i = 0;?><?php $__LIST__ = $tags?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$vo): ?><?php ++$i;?><?php $mod = ($i % 2 )?><li rel="<?php echo ($key); ?>"><a class="tag btn-cancel" href="javascript:;" style="float:left;"><span><?php echo ($vo); ?><i class="ico-close1" title="删除" onclick="return tagsTs.deleteTag(<?php echo ($key); ?>)" href="#"></i></span></a></li><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
		</ul>
		</div>
		<div id="post-tag-input-holder" class="add-tag">
			<input class="post-tag-input" style="width:<?php echo ($width); ?>" id="post_tag_input" type="text" value="<?php echo L('PUBLIC_TAG_TIPS');?>" onfocus="if(this.value == '<?php echo L('PUBLIC_TAG_TIPS');?>')this.value='';" onblur="if(this.value == '') this.value='<?php echo L('PUBLIC_TAG_TIPS');?>';" />
		</div>
	</div>
        </div></dd>
    </dl>
</div>
<input type="hidden" name="<?php echo ($apptable); ?>_tags" id="ts_tag_search_value" value="<?php echo ($tags_my); ?>" />
<input type="hidden" name="<?php echo ($apptable); ?>_row_id" value="<?php echo ($row_id); ?>" id="user_id" />

<script type="text/javascript"> 
// 资源ID
var row_id = '<?php echo (intval($row_id)); ?>';
// 应用名称
var appname = '<?php echo ($appname); ?>';
// 资源表名
var apptable = '<?php echo ($apptable); ?>';
/**
 * 标签操作Js类
 * @type {object}
 */
var tagsTs = {};
/**
 * 初始化标签操作
 * @return void
 */
tagsTs.init = function()
{
	var _this = this;
	// 标签显示框触发焦点问题
	$('#post-tag').live('click', function() {
		$('#post_tag_input').focus();});
	// 绑定回车，逗号与删除键盘事件
	$('#post_tag_input').keypress(function(e) {
		if(e.which == 13 || e.which == 44) {
			var value = $.trim($(this).val());
			value != "" && _this.add(value);
			$(this).val('');
		}
		if(e.which == 8) {
			var value = $(this).val();
			if(value.length == 0) {
				var rel = $('#post_tag_list li').last().attr('rel');
				_this.deleteTag(rel);
			}
		}
	});
	// 按键抬起效果
	$('#post_tag_input').keyup(function(e) {
		var value = $.trim($(this).val());
		if(value == "") {
			return false;
		}
		if(value.indexOf('，') == value.length - 1) {
			value = value.substring(0, value.length - 1);
			_this.add(value);
			$(this).val('');
		}
		if(value.indexOf(',') == value.length - 1) {
			$(this).val('');
		}
	});
};
/**
 * 添加标签效果操作
 * @param string tagName 标签名称
 * @return void
 */
tagsTs.add = function(tagName)
{
	// 判断标签长度，控制为10个汉字
	var tagLimit = 10;
	if(getLength(tagName) > tagLimit) {
		ui.error('标签长度不能超过'+tagLimit+'个汉字');
		return false;
	}
	// 判断标签数目，控制为10个标签
	var tagNums = $('#tag_num').val();
	if($('#post_tag_list li').length >= tagNums) {
		ui.error('最多只能设置'+tagNums+'个标签');
		return false;
	}
	var _this = this;
	if(row_id) {
		$.post(U('widget/Tag/getTagId'), {'appname':appname, 'apptable':apptable, 'name':tagName}, function(res) {
			if(res.status == 1) {
				var tagId = parseInt(res.data);
				// 验证是否重复加入标签
				var tagArr = $('#ts_tag_search_value').val().split(',');
				for(var i in tagArr) {
					if(tagArr[i] == tagId) {
						ui.error('标签已存在');
						return false;
					}
				}
				// 添加标签操作
				var html = '<li rel="'+tagId+'"><a class="tag btn-cancel" href="javascript:;" style="float:left;"><span>'+tagName+'<i class="ico-close1" title="删除" onclick="return tagsTs.deleteTag('+tagId+')" href="javascript:;"></i></span></a></li>';
				$('#post_tag_list').append(html);	
				_this.setSelectedNums();
			} else {
				ui.error(res.info);
				return false;
			}
			_this.updateValue();
		}, 'json');
	}
};
/**
 * 更新搜索标签后的值
 * @return void
 */
tagsTs.updateValue = function()
{
	var value = [];
	$('#post_tag_list li').each(function(i, n) {
		value.push($(n).attr('rel'));
	});
	$('#ts_tag_search_value').val(value.join(','));
};
/**
 * 移除已添加标签
 */
tagsTs.deleteTag = function(tagId)
{
	$('li[rel='+tagId+']').remove();
	this.updateValue();
	this.setSelectedNums();
	return false;
};

// 设置选中标签数目
tagsTs.setSelectedNums = function() {
	var len = $('#post_tag_list').find('li').length;
	$('#selected_nums').html(len);
};

// 开始标签操作
tagsTs.init();
</script>