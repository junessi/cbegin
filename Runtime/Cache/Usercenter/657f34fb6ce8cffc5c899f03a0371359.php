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


<style type="text/css">
.focus-html-item {margin:4px;border:1px solid #eee;padding:5px;}
.focus_field , .focus_html {padding:15px;}
</style>


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
    <link href="/Public/Usercenter/css/center.css" type="text/css" rel="stylesheet">
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
        <div class="common_block_border">
            <div class="common_block_title text-center">
                个人设置
            </div>

            <div id="usercenter-content-td">
                <div class="container-fluid">
                    
    <script>
        function center_toggle(name) {
            var show=$('#' + name + '_panel').css('display');
            $('.center_panel').hide();
            $('.center_arrow_right').show();
            $('.center_arrow_bottom').hide()
            if(show=='none'){
                $('#' + name + '_panel').show();
                $('#' + name + '_toggle_right').hide();
                $('#' + name + '_toggle_bottom').show()
            }else{
                $('#' + name + '_toggle_right').show();
                $('#' + name + '_toggle_bottom').hide()
            }

        }
    </script>
    <div id="center">
        <div id="center_base">
            <div class="row">
                <div class="col-xs-12">
                    <h4 onclick="center_toggle('base')"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;基本资料
                        <a class="pull-right" id="toggle_base">
                            编辑
                            <i id="base_toggle_right" title="展开" class="center_arrow_right" style="display: none"></i>
                            <i id="base_toggle_bottom" title="收起" class="center_arrow_bottom"></i>
                        </a>

                    </h4>
                    <hr class="center_line"/>
                </div>
            </div>

            <div class="row center_panel" id="base_panel">
                <div class="col-md-8">
                    <form class="form-horizontal center_info ajax-form" role="form" action="<?php echo U('Usercenter/Config/index');?>" method="post">
                        <div class="form-group">
                            <label for="nickname" class="col-sm-2 control-label">昵称</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo (op_t($user["nickname"])); ?>"
                                       placeholder="昵称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">性别</label>

                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input name="sex" type="radio" value="1"
                                    <?php if(($user["sex"]) == "1"): ?>checked<?php endif; ?>
                                    > 男
                                </label>
                                <label class="radio-inline">
                                    <input name="sex" type="radio" value="2"
                                    <?php if(($user["sex"]) == "2"): ?>checked<?php endif; ?>
                                    > 女
                                </label>
                                <label class="radio-inline">
                                    <input name="sex" type="radio" value="0"
                                    <?php if(($user["sex"]) == "0"): ?>checked<?php endif; ?>
                                    > 保密
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="邮箱" name="email"
                                       value="<?php echo (htmlspecialchars($user["email"])); ?>">
                            </div>
                        </div>
						<div class="form-group position">
                            <label for="email" class="col-sm-2 control-label">所在地</label>

                            <div class="col-sm-10">
                                <?php echo hook('J_China_City',array('province'=>$user['pos_province'],'city'=>$user['pos_city'],'district'=>$user['pos_district']));?>
                            </div>
                        </div>
						<div class="form-group position">
                            <label for="email" class="col-sm-2 control-label">家乡</label>

                            <div class="col-sm-10">
                                <?php echo hook('J_China_City',array('province'=>$user['home_province'],'city'=>$user['home_city'],'district'=>$user['home_district'],'province_name'=>'home_province','city_name'=>'home_city','district_name'=>'home_district'));?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="signature" class="col-sm-2 control-label">个性签名</label>

                            <div class="col-sm-10">
                                <textarea id="signature" name="signature" class="form-control"
                                          style="width: 100%; height: 6em;resize: none"><?php echo (htmlspecialchars($user["signature"])); ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="idtag" class="col-sm-2 control-label">身份</label>

                            <div class="col-sm-3">
                                <select name="idtag" class="form-control">
                                	<?php if(is_array(C("USER_ID"))): foreach(C("USER_ID") as $k=>$vo): ?><option value="<?php echo ($k); ?>" <?php if(($user["idtag"]) == $k): ?>selected<?php endif; ?> ><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="idtag" class="col-sm-2 control-label">关注方向</label>
							
                            <div class="col-sm-3">
                                <select  class="form-control" id="focus_sel" data-focus="<?php echo ($user["focus"]); ?>">
                                	<?php if(is_array(C("PROJECT_INDUSTRY"))): foreach(C("PROJECT_INDUSTRY") as $k=>$vo): ?><option value="<?php echo ($k); ?>" class="focus_sel focus_sel_<?php echo ($k); ?>" data-focus-check-checks="" ><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>
                           	
                           	<div class="col-sm-10 col-sm-offset-2 focus_field" data-focus="<?php echo ($user["focus"]); ?>"  >
                           		
                           	</div>
                           	
                           	<div class="col-sm-10 col-sm-offset-2 focus_html" data-focus="<?php echo ($user["focus"]); ?>">
                           		
                           	</div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="center_expandinfo">
            <div class="row">
                <div class="col-xs-12">
                    <h4 onclick="center_toggle('expand')"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;扩展资料

                        <a class="pull-right" id="toggle_expand"
                                >
                            编辑
                            <i id="expand_toggle_right" title="展开" class="center_arrow_right"></i>
                            <i id="expand_toggle_bottom" title="收起" class="center_arrow_bottom"
                               style="display: none"></i>
                        </a>
                    </h4>
                    <hr class="center_line"/>
                </div>
            </div>

            <div id="expand_panel" class="center_panel" style="display: none">
                <ul class="nav nav-pills ucenter_tab">
                    <?php if(is_array($profile_group_list)): $i = 0; $__LIST__ = $profile_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><li
                        <?php if(($vl["id"]) == $profile_group_id): ?>class="active"<?php endif; ?>
                        ><a onclick="$('#expandinfo_list').load($(this).attr('url'));$('.ucenter_tab li').removeClass('active');$(this).parent().addClass('active');"
                            url="<?php echo U('UserCenter/Config/showExpandInfo',array('profile_group_id'=>$vl['id'],'uid'=>$uid));?>"><?php echo ($vl["profile_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        <div id="expandinfo_list" class="row expandinfo-list">
                            <?php if($uid == is_login()): ?><script type="text/javascript" src="/Public/Usercenter/js/expandinfo-form.js"></script>
    <form action="<?php echo U('Config/edit_expandinfo');?>" method="post" class="ajax-form">
        <input type="hidden" name="profile_group_id" value="<?php echo ($profile_group_id); ?>">
        <div>
            <?php if(is_array($info_list)): $i = 0; $__LIST__ = $info_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><dl>
                    <?php echo W('InputRender/inputRender',array($vl,'personal'));?>
                </dl><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php if($info_list != null): ?><input type="submit" value="保存" id="submit_btn"
                   class="btn btn-primary expandinfo-sumbit">
            <?php else: ?>
            <span class="expandinfo-noticeinfo">该扩展信息分组没有信息！</span><?php endif; ?>
    </form>
    <?php else: ?>
    <div>
        <?php if(is_array($info_list)): $i = 0; $__LIST__ = $info_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vll): $mod = ($i % 2 );++$i;?><dl>
                <?php echo W('InputRender/inputRender',array($vll,'other'));?>
            </dl><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php if($info_list == null): ?><span class="expandinfo-noticeinfo">该扩展信息分组没有信息！</span><?php endif; ?>
    </div><?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div id="center_avatar">
            <div class="row">
                <div class="col-xs-12">
                    <h4 onclick="center_toggle('avatar')"><i class="glyphicon glyphicon-user"></i>&nbsp;修改头像
                        <a class="pull-right" id="toggle_avatar">
                            编辑
                            <i id="avatar_toggle_right" title="展开" class="center_arrow_right"></i>
                            <i id="avatar_toggle_bottom" title="收起" class="center_arrow_bottom"
                               style="display: none"></i>
                        </a>
                    </h4>
                    <hr class="center_line"/>
                    </h4>
                </div>
            </div>
            <div id="avatar_panel" class="center_panel" style="display: none">
                

    <style>
        .jcrop-holder > div > div {
            border-radius: 50%;
        }
    </style>


    <?php $user = query_user(array('avatar128')); ?>

    <div class="row">
        <div class="col-xs-3">
            <p class="text-warning">当前头像</p>

            <p>&nbsp;</p>

            <div class="thumbnail">
                <img src="<?php echo ($user["avatar128"]); ?>" class="avatar-img"/>
            </div>
        </div>
        <div class="col-xs-3">
            &nbsp;
        </div>
        <div class="col-xs-6">
            <p class="text-warning">设置新头像</p>

            <?php if(file_exists('./api/uc_login.lock')){ include_once './api/uc_client/client.php'; $html = uc_avatar(is_login()); ?>
            <?php echo ($html); ?>
            <?php }else{ ?>

            <p class="text-muted">支持jpg，png，gif，bmp等格式，可以在大照片中裁剪比较满意的部分</p>

            <form action="<?php echo U('UserCenter/Config/doUploadAvatar');?>" id="avatar_form" method="post"
                  enctype="multipart/form-data">
                <?php if(is_ie()): ?><input type="file" class="btn btn-default" name="image"/>
                    <?php else: ?>
                    <p class="hide">
                        <input type="file" name="image"/>
                    </p>

                    <div class="btn btn-primary" id="select_file_button">选择文件</div><?php endif; ?>
                <p class="text-error" id="submitTip"></p>
            </form>
            <p id="upload_tip" class="text-danger"></p>

            <div id="uploaded_image_div" style="display: none;">
                <div class="thumbnail">
                    <img id="uploaded_image" style="width: 100%;" class="thumbnails"/>
                </div>
                <p class="text-danger" id="save_avatar_tip"></p>
                <p>
                    <a class="btn btn-primary" id="save_avatar_button" data-url="<?php echo U('UserCenter/Config/doCropAvatar');?>">选区裁剪后保存头像</a>
                </p>
            </div>

            <?php } ?>


        </div>
    </div>



    <link rel="stylesheet" type="text/css" href="/Public/static/jcrop/jquery.Jcrop.css"/>
    <script src="/Public/static/jcrop/jquery.Jcrop.js"></script>
    <script src="/Public/static/browser/jquery.browser.js"></script>
    <script>
        var temp;

        $(function () {
            var crop;
            var jcrop_api;
            //选择图片文件之后立即上传表单
            $('[name=image]').change(function () {
                $('#avatar_form').submit();
            });

            $('#avatar_form').submit(function (e) {
                e.preventDefault();

                $.ajax(this.action, {
                    files: $(":file", this),
                    iframe: true,
                    processData: false
                }).complete(function (data) {
                    var json = data.responseJSON;

                    $('#avatar_form').trigger('onJson', [json])
                });
            });

            //头像上传后显示图片内容
            $('#avatar_form').bind('onJson', function (e, json) {
                //如果发生错误，则显示错误信息
                if (!json.success) {
                    $('#upload_tip').text(json.message);
                }

                //隐藏图片上传表单
                $('#avatar_form').hide();

                //显示图片内容
                $('#uploaded_image').attr('src', json.image);
                $('#uploaded_image_div').show();

                //图片加载完之后 开启图片切割
                $('#uploaded_image').load(function () {
                    $('#uploaded_image').Jcrop({
                        aspectRatio: 1,
                        onSelect: updateCoordinate,
                        minSize: [64,64],
                        setSelect: [0,0,366,366]
                    },function(){
                        jcrop_api=this;
                        crop=jcrop_api.tellScaled();
                    });


                })
            });
            function updateCoordinate(c) {
                crop = c;
            }

            //点击选择文件按钮之后显示选择文件对话框
            $('#select_file_button').click(function () {
                $('[name=image]').trigger('click');
            });

            //点击保存头像后
            function showAvatarTip(text) {
                $('#save_avatar_tip').text(text);
            }

            $('#save_avatar_button').click(function () {
                //检查是否已经裁剪过
                if (crop.w == undefined || crop.w == 0) {
                    showAvatarTip('请先选出图片中需要的部分');
                    return;
                }

                //显示正在保存
                $(this).text('正在保存');
                $(this).addClass('disabled');

                //隐藏错误消息
                showAvatarTip('');

                //提交到服务器
                var url = $(this).attr('data-url');
                var imageWidth = $('.jcrop-holder img').width();
                var imageHeight = $('.jcrop-holder img').height();
                var crop2 = crop.x / imageWidth + ',' + crop.y / imageHeight + ',' + crop.w / imageWidth + ',' + crop.h / imageHeight;
                $.post(url, {crop: crop2}, function (a) {
                    if (a.status) {
                        if(a.url){
                            location.href = a.url;
                        }
                    } else {
                        showAvatarTip(a.info);

                        //恢复按钮
                        $('#save_avatar_button').text('保存头像');
                        $('#save_avatar_button').removeClass('disabled');
                    }
                });
            })
        })
    </script>

            </div>
        </div>


        <div id="center_password">
            <div class="row">
                <div class="col-xs-12">
                    <h4 onclick="center_toggle('password')"><i class="glyphicon glyphicon-lock"></i>&nbsp;修改密码
                        <a class="pull-right" id="toggle_password"
                                >
                            编辑
                            <i id="password_toggle_right" title="展开" class="center_arrow_right"></i>
                            <i id="password_toggle_bottom" title="收起" class="center_arrow_bottom"
                               style="display: none"></i>
                        </a>
                    </h4>
                    <hr class="center_line"/>
                    </h4>
                </div>
            </div>
            <div id="password_panel" class="center_panel" style="display: none">
                

<div class="col-md-8">
    <form id="changePasswordForm"  action="<?php echo U('UserCenter/Config/doChangePassword');?>" method="post" class="ajax-form form-horizontal">
        <div class="form-group">
            <label for="inputOldPassword" class="col-sm-2 control-label">旧密码</label>

            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputOldPassword" value="" name="old_password" placeholder="输入旧密码">
            </div>
        </div>

        <div class="form-group">
            <label for="inputNewPassword" class="col-sm-2 control-label">新密码</label>

            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputNewPassword" value="" name="new_password" placeholder="输入新密码">
            </div>
        </div>

        <div class="form-group">
            <label for="inputConfirmPassword" class="col-sm-2 control-label">确认密码</label>

            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputConfirmPassword" value="" name="confirm_password"" placeholder="输入确认密码">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <p class="text-danger" id="submitTip"></p>
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </div>
    </form>
</div>


    <script>
        //检查两次输入的密码是否一致
        $(function(){
            $('#changePasswordForm').submit(function(e){
                var newPassword = $('#inputNewPassword').val();
                var confirmPassword = $('#inputConfirmPassword').val();
                if(newPassword != confirmPassword) {
                    toast.error('两次输入的密码不一致');
                    e.stopPropagation();
                    return false;
                }
            })
        })
    </script>

            </div>
        </div>


        <?php echo hook('userConfig');?>


    </div>
<?php if(($tab) != ""): ?><script>
        $(function () {

            center_toggle("<?php echo ($tab); ?>");
            
           
        })
    </script><?php endif; ?>


                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        $(function () {
            $(window).resize(function () {
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


	<script>
        $(function () {
			
        	var focus_data ;
        	var focus_ids = $('#focus_sel').attr('data-focus');
        	var focus_ids_arr = focus_ids.split(",");
        	$.post("<?php echo U('getDirection');?>",{ids:focus_ids},function(data){
        		str = '';
        		for(var i=0;i<data.length;i++){
        			str += '<span class="focus-html-item focus-html-item-'+data[i]['id']+'">'+data[i]['title']+'<input type="hidden" name="focus[]" value="'+data[i]['id']+'" /></span>';
            	}
        		$('.focus_html').append(str);
        	},'json');
        	
        	var current_focus_sel_id;
            $('#focus_sel').bind('change',function (){
            	
    			var obj = $(this);
    			var id = obj.val();
    			current_focus_sel_id = id;
    			var focus_check_checks = $('.focus_sel_'+id).attr('data-focus-check-checks');
    			var focus_check_checks_html = '';
    			if(focus_check_checks == ""){
    				$.post("<?php echo U('Home/Project/getDirection');?>",{id:id},function(data){
    					for(var i=0;i<data.length;i++){
    						if(in_array(data[i]['id'],focus_ids_arr)){
    							focus_check_checks_html += "<input type='checkbox' value='"+data[i]['id']+"' class='focus-item focus-item-"+data[i]['id']+"' data-id='"+data[i]['id']+"' data-title='"+data[i]['title']+"' checked> "+data[i]['title']+" ";
    						}
    						else{
    							focus_check_checks_html += "<input type='checkbox' value='"+data[i]['id']+"' class='focus-item focus-item-"+data[i]['id']+"' data-id='"+data[i]['id']+"' data-title='"+data[i]['title']+"' > "+data[i]['title']+" ";
    						}
    						
    						$('.focus_field').html(focus_check_checks_html);
    						$('.focus_sel_'+id).attr({'data-focus-check-checks':focus_check_checks_html});
    						
    						focusItem();
    					}
    					
    				},'json');
    			}
    			else{
    				$('.focus_field').html(focus_check_checks);
    			}
    		}).trigger('change'); 
            
            function focusItem(){
            	$('.focus-item').click(function (){
                	var focus_id = $(this).attr('data-id');
                	var is_check = $(this).prop('checked');
                	if(is_check == true){
                		var focus_title = $('.focus-item-'+focus_id).attr('data-title');
                		var str = '<span class="focus-html-item focus-html-item-'+focus_id+'">'+focus_title+'<input type="hidden" name="focus[]" value="'+focus_id+'" /></span>';
                		if($('.focus_html').find('.focus-html-item-'+focus_id)){
                			$('.focus_html').append(str);
                		}
                		$(this).attr({'checked':''});
                	}
                	else{
                		$('.focus_html').find('.focus-html-item-'+focus_id).remove();
                		$(this).attr({'checked':false});
                	}
                	
                	var last_focus_field_html = $('.focus_field').html();
                	$('.focus_sel_'+current_focus_sel_id).attr({'data-focus-check-checks':last_focus_field_html});
                });
            }
            
            function in_array(search,array){
                for(var i in array){
                    if(array[i]==search){
                        return true;
                    }
                }
                return false;
            }
            
        })
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

<script>
    $(function () {
        var $sidebar = $('#usercenter-sidebar-td');
        var $sidebar_xs = $('#usercenter-sidebar-xs');
        var $sidebar_sm = $('#usercenter-sidebar-sm');
        var $content = $('#usercenter-content-td');

        function trigger_resp() {
            var width = $(window).width();
            if (width < 768) {
                on_xs();
            } else {
                on_sm();
            }
        }

        function on_xs() {
            $sidebar_xs.append($sidebar);
            $content.css({'padding-left': 0, 'padding-right': 0});
        }

        function on_sm() {
            $sidebar_sm.prepend($sidebar);
        }

        trigger_resp();

        $(window).resize(function () {
            trigger_resp();
        })
    })
</script>

</body>
</html>