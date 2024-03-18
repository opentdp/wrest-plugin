<?php

class Price
{
    public static function help()
    {
        return [
            '商品URL' => '查询商品历史价格',
        ];
    }

    public static function simple($args)
    {
        $data = fetch('/price/' . $args);
        if (empty($data['title'])) {
            return '';
        }

        $list = [];
        $list[] = $data['title'];
        foreach ($data['prices'] as $item) {
            $list[] = $item['name'] . '：' . $item['price'];
        }

        return $list;
    }
}
