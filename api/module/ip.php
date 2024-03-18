<?php

class Ip
{
    public static function help()
    {
        return [
            '1.2.3.4' => '查询IP地址信息',
        ];
    }

    public static function simple($args)
    {
        if (empty($args)) {
            if (IS_WREST) {
                return '参数错误';
            }
            $args = $_SERVER['REMOTE_ADDR'];
        }

        $data = fetch('/ip/' . $args);

        $list = [];

        if (!empty($data['nation'])) {
            $list[] = '国家：' . $data['nation'];
        }
        if (!empty($data['country'])) {
            $list[] = '国家：' . $data['country'];
        }
        if (!empty($data['province'])) {
            $list[] = '省份：' . $data['province'];
        }
        if (!empty($data['city'])) {
            $list[] = '城市：' . $data['city'];
        }
        if (!empty($data['district'])) {
            $list[] = '地区：' . $data['district'];
        }
        if (!empty($data['longitude'])) {
            $list[] = '经度：' . $data['longitude'];
        }
        if (!empty($data['latitude'])) {
            $list[] = '纬度：' . $data['latitude'];
        }

        return $list;
    }
}
