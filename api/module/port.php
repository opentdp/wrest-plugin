<?php

class Port
{
    public static function help()
    {
        return [
            '1.2.3.4' => '查询IP/域名端口',
        ];
    }

    public static function simple($args)
    {
        if (empty($args)) {
            return '参数错误';
        }

        $data = fetch('/port/' . $args);
        if (isset($data['error'])) {
            return null;
        }

        $list = [];
        foreach ($data as $k => $v) {
            $list[] = "{$k}/{$v}";
        }
        return implode("、", $list);
    }
}
