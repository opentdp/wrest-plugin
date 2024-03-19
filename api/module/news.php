<?php

class News
{
    public static function help($next = 0)
    {
        if ($next == 0) {
            return ['' => '获取今日热点'];
        }

        $list = [];
        $data = fetch('/news/help');
        foreach ($data as $k => $v) {
            $k = str_replace('/news/', 'news ', $k);
            $list[] =  "【/api {$k}】{$v}";
        }
        return implode("\n", $list);
    }

    public static function simple($args)
    {
        if (empty($args) || $args == 'help') {
            return self::help(1);
        }

        $data = fetch('/news/' . $args);
        if (empty($data['list'])) {
            return null;
        }

        $list = [];
        $keys = array_rand($data['list'], 5);
        foreach ($keys as $key) {
            $item = $data['list'][$key];
            $list[] = "{$item['title']} {$item['url']}";
        }
        return implode("\n", $list);
    }
}
