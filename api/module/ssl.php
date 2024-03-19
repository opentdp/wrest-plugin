<?php

class Ssl
{
    public static $apis = [
        'https://www.cuteapi.com/api/ssl/api.php',
        'https://www.cuteapi.cn/api/ssl/api.php'
    ];

    public static function help()
    {
        return [
            'qq.com' => '检测证书信息',
        ];
    }

    public static function simple($args)
    {
        if (empty($args)) {
            return '参数错误';
        }

        $api = self::$apis[array_rand(self::$apis)];

        $data = fetch($api . '?domain=' . $args);
        if (empty($data['SSL_Domain'])) {
            return $data['error'] ?? null;
        }

        $list = [];
        $list[] = '域名：' . $args;
        $list[] = '网站IP：' . $data['IP'];
        $list[] = '签发域名：' . $data['SSL_Domain'];
        $list[] = '证书机构：' . $data['CA'];
        $list[] = '颁发者：' . $data['issuer'];
        if (!empty($data['SAN'])) {
            $san = str_replace('DNS:', '', $data['SAN']);
            $list[] = '备用主机：' .  $san;
        }
        if (!empty($data['Country'])) {
            $list[] = '国家：' . $data['Country'];
        }
        if (!empty($data['Province'])) {
            $list[] = '省：' . $data['Province'];
        }
        if (!empty($data['City'])) {
            $list[] = '市：' . $data['City'];
        }
        if (!empty($data['OA'])) {
            $list[] = '颁发给：' . $data['OA'];
        }
        if (!empty($data['SN'])) {
            $list[] = '加密方式：' . $data['SN'];
        }
        if (!empty($data['validFrom'])) {
            $list[] = '签发时间：' . $data['validFrom'];
        }
        if (!empty($data['validTo'])) {
            $list[] = '到期时间：' . $data['validTo'];
        }
        if (!empty($data['DaysRemaining'])) {
            list($days) = explode(' ', $data['DaysRemaining']);
            $list[] = '剩余时间：' . intval($days) . ' 天';
        }
        return implode("\n", $list);
    }
}
