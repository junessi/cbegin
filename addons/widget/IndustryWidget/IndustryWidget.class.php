<?php
/**
 * 行业选择 widget
 * @example W('Industry',array('level0'=>10,'level1'=>20,'tpl'=>'selectIndustry'))
 * @author Cricket <cricketlong@gmail.com>
 */
class IndustryWidget extends Widget {
	public function render($data) {
		
		$list = model('Industry')->getIndustriesTree();
		$data['tree'] = json_encode($list);
		$content = $this->renderFile (dirname(__FILE__)."/".$data['tpl'].'.html', $data );
		return $content;
	}
}
