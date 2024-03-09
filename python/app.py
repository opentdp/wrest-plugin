import asyncio
import websockets

async def connect_to_websocket():
    uri = "ws://localhost:7600/wcf/socket_receiver"

    async with websockets.connect(uri) as websocket:
        while True:
            response = await websocket.recv()
            print(f"收到的消息：{response}")

asyncio.get_event_loop().run_until_complete(connect_to_websocket())
