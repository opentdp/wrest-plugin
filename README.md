# wechat-rest-plugin

此仓库为 [wechat-rest](https://github.com/opentdp/wechat-rest) 外部开放插件，欢迎大家参与，不定时更新。

## 文本返回值

此类型返回值适用于 `/api` 指令集、计划任务插件、外部指令插件，解析规则如下：

- 以 `http://` 或 `https://` 开头的返回值，则尝试作为远程资源下载，然后以图片或文件的形式发送

- 以 `card\n{name}\n{account}\n{title}\n{digest}\n{url}\n{thumburl}` 格式返回的消息，则以链接卡片的形式发送

- 不满足上面规则的情况下，将消息原样发送

## `/api` 指令集

目录 `api` 为接口指令集的后端程序，使用 PHP 开发。除支持文本返回值外，还支持返回 JSON 数据，详情参阅[自定义 API 使用说明](https://github.com/opentdp/wechat-rest/tree/master/wclient#%E8%87%AA%E5%AE%9A%E4%B9%89-api-%E4%BD%BF%E7%94%A8%E8%AF%B4%E6%98%8E)。

## 计划任务插件

目录 `cronjob` 为计划任务插件程序，每个插件一个文件，支持各类脚本语言。开发时请参阅 `cronjob/ping.js` 内的说明设置必要的参数。

## 外部指令插件

目录 `keyword` 为外部指令插件程序，每个插件一个文件，支持各类脚本语言。开发时请参阅 `keyword/ping.js` 内的说明设置必要的参数。

## 通用插件开发

通用插件使用 HTTP/Websocket 协议交互，不依赖各插件框架的能力，可以实现更底层的操作，协议请参考 [wechat-rest 开发指南](https://github.com/opentdp/wechat-rest/tree/master?tab=readme-ov-file#%E5%BC%80%E5%8F%91%E6%8C%87%E5%8D%97)。

- 目录 `dotnet` 为 .NET 插件示例

- 目录 `nodejs` 为 Node.js 插件示例

- 目录 `python` 为 Python 插件示例

## 代码提交

提交代码时请使用 `feat: something` 作为说明，支持的标识如下

- `feat` 新功能（feature）
- `fix` 错误修复
- `docs` 文档更改（documentation）
- `style` 格式（不影响代码含义的更改，空格、格式、缺少分号等）
- `refactor` 重构（即不是新功能，也不是修补bug的代码变动）
- `perf` 优化（提高性能的代码更改）
- `test` 测试（添加缺失的测试或更正现有测试）
- `chore` 构建过程或辅助工具的变动
- `revert` 还原以前的提交
