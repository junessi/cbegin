<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>创始网</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <link rel="alternate icon" type="image/png" href="">
  <link rel="stylesheet" href="/Public/static/amazeui/css/amazeui.min.css"/>
  <link rel="stylesheet" href="/Public/Home/css/index.css" />
  <style>
      </style>
</head>
<body>
<header class="am-topbar am-topbar-fixed-top">
  <div class="am-container">
    <h1 class="am-topbar-brand">
      <a href="/">CBEGIN</a>
    </h1>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only"
            data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">导航切换</span> <span
        class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="collapse-head">
      <ul class="am-nav am-nav-pills am-topbar-nav">
        <li><a href="/">首页</a></li>
        <li><a href="/weibo/">创业圈</a></li>
        <li><a href="/project/" >创业集结</a></li>
        <li><a href="/news/" >创业资讯</a></li>
      </ul>
		
	<?php if(is_login()): ?><div class="am-topbar-right">
        	<a class="am-btn am-topbar-btn am-btn-sm" href="<?php echo U('UserCenter/Index/index');?>"><span class="am-icon-user"></span> 个人中心</a>
      	</div>
	<?php else: ?>
	  <div class="am-topbar-right">
        <a class="am-btn am-btn-danger am-topbar-btn am-btn-sm" href="<?php echo U('Home/User/register');?>"><span class="am-icon-pencil"></span> 注册</a>
      </div>

      <div class="am-topbar-right">
        <a class="am-btn am-btn-success am-topbar-btn am-btn-sm" href="<?php echo U('Home/User/login');?>"><span class="am-icon-user"></span> 登录</a>
      </div><?php endif; ?>
      
    </div>
  </div>
</header>

<div class="get">
  <div class="am-g">
    <div class="am-u-lg-12">
      <h1 class="get-title">CBegin - 创始网</h1>

      <p>
        创业社交平台
      </p>

      <p>
      "让天下没有难创的业"
      </p>
    </div>
  </div>
</div>
<div class="weibo">
	<div class="am-g am-container">
		<h2 class="detail-h2">我们的愿景：成为全球范围内连接每一个泛创业者的平台，构建一个完善的创业生态系统</h2>
		
		<ul class="am-comments-list ">
		
		<?php if(is_array($weibos)): foreach($weibos as $k=>$vo): ?><li class="am-comment  am-comment-success <?php if(($k%2) == 1): ?>am-comment-flip<?php endif; ?>">
		  	<a href="">
    			<img src="<?php echo (get_user_avatar($vo["uid"])); ?>" alt="" class="am-comment-avatar" width="100" height="100"/>
  			</a>
  			
  			<div class="am-comment-main">
			    <header class="am-comment-hd">
			      <div class="am-comment-meta">
			        <a href="" class="am-comment-author"><?php echo (get_username($vo["uid"])); ?></a>
			        发表于 <time datetime="" title=""><?php echo (date('Y-m-d H:i',$vo["create_time"])); ?></time>
			      </div>
			    </header>
			
			    <div class="am-comment-bd">
			      <?php echo ($vo["content"]); ?>
			    </div>
			  </div>

		  </li><?php endforeach; endif; ?>
		  
		</ul>

		
	</div>
	<div></div>
</div>

<div class="hope">
  <div class="am-g am-container">
    
    <div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
      <h2 class="hope-title">加入我们</h2>

      <p>
        帮助每一个愿意通过自己的努力，获取成功的创业者。
      </p>
    </div>
    
    <div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-img">
      <img src="/Public/static/amazeui/i/examples/landing.png" alt="" data-am-scrollspy="{animation:'slide-left', repeat: false}">
      <hr class="am-article-divider am-show-sm-only hope-hr">
    </div>
    
  </div>
</div>


<div class="detail">
  <div class="am-g am-container">
    <div class="am-u-lg-12">
      <h2 class="detail-h2">你可以在这里召唤合伙人</h2>

      <div class="am-g">
	    
	    <?php if(is_array($projects)): foreach($projects as $key=>$vo): ?><div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">

          <h3 class="detail-h3">
            <a href="<?php echo U('project/detail?id='.$vo['id']);?>"><?php echo ($vo["title"]); ?></a>
          </h3>

          <p class="detail-p index-por-des"><a href="<?php echo U('project/detail?id='.$vo['id']);?>"><?php echo ($vo["description"]); ?></a>
          </p>
          
          <p>
          	<span class="am-badge"><?php echo (get_project_config($vo["industry"],'industry')); ?></span>
          </p>
        </div><?php endforeach; endif; ?> 
       
        
        <div class="am-u-lg-12 am-text-center">
        	<a href="/project/" class="am-btn am-btn-success am-btn-lg">寻找更多</a>
        </div>
        
      </div>
    </div>
  </div>
</div>

<div class="hope">
  <div class="am-g am-container">
    <div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-img">
      <img src="/Public/static/amazeui/i/examples/landing.png" alt="" data-am-scrollspy="{animation:'slide-left', repeat: false}">
      <hr class="am-article-divider am-show-sm-only hope-hr">
    </div>
    <div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
      <h2 class="hope-title">同我们一起打造一个开放的创业平台</h2>

      <p>
        在信息爆炸的年代，我们不愿成为信息海洋的过客，发挥社区的力量，在这创业环境最好的年代里，参与到创业的浪潮中去。
      </p>
    </div>
  </div>
</div>

<div class="about">
  <div class="am-g am-container">
    <div class="am-u-lg-12">
      <h2 class="about-title about-color">Cbegin 开放、自由 、分享 、参与</h2>

      <div class="am-g">
        <div class="am-u-lg-6 am-u-md-6 am-u-sm-12">
          <ul class="am-list am-list-static am-list-border index-news-ul">
          	<?php if(is_array($news)): $i = 0; $__LIST__ = array_slice($news,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
    			<h3><a href="<?php echo U('news/detail?id='.$vo['id']);?>" ><?php echo ($vo["title"]); ?></a></h3>
    			<p class="index-news-des"><a href="<?php echo U('news/detail?id='.$vo['id']);?>" ><?php echo ($vo["description"]); ?></a></p>
    			<p class="am-text-right"><time><?php echo (date('Y-m-d',$vo["create_time"])); ?></time></p>
   			 </li><?php endforeach; endif; else: echo "" ;endif; ?>
   			 
 		  </ul>
          <hr class="am-article-divider am-show-sm-only">
        </div>

        <div class="am-u-lg-6 am-u-md-6 am-u-sm-12">
          <ul class="am-list am-list-static am-list-border index-news-ul">
          	<?php if(is_array($news)): $i = 0; $__LIST__ = array_slice($news,5,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
    			<h3><a href="<?php echo U('news/detail?id='.$vo['id']);?>" ><?php echo ($vo["title"]); ?></a></h3>
    			<p class="index-news-des"><a href="<?php echo U('news/detail?id='.$vo['id']);?>" ><?php echo ($vo["description"]); ?></a></p>
    			<p class="am-text-right"><time><?php echo (date('Y-m-d',$vo["create_time"])); ?></time></p>
   			 </li><?php endforeach; endif; else: echo "" ;endif; ?>
   			 
 		  </ul>
          <hr class="am-article-divider am-show-sm-only">
        </div>

      </div>
    </div>
  </div>
</div>

<footer class="footer">
  <p>© 2015 <a href="http://www.cbegin.com/">www.cbegin.com</a>创始网 <a
      href="http://www.miitbeian.gov.cn/" target="_blank">备案号 : 皖ICP备15001636号-1</a></p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="/Public/static/amazeui/js/polyfill/rem.min.js"></script>
<script src="/Public/static/amazeui/js/polyfill/respond.min.js"></script>
<script src="/Public/static/amazeui/js/amazeui.legacy.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/Public/static/amazeui/js/jquery.min.js"></script>
<script src="/Public/static/amazeui/js/amazeui.min.js"></script>
<!--<![endif]-->
</body>
</html>