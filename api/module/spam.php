<?php

class Spam
{
    public static function help()
    {
        return [
            '文本' => '检测违规内容',
        ];
    }

    public static function simple($args)
    {
        $data = fetch('/spam/' . $args);
        return $data ?? '';
    }
}
