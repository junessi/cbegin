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


    <link href="/Public/Usercenter/css/usercenter.css" rel="stylesheet" type="text/css"/>


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
        
    <div class="col-md-12 usercenter">
        <div class="uc">
                <div class="uc_top_bg">
        <img class="img-responsive" src="/Public/Usercenter/images/fractional.png" style="display: none">
    </div>
    <div class="row uc_info">
        <div class="col-md-3 col-xs-4">
            <dl>
                <dt>
                    <a href="<?php echo ($user_info["space_url"]); ?>" title="">
                        <img src="<?php echo ($user_info["avatar128"]); ?>" class="avatar-img img-responsive top_img"/>
                    </a>
                </dt>
                <dd>
                    <div>
                        <div class="col-xs-4 text-center">
                            <a href="<?php echo U('Weibo/Index/index',array('uid'=>$user_info['uid']));?>"
                               title="微博数"><?php echo ($user_info["weibocount"]); ?></a><br>微博
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="<?php echo U('Usercenter/Index/fans',array('uid'=>$user_info['uid']));?>" title="粉丝数"><?php echo ($user_info["fans"]); ?></a><br>粉丝
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="<?php echo U('Usercenter/Index/following',array('uid'=>$user_info['uid']));?>" title="关注数"><?php echo ($user_info["following"]); ?></a><br>关注
                        </div>
                    </div>
                </dd>
            </dl>
        </div>
        <div class="col-md-6 col-xs-8">
            <div class="uc_main_info">
                <div class="uc_m_t_12 uc_m_b_12 uc_uname">
                <span>
                    <a ucard="<?php echo ($user_info["uid"]); ?>" href="<?php echo ($user_info["space_url"]); ?>" title=""><?php echo (htmlspecialchars($user_info["nickname"])); ?></a>
                </span>
                    <span>
                <?php if($user_info['rank_link'][0]['num']): if(is_array($user_info['rank_link'])): $i = 0; $__LIST__ = $user_info['rank_link'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><img src="<?php echo ($vl["logo_url"]); ?>" title="<?php echo ($vl["title"]); ?>" alt="<?php echo ($vl["title"]); ?>"
                                 style="width: 18px;height: 18px;vertical-align: middle;margin-left: 2px;"/><?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </span>
                </div>
                <div class="uc_m_b_12 text-more" style="width: 100%">个性签名：<span>
                <?php if($user_info['signature'] == ''): ?>还没想好O(∩_∩)O
                    <?php else: ?>
                    <attr title="<?php echo ($user_info["signature"]); ?>"><?php echo ($user_info["signature"]); ?></attr><?php endif; ?>
            </span></div>
                <div class="uc_m_b_12">
                <span class="uc_m_r_36">积分：<?php echo ($user_info["score"]); ?>&nbsp;&nbsp;
                </span>
                </div>
                <div class="uc_m_b_12"><span>等级：<?php echo ($user_info["title"]); ?></span></div>
            </div>
        </div>
        <?php if(is_login() && $user_info['uid'] != get_uid()): ?><div class="col-md-3 col-xs-12">
                <div class="uc_follow">
                    <?php $user_info['is_following'] = D('Follow')->where(array('who_follow'=>get_uid(),'follow_who'=>$user_info['uid']))->find(); ?>
                    <?php echo W('Common/Ufollow/render',array('is_following'=>$user_info['is_following'],'uid'=>$user_info['uid']));?>
                </div>
            </div><?php endif; ?>
    </div>
            <?php if(ACTION_NAME=='information'){ $tabClass['user_data'] = 'uc_current'; } elseif(ACTION_NAME=='fans'||ACTION_NAME=='following'){ $tabClass['user_fans'] = 'uc_current'; } elseif(ACTION_NAME=='project'){ $tabClass['user_project'] = 'uc_current'; } elseif(ACTION_NAME=='news'){ $tabClass['user_news'] = 'uc_current'; } elseif(ACTION_NAME=='rankverify'||ACTION_NAME=='rank'||ACTION_NAME=='rankverifyfailure'||ACTION_NAME=='rankverifywait'){ $tabClass['user_rank'] = 'uc_current'; } else{ $tabClass[$type] = 'uc_current'; } ?>
<nav class="navbar navbar-default uc_navbar" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <?php if(is_array($appArr)): $i = 0; $__LIST__ = $appArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('appList',array('type'=>$key,'uid'=>$uid));?>"  class="<?php echo ($tabClass[$key]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            <li>
            	<a href="<?php echo U('project',array('uid'=>$uid));?>" class="<?php echo ($tabClass["user_project"]); ?>">项目</a>
            </li>
            <li>
            	<a href="<?php echo U('news',array('uid'=>$uid));?>" class="<?php echo ($tabClass["user_news"]); ?>">资讯</a>
            </li>
            <li>
                <a href="<?php echo U('information',array('uid'=>$uid));?>" class="<?php echo ($tabClass["user_data"]); ?>">资料</a>
            </li>
            <li>
                <a href="<?php echo U('rank',array('uid'=>$uid));?>" class="<?php echo ($tabClass["user_rank"]); ?>">头衔</a>
            </li>
            <li>
                <a href="<?php echo U('following',array('uid'=>$uid));?>" class="<?php echo ($tabClass["user_fans"]); ?>">关注/粉丝</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

            <div class="row uc_content">
                <div class="col-md-7 col-xs-12">
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-xs-12 uc_information" style="margin-left: 10px;">
                            <ul class="nav nav-pills ucenter-tab">
                                <li>
                                    <a href="<?php echo U('Usercenter/Index/project',array('uid'=>$uid,'info_type'=>'release'));?>"
                                    <?php if(($info_type) == "release"): ?>class="uc_current"<?php endif; ?>
                                    ><?php if($uid == is_login()): ?>我<?php else: ?>Ta<?php endif; ?>发布的项目</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Usercenter/Index/project',array('uid'=>$uid,'info_type'=>'collection'));?>"
                                    <?php if(($info_type) == "collection"): ?>class="uc_current"<?php endif; ?>
                                    ><?php if($uid == is_login()): ?>我<?php else: ?>Ta<?php endif; ?>关注的项目</a>
                               </li>
                               <li>
                                    <a href="<?php echo U('Usercenter/Index/project',array('uid'=>$uid,'info_type'=>'comment'));?>"
                                    <?php if(($info_type) == "comment"): ?>class="uc_current"<?php endif; ?>
                                    ><?php if($uid == is_login()): ?>我<?php else: ?>Ta<?php endif; ?>评论的项目</a>
                               </li>
                            </ul>

                        </div>
                    </div>
                    <div class="row uc_project">
                    	<?php if(($info_type) == "release"): if(is_array($lists)): foreach($lists as $key=>$vo): ?><div class="col-xs-12">
	                       			<p class="h3"><a href="<?php echo U('Home/project/detail?id='.$vo['id']);?>" ><?php echo ($vo["title"]); ?></a></p>
	                       			<p ><a href="<?php echo U('Home/project/detail?id='.$vo['id']);?>" ><?php echo ($vo["description"]); ?></a></p>
	                       			<p class="pull-left"><?php echo (date("Y-m-d H:i",$vo["create_time"])); ?> </p>
	                       			<p class="pull-right"><?php if(($vo["status"]) == "1"): ?>通过审核<?php endif; if(($vo["status"]) == "2"): ?>审核中<?php endif; if(($vo["status"]) == "-1"): ?>未通过审核<?php endif; ?></p>
	                       		</div><?php endforeach; endif; ?>
	                       	<div class="col-xs-12"><?php echo ($page); ?></div><?php endif; ?>
	                    <?php if(($info_type) == "collection"): if(is_array($lists)): foreach($lists as $key=>$vo): ?><div class="col-xs-12">
	                       			<p class="h3"><a href="<?php echo U('Home/project/detail?id='.$vo['id']);?>" ><?php echo ($vo["title"]); ?></a></p>
	                       			<p ><a href="<?php echo U('Home/project/detail?id='.$vo['id']);?>" ><?php echo ($vo["description"]); ?></a></p>
	                       			<p class="pull-left">关注时间 ：<?php echo (date("Y-m-d H:i",$vo["collection_time"])); ?> </p>
	                       		</div><?php endforeach; endif; ?>
	                       	<div class="col-xs-12"><?php echo ($page); ?></div><?php endif; ?>
	                    <?php if(($info_type) == "comment"): if(is_array($lists)): foreach($lists as $key=>$vo): ?><div class="col-xs-12">
	                       			<p class="h5">评论内容：<a href="<?php echo U('Home/project/detail?id='.$vo['row_id']);?>#comment" ><?php echo ($vo["content"]); ?></a></p>
	                       			<p class="pull-left">评论时间 ：<?php echo (date("Y-m-d H:i",$vo["create_time"])); ?> </p>
	                       			<p class="pull-right">评论给 ：<a href="<?php echo U('Home/project/detail?id='.$vo['row_id']);?>" ><?php echo ($vo["title"]); ?></a></p>
	                       		</div><?php endforeach; endif; ?>
	                       	<div class="col-xs-12"><?php echo ($page); ?></div><?php endif; ?>
                    </div>
                    
                    
                </div>
                <div class="col-md-5 col-sm-9 col-xs-12 uc_other_link">
                    <div>
    <div class="uc_link_block clearfix col-xs-12">
        <div class="uc_link_top clearfix">
            <div class="uc_title">
                <?php if($uid == is_login()): ?>我<?php else: ?>TA<?php endif; ?>的关注(<?php echo ((isset($follow_totalCount) && ($follow_totalCount !== ""))?($follow_totalCount):0); ?>)
            </div>
            <div class="uc_fl_right uc_more_link"><a href="<?php echo U('following',array('uid'=>$uid));?>">更多</a></div>
        </div>
        <div class="col-md-12 uc_link_info">
            <?php if(is_array($follow_default)): $i = 0; $__LIST__ = $follow_default;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fl): $mod = ($i % 2 );++$i;?><div class="col-sm-3 col-xs-4">
                    <dl>
                        <a href="<?php echo ($fl["user"]["space_url"]); ?>">
                            <dt><img ucard="<?php echo ($fl["user"]["uid"]); ?>" src="<?php echo ($fl["user"]["avatar64"]); ?>" class="avatar-img img-responsive">
                            </dt>
                            <dd ucard="<?php echo ($fl["user"]["uid"]); ?>" class="text-more" style="width: 100%"><?php echo ($fl["user"]["nickname"]); ?></dd>
                        </a>
                    </dl>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php if(count($follow_default) == 0): ?><p style="text-align: center; font-size: 24px;">
                <br><br>
                暂无关注任何人哦～
                <br><br><br>
            </p><?php endif; ?>
        </div>

    </div>
    <div class="uc_link_block clearfix col-xs-12" style="margin-top: 10px;">
        <div class="uc_link_top clearfix">
            <div class="uc_title">
                <?php if($uid == is_login()): ?>我<?php else: ?>TA<?php endif; ?>的粉丝(<?php echo ((isset($fans_totalCount) && ($fans_totalCount !== ""))?($fans_totalCount):0); ?>)
            </div>
            <div class="uc_fl_right uc_more_link"><a href="<?php echo U('fans',array('uid'=>$uid));?>">更多</a></div>
        </div>
        <div class="col-md-12 uc_link_info">
            <?php if(is_array($fans_default)): $i = 0; $__LIST__ = $fans_default;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fs): $mod = ($i % 2 );++$i;?><div class="col-sm-3 col-xs-4">
                    <dl>
                        <a href="<?php echo ($fs["user"]["space_url"]); ?>">
                            <dt><img ucard="<?php echo ($fs["user"]["uid"]); ?>" src="<?php echo ($fs["user"]["avatar64"]); ?>" class="avatar-img img-responsive">
                            </dt>
                            <dd ucard="<?php echo ($fs["user"]["uid"]); ?>" class="text-more" style="width: 100%"><?php echo ($fs["user"]["nickname"]); ?></dd>
                        </a>
                    </dl>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php if(count($fans_default) == 0): ?><p style="text-align: center; font-size: 24px;">
                <br><br>
                暂无粉丝哦～
                <br><br><br>
            </p><?php endif; ?>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>

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