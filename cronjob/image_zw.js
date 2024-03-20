// @Name: Image_zw
// @Second: 0
// @Minute: 0
// @Hour: 7
// @DayOfMonth: *
// @Month: *
// @DayOfWeek: *
// @Timeout: 300
// @Content: node.exe
// @Deliver: wechat,xxx@room,wxid_xxxx

// 引入axios库

// 定义一个名为Image_zw的类
class Image_zw {
  // 定义一个静态属性apis，存储API地址
  static apis = ['https://api.accmu.cn/api/images_zw.php'];

  // 定义一个静态方法help，返回帮助信息
  static help() {
    return {
      '': '返回早晚图',
    };
  }

  // 定义一个静态方法simple，用于获取早晚图数据
  static async simple() {
    // 随机选择一个API地址
    const api = this.apis[Math.floor(Math.random() * this.apis.length)];
    try {
      // 发送GET请求获取数据
      const response = await fetch(api);
      const data = await response.json();

      // 根据返回的数据结构进行处理
      if (data.links) {
        return data.links;
      } else if (data.upload_response) {
        return data.upload_response.data.links.url;
      } else {
        return null;
      }
    } catch (error) {
      // 如果发生错误，打印错误信息并返回null
      console.error(error);
      return null;
    }
  }
}

// 导出Image_zw类
module.exports = Image_zw;

// 使用Image_zw类的simple方法获取早晚图数据，并将结果输出到控制台
(async () => {
    const result = await Image_zw.simple();
    console.log(JSON.stringify(result));
  })();
