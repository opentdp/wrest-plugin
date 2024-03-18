# wechat-rest-plugin

此仓库为 [wechat-rest](https://github.com/opentdp/wechat-rest) 外部开放插件，欢迎大家参与，不定时更新。

## 通用返回值

- `网络文件` 以 `http://` 或 `https://` 开头，则自动下载后，以图片或文件的形式发送

- `卡片消息` 以 `card\n{name}\n{account}\n{title}\n{digest}\n{url}\n{thumburl}` 格式返回的消息，将以链接卡片的像是发送

- `文本消息` 不满足上面规则的情况下，将消息原样发送

## `/api` 指令集

目录 `api` 为接口指令集的后端程序，使用 PHP 开发。除支持通用返回值外，还支持返回 JSON 数据，详情参阅[自定义 API 使用说明](https://github.com/opentdp/wechat-rest/tree/master/wclient#%E8%87%AA%E5%AE%9A%E4%B9%89-api-%E4%BD%BF%E7%94%A8%E8%AF%B4%E6%98%8E)。

## 计划任务插件

目录 `cronjob` 为计划任务插件程序，每个插件一个文件，支持各类脚本语言。开发时请参阅 `cronjob/ping.js` 内的说明设置必要的参数。

## 外部指令插件

目录 `keyword` 为外部指令插件程序，每个插件一个文件，支持各类脚本语言。开发时请参阅 `keyword/ping.js` 内的说明设置必要的参数。

## 通用客户端开发

客户端使用 HTTP/Websocket 协议交互，不依赖各插件的能力，可以实现更底层的操作，协议请参考 [wechat-rest 开发指南](https://github.com/opentdp/wechat-rest/tree/master?tab=readme-ov-file#%E5%BC%80%E5%8F%91%E6%8C%87%E5%8D%97)。

- 目录 `dotnet` 为 .NET 客户端示例

- 目录 `nodejs` 为 Node.js 客户端示例

- 目录 `python` 为 Python 客户端示例
