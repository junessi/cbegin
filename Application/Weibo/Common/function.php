<?php

/**
 * 获取话题分类名称
 * @param int $id
 * @return string
 */
function get_topic_cate($id){
	$topic_cate =  C('TOPIC_CATE');
	return $topic_cate[$id];
}

function get_topic_follow($id){
	if (!is_login()){
		return "";
	}
	else{
		$map['uid'] = is_login();
		$map['topic_id'] = $id;
		$is_follow = M('TopicSub')->where($map)->find();
		if ($is_follow){
			return "<a href='javascript:;' >已关注</a>";
		}else{
			return "<a href='javascript:;' class='topic_follow' data-id='".$id."'>关注</a>";
		}
	}
}