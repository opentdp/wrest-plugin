// @Name: Image_wan
// @Second: 0
// @Minute: 0
// @Hour: 21
// @DayOfMonth: *
// @Month: *
// @DayOfWeek: *
// @Timeout: 300
// @Content: node.exe
// @Deliver: wechat,xxx@room,wxid_xxxx
const Image_zw = require('./image_zw');

(async () => {
  const result = await Image_zw.simple();
  console.log(JSON.stringify(result));
})();