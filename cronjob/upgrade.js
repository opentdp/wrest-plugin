// @Name: 版本升级提示
// @Second: 0
// @Minute: 0
// @Hour: 9
// @DayOfMonth: *
// @Month: *
// @DayOfWeek: *
// @Timeout: 300
// @Content: node.exe
// @Deliver: wechat,filehelper,-

const api = 'https://api.github.com/repos/opentdp/wrest-chat/releases/latest';

fetch(api).then(r => r.json()).then(data => {
    if (!data || !data.created_at) {
        return;
    }
    const now = new Date();
    const att = new Date(data.created_at);
    if (now.getTime() - att.getTime() < 86400000) {
        console.log('发现版本', data.tag_name);
        console.log('更新时间', att.toLocaleString());
        console.log('下载地址', data.assets[0].browser_download_url);
        console.log('\n【更新日志】', '\n' + data.body);
    }
});
