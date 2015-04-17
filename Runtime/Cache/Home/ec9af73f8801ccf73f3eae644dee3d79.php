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

<link type="text/css" rel="stylesheet" href="/Public/Home/css/project.css"/>

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
	

<div class="breadcrumbs ">
	<div class="container">
		<ul class="pull-left nav nav-pills">
		  <?php if(is_array($categoryNav)): foreach($categoryNav as $key=>$vo): ?><li role="presentation" <?php if(($currentCate["id"]) == $vo['id']): ?>class="active"<?php endif; ?> ><a href="/project/<?php echo ($vo['name']); ?>/"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; ?>
		</ul>
		<ul class="pull-right breadcrumb">
            <li><a href="/">首页</a></li>
            <li><a href="/project/">创业集结</a></li>
            <li><a href="/project/<?php echo ($category['name']); ?>/"><?php echo ($category["title"]); ?></a></li>
        </ul>
	</div>
</div>

<div id="main-container" class="container">
    <div class="row" >
        

	<div class="col-md-8 news-left">
		
		<div class="row">
		
			<div class="col-md-9">
				<div class="dropdown">
				  <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-region" data-toggle="dropdown" aria-expanded="true">
				    <?php echo ($region ? get_district_by_id($region) : '地区'); ?>
				     <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu dropdown-region-menu" role="menu" aria-labelledby="dropdown-region">
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo create_project_url('',array('region'=>'all'));?>">全部</a></li>
				    <?php $_result=get_project_region();if(is_array($_result)): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo create_project_url('',array('region'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				  </ul>
				</div>
			</div>
			
			<div class="col-md-3">
				<a href="javascript:;" class="btn btn-release" data-cate="<?php echo ($category['id']); ?>">发布项目</a>
			</div>
			
			<div class="col-md-12 ">
				<div class="sel-box">
					<div class="row sel-item">
						<div class="col-md-2 sel-item-title">项目行业</div>
						<div class="col-md-10 sel-item-lists">
							<a href="<?php echo create_project_url('',array('industry'=>'all'));?>" <?php if(empty($param["industry"])): ?>class="active"<?php endif; ?> >全部</a>
							<?php $_result=get_project_sel('industry');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo create_project_url('',array('industry'=>$vo['id']));?>" <?php if(($param["industry"]) == $vo["id"]): ?>class="active"<?php endif; ?> ><?php echo ($vo["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					
					<?php if(!empty($param["industry"])): ?><div class="row sel-item">
						<div class="col-md-2 sel-item-title">项目方向</div>
						
						<div class="col-md-10 sel-item-lists">
							<a href="<?php echo create_project_url('',array('direction'=>'all'));?>" <?php if(empty($param["direction"])): ?>class="active"<?php endif; ?> >全部</a>
							<?php $_result=get_project_tags($param['industry']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo create_project_url('',array('direction'=>$vo['id']));?>" <?php if(($param["direction"]) == $vo["id"]): ?>class="active"<?php endif; ?> ><?php echo ($vo["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
							
						</div>
					</div><?php endif; ?>
					
					<div class="row sel-item">
						<div class="col-md-2 sel-item-title">发展阶段</div>
						<div class="col-md-10 sel-item-lists">
							<a href="<?php echo create_project_url('',array('stage'=>'all'));?>" <?php if(empty($param["stage"])): ?>class="active"<?php endif; ?> >全部</a>
							<?php $_result=get_project_sel('stage');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo create_project_url('',array('stage'=>$vo['id']));?>" <?php if(($param["stage"]) == $vo["id"]): ?>class="active"<?php endif; ?> ><?php echo ($vo["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					
					<?php if(($category["id"]) == "51"): ?><div class="row sel-item">
						<div class="col-md-2 sel-item-title">投资来源</div>
						<div class="col-md-10 sel-item-lists">
							<a href="<?php echo create_project_url('',array('funds'=>'all'));?>" <?php if(empty($param["funds"])): ?>class="active"<?php endif; ?> >全部</a>
							<?php $_result=get_project_sel('funds');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo create_project_url('',array('funds'=>$vo['id']));?>" <?php if(($param["funds"]) == $vo["id"]): ?>class="active"<?php endif; ?>><?php echo ($vo["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					
					<div class="row sel-item">
						<div class="col-md-2 sel-item-title">投资额度</div>
						<div class="col-md-10 sel-item-lists">
							<a href="<?php echo create_project_url('',array('quotas'=>'all'));?>" <?php if(empty($param["quotas"])): ?>class="active"<?php endif; ?> >全部</a>
							<?php $_result=get_project_sel('quotas');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo create_project_url('',array('quotas'=>$vo['id']));?>" <?php if(($param["quotas"]) == $vo["id"]): ?>class="active"<?php endif; ?>><?php echo ($vo["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					
					<div class="row sel-item">
						<div class="col-md-2 sel-item-title">需要合伙</div>
						<div class="col-md-10 sel-item-lists">
							<a href="<?php echo create_project_url('',array('partners'=>'all'));?>" <?php if(empty($param["partners"])): ?>class="active"<?php endif; ?> >全部</a>
							<?php $_result=get_project_sel('partners');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo create_project_url('',array('partners'=>$vo['id']));?>" <?php if(($param["partners"]) == $vo["id"]): ?>class="active"<?php endif; ?> ><?php echo ($vo["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					
					<div class="row sel-item">
						<div class="col-md-2 sel-item-title">合伙方式</div>
						<div class="col-md-10 sel-item-lists">
							<a href="<?php echo create_project_url('',array('partners_mode'=>'all'));?>" <?php if(empty($param["partners_mode"])): ?>class="active"<?php endif; ?> >全部</a>
							<?php $_result=get_project_sel('partners_mode');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo create_project_url('',array('partners_mode'=>$vo['id']));?>" <?php if(($param["partners_mode"]) == $vo["id"]): ?>class="active"<?php endif; ?> ><?php echo ($vo["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div><?php endif; ?>
				</div>
			
			</div>
			
			<div class="col-md-12">
				<div class="projiect-order">
					<div class="btn-group" role="group" >
					  <button type="button" class="btn btn-default <?php if(empty($order)): ?>btn-active<?php endif; ?>"><a href="<?php echo create_project_url('',array('order'=>'all'));?>" >综合</a></button>
					  <button type="button" class="btn btn-default <?php if(($order) == "create_time"): ?>btn-active<?php endif; ?>"><a href="<?php echo create_project_url('',array('order'=>'create_time'));?>" >最新发布</a></button>
					  <button type="button" class="btn btn-default <?php if(($order) == "zan"): ?>btn-active<?php endif; ?>"><a href="<?php echo create_project_url('',array('order'=>'zan'));?>" >最受欢迎</a></button>
					  <button type="button" class="btn btn-default <?php if(($order) == "comment"): ?>btn-active<?php endif; ?>"><a href="<?php echo create_project_url('',array('order'=>'comment'));?>" >最多讨论</a></button>
					  <button type="button" class="btn btn-default <?php if(($order) == "collection"): ?>btn-active<?php endif; ?>"><a href="<?php echo create_project_url('',array('order'=>'collection'));?>" >最多关注</a></button>
					</div>
				</div>
			</div>
			
		</div>
		
		<div class="row">
		
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><div class="col-md-12  ">
					<div class="project-item-lists">
						<div class="row">
							<div class="col-md-3">
							<?php if(($category["id"]) == "51"): ?><img src="<?php echo (get_cover($vo["logo_img"],'path')); ?>" class="avatar-img" width="100%" ><?php endif; ?>
							<?php if(($category["id"]) == "52"): ?><img src="<?php echo (get_user_avatar($vo["uid"])); ?>" class="avatar-img" width="100%" ><?php endif; ?>
							</div>
							<div class="col-md-9">
								<div class="project-item-title"><a href="<?php echo U('detail?id='.$vo['id']);?>" ><?php echo ($vo["title"]); ?></a></div>
								<div class="row">
									<div class="project-item-sel-info col-md-6"><span>发布时间:</span><span class="info-detail"><?php echo (date('Y-m-d',$vo["create_time"])); ?></span> </div>
									<div class="project-item-sel-info col-md-6"><span>所属区域:</span> <span class="info-detail"><?php echo (get_district_by_id($vo["region"])); ?></span></div>
									<div class="project-item-sel-info col-md-6"><span>项目行业:</span> <span class="info-detail"><?php echo (get_project_config($vo["industry"],'industry')); ?></span></div>
									<div class="project-item-sel-info col-md-6"><span>发展阶段:</span> <span class="info-detail"><?php echo (get_project_config($vo["stage"],'stage')); ?></span> </div>
									<?php if(($category["id"]) == "51"): ?><div class="project-item-sel-info col-md-6"><span>投资额度:</span> <span class="info-detail"><?php echo (get_project_config($vo["quotas"],'quotas')); ?></span></div>
										<div class="project-item-sel-info col-md-6"><span>投资来源:</span> <span class="info-detail"><?php echo (get_project_config($vo["funds"],'funds')); ?></span></div>
										<div class="project-item-sel-info col-md-6"><span>需要合伙人:</span> <span class="info-detail"><?php echo (get_project_config($vo["partners"],'partners')); ?></span></div>
										<div class="project-item-sel-info col-md-6"><span>合作方式:</span> <span class="info-detail"><?php echo (get_project_config($vo["partners_mode"],'partners_mode')); ?></span></div><?php endif; ?>
									<?php if(($category["id"]) == "52"): ?><div class="project-item-sel-info col-md-6"><span>投资额度:</span> <span class="info-detail"><?php echo ($vo["invest_quotas"]); ?></span></div><?php endif; ?>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="project-item-descrition project-item-descrition-<?php echo ($vo["id"]); ?>">
									<span>项目描述:</span> 
									<span class="info-detail">
									<a href="<?php echo U('detail?id='.$vo['id']);?>" ><?php echo ($vo["description"]); ?></a>
									<a href="javascript:;" class="view-more" data-id="<?php echo ($vo["id"]); ?>">更多</a>
									</span>
								</div>
								<div class="project-item-content project-item-content-<?php echo ($vo["id"]); ?> hide">
									<div class="project-item-content-detail-<?php echo ($vo["id"]); ?>"></div>
									<div class="text-right"><a href="javascript:;" class="view-close" data-id="<?php echo ($vo["id"]); ?>">收起</a></div>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="project-item-social pull-left">
									<div class="btn-group" role="group" >
										<a href="<?php echo U('detail?id='.$vo['id']);?>#comment" class="btn btn-info">讨论:<em><?php echo ($vo["comment"]); ?></em></a>
										<button type="button" class="btn btn-danger do-zan" data-zan="0" data-id="<?php echo ($vo["id"]); ?>">支持:<em><?php echo ($vo["zan"]); ?></em></button>
										<button type="button" class="btn btn-warning do-collection" data-id="<?php echo ($vo["id"]); ?>">关注:<em><?php echo ($vo["collection"]); ?></em></button>
									</div>
								</div>
								<div class="project-item-more pull-right">
									<a href="<?php echo U('detail?id='.$vo['id']);?>" class="btn">查看详情</a>
								</div>
							</div>
							
						</div>
					</div>
				</div><?php endforeach; endif; ?>
		</div>
		
		<div class="page"><?php echo ($page); ?></div>
	</div>
	
	<div class="col-md-4">
		
	<div class="row">
	<?php if(is_login()): ?><div class="col-md-12">
			<div class="user-box">
				<div class="row">
					<div class="col-md-3">
						<p><img src='<?php echo ($self["avatar128"]); ?>' width="100%"></p>
						<p class="user-box-info text-center"><?php echo ($self["title"]); ?></p>
					</div>
					<div class="col-md-9 ">
						<p class="user-box-name"><a href="<?php echo U('usercenter/index/index?uid='.$self['uid']);?>" ><?php echo ($self["nickname"]); ?></a></p>
						<p class="user-box-info">注册日期：<?php echo (date('Y-m-d H:i:s',$self["reg_time"])); ?></p>
						<p class="user-box-info">上次访问：<?php echo (date('Y-m-d H:i:s',$self["last_login_time"])); ?></p>
					</div>
					
					<div class="col-md-12">
						<div class="user-box-count text-center">
							<div>
								<p>发布</p>
								<p><a href="<?php echo U('usercenter/index/project',array('uid'=>$self['uid'],'info_type'=>'release'));?>" ><?php echo ($self["project_count"]); ?></a></p>
							</div>
							<div>
								<p>关注</p>
								<p><a href="<?php echo U('usercenter/index/project',array('uid'=>$self['uid'],'info_type'=>'collection'));?>" ><?php echo ($self["project_collection"]); ?></a></p>
							</div>
							<div>
								<p>评论</p>
								<p><a href="<?php echo U('usercenter/index/project',array('uid'=>$self['uid'],'info_type'=>'comment'));?>" ><?php echo ($self["project_comment"]); ?></a></p>
							</div>
						</div>
					</div>
					
					
				</div>
			</div>
		</div><?php endif; ?>	
		<div class="col-md-12">
			<div class="right-block-title">
				<p>热门标签</p>
			</div>
			<div class="right-hot-tags">
				
				<?php $_result=get_project_tags(0);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo create_project_url('',array('direction'=>$vo['id']));?>" class="label label-default" ><?php echo ($vo["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				
			</div>
			
			<div class="clearfix"></div>
			<div class="right-block-title">
				<p>最热项目</p>
			</div>
			<div class="right-hot-project">
				<?php $_result=get_hot_project();if(is_array($_result)): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="right-hot-project-info">
						<div class="right-hot-project-avatar">
						<img src="<?php echo (get_user_avatar($vo["uid"])); ?>" width="100%" ucard="<?php echo ($vo["uid"]); ?>">
						</div>
						<div class="right-hot-project-item">
							<p><a href="<?php echo U('detail?id='.$vo['id']);?>" ><?php echo ($k); ?>.<?php echo ($vo["title"]); ?></a></p>
							
						</div>
					</div>
					
					<div class="clearfix"></div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			
			<div class="right-block-title">
				<p>感兴趣的项目</p>
			</div>
		</div>
		
	</div>


	</div>
	
	<div class="modal fade" id="myModal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">发布项目</h4>
	      </div>
	      <div class="modal-body text-center">
	      </div>
	      <div class="modal-footer">
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


<script src="/Public/Home/js/project.js"></script>
<script>
$(function (){
	$('.view-more').click(function (){
		var id = $(this).attr('data-id');
		var content = $(".project-item-content-detail-"+id).html();
		if(content == ""){
			$.post("<?php echo U('getProjectContent');?>",{id:id},function (data){
				$(".project-item-content-detail-"+id).html(data);
				$('.project-item-descrition-'+id).addClass('hide');
				$('.project-item-content-'+id).removeClass('hide');
			} ,'text');
		}
		else{
			$('.project-item-descrition-'+id).addClass('hide');
			$('.project-item-content-'+id).removeClass('hide');
		}
		
	});
	
	$('.view-close').click(function (){
		var id = $(this).attr('data-id');
		$('.project-item-descrition-'+id).removeClass('hide');
		$('.project-item-content-'+id).addClass('hide');
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