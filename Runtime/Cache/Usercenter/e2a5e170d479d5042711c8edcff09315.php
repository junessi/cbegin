<?php if (!defined('THINK_PATH')) exit(); $currentSession=D('Common/Talk')->getCurrentSessions(); ?>
<div id="session_panel_main">
    <h2>快捷聊天</h2>
    <div class="session_spliter"></div>



    <div id="scrollArea_session" class="row ">
        <div id="scrollContainer_session">
            <ul class="friend_list">
                <?php if(is_array($currentSession)): $i = 0; $__LIST__ = $currentSession;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$session): $mod = ($i % 2 );++$i;?><li id="chat_li_<?php echo ($session["id"]); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <a title=" <?php echo (op_t($session["title"])); ?> " class="session_ico" onclick="talker.open(<?php echo ($session["id"]); ?>)">
                                    <img src="<?php echo ($session["first_user"]["avatar64"]); ?>" class="avatar-img" style="width: 50px;max-width: 200%">
                                    <?php if(($session["new"]) == "1"): ?><span class="badge_new">&nbsp;</span><?php endif; ?>
                                </a>
                            </div>
                            <div class="col-md-6" style="padding-left: 0">
                                <div>
                                    <a class="text-more " style="width: 100%" target="_blank"
                                       title="<?php echo (op_t($session["title"])); ?>" >
                                        <?php echo ($session["title"]); ?>
                                    </a>
                                </div>
                                <div>
                                    <a onclick="talker.exit(<?php echo ($session["id"]); ?>)"><i style="color: white" title="退出聊天"
                                                                             class="glyphicon glyphicon-off"></i></a>
                                </div>
                            </div>
                        </div>

                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>

    </div>
    <div class="session_more clearfix">
        <a title="聊天面板" onclick="$('#friend_panel_main').toggle();$('#session_panel_main').toggle()"
           class="btn_session_more col-md-6 active tab_chat">正在聊天</i>
        </a>
        <a title="好友面板" onclick="$('#friend_panel_main').toggle();$('#session_panel_main').toggle()"
           class="btn_session_more col-md-6 tab_friend">我的好友</i>
        </a>
    </div>

    <script>
        $('#scrollArea_session').slimScroll({
            height: '430px',
            alwaysVisible: true
        });
        var last_toast_talk_message_time = "<?php echo time();?>";//最后提示聊天消息的时间
    </script>
    <!--结束聊天版-->
</div>
<!--开始好友板-->
<div id="friend_panel_main" style="display: none">
    <?php $friends=D('Common/Follow')->getAllFriends(); ?>
    <h2>快捷聊天</h2>
    <div class="session_spliter"></div>

    <div id="scrollArea_friend" class="row ">
        <div id="scrollContainer_friend">
            <ul class="friend_list">
                <?php if(is_array($friends)): $i = 0; $__LIST__ = $friends;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$friend): $mod = ($i % 2 );++$i; $friend=query_user(array('avatar64','nickname','space_url','uid'),$friend['follow_who']) ?>
                    <li id="friends_li_<?php echo ($friend["id"]); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <a target="_blank" title=" <?php echo (op_t($friend["nickname"])); ?>"
                                   href="<?php echo ($friend["space_url"]); ?>">
                                    <img src="<?php echo ($friend["avatar64"]); ?>" class="avatar-img" style="width: 45px;">
                                </a>
                            </div>
                            <div class="col-md-6" style="padding-left: 0">
                                <div>
                                    <a class="text-center" style="width: 100%" target="_blank"
                                       title=" <?php echo (op_t($friend["nickname"])); ?>"
                                       href="<?php echo ($friend["space_url"]); ?>">
                                        <?php echo ($friend["nickname"]); ?>
                                    </a>
                                </div>
                                <div>
                                    <a onclick="talker.start_talk(<?php echo ($friend["uid"]); ?>)"><i title="发起新聊天"
                                                                              class="glyphicon glyphicon-send"></i></a>
                                </div>
                            </div>
                        </div>

                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="session_more">
        <a title="聊天面板" onclick="$('#friend_panel_main').toggle();$('#session_panel_main').toggle()"
           class="btn_session_more col-md-6 tab_chat">正在聊天</i>
        </a>
        <a title="好友面板" onclick="$('#friend_panel_main').toggle();$('#session_panel_main').toggle()"
           class="btn_session_more col-md-6 active tab_friend">我的好友</i>
        </a>
    </div>
    <script>
        $('#scrollArea_friend').slimScroll({
            height: '430px',
            alwaysVisible: true
        });
    </script>


</div>
<!--结束聊天版-->