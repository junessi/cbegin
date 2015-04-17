<?php
/**
 * Created by PhpStorm.
 * User: caipeichao
 * Date: 14-3-10
 * Time: PM9:14
 */

namespace Weibo\Controller;

use Think\Controller;
use Think\Hook;
use Weibo\Api\WeiboApi;
use Think\Exception;
use Common\Exception\ApiException;
use Think\Page;

class IndexController extends Controller
{
    /**
     * 业务逻辑都放在 WeiboApi 中
     * @var
     */
    private $weiboApi;

    public function _initialize()
    {
        $this->weiboApi = new WeiboApi();
    }

    public function index($uid = 0, $page = 1, $lastId = 0)
    {
        $page = intval($page);
        //载入第一页微博
        if ($uid != 0) {
            $result = $this->weiboApi->listAllWeibo($page, 30, array('uid' => $uid), 1, $lastId);
        } else {
            $result = $this->weiboApi->listAllWeibo($page, 30, '', 1, $lastId);
        }
        //显示页面
        $this->assign('list', $result['list']);
        $this->assign('lastId', $result['lastId']);
        $this->assign('page', $page);
        $this->assign('tab', 'all');
        $this->assign('loadMoreUrl', U('loadweibo', array('uid' => $uid)));
        $total_count = $this->weiboApi->listAllWeiboCount();

        $this->assign('total_count', $total_count['total_count']);

        $this->assign('tox_money_name', getToxMoneyName());
        $this->assign('tox_money', getMyToxMoney());
        $this->setTitle('全站关注——微博');
        $this->assign('filter_tab', 'all');
        $this->assignSelf();
        $this->display();
    }
	
    public function topic(){
    	
    	$type = $_GET['type'] ? $_GET['type'] : 'hot';
    	$this->assign('topic_type',$type);
    	if ($type == "hot"){
    		$lists = $this->getHotTopic();
    		$this->assign('lists',$lists);
    		
    	}
    	if ($type == "cate"){
    		$cid = $_GET['cid'] ? $_GET['cid'] : null;
    		$this->assign('cid',$cid);
    		$lists = $this->getHotTopic($cid);
    		$this->assign('lists',$lists);
    	}
    	
    	if ($type == 'friend'){
    		$firends = D('Follow')->getAllFriends();
    		foreach ($firends as $v){
    			$uids[] = $v['follow_who'];
    			
    		}
    		$uids = implode(",", $uids);
    		$map['uid'] = array('in' , $uids);
    		$table = C('DB_PREFIX')."topic_sub a ,".C('DB_PREFIX')."topic b";
    		$where = "a.topic_id = b.id and a.uid in ({$uids}) and b.status=1";
    		$order = "a.create_time desc";
    		$fields = "a.id,a.topic_id,a.uid,b.name,a.create_time,b.status";
    		$lists = M()->table($table)->where($where)->order($order)->field($fields)->limit(0,10)->select();
    		$this->assign("lists",$lists);
    		
    		
    	}
    	
    	$this->assignSelf();
    	$this->assign('filter_tab','topic');
    	$this->display();
    }
    
    public function find(){
    	$this->assignSelf();
    	$this->assign('filter_tab','find');
    	
    	$data = $_GET;
    	if (!empty($data['name'])){
    		$map['nickname'] = array('like' , "%".$data['name']."%");
    	}
    	if ($data['sex']){
    		$map['sex'] = $data['sex'];
    	}
    	if ($data['pos_province']){
    		$map['pos_province'] = $data['pos_province'];
    	}
    	if ($data['pos_city']){
    		$map['pos_city'] = $data['pos_city'];
    	}
    	if ($data['pos_district']){
    		$map['pos_district'] = $data['pos_district'];
    	}
    	if ($data['home_province']){
    		 $map['home_province'] = $data['home_province'];
    	}
    	if ($data['home_provice']){
    		$map['home_provice'] = $data['home_provice'];
    	}
    	if ($data['home_district']){
    		$map['home_district'] = $data['home_district'];
    	}
    	
    	if ($data['focus']){
    		$map['focus'] = array('like' , "%".$data['focus']."%");
    	}
    	
    	$this->assign('info',$data);
    	$map['status'] = 1;
    	$M = M('Member');

    	$p = $_GET['page'];
    	$pagesize = 10;
    	
    	$lists = $M->where($map)->page($p,$pagesize)->select();
    	$this->assign('lists',$lists);
    	
    	$count = $M->where($map)->count();
    	$page = new Page($count , $pagesize);
    	$show = $page->show();
    	$this->assign('s_page',$show);
    	
    	$this->display();
    }
    
    public function search($uid = 0, $page = 1, $lastId = 0)
    {
        $keywords = op_t($_REQUEST['keywords']);
        if (!isset($keywords)) {
            $keywords = '';
        }
        //载入第一页微博
        if ($uid != 0) {
            $result = $this->weiboApi->listAllWeibo($page, null, array('uid' => $uid), 1, $lastId, $keywords);
        } else {
            $result = $this->weiboApi->listAllWeibo($page, 0, '', 1, $lastId, $keywords);
        }
        //显示页面
        $this->assign('list', $result['list']);
        $this->assign('lastId', $result['lastId']);
        $this->assign('page', $page);
        $this->assign('tab', 'all');
        $this->assign('loadMoreUrl', U('loadWeibo', array('uid' => $uid, 'keywords' => $keywords)));
        if (isset($keywords) && $keywords != '') {
            $map['content'] = array('like', "%{$keywords}%");
        }
        $total_count = $this->weiboApi->listAllWeiboCount($map);

        $this->assign('key_words', $keywords);
        $this->assign('total_count', $total_count['total_count']);

        $this->assign('tox_money_name', getToxMoneyName());
        $this->assign('tox_money', getMyToxMoney());
        $this->setTitle('全站搜索微博');
        $this->assign('filter_tab', 'all');
        $this->assignSelf();
        $this->display();
    }

    public function myconcerned($uid = 0, $page = 1, $lastId = 0)
    {
        if ($page == 1) {
            $result = $this->weiboApi->listMyFollowingWeibo($page, null, '', 1, $lastId);
            $this->assign('lastId', $result['lastId']);
            $this->assign('list', $result['list']);
        }
        //载入我关注的微博


        $total_count = $this->weiboApi->listMyFollowingWeiboCount($page, 0, '', 1, $lastId);
        $this->assign('total_count', $total_count['total_count']);

        $this->assign('page', $page);

        //显示页面


        $this->assign('tab', 'concerned');
        $this->assign('loadMoreUrl', U('loadConcernedWeibo'));

        $this->assignSelf();
        $this->setTitle('我关注的——微博');
        $this->assign('filter_tab', 'concerned');


        $this->assign('tox_money_name', getToxMoneyName());
        $this->assign('tox_money', getMyToxMoney());
        $this->display('index');
    }

    public function weiboDetail($id)
    {
        //读取微博详情
        $result = $this->weiboApi->getWeiboDetail($id);

        //显示页面
        $this->assign('weibo', $result['weibo']);
        $this->assignSelf();
        $this->setTitle('{$weibo.content|op_t}——微博详情');

        $this->display();
    }

    public function sendrepost($sourseId, $weiboId)
    {


        $result = $this->weiboApi->getWeiboDetail($sourseId);
        $this->assign('soueseWeibo', $result['weibo']);

        if ($sourseId != $weiboId) {
            $weibo1 = $this->weiboApi->getWeiboDetail($weiboId);
            $weiboContent = '//@' . $weibo1['weibo']['user']['nickname'] . ' ：' . $weibo1['weibo']['content'];

        }
        $this->assign('weiboId', $weiboId);
        $this->assign('weiboContent', $weiboContent);
        $this->assign('sourseId', $sourseId);

        $this->display();
    }

    public function doSendRepost($content, $type, $sourseId, $weiboId, $becomment)
    {
        $feed_data = '';
        $sourse = $this->weiboApi->getWeiboDetail($sourseId);
        $sourseweibo = $sourse['weibo'];
        $feed_data['sourse'] = $sourseweibo;
        $feed_data['sourseId'] = $sourseId;

        Hook('beforeSendRepost', array('content' => &$content, 'type' => &$type, 'feed_data' => &$feed_data));

        //发送微博
        $result = $this->weiboApi->sendWeibo($content, $type, $feed_data);
        if ($result) {
            D('weibo')->where('id=' . $sourseId)->setInc('repost_count');
            $weiboId != $sourseId && D('weibo')->where('id=' . $weiboId)->setInc('repost_count');
            S('weibo_' . $weiboId, null);
            S('weibo_' . $sourseId, null);
        }

        $user = query_user(array('nickname'), is_login());
        $toUid = D('weibo')->where(array('id' => $weiboId))->getField('uid');
        D('Common/Message')->sendMessage($toUid, $user['nickname'] . '转发了您的微博！', '转发提醒', U('Weibo/Index/weiboDetail', array('id' => $result['weibo_id'])), is_login(), 1);


        if ($becomment == 'true') {
            $this->weiboApi->sendRepostComment($weiboId, $content);
        }

        $weibo = $this->weiboApi->getWeiboDetail($result['weibo_id']);

        $result['html'] = R('WeiboDetail/weibo_html', array('weibo' => $weibo['weibo']), 'Widget');
        //返回成功结果
        $this->ajaxReturn(apiToAjax($result));
    }

    public function loadweibo($page = 1, $uid = 0, $loadCount = 1, $lastId = 0, $keywords = '')
    {
        $count = 30;
        //载入全站微博
        if ($uid != 0) {
            $result = $this->weiboApi->listAllWeibo($page, $count, array('uid' => $uid), $loadCount, $lastId, $keywords);
        } else {
            $result = $this->weiboApi->listAllWeibo($page, $count, '', $loadCount, $lastId, $keywords);
        }
        //如果没有微博，则返回错误
        if (!$result['list']) {
            $this->error('没有更多了');
        }

        //返回html代码用于ajax显示
        $this->assign('list', $result['list']);
        $this->assign('lastId', $result['lastId']);
        $this->display();
    }

    public function loadConcernedWeibo($page = 1, $loadCount = 1, $lastId = 0)
    {

        $count = 30;
        //载入我关注的人的微博
        $result = $this->weiboApi->listMyFollowingWeibo($page, $count, '', $loadCount, $lastId);

        //如果没有微博，则返回错误
        if (!$result['list']) {
            $this->error('没有更多了');
        }

        //返回html代码用于ajax显示
        $this->assign('list', $result['list']);
        $this->assign('lastId', $result['lastId']);
        $this->display('loadweibo');
    }

    public function doSend($content, $type = 'feed', $attach_ids = '')
    {
        if (!check_auth('sendWeibo')) {
            $this->error('您无微博发布权限。');
        }
        $feed_data = '';
        $feed_data['attach_ids'] = $attach_ids;

        Hook('beforeSendWeibo', array('content' => &$content, 'type' => &$type, 'feed_data' => &$feed_data));

        //发送微博
        $result = $this->weiboApi->sendWeibo($content, $type, $feed_data);

        $weibo = $this->weiboApi->getWeiboDetail($result['weibo_id']);

        $result['html'] = R('WeiboDetail/weibo_html', array('weibo' => $weibo['weibo']), 'Widget');


        //返回成功结果
        $this->ajaxReturn(apiToAjax($result));
    }

    public function settop($weibo_id)
    {
        $weibo_id = intval($weibo_id);
        if (is_administrator() || check_auth('setWeiboTop')) {
            $weiboModel = D('Weibo');
            $weibo = $weiboModel->find($weibo_id);
            if (!$weibo) {
                $this->error('置顶失败，微博不能存在。');
            }
            if ($weibo['is_top'] == 0) {
                if ($weiboModel->where(array('id' => $weibo_id))->setField('is_top', 1)) {
                    S('weibo_' . $weibo_id, null);
                    $this->success('置顶成功。');
                } else {
                    $this->error('置顶失败。');
                };
            } else {
                if ($weiboModel->where(array('id' => $weibo_id))->setField('is_top', 0)) {
                    S('weibo_' . $weibo_id, null);
                    $this->success('取消置顶成功。');
                } else {
                    $this->error('取消置顶失败。');
                };
            }
        } else {
            $this->error('置顶失败，您不具备管理权限。');
        }
    }

    public function doComment($weibo_id, $content, $comment_id = 0)
    {
        //发送评论
        $result = $this->weiboApi->sendComment($weibo_id, $content, $comment_id);

        //返回成功结果
        $this->ajaxReturn(apiToAjax($result));
    }

    public function loadComment($weibo_id)
    {
        //读取数据库中全部的评论列表
        // $result = $this->weiboApi->listComment($weibo_id, 1, 10000);
        //$list = $result['list'];
        $weiboCommentTotalCount = D('WeiboComment')->where(array('weibo_id' => intval($weibo_id), 'status' => 1))->count();
        //$weiboCommentTotalCount = count($list);

        $result1 = $this->weiboApi->listComment($weibo_id, 1, 5);
        $list1 = $result1['list'];
        //返回html代码用于ajax显示
        $this->assign('list', $list1);
        $this->assign('weiboId', $weibo_id);
        $weobo = $this->weiboApi->getWeiboDetail($weibo_id);
        $this->assign('weibo', $weobo['weibo']);
        $this->assign('weiboCommentTotalCount', $weiboCommentTotalCount);
        $this->display();
    }

    public function commentlist($weibo_id, $page = 1)
    {

        $result = $this->weiboApi->listComment($weibo_id, $page, 10000);
        $list = $result['list'];
        $this->assign('list', $list);
        $this->assign('weiboId', $weibo_id);
        $html = $this->fetch('commentlist');
        $this->ajaxReturn($html);
        dump($html);

    }

    public function doDelWeibo($weibo_id = 0)
    {
        //删除微博
        $result = $this->weiboApi->deleteWeibo($weibo_id);

        //返回成功信息
        $this->ajaxReturn(apiToAjax($result));
    }

    public function doDelComment($comment_id = 0)
    {
        //删除评论
        $result = $this->weiboApi->deleteComment($comment_id);

        //返回成功信息
        $this->ajaxReturn(apiToAjax($result));
    }

    public function atWhoJson()
    {
        exit(json_encode($this->getAtWhoUsersCached()));
    }


    private function getAtWhoUsers()
    {
        //获取能AT的人，UID列表
        $uid = get_uid();
        $follows = D('Follow')->where(array('who_follow' => $uid, 'follow_who' => $uid, '_logic' => 'or'))->limit(999)->select();
        $uids = array();
        foreach ($follows as &$e) {
            $uids[] = $e['who_follow'];
            $uids[] = $e['follow_who'];
        }
        unset($e);
        $uids = array_unique($uids);

        //加入拼音检索
        $users = array();
        foreach ($uids as $uid) {
            $user = query_user(array('nickname', 'id', 'avatar32'), $uid);
            $user['search_key'] = $user['nickname'] . D('PinYin')->Pinyin($user['nickname']);
            $users[] = $user;
        }

        //返回at用户列表
        return $users;
    }

    private function getAtWhoUsersCached()
    {
        $cacheKey = 'weibo_at_who_users_' . get_uid();
        $atusers = S($cacheKey);
        if (empty($atusers)) {
            $atusers = $this->getAtWhoUsers();
            S($cacheKey, $atusers, 600);
        }
        return $atusers;
    }

    private function assignSelf()
    {
        $self = query_user(array('title', 'avatar128', 'nickname', 'uid', 'space_url', 'icons_html', 'score', 'title', 'fans', 'following', 'weibocount', 'rank_link'));
        $this->assign('self', $self);
    }
    
    private function getHotTopic($cid = null){
    	
    	$rank= $cid ? S('topic_rank_cid_'.$cid) : S('topic_rank');
    	if(empty($rank)){
    		$where['is_top'] = 1;
    		$where['status'] = 1;
    		if ($cid){
    			$where['cate_id'] = $cid;
    		}
    		$retopic = D('Topic')->where($where)->order('read_count desc')->limit(10)->select();
    		foreach($retopic as $key=>$val){
    			$retopic[$key]['reCount'] =  D('Weibo')->where("`content` LIKE  '%#".$val['name']."#%' and status = 1 ")->count();
    		}
    		$rank=$retopic;
    		if ($cid){
    			S('topic_rank',$rank,60);
    		}
    		else{
    			S('topic_rank_cid_'.$cid,$rank,60);
    		}
    		
    	}
    	
    	return $rank;
    }
}