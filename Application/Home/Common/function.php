<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

/**
 * 前台公共库文件
 * 主要定义前台公共函数库
 */

/**
 * 检测验证码
 * @param  integer $id 验证码ID
 * @return boolean     检测结果
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function check_verify($code, $id = 1){
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}

/**
 * 获取段落总数
 * @param  string $id 文档ID
 * @return integer    段落总数
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function get_part_count($id){
    static $count;
    if(!isset($count[$id])){
        $count[$id] = D('Document')->partCount($id);
    }
    return $count[$id];
}


/**
 * 生成系统AUTH_KEY
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function build_auth_key(){
    $chars  = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   // $chars .= '`~!@#$%^&*()_+-=[]{};:"|,.<>/?';
    $chars  = str_shuffle($chars);
    return substr($chars, 0, 40);
}

/**
 * 
 * @param unknown $id
 * @return string
 */
function get_category_info($id){
	
	$category = M('category')->find($id);
	
	return "<span class='news-cate-title'> ".$category['title']." </span> <em> / </em> <span class='news-cate-name' >".$category['name']." </span>";
}

function get_user_info($uid){
	
	$member = M('member')->find($uid);
	return $member;
}
/**
 * 
 * @param unknown $time
 * @return string
 */
function format_news_time($time){
	
	$now = time();
	
	if (time() - $time >0 && time() - $time < 60){
		$str = '刚刚';
	}elseif (time() - $time >= 60 && time() - $time < 60 * 60){
		$min = (time() - $time) / 60 ;
		$str = intval($min) . "分钟前";
	}elseif (time() - $time >= 60 * 60 && time() - $time < 24 * 60 * 60){
		$h = (time() - $time) / 3600;
		$str = intval($h) . '小时前';
	}else{
		$str = date("Y-m-d",$time);
	}
	return $str;
}

/**
 * 
 * @param unknown $type
 */
function get_user_news($type){
	
	$uid = is_login();
	$map['uid'] = $uid;
	$map['status'] =  1;
	$category_ids = D('DocCategory')->getChildrenId(1);
	$map['category_id'] = array('in' , $category_ids);
	$M = D('Document');
	switch ($type){
		case 'release':
			$lists = $M->where($map)->field('id,title,uid,create_time')->order('create_time desc')->limit(0,5)->select();
			break;
		
		case 'collect':
			$ids = M('documentCollection')->where("uid=".$uid)->order('create_time desc')->getField('document_id',true);
			
			$ids = array_slice($ids, 0 ,5);
			$ids = implode(",", $ids);
			$mapColl['id'] = array('in',$ids);
			$mapColl['status'] = 1;
			$mapColl['category_id'] = array('in' , $category_ids);
			$lists = $M->where($mapColl)->field('id,title,uid,create_time')->limit(0,5)->select();
			break;
		
		case 'comment':
			
			$ids = M('localComment')->where("uid=".$uid)->order('create_time desc')->getField('row_id',true);
			$ids = array_unique($ids);
			$ids = array_slice($ids, 0 ,5);
			$ids = implode(",", $ids);
			$mapCom['id'] = array('in',$ids);
			$mapCom['status'] = 1;
			$mapCom['category_id'] = array('in' , $category_ids);
			$lists = $M->where($mapCom)->field('id,title,uid,create_time')->limit(0,5)->select();
			break;
	}
	
	return $lists;
}

/**
 * 
 * @param unknown $sort
 * @return unknown
 */
function get_top_news($sort){
	
	$order = $sort . " desc";
	$map['status'] = 1;
	$category_ids = D('DocCategory')->getChildrenId(1);
	$map['category_id'] = array('in' , $category_ids);
	
	$M = D('Document');
	
	$lists = $M->where($map)->field('id,title,uid,create_time,view')->order($order)->limit(0,5)->select();
	
	
	return $lists;
}



/**
 * 获得项目区域
 * @return unknown
 */
function get_project_region(){

	$districts = M('District')->where(array('level' => 1))->field('id,name')->select();
	$districts[] = array('id'=>2 , 'name'=> '海外');
	$districts[] = array('id'=>1 , 'name'=> '其他');
	return $districts;

}
/**
 * 通过id获取区域名称
 * @param int $id
 * @return unknown
 */
function get_district_by_id($id){
	$map['id'] = $id;
	$district = M('District')->where($map)->find();
	return $district['name'];
}

/**
 * 获取筛选条件
 * @param string $type
 * @return array
 */
function get_project_sel($type){
	
	$arrs = C('PROJECT_'.strtoupper($type));
	foreach ($arrs as $k => $v){
		$arr[$k]['id'] = $k;
		$arr[$k]['title'] = $v;
	}
	return $arr;
}

/**
 * 获取项目配置
 * @param unknown $id
 * @param unknown $type
 * @return Ambigous <>
 */
function get_project_config($id , $type){

	$config = C('PROJECT_'.strtoupper($type));
	return $config[$id];
}
/**
 * 获取项目方向标签
 * @param number $pid
 * @return unknown
 */
function get_project_tags($pid = 0){
	if ($pid == 0){
		$map['hot'] = 1;
	}
	else{
		$map['pid'] = $pid;
	}
	
	$list = M('ProjectTags')->where($map)->order('sort')->select();
	return $list;
}

function get_hot_project(){
	
	$hotProjectCache = S('project_hot');
	if ($hotProjectCache){
		$result = $hotProjectCache;
	}else{
		$map['category_id'] = array('in' , '51,52');
		$map['status'] = 1;
		$order = "zan desc,comment desc,collection desc";
		$field = "id,uid,title,zan,comment,collection,status";
		$M = M('Document');
		$lists = $M->where($map)->order($order)->limit(0,10)->field($field)->select();
		
		S('project_hot' , $lists ,3600);
		
		$result = $lists;
	}
	
	return $result;
	
}

/**
 * 获取关注者列表
 * @param int $id
 * @param string $type
 * @return array
 */
function get_collection_lists($id , $type = 'name'){
	$M = M();
	if ($type == 'name'){
		$table = C('DB_PREFIX')."document_collection a ,".C('DB_PREFIX')."member b";
		$where = "a.document_id = ".$id." and a.uid = b.uid";
		$fields = "a.id,a.uid,a.create_time,b.nickname";
		$lists = $M->table($table)->where($where)->field($fields)->order('a.create_time desc')->select();
		
	}
	if ($type == 'avatar'){
		$table = C('DB_PREFIX')."document_collection a ,".C('DB_PREFIX')."avatar b";
		$where = "a.document_id = ".$id." and a.uid = b.uid";
		$fields = "a.id,a.uid,a.create_time,b.path";
		$lists = $M->table($table)->where($where)->field($fields)->order('a.create_time desc')->select();
	}
	return $lists;
}
/**
 * 生成项目筛选条件链接
 * @param unknown $action
 * @param string $param
 * @return Ambigous <string, boolean, mixed>
 */
function create_project_url($action , $param = NULL ){
	if ($param){
		$params = $_GET;
		foreach ($param as $k=>$v){
			if ($v == 'all'){
				unset($params[$k]);
				if ($k == 'industry'){
					unset($params['direction']);
				}
			}else{
				$params[$k] = $v;
			}
				
		}
		
		if (isset($params['page'])){
			unset($params['page']);
		}
		$url = U($action,$params);
	}
	else{
		$url = U($action,$_GET);
	}

	return $url;
}

