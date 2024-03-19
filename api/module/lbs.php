<?php

class Lbs
{
    public static function help()
    {
        return [
            '南山' => '地址解析，地址转坐标',
            '纬度,经度' => '逆地址解析，坐标位置描述',
        ];
    }

    public static function simple($args)
    {
        $data = fetch('/lbs/' . $args);
        if (empty($data['location'])) {
            return null;
        }

        if (preg_match('/^\d+\.\d+,\d+\.\d+$/', $args)) {
            return $data['address'] ?? '';
        }

        return implode("\n", [
            '纬度：' . $data['location']['lat'],
            '经度：' . $data['location']['lng'],
        ]);
    }
}
