<?php
/*
 * @Date: 2024-04-12 10:01:42
 * @LastEditTime: 2024-04-12 10:41:43
 * @Description: 
 */
require_once __DIR__ . '/vendor/autoload.php';

use Spatie\Async\Pool;

$data = file_get_contents('php://input');
$wfbot = json_decode($data, true);
$pool = Pool::create();

// 进行消息类型判断
if ($wfbot['id']) {
    if ($wfbot['is_self']) {
        // 消息来自自己，忽略
    } elseif (isset($wfbot['is_group'], $wfbot['roomid']) && $wfbot['is_group'] === true) {
        // 群聊消息
        handleGroupMessage($wfbot, $pool);
    } elseif (isset($wfbot['id']) && !isset($wfbot['is_group']) && !isset($wfbot['roomid'])) {
        // 私聊消息
        handlePrivateMessage($wfbot, $pool);
    }
}

// 处理群聊消息
function handleGroupMessage($wfbot, $pool)
{
    $pool->add(function () use ($wfbot) {
        sendChatRequest('/send_txt', [
            'msg' =>  '这是回复群聊小程序消息',
            'receiver' => $wfbot['roomid'],
        ]);
    });
}

// 处理私聊消息
function handlePrivateMessage($wfbot, $pool)
{

    $pool->add(function () use ($wfbot) {
        sendChatRequest('/send_txt', [
            'msg' =>  '这是回复私聊小程序消息',
            'receiver' => $wfbot['sender'],
        ]);
    });
}



// 完成处理所有异步任务
$pool->wait();

function sendChatRequest($endpoint, $data, $apiUrl = 'http://127.0.0.1:7600/wcf')
{
    $url = $apiUrl . $endpoint;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
