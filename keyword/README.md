# 外部指令插件

此目录为外部指令插件程序，每个插件一个文件，支持各类脚本语言。开发时请参阅 `ping.js` 内的说明设置必要的参数。

## 现有插件：

### [ping.js](ping.js)

外部指令插件示例，用于测试外部指令能否正常工作

### [epic.py](epic.py)

获取今日EPIC免费游戏

### [qrcode_scanner.py](qrcode_scanner.py)


<details>
  <summary>检测群聊内图片是否含有二维码，若含有返回二维码内容。  点击展开使用方法</summary>
  
<br>
在终端中运行下方命令安装所需库

```
pip install websockets opencv-python-headless pyzbar requests
```



配置参数：

| 名称            | 是否必填 | 说明                                   |
| --------------- | -------- | -------------------------------------- |
| enable_WebToken | 是       | 是否启用了web Token                    |
| WebToken        | 否       | webtoken值，enable_WebToken=True时必填 |
| admin_wxid      | 是       | 可以关闭此插件的人,填写wxid              |

使用方法：

启用：`开启检测二维码`

关闭：`关闭检测二维码`

</details>
