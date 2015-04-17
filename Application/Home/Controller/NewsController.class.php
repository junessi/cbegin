<?php

namespace Home\Controller;

use Think\Page;
class NewsController extends HomeController{
	
 	/* 文档模型频道页 */
    public function index()
    {
        /* 分类信息 */
        $category = $this->category(1);
		$categoryNav = D('DocCategory')->getChildrenCate($category);
		$this->assign('categoryNav',$categoryNav);
		
        //频道页只显示模板，默认不读取任何内容
        //内容可以通过模板标签自行定制

        /* 模板赋值并渲染模板 */
        $this->assign('category', $category);
        $this->assign('pageType','all');

        $p = $_GET['page'] ? $_GET['page'] : 1;
        $this->lists(1,$p);
        
       // $this->display($category['template_index']);
    }
	
    public function _getCateNav(){
    	
    	$cate = $this->category(1);
    	$categoryNav = D('DocCategory')->getChildrenCate($cate);
    	$this->assign('categoryNav',$categoryNav);
    }
    
    public function _empty(){
    	
    	
    	$action = ACTION_NAME;
    	$map['name'] = $action;
    	$category = M('category')->where($map)->find();
    	$this->assign('currentCate',$category);
    	$this->_getCateNav();
    	
    	$p = $_GET['page'] ? $_GET['page'] : 1;
    	$this->lists($category['id'] , $p);
    	
    	
    }
    
    /* 文档模型列表页 */
    public function lists($categroy_id ,$page = 1 )
    {
        /* 分类信息 */
        $category = $this->category($categroy_id);

        /* 获取当前分类列表 */
        $Document = D('Document');
        $Category = D('DocCategory');

        $children = $Category->getChildrenId($category['id']);
        if ($children == '') {
            //获取当前分类下的文章
            $list = $Document->page($page, $category['list_row'])->lists($category['id']);
            $is_top_category = ($category['pid'] == 0);
            if (!$is_top_category) {//判断是否是顶级分类，如果是顶级，就算没有子分类，也不获取同级
                //如果是不是顶级分类
                $children = $Category->getSameLevel($category['id']);
                $this->setCurrent($category['pid']);
                $this->assign('children_cates', $children);
            } else {
                //如果是顶级分类
                $this->setCurrent($category['id']);
            }

			$count = $Document->listCount($category['id']);
			$listRow = $category['list_row'] ? $category['list_row'] : 10;
			$Page = new Page($count , $listRow);
			$show = $Page->show();
			
        } else {
            //如果还有子分类
            //分割分类
            $children = explode(',', $children);
            //将当前分类的文章和子分类的文章混合到一起
            $cates = $children;
            array_push($cates, $category['id']);
            $list = $Document->page($page, $category['list_row'])->lists(implode(',', $cates));
            //dump($children);exit;
            //得到子分类的目录
            foreach ($children as &$child) {
                $child = $Category->info($child);
            }
            unset($child);
            $this->setCurrent($category['id']);
            $this->assign('children_cates', $children);
            
            $count = $Document->listCount(implode(',', $cates));
            $listRow = $category['list_row'] ? $category['list_row'] : 10; 
            $Page = new Page($count , $listRow);
            $show = $Page->show();
        }


        if (false === $list) {
            $this->error('获取列表数据失败！');
        }


        /* 模板赋值并渲染模板 */
        $this->assign('category', $category);
        $this->setTitle('{$category.title|op_t}');
        $this->assign('list', $list);
        $this->assign('page',$show);
        
        if (is_login()){
        	$this->assignSelf();
        }
        $category['template_lists'] = $category['template_lists'] ? $category['template_lists'] : 'lists';
        $this->display($category['template_lists']);
    }

    /* 文档模型详情页 */
    public function detail($id = 0, $p = 1)
    {
        /* 标识正确性检测 */
        if (!($id && is_numeric($id))) {
            $this->error('文档ID错误！');
        }

        /* 页码检测 */
        $p = intval($p);
        $p = empty($p) ? 1 : $p;

        /* 获取详细信息 */
        $Document = D('Document');
        $info = $Document->detail($id);
        if (!$info) {
            $this->error($Document->getError());
        }

        /* 分类信息 */
        $category = $this->category($info['category_id']);

        /* 获取模板 */
        if (!empty($info['template'])) { //已定制模板
            $tmpl = $info['template'];
        } elseif (!empty($category['template_detail'])) { //分类已定制模板
            $tmpl = $category['template_detail'];
        } else { //使用默认模板
            $tmpl = 'detail';
        }

        /* 更新浏览数 */
        $map = array('id' => $id);
        $Document->where($map)->setInc('view');
        
        /* 分类信息 */
        $this->_getCateNav();

        /* 模板赋值并渲染模板 */
        $this->assign('category', $category);
        $this->assign('currentCate',$category);
        $this->assign('info', $info);
        $this->assign('page', $p); //页码
        $this->assign('uid',is_login() ? is_login() :0);
        $this->setTitle('{$info.title} —— 资讯');
        
        if (is_login()){
        	$this->assignSelf();
        }
		
        $this->display($tmpl);
    }

    /* 文档分类检测 */
    private function category($id = 0)
    {
        /* 标识正确性检测 */
        $id = $id ? $id : I('get.category', 0);
        if (empty($id)) {
            $this->error('没有指定文档分类！');
        }

        $categoryModel = new \Blog\Model\DocCategoryModel();
        /* 获取分类信息 */
        $category = D('Blog/DocCategory')->info($id);
        if ($category && 1 == $category['status']) {
            switch ($category['display']) {
                case 0:
                    $this->error('该分类禁止显示！');
                    break;
                //TODO: 更多分类显示状态判断
                default:
                    return $category;
            }
        } else {
            $this->error('分类不存在或被禁用！');
        }
    }

    /**
     * @param $category
     * @auth 陈一枭
     */
    private function setCurrent($category_id)
    {
        $this->assign('current', $category_id);
    }
	
    /**
     * 发布新闻
     * @author CC
     */
    public function release(){
    	
    	if (!is_login()){
    		$this->redirect('user/login','',3,'您还未登陆，请先登录');
    	}
    	else{
    		if (IS_POST){
    			
    			$data = $_POST;
    			$_POST['type'] = 2;
    			$_POST['model_id'] = 2;
    			$_POST['description'] = str_replace("&nbsp;", "", msubstr(strip_tags($data['content']), 0,80));
    			
    			$Document = D('Document');
    			$rs = $Document->update();
    			if ($rs){
    				
    				//发送成功，记录动作，更新最后发送时间
    				$tox_money_before = getMyToxMoney();
    				$score_increase = action_log_and_get_score('add_news', 'News', $rs, is_login());
    				$tox_money_after = getMyToxMoney();
    				$message = '发布资讯成功。' . getScoreTip(0, $score_increase) . getToxMoneyTip($tox_money_before, $tox_money_after);
    				
    				$this->success($message,'/news/');
    				
    			}
    			else{
    				$this->error('发布资讯失败');
    			}
    			//$rs = $Document->add($data);
    			//dump($Document->getError());
    		}
    		else{
    			
    			/* 分类信息 */
    			$this->_getCateNav();
    			
    			if (is_login()){
    				$this->assignSelf();
    			}
    			
    			$this->setTitle('发布资讯');
    			$this->display();
    		}
    	}
    }
    
    /**
     * 检测是否可以发布资讯
     */
    public function checkRelease(){
    	
    	if (IS_AJAX){
    		
    		if (!is_login()){
    			$this->error('未登录，请登录后发布资讯');
    			
    		}
    		else{
    			$this->success('',U('release'));
    			
    		}
    	}
    }
    
    /* 点赞 */
    public function doZan(){
    	
    	if(IS_AJAX){
    		$ip = get_client_ip(1);
    		$id = $_POST['id'];
    		
    		if (cookie('news_zan_'.$ip."_".$id) == true){
    			$this->error('您已经点赞过');
    		}
    		
    		$rs = M('Document')->where('id='.$id)->setInc('zan',1);
    		
    		if ($rs){
    			cookie('news_zan_'.$ip."_".$id , true ,24 * 3600);
    			$this->success('点赞成功');
    		}
    		else{
    			$this->error('点赞失败');
    		}
    	}
    	else{
    		
    	}
    }
    
    /* 收藏 */
    public function doCollect(){
    	
    	if (IS_AJAX){
    		if (!is_login()){
    			$this->error('登陆后才可以收藏');
    		} 
    		else {
    			$map['uid'] = is_login();
    			$map['document_id'] = $_POST['id'];
    			
    			$rs = M('DocumentCollection')->where($map)->find();
    			
    			if ($rs){
    				$this->error('您已经收藏过了');
    			}
    			else{
    				$data = $map;
    				$data['create_time'] = time();
    				$res = M('DocumentCollection')->add($data);
    				
    				if ($res){
    					M('Document')->where('id='.$_POST['id'])->setInc('collection',1);
    					$this->success('收藏成功');
    				}
    				else{
    					$this->error('收藏失败');
    				}
    			}
    		}
    	}
    }

    
    private function assignSelf()
    {
    	$self = query_user(array('title', 'avatar128', 'nickname', 'uid', 'space_url', 'icons_html', 'score', 'title', 'reg_time','last_login_time','news_count','news_collection','news_comment'));
    	$this->assign('self', $self);
    }
}