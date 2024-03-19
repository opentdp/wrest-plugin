<?php

class Weather
{
    public static function help()
    {
        return [
            '上海' => '根据地址查询天气',
            '经度,纬度' => '根据经纬度查询天气',
        ];
    }

    public static function simple($args)
    {
        if (empty($args)) {
            if (IS_WREST) {
                return '参数错误';
            }
            $data = fetch('/ip/' . $_SERVER['REMOTE_ADDR']);
            if (empty($data['longitude']) || empty($data['latitude'])) {
                return '参数错误';
            }
            $args = $data['longitude'] . ',' . $data['latitude'];
        }

        $data = fetch('/weather/' . $args);
        if (empty($data['address'])) {
            return null;
        }

        return implode('', [
            implode('', $data['address']) . "：{$data['description']}；{$data['forecast']}；",
            "气温：{$data['realtime']['temperature']} ℃，体感：{$data['realtime']['apparent_temperature']} ℃；",
            "相对湿度：" . intval($data['realtime']['humidity'] * 100) . "%；风速：{$data['realtime']['wind']['speed']}米/秒；",
            "空气质量：{$data['realtime']['air_quality']['description']['chn']}，PM2.5：{$data['realtime']['air_quality']['pm25']}，PM10：{$data['realtime']['air_quality']['pm10']}；",
            "舒适度指数：{$data['realtime']['life_index']['comfort']['index']}，{$data['realtime']['life_index']['comfort']['desc']}；",
            "紫外线指数：{$data['realtime']['life_index']['ultraviolet']['index']}，{$data['realtime']['life_index']['ultraviolet']['desc']}；",
        ]);
    }
}
