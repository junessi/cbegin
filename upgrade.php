<?php
/**
 * 1. 核心升级 + 应用升级
 * 2. 夸版本升级 (即: 数据库的夸版本升级)
 */
error_reporting(E_ERROR);
header('Content-type: text/html; charset=UTF-8');

/*** 增加统计代码 ***/

define('SITE_PATH','');
$_REQUEST = array_merge($_GET,$_POST);
$sitehost = h($_REQUEST['site']);
$siteip = h($_SERVER['REMOTE_ADDR']);
$version = h($_REQUEST['version']);

$config = require 'config.inc.php';
$dbconfig = array();

$dbconfig['DB_TYPE'] = $config['DB_TYPE'];
$dbconfig['DB_HOST'] = $config['DB_HOST'];
$dbconfig['DB_NAME'] = $config['DB_NAME'];
$dbconfig['DB_USER'] = $config['DB_USER'];
$dbconfig['DB_PWD']	 = $config['DB_PWD'];
$dbconfig['DB_PORT'] = $config['DB_PORT'];
$dbconfig['DB_PREFIX'] = $config['DB_PREFIX'];
$dbconfig['DB_CHARSET'] = $config['DB_CHARSET'];

//实例化数据库
$db	= new Db($dbconfig);
$result = $db->query("SELECT * FROM ts_onlive_site WHERE siteip='".$siteip."';");
if(!$result) {
	$add_result = $db->execute('INSERT INTO ts_onlive_site (`sitehost`,`siteip`,`sitedata`,`version`) VALUES ("'.$sitehost.'","'.$siteip.'","", "'.$version.'");');
}

$result = array();
// 模拟数据
$result['info'] = 'ThinkSNS V3 预览版于2013年1月21日发布，<a href="http://demo.thinksns.com/t3/">查看详情</a>';

// 输出结果
switch(strtolower($_REQUEST['output_format'])) {
	case 'json':
		echo json_encode($result);
		break;
	case 'php':
		dump($result);
		break;
	default:
		echo serialize($result);
}

exit();

/**
 * 获取应用的最新版本的信息 (包括"核心")
 *
 * 注意: 本函数不检查版本号的有效性, 请在调用本函数前检查.
 *
 * @param string $app			  应用名
 * @param string $now_version	  应用当前版本的版本号
 * @param string $lastest_version 应用最新版本的版本号
 * @return array
 * <code>
 * array(
 *     'error'			        => '0', 	// 无错误
 *     'error_message'	        => '',  	// 无错误信息
 *     'has_update'		        => int, 	// 0: 无更新 1:有更新
 *     'version'				=> string,  // 版本号 [仅核心(Core)时有效]
 *     'current_version_number' => int, 	// 当前版本的版本号
 *     'lastest_version_number' => int, 	// 最新版本的版本号
 *     'download_url'           => string,	// 下载地址
 *     'changelog'				=> text,    // ChangeLog
 * )
 * </code>
 */
function getLastestVersionInfo($app, $current_version, $lastest_version)
{
	if ($current_version >= $lastest_version)
		return array(
				'error'						=> '0',
				'error_message'				=> '',
				'has_update'				=> '0',
				'current_version_number'	=> $current_version,
				'lastest_version_number'	=> $lastest_version,);

	global $versions;
	// 下载地址
	$var_download_url = $app . '_download_url_' . $lastest_version;
	global $$var_download_url;
	$info = array(
				'error'						=> '0',
				'error_message'				=> '',
				'has_update'				=> '1',
				'current_version_number'	=> $current_version,
				'lastest_version_number'	=> $lastest_version,
				'download_url'				=> $$var_download_url);
	// 版本名称 (核心升级时必须, 如: ThinkSNS 2.1 Build 10992)
	if ($app == 'core') {
		$var_core_version = 'core_version_' . $lastest_version;
		global $$var_core_version;
		$info['lastest_version']  = $$var_core_version;
	}
	// changelog
	$info['changelog'] = '';
	foreach ($versions[$app] as $version_no) {
		if ($current_version >= $version_no)
			continue ;

		$var_changelog = $app . '_changelog_' . $version_no;
		global $$var_changelog;
		$info['changelog'] .= $$var_changelog;
	}
	// 版本列表
	$info['version_number_list'] = $versions[$app];

	return $info;
}

// 浏览器友好的输出
function dump($var, $echo=true,$label=null, $strict=true)
{
    $label = ($label===null) ? '' : rtrim($label) . ' ';
    if(!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre style="text-align:left">'.$label.htmlspecialchars($output,ENT_QUOTES).'</pre>';
        } else {
            $output = $label . " : " . print_r($var, true);
        }
    }else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if(!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre style="text-align:left">'. $label. htmlspecialchars($output, ENT_QUOTES). '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}


function h($text) {
	//过滤标签
	$text	=	nl2br($text);
	$text	=	htmlspecialchars_decode($text);
	$text	=	strip_tags($text);
	$text	=	str_ireplace(array("\r\t","\n\l","\r","\n","\t","\l","'",'&nbsp;','&amp;'),'',$text);
	$text	=	str_ireplace(array(chr('0001'),chr('0002'),chr('0003'),chr('0004'),chr('0005'),chr('0006'),chr('0007'),chr('0008')),'',$text);
	$text	=	str_ireplace(array(chr('0009'),chr('0010'),chr('0011'),chr('0012'),chr('0013'),chr('0014'),chr('0015'),chr('0016')),'',$text);
	$text	=	str_ireplace(array(chr('0017'),chr('0018'),chr('0019'),chr('0020'),chr('0021'),chr('0022'),chr('0023'),chr('0024')),'',$text);
	$text	=	str_ireplace(array(chr('0025'),chr('0026'),chr('0027'),chr('0028'),chr('0029'),chr('0030'),chr('0031'),chr('0032')),'',$text);
	return $text;
}

/**
 +------------------------------------------------------------------------------
 * ThinkPHP 简洁模式数据库中间层实现类
 * 只支持mysql
 +------------------------------------------------------------------------------
 */
class Db
{

    static private $_instance	= null;
    // 是否显示调试信息 如果启用会在日志文件记录sql语句
    public $debug				= false;
    // 是否使用永久连接
    protected $pconnect         = false;
    // 当前SQL指令
    protected $queryStr			= '';
    // 最后插入ID
    protected $lastInsID		= null;
    // 返回或者影响记录数
    protected $numRows			= 0;
    // 返回字段数
    protected $numCols			= 0;
    // 事务指令数
    protected $transTimes		= 0;
    // 错误信息
    protected $error			= '';
    // 当前连接ID
    protected $linkID			=   null;
    // 当前查询ID
    protected $queryID			= null;
    // 是否已经连接数据库
    protected $connected		= false;
    // 数据库连接参数配置
    protected $config			= '';
    // SQL 执行时间记录
    protected $beginTime;
    /**
     +----------------------------------------------------------
     * 架构函数
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $config 数据库配置数组
     +----------------------------------------------------------
     */
    public function __construct($config=''){
        if ( !extension_loaded('mysql') ) {
            throw_exception('not support mysql');
        }
        $this->config   =   $this->parseConfig($config);
    }

    /**
     +----------------------------------------------------------
     * 连接数据库方法
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function connect() {
        if(!$this->connected) {
            $config =   $this->config;
            // 处理不带端口号的socket连接情况
            $host = $config['hostname'].($config['hostport']?":{$config['hostport']}":'');
            if($this->pconnect) {
                $this->linkID = mysql_pconnect( $host, $config['username'], $config['password']);
            }else{
                $this->linkID = mysql_connect( $host, $config['username'], $config['password'],true);
            }
            if ( !$this->linkID || (!empty($config['database']) && !mysql_select_db($config['database'], $this->linkID)) ) {
                throw_exception(mysql_error());
            }
            $dbVersion = mysql_get_server_info($this->linkID);
            if ($dbVersion >= "4.1") {
                //使用UTF8存取数据库 需要mysql 4.1.0以上支持
                mysql_query("SET NAMES 'UTF8'", $this->linkID);
            }
            //设置 sql_model
            if($dbVersion >'5.0.1'){
                mysql_query("SET sql_mode=''",$this->linkID);
            }
            // 标记连接成功
            $this->connected    =   true;
            // 注销数据库连接配置信息
            unset($this->config);
        }
    }

    /**
     +----------------------------------------------------------
     * 释放查询结果
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function free() {
        mysql_free_result($this->queryID);
        $this->queryID = 0;
    }

    /**
     +----------------------------------------------------------
     * 执行查询 主要针对 SELECT, SHOW 等指令
     * 返回数据集
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $str  sql指令
     +----------------------------------------------------------
     * @return mixed
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function query($str='') {
        $this->connect();
        if ( !$this->linkID ) return false;
        if ( $str != '' ) $this->queryStr = $str;
        //释放前次的查询结果
        if ( $this->queryID ) {    $this->free();    }
        $this->Q(1);
        $this->queryID = mysql_query($this->queryStr, $this->linkID);
        $this->debug();
        if ( !$this->queryID ) {
            if ( $this->debug )
                throw_exception($this->error());
            else
                return false;
        } else {
            $this->numRows = mysql_num_rows($this->queryID);
            return $this->getAll();
        }
    }

    /**
     +----------------------------------------------------------
     * 执行语句 针对 INSERT, UPDATE 以及DELETE
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $str  sql指令
     +----------------------------------------------------------
     * @return integer
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function execute($str='') {
        $this->connect();
        if ( !$this->linkID ) return false;
        if ( $str != '' ) $this->queryStr = $str;
        //释放前次的查询结果
        if ( $this->queryID ) {    $this->free();    }
        $this->W(1);
        $result =   mysql_query($this->queryStr, $this->linkID) ;
        $this->debug();
        if ( false === $result) {
            if ( $this->debug )
                throw_exception($this->error());
            else
                return false;
        } else {
            $this->numRows = mysql_affected_rows($this->linkID);
            $this->lastInsID = mysql_insert_id($this->linkID);
            return $this->numRows;
        }
    }


    /**
     +----------------------------------------------------------
     * 获得所有的查询数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return array
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function getAll() {
        if ( !$this->queryID ) {
            throw_exception($this->error());
            return false;
        }
        //返回数据集
        $result = array();
        if($this->numRows >0) {
            while($row = mysql_fetch_assoc($this->queryID)){
                $result[]   =   $row;
            }
            mysql_data_seek($this->queryID,0);
        }
        return $result;
    }

    /**
     +----------------------------------------------------------
     * 关闭数据库
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function close() {
        if (!empty($this->queryID))
            mysql_free_result($this->queryID);
        if ($this->linkID && !mysql_close($this->linkID)){
            throw_exception($this->error());
        }
        $this->linkID = 0;
    }

    /**
     +----------------------------------------------------------
     * 数据库错误信息
     * 并显示当前的SQL语句
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    public function error() {
        $this->error = mysql_error($this->linkID);
        if($this->queryStr!=''){
            $this->error .= "\n [ SQL语句 ] : ".$this->queryStr;
        }
        return $this->error;
    }

    /**
     +----------------------------------------------------------
     * SQL指令安全过滤
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $str  SQL字符串
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    public function escape_string($str) {
        return mysql_escape_string($str);
    }

   /**
     +----------------------------------------------------------
     * 析构方法
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function __destruct()
    {
        // 关闭连接
        $this->close();
    }

    /**
     +----------------------------------------------------------
     * 取得数据库类实例
     +----------------------------------------------------------
     * @static
     * @access public
     +----------------------------------------------------------
     * @return mixed 返回数据库驱动类
     +----------------------------------------------------------
     */
    public static function getInstance($db_config='')
    {
		if ( self::$_instance==null ){
			self::$_instance = new Db($db_config);
		}
		return self::$_instance;
    }

    /**
     +----------------------------------------------------------
     * 分析数据库配置信息，支持数组和DSN
     +----------------------------------------------------------
     * @access private
     +----------------------------------------------------------
     * @param mixed $db_config 数据库配置信息
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    private function parseConfig($_db_config='') {
		// 如果配置为空，读取配置文件设置
		$db_config = array (
			'dbms'		=>   $_db_config['DB_TYPE'],
			'username'	=>   $_db_config['DB_USER'],
			'password'	=>   $_db_config['DB_PWD'],
			'hostname'	=>   $_db_config['DB_HOST'],
			'hostport'	=>   $_db_config['DB_PORT'],
			'database'	=>   $_db_config['DB_NAME'],
			'dsn'		=>   $_db_config['DB_DSN'],
			'params'	=>   $_db_config['DB_PARAMS'],
		);
        return $db_config;
    }

    /**
     +----------------------------------------------------------
     * 数据库调试 记录当前SQL
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     */
    protected function debug() {
        // 记录操作结束时间
        if ( $this->debug )    {
            $runtime    =   number_format(microtime(TRUE) - $this->beginTime, 6);
            Log::record(" RunTime:".$runtime."s SQL = ".$this->queryStr,Log::SQL);
        }
    }

    /**
     +----------------------------------------------------------
     * 查询次数更新或者查询
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param mixed $times
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    public function Q($times='') {
        static $_times = 0;
        if(empty($times)) {
            return $_times;
        }else{
            $_times++;
            // 记录开始执行时间
            $this->beginTime = microtime(TRUE);
        }
    }

    /**
     +----------------------------------------------------------
     * 写入次数更新或者查询
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param mixed $times
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    public function W($times='') {
        static $_times = 0;
        if(empty($times)) {
            return $_times;
        }else{
            $_times++;
            // 记录开始执行时间
            $this->beginTime = microtime(TRUE);
        }
    }

    /**
     +----------------------------------------------------------
     * 获取最近一次查询的sql语句
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    public function getLastSql() {
        return $this->queryStr;
    }

}//类定义结束