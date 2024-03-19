<?php

class Ssl
{
    public static function help()
    {
        return [
            $list[] = 'qq.com：' . '检测证书信息',
        ];
    }

    public static function simple($args)
    {
        if (empty($args)) {
            return '参数错误';
        }

        $data = fetch('https://www.cuteapi.com/api/ssl/api.php?domain=' . $args);

        if (empty($data['SSL_Domain'])) {
            return null;
        }

        $list = [];
        $list[] = '域名：' . $args;
        $list[] = '网站IP：' . $data['IP'];
        $list[] = '签发域名：' . $data['SSL_Domain'];
        $list[] = '证书机构：' . $data['CA'];
        $list[] = '颁发者：' . $data['issuer'];
        if (!empty($data['SAN'])) {
            $list[] = '备用主机：' . $data['SAN'];
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
            $list[] = '剩余时间：' . $data['DaysRemaining'];
        }
        return implode("\n", $list);
    }
}
