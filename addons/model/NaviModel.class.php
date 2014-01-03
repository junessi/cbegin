<?php
/**
 * 导航模型 - 数据对象模型
 * @author jason <renjianchao@zhishisoft.com> 
 * @version TS3.0
 */
class NaviModel extends Model {

	protected $tableName = 'navi';
	protected $fields = array(0=>'navi_id',1=>'navi_name',2=>'app_name',3=>'url',4=>'target',5=>'status',6=>'position',7=>'guest',8=>'is_app_navi',9=>'parent_id',10=>'order_sort');
	
	/**
	 * 获取头部导航
	 * @return array 头部导航 
	 */
	public function getTopNav() {

		if(($topNav = model('Cache')->get('topNav')) === false) {
			$map['status'] = 1;
			$map['position'] = 0;
			$list = $this->where($map)->order('order_sort ASC')->findAll();
	    	foreach($list as $v){
	    		$v['url'] = empty($v['url']) ? 'javascript:;' : str_replace('{website}', SITE_URL, $v['url']);
	    		if ( $v['parent_id'] == 0 ){
	    			$navlist[$v['navi_id']] = $v;
	    		}
	    	}
	    	foreach($list as $v){
	    		if ( $v['parent_id'] > 0 ){
	    			$navlist[$v['parent_id']]['child'][] = $v;
	    		}
	    	}
			$topNav = $navlist;
			empty($topNav) && $topNav = array();
			model('Cache')->set('topNav', $topNav);
		}

		return $topNav;
	}	

	/**
	 * 获取底部导航
	 * @return array 底部导航
	 */
	public function getBottomNav() {
		
		if(($bottomNav = model('Cache')->get('bottomNav')) === false) {
			$map['status'] = 1;
			$map['position'] = 1;
			$list = $this->where($map)->order('order_sort ASC')->findAll();
	    	foreach($list as $v){
	    		$v['url'] = empty($v['url']) ? 'javascript:;' : str_replace('{website}', SITE_URL, $v['url']);
	    		if ( $v['parent_id'] == 0 ){
	    			$navlist[$v['navi_id']] = $v;
	    		}
	    	}
	    	foreach($list as $v){
	    		if ( $v['parent_id'] > 0 ){
	    			$navlist[$v['parent_id']]['child'][] = $v;
	    		}
	    	}
			$bottomNav = $navlist;
			empty($bottomNav) && $bottomNav = array();
			model('Cache')->set('bottomNav', $bottomNav);
		}

		return $bottomNav;
	}

	public function getBottomChildNav($bottomNav){
		foreach ($bottomNav as $v){
			if(isset($v['child']) && !empty($bottomNav)){
				return true;
			}
		}
		return false;
	}

	public function addToFrontAppList($data){
		$map['app_name'] = $data['app_name'];
		$list = $this->where($map)->findAll();
		if (count($list) == 0)
		{
			unset($navi['navi_id']);
			$navi['navi_name'] = $data['app_alias'];
			$navi['app_name'] = $data['app_name'];
			$navi['url'] = '{website}'.'/index.php?app='.$data['app_name'].'&mod=Index&act=index';
			$navi['target'] = '_self';
			$navi['status'] = $data['status'];
			$navi['position'] = 0;
			$navi['guest'] = 1;
			$navi['is_app_navi'] = 0;
			$navi['parent_id'] = 0;
			$navi['order_sort'] = $this->max('order_sort') + 1;
			if ($this->add($navi))
				return true;
		}
		return false;
	}

	public function removeFromFrontAppList($data){
		$map['app_name'] = $data['app_name'];
		$list = $this->where($map)->findAll();
		if (count($list) > 0)
		{
			$this->where($map)->delete();
			return true;
		}
		return false;
	}
	/**
	 * 清除导航缓存
	 * @return void
	 */
	public function cleanCache() {
		model('Cache')->rm('topNav');
		model('Cache')->rm('bottomNav');
	}	
}
