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
<!-- /头部 -->

<!-- 主体 -->
<div id="main-container" class="container">
    <div class="row" >
<section>

    <div class="col-xs-9 login">
        <div class="col-md-6 col-xs-12 lg_left">
            <div class="col-xs-12">
                <div class="col-xs-11 col-xs-offset-1 lg_lf_top">
                    <a href="<?php echo U('Home/Index/index');?>" title="首页" style="font-size: 18px">欢迎回到 <?php echo C('WEB_SITE');?> ！</a>
                </div>
                <div class="clearfix"></div>
                <form action="/login" method="post" class="lg_lf_form " >
                    <div class="form-group">
                        <label for="inputEmail" class=".sr-only col-xs-12"></label>

                        <div class="col-xs-12 col-xs-offset-1">
                            <input type="text" id="inputEmail" class="form-control" placeholder="请输入用户名"
                                   ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写1-16位用户名"
                                   nullmsg="请填写用户名"
                                   datatype="*1-16" value="" name="username">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class=".sr-only col-xs-12"></label>

                        <div class="col-xs-12 col-xs-offset-1">
                            <div id="password_block" class="input-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="请输入密码"
                                       errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password">

                                <div class="input-group-addon"><a style="width: 100%;height: 100%" href="javascript:void(0);" onclick="change_show(this)">show</a></div>
                            </div>
                        </div>
                        <div style="margin-left: 30px;"><a class="btn btn-link" href="<?php echo U('User/mi');?>" style="color: #848484;font-size: 12px;">忘记密码？</a></div>
                        <div class="clearfix"></div>
                    </div>
                    <?php if(C(VERIFY_OPEN) == 1 OR C(VERIFY_OPEN) == 3): ?><div class="form-group">
                            <label for="verifyCode" class=".sr-only col-xs-12" style="display: none"></label>

                            <div class="col-xs-12 col-md-5 col-xs-offset-1">
                                <input type="text" id="verifyCode" class="form-control" placeholder="验证码"
                                       errormsg="请填写验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
                            </div>
                            <div class="col-xs-12 col-md-6 lg_lf_fm_verify">
                                <img class="verifyimg reloadverify  " alt="点击切换" src="<?php echo U('verify');?>"
                                     style="cursor:pointer;max-width: 100%">
                            </div>
                            <div class="col-xs-12 Validform_checktip text-warning lg_lf_fm_tip col-xs-offset-1"></div>
                            <div class="clearfix"></div>
                        </div><?php endif; ?>
                    <div class="checkbox lg_lf_fm_checkbox col-xs-offset-1">
                        <label>
                            <input type="checkbox" name="remember" style="cursor:pointer;"> 记住登录
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right" style="margin-right: -15px;">登 录</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>

        <div class="col-md-6 col-xs-12">
            <div class="hidden-xs hidden-sm lg_center"></div>
            <div class="hidden-xs hidden-sm" style="margin: 21px 0 16px 40px;padding-top: 60px">
                <span>
                    <a class="btn btn-primary btn-lg btn-block" href="<?php echo U('Home/User/register');?>" title="" >立即注册</a></span></div>
            <div style="margin-top: 35px;">
                <?php echo hook('syncLogin');?>
            </div>
            </div>


        </div>
        <div class="col-xs-11 col-xs-offset-1 lg_middle"></div>




</section>
</div>
</div>

<script type="text/javascript" src="/Public/Core/js/ext/placeholder/placeholder.js"></script>
<script type="text/javascript" src="/Public/Core/js/ext/atwho/atwho.js"></script>
<link type="text/css" rel="stylesheet" href="/Public/Core/js/ext/atwho//atwho.css"/>
<!-- /主体 -->

<!-- 底部 -->
<!-- /底部 -->
<script type="text/javascript">

    $(document)
            .ajaxStart(function () {
                $("button:submit").addClass("log-in").attr("disabled", true);
            })
            .ajaxStop(function () {
                $("button:submit").removeClass("log-in").attr("disabled", false);
            });

    function change_show(obj){
        if($(obj).text().trim()=='show'){
            var value=$('#inputPassword').val().trim();
            var html='<input type="text" value="'+value+'" id="inputPassword" class="form-control" placeholder="请输入密码" errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password">'+
                    '<div class="input-group-addon"><a style="width: 100%;height: 100%" href="javascript:void(0);" onclick="change_show(this)">hide</a></div>';
            $('#password_block').html(html);
        }else{
            var value=$('#inputPassword').val().trim();
            var html='<input type="password" value="'+value+'" id="inputPassword" class="form-control" placeholder="请输入密码" errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password">'+
                    '<div class="input-group-addon"><a style="width: 100%;height: 100%" href="javascript:void(0);" onclick="change_show(this)">show</a></div>';
            $('#password_block').html(html);
        }
    }

    $(function () {
        $("form").submit(function () {
            var self = $(this);
            $.post(self.attr("action"), self.serialize(), success, "json");
            return false;


            function success(data) {
                if (data.status) {
                    $('body').append(data.info);
                    toast.success('欢迎回来，页面正在跳转，请稍候。', '温馨提示');
                    setTimeout(function () {
                        window.location.href = data.url;
                    }, 1500);
                } else {
                    toast.error(data.info, '温馨提示');
                    //self.find(".Validform_checktip").text(data.info);
                    //刷新验证码
                    $(".reloadverify").click();
                }
            }
        });


        var verifyimg = $(".verifyimg").attr("src");
        $(".reloadverify").click(function () {
            if (verifyimg.indexOf('?') > 0) {
                $(".verifyimg").attr("src", verifyimg + '&random=' + Math.random());
            } else {
                $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
            }
        });
    });
</script>
</body>
</html>