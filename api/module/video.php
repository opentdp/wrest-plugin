<?php

class Video
{
    public static function help()
    {
        return [
            '北极' => '按关键字返回视频',
        ];
    }

    public static function simple($args)
    {
        $data = fetch('/video/' . $args);
        return $data['output'] ?? '';
    }
}
