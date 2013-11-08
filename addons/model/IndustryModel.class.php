<?php
/**
 * 行业模型 - 数据对象模型
 * @author Cricket <cricketlong@gmail.com>
 */
class IndustryModel extends Model {

	protected $tableName = 'industry';

	/**
	 * 获取行业
	 * 返回的行业拥有相同的pid
	 * 返回格式为二维数组
	 * @author Cricket <cricketlong@gmail.com>
	 */
	public function getIndustries($pid = -1) {
		if($pid != -1)
			$map['pid'] = $pid;
		$data = $this->where($map)->findAll(); 
		return $data;
	}

	public function getIndustriesTree() {
		$tree = array();
		$data = $this->getIndustries();
		foreach($data as $k=>$v) {
			if($data[$k]['pid'] == '0') {
				$child = array();
				foreach($data as $kk=>$vv) {
					if($data[$kk]['pid'] == $data[$k]['industry_id']) {
						array_push($child, $data[$kk]);
					}
				}
				array_push($tree, array('industry_id'=>$data[$k]['industry_id'], 'industry_name'=>$data[$k]['industry_name'],'child'=>$child));
			}
		}
		return $tree;
	}
}
