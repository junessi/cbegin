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


    <link href="/Public/Weibo/css/topic.css" rel="stylesheet"/>
    <link href="/Public/Weibo/css/weibo.css" rel="stylesheet"/>


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
        
<div class="topics">
<div id="topic">
<div class="top-jg"></div>
<div class="top">
    <div class="data">
        <div class="fudg">
            <div class="portrait"><img
                    src="<?php if($topic["logo"] != 0): echo (getthumbimagebyid($topic["logo"],180,180)); else: ?>/Public/Weibo/images/topicavatar.png<?php endif; ?>"
                    width="180" height="180"></div>
        </div>
        <div class="fudg">
            <div class="huati">#<?php echo ($topic["name"]); ?>#</div>
            <div class="gzfx">
            	<?php if(($is_follow) == "true"): ?><a class="hjgfb public-cursor public-background hjgfb1" >已关注</a>
                <?php else: ?>
                	<a class="hjgfb public-cursor public-background hjgfb1" id="topic_sub">关注</a><?php endif; ?>
                <a class="hjgfb public-cursor" target="_blank" id="topic_shareBtn">分享</a>
                <script>
                    $(function () {
                        var wb_shareBtn = document.getElementById("topic_shareBtn")
                        wb_url = document.URL, //获取当前页面地址，也可自定义例：wb_url = "http://www.bluesdream.com"
                                wb_appkey = "",
                                wb_title = document.title,
                                wb_ralateUid = "<?php echo C('SHARE_WEIBO_ID');?>",
                                wb_pic = "",
                                wb_language = "zh_cn";
                        wb_shareBtn.setAttribute("href", "http://service.weibo.com/share/share.php?url=" + wb_url + "&appkey=" + wb_appkey + "&title=" + wb_title + "&pic=" + wb_pic + "&ralateUid=" + wb_ralateUid + "&language=" + wb_language + "");
                    })
                </script>
            </div>
        </div>
    </div>
</div>
<div class="content">
<div class="public-left conhjg">
    <div class="border line2">
        <div class="line2-lefd col-xs-4" style="width: 33%">
            <div class="numder"><?php echo ($topic["read_count"]); ?></div>
            <div class="beizu">阅读</div>
        </div>
        <div class="line2-lefd col-xs-4 text-center" style="width: 33%">
            <div class="numder"><?php echo ($total_count); ?></div>
            <div class="beizu">讨论</div>
        </div>
        <div class="line2-lefd col-xs-4 text-center" style="width: 33%">
               <div class="numder"><?php echo ((isset($total_sub) && ($total_sub !== ""))?($total_sub):0); ?></div>
               <div class="beizu">粉丝</div>
        </div>
    </div>


    <div class="border">
        <div class="recommended">
            <h4 class="name">话题主持人</h4>

            <?php if(($host["status"]) == "1"): ?><div class="original ">
                    <img name="" src="<?php echo ($host["avatar128"]); ?>" style="border-radius: 50%;" width="80" height="80">

                    <div class="jshgv">
                        <a class="named" href="<?php echo ($host["space_url"]); ?>">
                            <?php echo ($host["nickname"]); ?>
                            <?php if(is_array($host["rank_link"])): $i = 0; $__LIST__ = $host["rank_link"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rank): $mod = ($i % 2 );++$i;?><img src="<?php echo ($rank["logo_url"]); ?>" title="<?php echo ($rank["title"]); ?>" alt="<?php echo ($rank["title"]); ?>"
                                     style="width: 16px;height: 16px;vertical-align: middle;margin-left: 2px;"><?php endforeach; endif; else: echo "" ;endif; ?>
                        </a>

                        <div class="shumin">
                            <?php if($user_info['signature'] == ''): ?>还没想好O(∩_∩)O
                                <?php else: ?>
                                <attr title="<?php echo ($user_info["signature"]); ?>"><?php echo ($user_info["signature"]); ?></attr><?php endif; ?>
                        </div>
                        <?php if(is_login() && $host['uid'] != get_uid()): $host['is_following'] = D('Follow')->where(array('who_follow'=>get_uid(),'follow_who'=>$host['uid']))->find(); ?>
                            <p class="text-right">
                                <?php echo W('Common/Ufollow/render',array('is_following'=>$host['is_following'],'uid'=>$host['uid']));?></p>
                            <?php else: ?>
                            <?php if($host['uid'] == get_uid()): ?><p class="text-right"><a class="btn btn-primary" disabled="disabled">自己</a></p><?php endif; endif; ?>
                    </div>
                </div>
                <div class="margin_bottom_10"></div>
                <div class="statement">此话题为用户观点，不代表本站观点！</div><?php endif; ?>

            <?php if(($host["status"]) == "0"): ?><div class="clearfix margin_bottom_10 ">
                    <div class="col-md-4">
                        <img class="avatar-img" src="/Public/Weibo/images/nobody.jpg"/>
                    </div>
                    <div class="col-md-8">
                        <h5><a>虚位以待</a></h5>

                        <div>
                            <p>
                                <?php if(check_auth('beTopicAdmin') OR is_administrator()): ?><button class="btn btn-danger" onclick="to_be_number_one(<?php echo ($topic['id']); ?>)">抢先主持
                                    </button><?php endif; ?>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger margin_bottom_0">第一位点击主持的用户可以成为主持人。主持人可以推荐话题。</div>
                <?php else: endif; ?>
        </div>
    </div>
    <?php if($topic['qrcode'] != 0): ?><div class="border public-clear">
            <h4 class="shaoshao">话题二维码</h4>

            <div class="shayh">
                <img src="<?php echo (getthumbimagebyid($topic["qrcode"],220,220)); ?>" width="220" height="220">
            </div>
        </div><?php endif; ?>
    <?php if(check_auth('manageTopic') OR $topic['uadmin'] == get_uid()): ?><div class="common_block_border">
            <h4 class="common_block_title">管理面板</h4>

            <div class="clearfix">

                <div class="clearfix col-md-12 margin_bottom_10">
                    <form role="form" action="<?php echo U('editTopic');?>" method="post" class="ajax-form">
                        <div class="form-group">
                            <div class="margin_bottom_10">主持人设置项(以下选项仅主持人可设置)</div>
                            <input name="id" type="hidden" value="<?php echo ($topic["id"]); ?>">
                            <style>
                                .web_uploader_picture_list img {
                                    width: 180px;
                                    height: 180px;
                                    margin-top: 10px;
                                }

                                #web_uploader_picture_list_qrcode img {
                                    width: 220px;
                                    height: 220px;
                                }
                            </style>
                            <label for="avatar">话题图片(180px*180px)</label>

                            <div>
                                <?php echo W('Common/UploadImage/render',array(array('id'=>'avatar','name'=>'logo','value'=>$topic['logo'])));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qrcode">话题二维码(220px*220px)</label>

                            <div>
                                <?php echo W('Common/UploadImage/render',array(array('id'=>'qrcode','name'=>'qrcode','width'=>'100','height'=>'100','value'=>$topic['qrcode'])));?>
                            </div>

                        </div>
						
						<div class="form-group">
                            <label for="cate_id">话题分类</label>
                            <div >
                            	<?php if(is_array(C("topic_cate"))): foreach(C("topic_cate") as $k=>$vo): ?><span style="margin-right:15px;"><input type="radio" name="cate_id" value="<?php echo ($k); ?>"  <?php if(($topic["cate_id"]) == $k): ?>checked<?php endif; ?> ><?php echo ($vo); ?></span><?php endforeach; endif; ?>
                            </div>
                           
                        </div>
						

                        <div class="form-group">
                            <label for="intro">话题导语</label>
                            <textarea class="form-control" id="intro" name="intro" placeholder="输入话题导语"><?php echo ($topic['intro']); ?></textarea>
                        </div>
                        <?php if(check_auth('manageTopic')): ?><div class="margin_bottom_10">管理员设置项(以下选项仅管理员可设置)</div>
                            <div class="form-group">
                                <label for="intro">主持人UID</label>
                                <input type="text" class="form-control" id="uadmin" name="uadmin" placeholder="输入主持人的UID"
                                       value="<?php echo ($topic['uadmin']); ?>">
                            </div>
                            <div class="form-group">
                                <?php if(($topic["is_top"]) == "1"): ?><input type="checkbox" value="1" id="top" name="is_top" checked><label for="top">是否为推荐话题</label>
                                    <?php else: ?>
                                    <input type="checkbox" value="1" id="top" name="is_top"><label
                                        for="top">是否为推荐话题</label><?php endif; ?>

                            </div><?php endif; ?>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                设置
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div><?php endif; ?>
</div>
<div class="public-right coghgf ">
    <div class="batem margin_bottom_10">导语：<?php echo ((isset($topic["intro"]) && ($topic["intro"] !== ""))?($topic["intro"]):推荐话题！); ?></div>


    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$weibo): $mod = ($i % 2 );++$i; if(($weibo["topic_top"]) == "1"): ?><div class="border qwer" id="weibo_<?php echo ($weibo["id"]); ?>">
                <div style="padding:15px;position: relative;">
                    <div class="ribbion-green"></div>
                    <div style="color:#333;font-weight: 700; margin-bottom:10px">主持人推荐</div>
                    <div class="leftgh"><img src="<?php echo ($weibo["user"]["avatar64"]); ?>" width="64" height="64"></div>
                    <div class="rightjk">
                        <div class="name"><a
                                href="<?php echo ($weibo["user"]["space_url"]); ?>"><?php echo (htmlspecialchars($weibo["user"]["nickname"])); ?></a></div>
                        <div class="conner"><?php echo (parse_topic($weibo["fetchContent"])); ?></div>

                        <div class="row weibo-comment-list" style="display: none;" data-weibo-id="<?php echo ($weibo["id"]); ?>">
                            <div class="col-xs-12">
                                <div class="light-jumbotron" style="padding: 1em 2em;">
                                    <div class="weibo-comment-container">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="weibo_content_bottom row" style="margin:5px 0px;font-size: 12px;">
                            <div class="col-md-4">
                                    <span class="text-primary"><a
                                            href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['id']));?>"><?php echo (friendlydate($weibo["create_time"])); ?></a></span>
                            </div>
                            <div class="col-md-8">
                      <span class="pull-right" data-weibo-id="<?php echo ($weibo["id"]); ?>">
                      <?php $weiboCommentTotalCount = $weibo['comment_count']; ?>
                      <?php echo Hook('support',array('table'=>'weibo','row'=>$weibo['id'],'app'=>'Weibo','uid'=>$weibo['uid']));?>
<?php echo Hook('repost',array('weiboId'=>$weibo['id']));?>
<div class=" col-xs-4"style="padding: 0px"><span class="weibo-comment-link cpointer " data-weibo-id="<?php echo ($weibo["id"]); ?>">
    评论 <?php echo ($weiboCommentTotalCount); ?>
</span></div>
   </span>
                            </div>
                        </div>
                    </div>
                    <div class="public-clear"></div>
                </div>
            </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    <div class="row">
        <?php if(is_login()): if(is_login() && check_auth('sendWeibo')): ?><div class="row">
        <div class="col-xs-12">
            <div class="col-md-2 col-sm-2 col-xs-12 text-center" style="position: relative">
                <a class="s_avatar" href="<?php echo ($self["space_url"]); ?>" ucard="<?php echo ($self["uid"]); ?>">
                    <img src="<?php echo ($self["avatar128"]); ?>"
                         class="avatar-img"
                         style="width: 64px;"/>
                </a>
                <br/>

            </div>
            <div class="col-md-10 col-sm-8 col-xs-12">
                <div class="weibo_content weibo_post_box">

                    <p class="pull-left">
                        <if condition="modC('SHOW_TITLE',1)">
                            <small class="font_grey">【<?php echo ($self["title"]); ?>】</small><?php endif; ?>
                        <a ucard="<?php echo ($self["uid"]); ?>"
                           href="<?php echo ($self["space_url"]); ?>" class="user_name"> <?php echo (htmlspecialchars($self["nickname"])); ?>
                        </a>
                        <?php echo ($weibo["user"]["icons_html"]); ?>
                        <?php if(is_array($self['rank_link'])): $i = 0; $__LIST__ = $self['rank_link'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i; if($vl['is_show']): ?><img src="<?php echo ($vl["logo_url"]); ?>" title="<?php echo ($vl["title"]); ?>" alt="<?php echo ($vl["title"]); ?>"
                                     class="rank_html"/><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </p>
                    <div class="pull-right show_num_quick">还可以输入<?php echo C('WEIBO_WORDS_COUNT');?>个字</div>
                    <div class="weibo_content_p">
                        <div class="row">
                            <div class="col-xs-12">
                                <p><textarea class="form-control weibo_content_quick" id="weibo_content"
                                             style="height: 6em;"
                                             placeholder="写点什么吧～～" onfocus="startCheckNum_quick($(this))"
                                             onblur="endCheckNum_quick()">#<?php echo ($topic['name']); ?>#</textarea></p>

                                <a href="javascript:" onclick="insertFace($(this))"><img class="weibo_type_icon"
                                                                                         src="/Public/static/image/bq.png"/></a>
                                <script>
                                    $(function () {
                                        $('.weibo_content_quick').atwho(atwho_config);
                                    })
                                </script>
                                <?php echo hook('weiboType');?>
                                <p class="pull-right"><input type="submit" value="发表 Ctrl+Enter"
                                                             class="btn btn-primary send_weibo_button"
                                                             data-url="<?php echo U('Weibo/Index/doSend');?>"/>
                                </p>
                            </div>
                        </div>
                        <div id="emot_content" class="emot_content"></div>
                        <div id="hook_show" class="emot_content"></div>
                    </div>
                </div>
            </div>
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


        </if>

        <div id="weibo_list">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$weibo): $mod = ($i % 2 );++$i; echo W('WeiboDetail/detail',array('weibo'=>$weibo)); endforeach; endif; else: echo "" ;endif; ?>


<script>
    ucard();
    bindSupport();
    bind_weibo_managment();
    lastId = '<?php echo ($lastId); ?>';

    bind_weibo_popup();

    $(document).ready(function () {

        $("#weibo_<?php echo ($weibo['id']); ?> img.lazy").lazyload({effect: "fadeIn", threshold: 200, failure_limit: 100});
    });

</script>
        </div>
        <div id="load_more" class="text-center text-muted" <?php if($page != 1): ?>style="display:none"<?php endif; ?>>
        <p id="load_more_text">载入更多</p>
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
			$('#topic_sub').click(function (){
				var obj = $(this);
				var topic_id = <?php echo ($topic["id"]); ?>;
				var action = "<?php echo U('follow');?>";
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
        function to_be_number_one(tid) {
            $.post(U('weibo/topic/beadmin'),{tid:tid},function(msg){
                handleAjax(msg);
            })
        }
        
        
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