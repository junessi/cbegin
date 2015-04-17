<?php

function get_project_region(){

	$districts = M('District')->where(array('level' => 1))->field('id,name')->select();
	$districts[] = array('id'=>2 , 'name'=> '海外');
	$districts[] = array('id'=>1 , 'name'=> '其他');
	return $districts;

}

function get_district_by_id($id){
	$map['id'] = $id;
	$district = M('District')->where($map)->find();
	return $district['name'];
}

function get_type_by_id($id){
	$type = M('ForumType')->where(array('id' => $id))->find();
	return $type['title'];
}

function get_project_type(){
	$types = M('ForumType')->field('id,title')->select();
	return $types;
}

function get_project_stage(){
	
	$stage = C('PROJECT_STAGE');
	foreach ($stage as $k=>$v){
		$stages[$k]['id'] = $k;
		$stages[$k]['title'] = $v;
	}
	
	return $stages;
}

function get_project_partners(){
	
	$partners = C('PROJECT_PARTNERS');
	foreach ($partners as $k => $v){
		$arr[$k]['id'] = $k;
		$arr[$k]['title'] = $v;
	}
	return $arr;
}

function get_project_quotas(){

	$quotas = C('PROJECT_QUOTAS');
	foreach ($quotas as $k => $v){
		$arr[$k]['id'] = $k;
		$arr[$k]['title'] = $v;
	}

	return $arr;
}

function get_project_config($id , $type){
	
	$config = C('PROJECT_'.strtoupper($type));
	return $config[$id];
}

function get_forum_post_count($id){
	
	$count = M('ForumPost')->where("forum_id=".$id)->count();
	return $count;
}

function create_project_url($action , $param = NULL ){
	if ($param){
		$params = $_GET;
		foreach ($param as $k=>$v){
			if ($v == 'all'){
				unset($params[$k]);
			}else{
				$params[$k] = $v;
			}
			
		}
	
		$url = U($action,$params);
	}
	else{
		$url = U($action,$_GET);
	}
	
	return $url;
}