<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">

<?php echo hook('syncMeta');?>

<?php $oneplus_seo_meta = get_seo_meta($vars,$seo); ?>
<?php if($oneplus_seo_meta['title']): ?><title><?php echo ($oneplus_seo_meta['title']); ?></title>
    <?php else: ?>
    <title><?php echo C('WEB_SITE_TITLE');?></title><?php endif; ?>
<?php if($oneplus_seo_meta['keywords']): ?><meta name="keywords" content="<?php echo ($oneplus_seo_meta['keywords']); ?>"/><?php endif; ?>
<?php if($oneplus_seo_meta['description']): ?><meta name="description" content="<?php echo ($oneplus_seo_meta['description']); ?>"/><?php endif; ?>

<!-- 为了让html5shiv生效，请将所有的CSS都添加到此处 -->
<link href="/Public/static/bootstrap/css/bootstrap.css" rel="stylesheet"/>
<link href="/Public/static/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
<link type="text/css" rel="stylesheet" href="/Public/static/qtip/jquery.qtip.css"/>
<link type="text/css" rel="stylesheet" href="/Public/Core/js/ext/toastr/toastr.min.css"/>
<link href="/Public/Core/css/oneplus.css" rel="stylesheet"/>
<link href="/Public/Core/css/layout.css" rel="stylesheet"/>
<link type="text/css" rel="stylesheet" href="/Public/Core/js/ext/magnific/magnific-popup.css"/>



<!-- 增强IE兼容性 -->
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="/Public/static/bootstrap/js/html5shiv.js"></script>
<script src="/Public/static/bootstrap/js/respond.js"></script>
<![endif]-->

<!-- jQuery库 -->
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
<!--<![endif]-->

<!--合并前的js-->
<!-- Bootstrap库 -->
<script type="text/javascript" src="/Public/static/bootstrap/js/bootstrap.min.js"></script>

<!-- 其他库-->
<script src="/Public/static/qtip/jquery.qtip.js"></script>
<script type="text/javascript" src="/Public/Core/js/ext/toastr/toastr.min.js"></script>
<script type="text/javascript" src="/Public/Core/js/ext/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/Public/static/jquery.iframe-transport.js"></script>

<script type="text/javascript" src="/Public/Core/js/ext/lazyload/lazyload.js"></script>
<script type="text/javascript" src="/Public/Core/js/ext/magnific/jquery.magnific-popup.min.js"></script>

<script type="text/javascript" src="/Public/Core/js/core.js"></script>
<!--合并前的js-->
<?php $config = api('Config/lists'); C($config); $icp=C('WEB_SITE_ICP'); $count_code=C('COUNT_CODE'); ?>
<script type="text/javascript">
    var ThinkPHP = window.Think = {
        "ROOT": "", //当前网站地址
        "APP": "", //当前项目地址
        "PUBLIC": "/Public", //项目公共目录地址
        "DEEP": "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
        "MODEL": ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
        "VAR": ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
        'URL_MODEL': "<?php echo C('URL_MODEL');?>",
        'WEIBO_ID': "<?php echo C('SHARE_WEIBO_ID');?>"
    }
</script>


<script>
    //全局内容的定义
    var _ROOT_ = "";
    var MID = "<?php echo is_login();?>";
    var MODULE_NAME="<?php echo MODULE_NAME; ?>";
    var ACTION_NAME="<?php echo ACTION_NAME; ?>";
    var initNum = "<?php echo C('WEIBO_WORDS_COUNT');?>";
</script>

<audio id="music" src="" autoplay="autoplay"></audio>
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>
</head>
<body>
	<!-- 头部 -->
	<?php if((is_login()) ): ?><div id="right_panel" class="friend_panel visible-md visible-lg" style="display: none;">
        <a class="btn-pull" onclick="show_panel()"> <img style="width: 30px" src="/Public/Core/images/friend.png"/> </i>
            <script>
                function show_panel() {
                    var $right_panel = $('#right_panel_main');
                    if ($right_panel.text()) {
                        $right_panel.load(U('Usercenter/Session/panel'));
                        $right_panel.toggle();
                    } else {
                        $right_panel.toggle();
                    }

                }
            </script>

            <i id="friend_has_new"
            <?php $map_mid=is_login(); $modelTP=D('talk_push'); $has_talk_push=$modelTP->where("(uid = ".$map_mid." and status = 1) or (uid = ".$map_mid." and status = 0)")->count(); $has_message_push=D('talk_message_push')->where("uid= ".$map_mid." and (status=1 or status=0)")->count(); if($has_talk_push || $has_message_push){ ?>
            style="display: inline-block"
            <?php } ?>
            ></i>

        </a>
        <?php if(count($currentSession) == 0): ?><div id="right_panel_main" style="display: none;">
                <div style="color: white;line-height: 500px;font-size: 16px;padding:10px;">
                    <img src="/Public/Core/images/loading.gif"/>
                </div>
            </div>
            <?php else: ?>
            <div id="right_panel_main" style="display: none;" >
                <div style="color: white;line-height: 500px;font-size: 16px;padding:10px;">
                    <img src="/Public/Core/images/loading.gif"/>
                </div>
            </div><?php endif; ?>


    </div>
    <!--开始聊天板-->
    <div id="chat_box" style="display: none" class="chat_panel weibo_post_box">
        <div class="panel_title"><img id="chat_ico" class="chat_avatar avatar-img" src="<?php echo ($friend["avatar64"]); ?>">

            <div id="chat_title" class="title pull-left text-more"></div>
            <div class="control_btns pull-right"><a><i onclick="$('#chat_box').hide();"
                                                       class="glyphicon glyphicon-minus"></i></a><!-- <a
                ><i class="glyphicon glyphicon-off"></i></a>--></div>
        </div>
        <div class="row talk-body ">
            <div id="scrollArea_chat" class="row ">
                <div id="scrollContainer_chat">
                </div>
            </div>

        </div>

        <div class="send_box">
            <input id="chat_id" type="hidden" value="0">
            <?php $talk_self=query_user(array('avatar128')); ?>
            <script>
                var myhead = "<?php echo ($talk_self["avatar128"]); ?>";
            </script>
            <textarea id="chat_content" class="form-control"></textarea>

        </div>


        <div class="row">
            <div class="col-md-6">
                <button class=" btn btn-danger" onclick="talker.exit()"
                        style="margin: 10px 10px" title="退出聊天"><i class="glyphicon glyphicon-off"></i>
                </button>
                <!--  <button class=" btn btn-success" onclick="chat_exit()"
                          style="margin: 10px 10px" title="邀请好友"><i class="glyphicon glyphicon-plus"></i>
                  </button>-->
                <a href="javascript:" onclick="insertFace($(this))"><img class="weibo_type_icon" src="/Public/static/image/bq.png"/></a>
            </div>
            <div class="col-md-6">

                <button class="pull-right btn btn-primary" onclick="talker.post_message()"
                        style="margin: 10px 10px"> 发送 Ctrl+Enter
                </button>
            </div>
            <div id="emot_content" class="emot_content" style="margin-top: -165px;margin-left: -415px;"></div>


        </div>
    </div>
    <?php else: ?>
    <div id="right_panel" class="friend_panel visible-md visible-lg" style="display: none;">
        <a class="btn-pull" onclick="toast.error('请登陆后使用好友面板。','温馨提示')"> <img style="width: 30px" src="/Public/Core/images/friend.png"/> </i>
        </a>
    </div><?php endif; ?>

<?php D('Home/Member')->need_login(); ?>
<!--[if lt IE 8]>
<div class="alert alert-danger" style="margin-bottom: 0">您正在使用 <strong>过时的</strong> 浏览器. 是时候 <a target="_blank" href="http://browsehappy.com/">更换一个更好的浏览器</a> 来提升用户体验.</div>
<![endif]-->
<div id="top_bar" class="top_bar">
    <div class="container">
        <div class="row  ">
            <?php if(is_login()): else: ?>
                <div class="col-xs-6 text-center visible-xs">
                    <a href="<?php echo U('Home/User/login');?>" style="padding-top: 10px;display: block;font-size: 16px;color: #ccc !important;">登录</a>
                </div>
                <div class="col-xs-6 text-center visible-xs">
                    <a href="<?php echo U('Home/User/register');?>" style="padding-top: 10px;display: block;font-size: 16px;color: #ccc!important;">注册</a>
                </div><?php endif; ?>
            <div class="col-md-6 col-sm-6 hidden-xs">
               <?php if(C('SHARE_WEIBO_ID') != ''): ?>分享<a class="share_weibo" id="weibo_shareBtn" target="_blank"></a>
                   <script>
                       $(function () {
                           weiboShare();//处理微博分享
                       })
                   </script><?php endif; ?>
            </div>
            <div class="col-md-6 col-xs-12  text-right top_right">
                <?php $unreadMessage=D('Common/Message')->getHaventReadMeassageAndToasted(is_login()); ?>

                <ul class="nav navbar-nav navbar-right">
                    <!-- <li>
                         &lt;!&ndash;换肤功能预留&ndash;&gt;
                        <a>换肤</a>
                        &lt;!&ndash;换肤功能预留end&ndash;&gt;
                    </li>-->
                    <!--登陆面板-->
                    <?php if(is_login()): ?><li class="dropdown op_nav_ico hidden-xs hidden-sm">
                            <div></div>
                            <a id="nav_info" class="dropdown-toggle text-left" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-bell"></span>
                                <span id="nav_bandage_count"
                                <?php if(count($unreadMessage) == 0): ?>style="display: none"<?php endif; ?>
                                class="badge pull-right"><?php echo count($unreadMessage);?></span>
                                &nbsp;
                            </a>
                            <ul class="dropdown-menu extended notification">
                                <li style="padding-left: 15px;padding-right: 15px;">
                                    <div class="row nav_info_center">
                                        <div class="col-xs-9 nav_align_left"><span
                                                id="nav_hint_count"><?php echo count($unreadMessage);?></span> 条未读
                                        </div>
                                        <div class="col-xs-3"><i onclick="setAllReaded()"
                                                                 class="set_read glyphicon glyphicon-ok"
                                                                 title="全部标为已读"></i></div>
                                    </div>
                                </li>
                                <li>
                                    <div style="position: relative;width: auto;overflow: hidden;max-height: 250px ">
                                        <ul id="nav_message" class="dropdown-menu-list scroller "
                                            style=" width: auto;">
                                            <?php if(count($unreadMessage) == 0): ?><div style="font-size: 18px;color: #ccc;font-weight: normal;text-align: center;line-height: 150px">
                                                    暂无任何消息!
                                                </div>
                                                <?php else: ?>
                                                <?php if(is_array($unreadMessage)): $i = 0; $__LIST__ = $unreadMessage;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$message): $mod = ($i % 2 );++$i;?><li>
                                                        <a data-url="<?php echo ($message["url"]); ?>"
                                                           onclick="readMessage(this,<?php echo ($message["id"]); ?>)">
                                                            <i class="glyphicon glyphicon-bell"></i>
                                                            <?php echo ($message["title"]); ?>
                                            <span class="time">
                                            <?php echo ($message["ctime"]); ?>
                                            </span>
                                                        </a>
                                                    </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>

                                        </ul>
                                    </div>
                                </li>
                                <li class="external">
                                    <a href="<?php echo U('Usercenter/Message/message');?>">
                                        消息中心 <i class="glyphicon glyphicon-circle-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a style="margin-right: 15px;" title="修改资料" href="<?php echo U('Usercenter/Config/index');?>"><i
                                    class="glyphicon glyphicon-cog"></i></a>
                        </li>
                        <li class="dropdown">
                            <?php $common_header_user = query_user(array('nickname')); ?>
                            <a role="button" class="dropdown-toggle dropdown-toggle-avatar" data-toggle="dropdown">
                                <?php echo ($common_header_user["nickname"]); ?>&nbsp;<i style="font-size: 12px"
                                                                       class="glyphicon glyphicon-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu text-left" role="menu">
                                <li><a href="<?php echo U('UserCenter/Index/index');?>"><span
                                        class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;个人主页</a>
                                </li>
                                <li><a href="<?php echo U('Usercenter/message/message');?>"><span
                                        class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;消息中心</a>
                                </li>
                                <!-- <li><a href="<?php echo U('Usercenter/Collection/index');?>"><span
                                        class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;我的收藏</a>
                                </li> -->
                                <li><a href="<?php echo U('People/Index/ranking');?>"><span
                                        class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;签到排行</a>
                                </li>
                                <li><a href="<?php echo U('Usercenter/Index/rank');?>"><span
                                        class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;我的头衔</a>
                                </li>
                                <?php echo hook('personalMenus');?>
                                <?php if(is_administrator()): ?><li><a href="<?php echo U('Admin/Index/index');?>" target="_blank"><span
                                            class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;管理后台</a></li><?php endif; ?>
                                <li><a event-node="logout"><span
                                        class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;注销</a>
                                </li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li class="hidden-xs">
                            <a href="<?php echo U('Home/User/login');?>">登录</a>
                        </li>
                        <li class="hidden-xs">
                            <a href="<?php echo U('Home/User/register');?>">注册</a>
                        </li><?php endif; ?>
                </ul>
            </div>
        </div>
    </div> 
</div>

<div id="nav_bar" class="nav_bar " >
    <nav class="container" id="nav_bar_container" role="navigation">
        <div class="collapse navbar-collapse " id="nav_bar_main">
			<ul class="nav navbar-nav " style="font-size: 16px">
				<li><a href="/" >创始网</a></li>
			</ul>
            <ul class="nav navbar-nav  navbar-right" style="font-size: 16px">
                <?php $__NAV__ = M('Channel')->field(true)->where("status=1")->order("sort")->select(); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if(($nav["pid"]) == "0"): $children=D('Channel')->where(array('pid'=>$nav['id']))->order('sort asc')->select(); if($children){ ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle nav_item" data-toggle="dropdown" href="#" style="color:<?php echo ($nav["color"]); ?>">

                                <?php echo ($nav["title"]); ?> <span class="caret"></span><?php if(($nav["band_text"]) != ""): ?><span class="badge" style="background: <?php echo ($nav["band_color"]); ?>"><?php echo ($nav["band_text"]); ?></span><?php endif; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if(is_array($children)): $i = 0; $__LIST__ = $children;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subnav): $mod = ($i % 2 );++$i;?><li role="presentation"><a role="menuitem" tabindex="-1" style="color:<?php echo ($subnav["color"]); ?>"
                                                               href="<?php echo (get_nav_url($subnav["url"])); ?>"
                                                               target="<?php if(($subnav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"><?php echo ($subnav["title"]); if(($subnav["band_text"]) != ""): ?><span class="badge" style="background: <?php echo ($subnav["band_color"]); ?>"><?php echo ($subnav["band_text"]); ?></span><?php endif; ?></a>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </li>
                        <?php }else{ ?>
                        <li class="<?php if((get_nav_active($nav["url"])) == "1"): ?>active<?php else: endif; ?>">
                            <a href="<?php echo (get_nav_url($nav["url"])); ?>"
                               target="<?php if(($nav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>" style="color:<?php echo ($nav["color"]); ?>"><?php echo ($nav["title"]); if(($nav["band_text"]) != ""): ?><span class="badge" style="background: <?php echo ($nav["band_color"]); ?>"><?php echo ($nav["band_text"]); ?></span><?php endif; ?></a>
                        </li>
                        <?php } endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>

        </div>

        <!--导航栏菜单项-->

        <div class="row visible-xs">
            <div class="navbar-header col-xs-3 pull-right text-left">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav_bar_main">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
        </div>


    </nav>
</div>
</div>
<a id="goTopBtn"></a>
	<!-- /头部 -->
	
	<!-- 主体 -->
	

<div id="main-container" class="container">
    <div class="row" >
        
<style>
    #main-container{
        width: 1080px;
    }
</style>
    <link href="/Public/Weibo/css/weibo.css" rel="stylesheet"/>
    <!--微博左侧内容列表部分-->
    <!--微博左侧内容列表部分-->
    <!--微博内容列表部分-->
    <div class="weibo_middle col-md-8">
        <?php if(is_login() && check_auth('sendWeibo')): ?><div class="weibo_content weibo_post_box">

        <p class="pull-left">
            有什么新鲜麻辣的创业事分享给大家？
        </p>
        <div class="pull-right show_num_quick">还可以输入<?php echo C('WEIBO_WORDS_COUNT');?>个字</div>
        <div class="weibo_content_p">
            <div class="row">
                <div class="col-xs-12">
                    <p><textarea class="form-control weibo_content_quick" id="weibo_content" style="height: 6em;"
                                 placeholder="写点什么吧～～" onfocus="startCheckNum_quick($(this))"
                                 onblur="endCheckNum_quick()"></textarea></p>
                    <a href="javascript:" onclick="insertFace($(this))"><img class="weibo_type_icon"
                                                                             src="/Public/static/image/bq.png"/></a>
                    <script>
                        $(function () {
                            $('.weibo_content_quick').atwho(atwho_config);
                        })
                    </script>
                    <?php echo hook('weiboType');?>
                    <p class="pull-right"><input type="submit" value="发表"
                                                 class="btn btn-primary send_weibo_button"
                                                 data-url="<?php echo U('Weibo/Index/doSend');?>"/>
                    </p>
                </div>
            </div>
            <div id="emot_content" class="emot_content"></div>
            <div id="hook_show" class="emot_content"></div>
        </div>
    </div>


    <script>
        var ID_setInterval;
        function checkNum_quick(obj) {
            var value = obj.val();
            var value_length = value.length;
            var can_in_num = initNum - value_length;
            if (can_in_num < 0) {
                value = value.substr(0, initNum);
                obj.val(value);
                can_in_num = 0;
            }
            var html = "还可以输入" + can_in_num + "个字";
            $('.show_num_quick').html(html);
        }
        function startCheckNum_quick(obj) {
            ID_setInterval = setInterval(function () {
                checkNum_quick(obj);
            }, 250);
        }
        function endCheckNum_quick() {
            clearInterval(ID_setInterval);
        }
    </script><?php endif; ?>

        <div>

            <?php echo hook('Advs', 'weibo_below_sendbox');?>
        </div>
        <!--  筛选部分-->
        <?php if(is_login()): ?><div>
                <div id="weibo_filter" style="margin-bottom: 10px">
                        <a id="all"  href="<?php echo U('Weibo/Index/index');?>">圈子动态</a>
                        <a id="concerned" href="<?php echo U('Weibo/Index/myconcerned');?>">我的关注</a>
                        <a id="topic" href="<?php echo U('Weibo/Index/topic');?>">话题讨论</a>
                        <a id="find" href="<?php echo U('Weibo/Index/find');?>">创友查找</a>
                </div>
            </div>
            <script>
                $('#weibo_filter #<?php echo ($filter_tab); ?>').addClass('active');
                /*                    $('#nav_bar_container').append( $('#weibo_filter'));*/
            </script><?php endif; ?>
        
		<div class="index_topic_type">
			<div class="row">
				<div class="col-md-12">
					<ul>
						<li <?php if(($topic_type) == "hot"): ?>class="active"<?php endif; ?>><a href="<?php echo U('',array('type'=>'hot'));?>"  >热门话题榜</a></li>
						<li <?php if(($topic_type) == "cate"): ?>class="active"<?php endif; ?> ><a href="<?php echo U('',array('type'=>'cate'));?>"  >分类</a></li>
						<li <?php if(($topic_type) == "friend"): ?>class="active"<?php endif; ?> ><a href="<?php echo U('',array('type'=>'friend'));?>"  >好友关注</a></li>
					</ul>
				</div>
			</div>
		</div>
	    <div id="index_topic_page" >
	    	<?php if(($topic_type) == "hot"): if(is_array($lists)): $k = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="row index-topic-item">
	        		<div class="col-md-3 text-left " >
	        			<a href="<?php echo U('weibo/topic/index',array('topk'=>urlencode($vo['name'])));?>" ><img src="<?php echo (get_cover($vo["logo"],'path')); ?>" width="160" height="160"></a>
	        		</div>
	        		<div class="col-md-9">
	        			<div class="row ">
	        				<div class="col-md-12 ">
	        					<div class="index-topic-title">
		        					<span class="topic-item-top">TOP<?php echo ($k); ?></span> 
		        					<span class="topic-item-name"><a href="<?php echo U('weibo/topic/index',array('topk'=>urlencode($vo['name'])));?>" >#<?php echo ($vo["name"]); ?>#</a></span>
		        					<span class="topoc-item-cate btn btn-default btn-xs"><?php echo (get_topic_cate($vo["cate_id"])); ?></span>
	        					</div>
	        					<div class="index-topic-intro">
	        						<p><?php echo ($vo["intro"]); ?></p>
	        					</div>
	        					<div class="index-topic-info">
	        						<span class="topic-item-count">阅读数：<?php echo ($vo["read_count"]); ?></span>
	        						<span class="topic-item-host">主持人：<?php echo (get_username($vo["uadmin"])); ?></span>
	        						<span class="topic-item-follow"><?php echo (get_topic_follow($vo["id"])); ?></span>
	        					</div>
	        				</div>
	        			</div>
					</div>
	        	</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	        <?php if(($topic_type) == "cate"): ?><div class="index-topic-cate-box">
	        		<a href="<?php echo U('',array('type'=>'cate'));?>" class="btn btn-default btn-sm index-topic-cate-btn <?php if(empty($cid)): ?>active<?php endif; ?>">全部</a>
	        		<?php if(is_array(C("topic_cate"))): foreach(C("topic_cate") as $k=>$vo): ?><a href="<?php echo U('',array('type'=>'cate','cid'=>$k));?>" class="btn btn-default btn-sm index-topic-cate-btn <?php if(($cid) == $k): ?>active<?php endif; ?>"><?php echo ($vo); ?></a><?php endforeach; endif; ?>
	        	</div>
	        	
	        	<?php if(is_array($lists)): $k = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="row index-topic-item">
	        		<div class="col-md-3 text-left " >
	        			<a href="<?php echo U('weibo/topic/index',array('topk'=>urlencode($vo['name'])));?>" ><img src="<?php echo (get_cover($vo["logo"],'path')); ?>" width="160" height="160"></a>
	        		</div>
	        		<div class="col-md-9">
	        			<div class="row ">
	        				<div class="col-md-9 ">
	        					<div class="index-topic-title">
		        					<span class="topic-item-top">TOP<?php echo ($k); ?></span> 
		        					<span class="topic-item-name"><a href="<?php echo U('weibo/topic/index',array('topk'=>urlencode($vo['name'])));?>" >#<?php echo ($vo["name"]); ?>#</a></span>
		        					<span class="topoc-item-cate btn btn-default btn-xs"><?php echo (get_topic_cate($vo["cate_id"])); ?></span>
	        					</div>
	        					<div class="index-topic-intro">
	        						<p><?php echo ($vo["intro"]); ?></p>
	        					</div>
	        					<div class="index-topic-info">
	        						<span class="topic-item-count">阅读数：<?php echo ($vo["read_count"]); ?></span>
	        						<span class="topic-item-host">主持人：<?php echo (get_username($vo["uadmin"])); ?></span>
	        						<span class="topic-item-follow"><?php echo (get_topic_follow($vo["id"])); ?></span>
	        					</div>
	        				</div>
	        			</div>
					</div>
	        	</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	        
	        <?php if(($topic_type) == "friend"): if(is_array($lists)): $k = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="row index-topic-item">
		        	<div class="col-md-12">
		        		<p class="index-topic-follow-lists">
			        		<span><a href="" ><img src="<?php echo get_user_avatar($vo['uid']);?>" ucard="<?php echo ($vo["uid"]); ?>" height="50px"></a></span>
			        		<span>关注了话题 <a href="<?php echo U('weibo/topic/index',array('topk'=>urlencode($vo['name'])));?>" >#<?php echo ($vo["name"]); ?>#</a></span>
			        		<span><?php echo (date('Y-m-d H:i',$vo["create_time"])); ?></span>
		        		</p>
		        	</div>
	        	</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	    </div>
    </div>

    <!--微博内容列表部分结束-->

    <!--首页右侧部分-->
    <div class="weibo_right col-md-4">

        <!--登录后显示个人区域-->
        <?php if(is_login()): ?><div ><img class="cover" src="/Public/Weibo/images/bg.jpg" style="height: 70px;width: 100%"></div>

            <div class=" user_info" style="padding: 0px;background-color: #ffffff;">

                <div class="avatar-bg">


                    <div class="headpic ">
                        <a href="<?php echo ($self["space_url"]); ?>" ucard="<?php echo ($self["uid"]); ?>"><img src="<?php echo ($self["avatar128"]); ?>"
                                                                             class="avatar-img"
                                                                             style="width:60px;"/></a>
                    </div>


                    <div class="clearfix " style="padding: 0px;margin-bottom:8px">
                        <div class="col-xs-12" style="text-align: center">
                        <span class="name_touxian">
                            <?php echo ($self["title"]); ?>
                        <a ucard="<?php echo ($self["user"]["uid"]); ?>" href="<?php echo ($self["space_url"]); ?>" class="user_name"><?php echo (htmlspecialchars($self["nickname"])); ?></a>

                             <?php if($self['rank_link'][0]['num']): if(is_array($self['rank_link'])): $i = 0; $__LIST__ = $self['rank_link'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i; if($vl['is_show']): ?><img src="<?php echo ($vl["logo_url"]); ?>" title="<?php echo ($vl["title"]); ?>"
                                              alt="<?php echo ($vl["title"]); ?>"
                                              style="width: 18px;height: 18px;vertical-align: middle;margin-left: 2px;"/><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                 <?php else: endif; ?>
                            </span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="<?php echo U('usercenter/index/applist',array('uid'=>$self['uid'],'type'=>'weibo'));?>" title="微博数"><?php echo ($self["weibocount"]); ?></a><br>微博
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="<?php echo U('usercenter/index/fans',array('uid'=>$self['uid']));?>" title="粉丝数"><?php echo ($self["fans"]); ?></a><br>粉丝
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="<?php echo U('usercenter/index/following',array('uid'=>$self['uid']));?>" title="关注数"><?php echo ($self["following"]); ?></a><br>关注
                        </div>
                    </div>

                </div>
            </div><?php endif; ?>
        <!--登录后显示个人区域部分结束-->

        <div>
            <div class="checkin">
                <?php echo hook('checkin');?>


                <?php echo hook('Rank');?>
            </div>
            <?php echo hook('weiboSide');?>
            <!--广告位-->
            <?php echo hook('Advs', 'weibo_below_checkrank');?>
            <!--广告位end-->
            <?php echo W('TopUserList/lists',array(null,'score desc','活跃用户','top'));?>
            <?php echo W('UserList/lists');?>

        </div>
    </div>
    <!--首页右侧部分结束-->



    </div>
</div>

<script type="text/javascript">
    $(function(){
        $(window).resize(function(){
            $("#main-container").css("min-height", $(window).height() - 343);
        }).resize();
    })
</script>
	<!-- /主体 -->

	<!-- 底部 -->
	<!-- 底部
================================================== -->

<div class="footer-jumbotron footer_bar">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div><h2><a href="http://www.ourstu.com" target="_blank"><?php echo C('FOOTER_TITLE');?></a></h2>

                    <p class="han_p"><?php echo C('FOOTER_SUMMARY');?>
                    </p>

                    
                </div>
            </div>
            <div class="col-md-4 text-right">
                <div class="footer_right">
                    <?php echo C('FOOTER_RIGHT');?>
                </div>
            </div>
            <!-- <div class="col-md-2">
                <?php echo C('FOOTER_QCODE');?>
            </div> -->
            
        </div>
    </div>
</div>

<div class="copyright">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<script>
			var _hmt = _hmt || [];
			(function() {
			  var hm = document.createElement("script");
			  hm.src = "//hm.baidu.com/hm.js?130837efd3f7c495b2d48b55a199b9c1";
			  var s = document.getElementsByTagName("script")[0]; 
			  s.parentNode.insertBefore(hm, s);
			})();
			</script>
			
			</div>
		 	<?php if(!empty($icp)): ?><div class="col-md-6">备案号：<a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo ($icp); ?></a>
                </div><?php endif; ?>
            <div class="col-md-6 text-right">
                <!--// 如未获得opensns官方授权，请勿删除此处的文字和链接 购买请查看 http://www.opensns.cn/fee.html -->
                <a href="http://www.opensns.cn/" target="_blank">Powered By OpenSNS</a>
                <!--// 如未获得opensns官方授权，请勿删除此处的文字和链接 购买请查看 http://www.opensns.cn/fee.html end -->
            </div>
            <div class="col-md-12">
                <?php echo ($count_code); ?>
            </div>
        </div>
	</div>
</div>

<script type="text/javascript" src="/Public/Core/js/ext/placeholder/placeholder.js"></script>
<script type="text/javascript" src="/Public/Core/js/ext/atwho/atwho.js"></script>
<link type="text/css" rel="stylesheet" href="/Public/Core/js/ext/atwho//atwho.css"/>



    <script src="/Public/Weibo/js/weibo.js"></script>
    <script>
        var SUPPORT_URL = "<?php echo addons_url('Support://Support/doSupport');?>";
        var noMoreNextPage = false;
        var isLoadingWeibo = false;
        var currentPage = '<?php echo ($page); ?>';
        var loadCount = 1;
        var lastId = '<?php echo ($lastId); ?>';
        var url = "<?php echo ($loadMoreUrl); ?>";
        $(function () {
            //当屏幕滚动到底部时

            if (currentPage == 1) {
                $(window).on('scroll', function () {
                    if (noMoreNextPage) {
                        return;
                    }
                    if (isLoadingWeibo) {
                        return;
                    }
                    if (isLoadMoreVisible()) {
                        loadNextPage();
                    }
                });
                $(window).trigger('scroll');
            }
	
            var is_follow = 0;
			$('.topic_follow').click(function (){
				var obj = $(this);
				var topic_id = obj.attr('data-id');
				var action = "<?php echo U('Topic/follow');?>";
				if(is_follow == 0){
					$.post(action,{topic_id:topic_id},function(data){
						if(data.status){
							toast.success(data.info, '温馨提示');
							obj.text('已关注');
							is_follow = 1;
						}else{
							toast.error(data.info, '温馨提示');
						}
					},'json');
				}
				
			});

        });
    </script>


 <!-- 用于加载js代码 -->
<script>
    $(function() {
        $("img.lazy").lazyload({effect: "fadeIn",threshold:200,failure_limit : 100});
    });
</script>
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
    
</div>

	<!-- /底部 -->
</body>
</html>