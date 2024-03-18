<?php

class Img
{
    public static function help()
    {
        return [
            '大山' => '按关键字返回图片',
        ];
    }

    public static function simple($args)
    {
        $data = fetch('/img/' . $args);
        return $data['output'] ?? '';
    }
}
