import Websocket from 'ws';
import WrestApi from './jssdk.js';

// config

const addr = '127.0.0.1:7600';

// http api

const api = WrestApi('http://' + addr);

api.selfInfo({}).then((data) => {
    console.log(data);
});

// websocket

const ws = new Websocket('ws://' + addr + '/wcf/socket_receiver');

ws.on('open', () => {
    console.log('websocket connected');
})

ws.on('close', () => {
    console.log('websocket closed');
})

ws.on('message', (data) => {
    console.log(data.toString());
});
