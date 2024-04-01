# @Roomid: *
# @Phrase: 开启检测二维码
# @Level: 9
# @Target: python.exe
# @Remark: 检测图片消息中的二维码,Author:tan90@tdp

# 请注意，此插件一旦开启则全局可用,Python Version >= 3.7
# pip install websockets opencv-python-headless pyzbar requests
import asyncio
import time
import websockets
import cv2
from pyzbar.pyzbar import decode
import requests
import json

# YourWebToken
enable_WebToken = False
WebToken = ""
# 可以关闭此插件的用户
admin_wxid = ""

ws_url = "ws://127.0.0.1:7600/wcf/socket_receiver"
headers = {'Content-Type': 'application/json',
           'Accept': 'application/json'
           }
if enable_WebToken:
    headers['Authorization'] = f'Bearer {WebToken}'
    ws_url = f"ws://127.0.0.1:7600/wcf/socket_receiver?token={WebToken}"


def mumber_name(roomid, wxid):
    url = 'http://127.0.0.1:7600/wcf/alias_in_chatroom'
    data = {
        'roomid': roomid,
        'wxid': wxid
    }
    response = requests.post(url, json=data, headers=headers).json()['Payload']
    return response


def send_txt(sender, msg, aters="string"):
    # 准备回复消息数据
    reply_data = {
        "aters": [aters],
        "msg": msg,
        "receiver": sender
    }

    # 发送POST请求回复
    send_txt_url = "http://127.0.0.1:7600/wcf/send_txt"  # 替换成实际的回复API的URL

    try:
        response = requests.post(send_txt_url, json=reply_data, headers=headers)

        response.raise_for_status()  # 检查是否有错误

    except requests.exceptions.RequestException as e:
        pass


def detect_qrcode_from_image(image_path):
    # 加载图片
    image = cv2.imread(image_path)

    # 转换为灰度图像以提高二维码识别效率
    try:
        gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    except cv2.error:
        return 'error'
    # 解码图像中的条形码和二维码
    decoded_objects = decode(gray)

    # 遍历解码出的对象，寻找二维码
    qrcode_data = []
    for obj in decoded_objects:
        if obj.type == 'QRCODE':
            qrcode_data.append(obj.data.decode('utf-8'))  # 将字节数据转换为字符串

    return qrcode_data


async def connect_to_websocket():
    async with websockets.connect(ws_url) as websocket:
        while True:
            response = await websocket.recv()
            response = json.loads(response)
            message_type = response['type']
            sender = response['sender']
            if message_type == 1 and sender == admin_wxid:
                message = response['content']
                if message == '关闭检测二维码':
                    print('stop ok')
                    break
            if message_type == 3:
                message_id = response['id']

                try:
                    is_group = response['is_group']
                    roomid = response['roomid']
                    sender_name = mumber_name(roomid, sender)
                except KeyError:
                    is_group = False

                image_path = response['extra']
                time.sleep(5)
                qrcode_data = detect_qrcode_from_image(image_path)
                retry_max = 3
                retry = 0
                while qrcode_data == 'error' and retry < retry_max:
                    time.sleep(2)
                    qrcode_data = detect_qrcode_from_image(image_path)
                    retry += 1

                if qrcode_data and qrcode_data != 'error':
                    data = ''
                    for qrcode in qrcode_data:
                        data += qrcode + '\n\n'
                    if is_group:
                        data = f"@{sender_name} 发送的图片中的二维码内容是: \n" + data
                        send_txt(roomid, data, aters=sender)
                    else:
                        data = "图片中的二维码内容是: \n" + data
                        send_txt(sender, data)


send_txt(admin_wxid, 'start ok')
asyncio.run(connect_to_websocket())
