export default (url) => {
    url && (config.url = url);
    return WrestApi;
}

const config = {
    url: 'http://127.0.0.1:7600',
};

async function httpRequest(input, options = {}) {
    const header = { 'Content-Type': 'application/json' };
    options.headers = Object.assign(header, options.headers);
    try {
        const resp = await fetch(config.url + input, options);
        if (resp.status < 200 || resp.status > 300) {
            throw new Error(resp.statusText);
        }
        const data = await resp.json();
        if (data.Message) {
            console.warn(data.Message);
        }
        if (data.Error) {
            if (data.Error.Message) {
                throw new Error(data.Error.Message);
            }
            throw data.Error;
        }
        return data.Payload;
    }
    catch (error) {
        throw error;
    }
}

const WrestApi = {
    /**
     * @summary 接受好友请求
     * @param {WcfrestAcceptNewFriendRequest} body 接受好友参数
     * @param {*} [options] Override http request option.
     */
    acceptNewFriend(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/accept_new_friend', options);
    },
    /**
     * @summary 添加群成员
     * @param {WcfrestChatroomMembersRequest} body 管理群成员参数
     * @param {*} [options] Override http request option.
     */
    addChatroomMembers(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/add_chatroom_members', options);
    },
    /**
     * @summary 获取群成员昵称
     * @param {WcfrestGetAliasInChatRoomRequest} body 获取群成员昵称参数
     * @param {*} [options] Override http request option.
     */
    aliasInChatroom(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/alias_in_chatroom', options);
    },
    /**
     * @summary 获取头像列表
     * @param {WcfrestGetAvatarsRequest} body 获取头像列表参数
     * @param {*} [options] Override http request option.
     */
    avatars(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/avatars', options);
    },
    /**
     * @summary 获取群成员列表
     * @param {WcfrestGetChatRoomMembersRequest} body 获取群成员列表参数
     * @param {*} [options] Override http request option.
     */
    chatroomMembers(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/chatroom_members', options);
    },
    /**
     * @summary 获取群列表
     * @param {unknown} [options] body 获取群列表参数
     * @param {*} [options] Override http request option.
     */
    chatrooms(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/chatrooms', options);
    },
    /**
     * @summary 获取完整通讯录
     * @param {unknown} [options] body 获取完整通讯录参数
     * @param {*} [options] Override http request option.
     */
    contacts(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/contacts', options);
    },
    /**
     * @summary 获取数据库列表
     * @param {unknown} [options] body 获取数据库列表参数
     * @param {*} [options] Override http request option.
     */
    dbNames(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/db_names', options);
    },
    /**
     * @summary 执行数据库查询
     * @param {WcfrestDbSqlQueryRequest} body 数据库查询参数
     * @param {*} [options] Override http request option.
     */
    dbQuerySql(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/db_query_sql', options);
    },
    /**
     * @summary 获取数据库表列表
     * @param {WcfrestGetDbTablesRequest} body 获取数据库表列表参数
     * @param {*} [options] Override http request option.
     */
    dbTables(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/db_tables', options);
    },
    /**
     * @summary 删除群成员
     * @param {WcfrestChatroomMembersRequest} body 管理群成员参数
     * @param {*} [options] Override http request option.
     */
    delChatroomMembers(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/del_chatroom_members', options);
    },
    /**
     * @summary 关闭推送消息到URL
     * @param {WcfrestReceiverRequest} body 推送消息到URL参数
     * @param {*} [options] Override http request option.
     */
    disableReceiver(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/disable_receiver', options);
    },
    /**
     * @summary 下载附件
     * @param {WcfrestDownloadAttachRequest} body 下载附件参数
     * @param {*} [options] Override http request option.
     */
    downloadAttach(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/download_attach', options);
    },
    /**
     * @summary 下载图片
     * @param {WcfrestDownloadImageRequest} body 下载图片参数
     * @param {*} [options] Override http request option.
     */
    downloadImage(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/download_image', options);
    },
    /**
     * @summary 开启推送消息到URL
     * @param {WcfrestReceiverRequest} body 推送消息到URL参数
     * @param {*} [options] Override http request option.
     */
    enableReceiver(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/enable_receiver', options);
    },
    /**
     * @summary 转发消息
     * @param {WcfrestForwardMsgRequest} body 转发消息参数
     * @param {*} [options] Override http request option.
     */
    forwardMsg(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/forward_msg', options);
    },
    /**
     * @summary 获取好友列表
     * @param {unknown} [options] body 获取好友列表参数
     * @param {*} [options] Override http request option.
     */
    friends(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/friends', options);
    },
    /**
     * @summary 获取语音消息
     * @param {WcfrestGetAudioMsgRequest} body 获取语音消息参数
     * @param {*} [options] Override http request option.
     */
    getAudioMsg(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/get_audio_msg', options);
    },
    /**
     * @summary 获取OCR识别结果
     * @param {WcfrestGetOcrRequest} body 获取OCR识别结果参数
     * @param {*} [options] Override http request option.
     */
    getOcrResult(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/get_ocr_result', options);
    },
    /**
     * @summary 邀请群成员
     * @param {WcfrestChatroomMembersRequest} body 管理群成员参数
     * @param {*} [options] Override http request option.
     */
    inviteChatroomMembers(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/invite_chatroom_members', options);
    },
    /**
     * @summary 检查登录状态
     * @param {unknown} [options] body 检查登录状态参数
     * @param {*} [options] Override http request option.
     */
    isLogin(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/is_login', options);
    },
    /**
     * @summary 登录二维码
     * @param {unknown} [options] body 获取登录二维码参数
     * @param {*} [options] Override http request option.
     */
    loginQr(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/login_qr', options);
    },
    /**
     * @summary 获取所有消息类型
     * @param {unknown} [options] body 获取所有消息类型参数
     * @param {*} [options] Override http request option.
     */
    msgTypes(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/msg_types', options);
    },
    /**
     * @summary 接受转账
     * @param {WcfrestReceiveTransferRequest} body 接受转账参数
     * @param {*} [options] Override http request option.
     */
    receiveTransfer(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/receive_transfer', options);
    },
    /**
     * @summary 刷新朋友圈
     * @param {WcfrestRefreshPyqRequest} body 刷新朋友圈参数
     * @param {*} [options] Override http request option.
     */
    refreshPyq(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/refresh_pyq', options);
    },
    /**
     * @summary 撤回消息
     * @param {WcfrestRevokeMsgRequest} body 撤回消息参数
     * @param {*} [options] Override http request option.
     */
    revokeMsg(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/revoke_msg', options);
    },
    /**
     * @summary 获取登录账号个人信息
     * @param {unknown} [options] body 获取数据库列表参数
     * @param {*} [options] Override http request option.
     */
    selfInfo(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/self_info', options);
    },
    /**
     * @summary 获取登录账号wxid
     * @param {unknown} [options] body 获取登录账号wxid参数
     * @param {*} [options] Override http request option.
     */
    selfWxid(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/self_wxid', options);
    },
    /**
     * @summary 发送文件消息
     * @param {WcfrestSendFileRequest} body 发送文件消息参数
     * @param {*} [options] Override http request option.
     */
    sendFile(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/send_file', options);
    },
    /**
     * @summary 发送图片消息
     * @param {WcfrestSendImgRequest} body 发送图片消息参数
     * @param {*} [options] Override http request option.
     */
    sendImg(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/send_img', options);
    },
    /**
     * @summary 拍一拍群友
     * @param {WcfrestSendPatMsgRequest} body 拍一拍群友参数
     * @param {*} [options] Override http request option.
     */
    sendPatMsg(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/send_pat_msg', options);
    },
    /**
     * @summary 发送卡片消息
     * @param {WcfrestSendRichTextRequest} body 发送卡片消息参数
     * @param {*} [options] Override http request option.
     */
    sendRichText(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/send_rich_text', options);
    },
    /**
     * @summary 发送文本消息
     * @param {WcfrestSendTxtRequest} body 发送文本消息参数
     * @param {*} [options] Override http request option.
     */
    sendTxt(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/send_txt', options);
    },
    /**
     * @summary 根据wxid获取个人信息
     * @param {WcfrestGetInfoByWxidRequest} body 根据wxid获取个人信息参数
     * @param {*} [options] Override http request option.
     */
    userInfo(body, options = {}) {
        options = { method: 'POST', body: JSON.stringify(body || {}), ...options };
        return httpRequest('/wcf/user_info', options);
    },
};
