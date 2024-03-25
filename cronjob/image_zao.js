// @Name: 早安图片问候
// @Second: 0
// @Minute: 0
// @Hour: 7
// @DayOfMonth: *
// @Month: *
// @DayOfWeek: *
// @Timeout: 300
// @Content: node.exe
// @Deliver: wechat,xxx@room,wxid_xxxx

const urls = [
    'https://api.accmu.cn/api/images_zw.php'
];

const api = urls[Math.floor(Math.random() * urls.length)];

fetch(api).then(r => r.json()).then(data => {
    if (data.upload_response) {
        console.log(data.upload_response.data.links.url);
    }
});
