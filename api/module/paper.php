<?php

class Paper
{
    public static function help()
    {
        return [
            '北京' => '生成咸鱼日报',
        ];
    }

    public static function simple($args)
    {
        if (empty($args)) {
            if (IS_WREST) {
                return '参数错误';
            }
            $data = fetch('/ip/' . $_SERVER['REMOTE_ADDR']);
            $args = !empty($data['city']) ? $data['city'] : '';
        }

        $data = fetch('/paper/' . $args);

        if (isset($data['image'])) {
            return $data['image'];
        }

        return '';
    }
}
