<?php
/**
 * 所属项目 OnePlus.
 * 开发者: 想天
 * 创建日期: 3/16/14
 * 创建时间: 10:56 PM
 * 版权所有 想天工作室(www.ourstu.com)
 */

namespace Group\Model;

use Common\Model\IMessage;
use Think\Model;

class GroupMessageModel extends Model implements IMessage
{
    /**获取聊天源，一般用于创建聊天时对顶部来源进行赋值
     * @param $message
     * @return mixed
     */
    public function getSource($message)
    {
        if ($message['apptype'] == 'reply') {
            $post = D('GroupPost')->find($message['source_id']);
            $source['source_title'] = $post['title'];
            $source['source_content'] = $post['content'];
            $source['source_url'] = U('Group/Index/detail', array('id' => $post['id']));
            $source['title'] = '基于' . $post['title'] . '的贴内对话';
        }elseif($message['apptype'] == 'lzlreply'){
            $post = D('GroupLzlReply')->find($message['find_id']);
            $source['source_title'] = '楼中楼回复';
            $source['source_content'] = $post['content'];
            $source['source_url'] = U('Group/Index/detail', array('id' => $post['id']));
            $source['title'] = '基于' . $post['title'] . '的楼中楼对话';

        }

        return $source;
    }

    /**获得查找的内容，在第一次创建聊天的时候获取第一个聊天的内容时触发
     * @param $message
     * @return mixed
     */
    public function getFindContent($message)
    {
        if ($message['apptype'] == 'reply') {
            $reply = D('GroupPostReply')->find($message['find_id']);
            return $reply['content'];
        }
    }

    /**在自己发送聊天消息的时候被触发，一般用于同步内容到对应的应用
     * @param $source_message
     * @param $talk
     * @param $content
     * @return array
     */
    public function postMessage($source_message, $talk, $content)
    {
        $lzlReplys = array();

        $uids = D('Talk')->getUids($talk['uids']);
        foreach ($uids as $uid) {
            if ($uid != is_login()) {
                $user = query_user(array('username'), $uid);
                $lzlReplys[] = D('Group/GroupLzlReply')->addLZLReply($source_message['source_id'], $source_message['find_id'], $source_message['find_id'], $uid, '回复 ' . $user['username'] . '： ' . $content, false);
            }

        }

        return $lzlReplys;
    }


}