<?php

class Image_zw
{
public static $apis = [
        'https://api.accmu.cn/api/images_zw.php'
    ];

public static function help()
{
    return [
        '' => '返回早晚图',
    ];
}

public static function simple()
{
    $api = self::$apis[array_rand(self::$apis)];
    $data = fetch($api);


    if (empty($data['links'])) {
        return $data['error'] ?? null;
    }
    if (!empty($data['upload_response'])) {
        return  $data['upload_response']['data']['links']['url'];
    }

}
}