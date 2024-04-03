# @Roomid: *
# @Phrase: crazy_thursday
# @Level: 9
# @Target: python.exe
# @Remark: 获取疯狂星期四语录,Author: xinmouren

# Python Version >= 3.7
# pip install requests

import requests
import sys
import io


def fetch(url):
    try:
        response = requests.get(url)
        response.raise_for_status()  # 如果响应状态码不是200，将抛出HTTPError异常
        return response.text
    except requests.exceptions.HTTPError as errh:
        return "HTTP请求错误: " + str(errh)
    except requests.exceptions.ConnectionError as errc:
        return "连接错误: " + str(errc)
    except requests.exceptions.Timeout as errt:
        return "请求超时: " + str(errt)
    except requests.exceptions.RequestException as err:
        return "请求错误: " + str(err)


if __name__ == "__main__":
    sys.stdout = io.TextIOWrapper(
        sys.stdout.buffer, encoding="utf-8")  # 设置控制台按照uitf-8输出
    url = "https://jkyapi.top/API/fkxqs.php"
    send_txt_message = fetch(url)
    print(send_txt_message)
