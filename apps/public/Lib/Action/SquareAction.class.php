<?php 
class SquareAction extends Action{

	public function _initialize(){
		header("Content-Type:text/html; charset=UTF8");
	}

	//全站微博
	public function index(){		
		$map['count'] = 2;
		$result = api('WeiboStatuses')->data($map)->public_timeline();
		dump($result);
		
	}

	//频道微博
	public function channel(){
		$map['category_id'] = intval($_GET['cid']);
		$map['count'] = 2;
		//$map['page'] = 2;
		$result = api('Channel')->data($map)->get_channel_feed();
		//dump(M()->getLastSql());
		dump($result);
	}

	//话题微博
	public function topic(){
		$topic = 'test';
		$feed_ids = model('FeedTopic')->getFeedIdByTopic($topic);
		$result = model('Feed')->getFeeds($feed_ids);
		dump($result);
	}
}