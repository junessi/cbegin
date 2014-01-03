<?php
if (!defined('SITE_PATH')) exit();

$db_prefix = C('DB_PREFIX');

$sql = array(
	// Blog数据
	"DROP TABLE IF EXISTS `{$db_prefix}weiba`;",
	"DROP TABLE IF EXISTS `{$db_prefix}weiba_follow`;",
	"DROP TABLE IF EXISTS `{$db_prefix}weiba_post`;",
	"DROP TABLE IF EXISTS `{$db_prefix}weiba_reply`;",
	// ts_system_data数据
	//"DELETE FROM `{$db_prefix}system_data` WHERE `list` = 'weiba'",
	// 积分规则
	"DELETE FROM `{$db_prefix}credit_setting` WHERE `type` = 'weiba';",
);

foreach ($sql as $v)
	M('')->execute($v);