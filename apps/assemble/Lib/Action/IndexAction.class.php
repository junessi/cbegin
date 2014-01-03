<?php
/**
 * 找人首页控制器
 * @author zivss <guolee226@gmail.com>
 * @version TS3.0
 */
class IndexAction extends Action
{
	public function _initialize()
	{
		$this->appCssList[] = 'people.css';
	}

	public function index()
	{
		$title = 'temp';
		$cate = getSubByKey($cate,'title');
		$this->setTitle( $title );
		$this->setKeywords( $title );
		$this->setDescription( implode(',', $cate) );

		$this->display();
	}

	/**
	 * 获取指定父分类的树形结构
	 * @return integer $pid 父分类ID
	 * @return array 指定父分类的树形结构
	 */
	public function getNetworkList()
	{
		$pid = intval($_REQUEST['pid']);
		$list = model('CategoryTree')->setTable('area')->getNetworkList($pid);
		$id = $pid + 100;
		// exit($list[$id]['child']);
		//dump($list[$id]['child']);
		exit(json_encode($list[$id]['child']));
	}
}
