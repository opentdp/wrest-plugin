// @Name: 早安图片
// @Second: 0
// @Minute: 0
// @Hour: 7
// @DayOfMonth: *
// @Month: *
// @DayOfWeek: *
// @Timeout: 300
// @Content: node.exe
// @Deliver: wechat,xxx@room,wxid_xxxx

const api = 'https://api.accmu.cn/api/images_zw.php';

fetch(api).then(r => r.json()).then(data => {
    if (data.links) {
        console.log(data.links);
        return;
    }
    if (data.upload_response) {
        console.log(data.upload_response.data.links.url);
        return;
    }
});
