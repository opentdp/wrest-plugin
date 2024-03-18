<?php

class Whois
{
    public static function help()
    {
        return [
            'qq.com' => '获取域名 Whois 信息 <whois.ddnsip.cn>',
        ];
    }

    public static function simple($args)
    {
        if (empty($args)) {
            if (IS_WREST) {
                return '参数错误';
            }
            $args = $_SERVER['REMOTE_ADDR'];
        }

        $data = fetch('https://whois.ddnsip.cn/' . $args);

        if (isset($data['Domain Name'])) {
            $list = [];
            $list[] = '注册商：' . $data['Registrar'];
            $list[] = '域名状态：' . implode('、', $data['Domain Status']);
            $list[] = '创建时间：' . $data['Creation Date'];
            $list[] = '过期时间：' . $data['Registry Expiry Date'];
            $list[] = '更新时间：' . $data['Updated Date'];
            $list[] = '域名服务器：' . implode('、', $data['Name Server']);
            $list[] = 'DNSSEC 状态：' . $data['DNSSEC'];
            $list[] = 'DNSSEC DS 数据：' . $data['DNSSEC DS Data'];
            $list[] = '数据库更新时间：' . $data['Last Update of Database'];
            return $list;
        }

        if (isset($data['IP Network'])) {
            $list = [];
            $list[] = '地址范围：' . $data['Address Range'];
            $list[] = '网络名称：' . $data['Network Name'];
            $list[] = 'CIDR：' . $data['CIDR'];
            $list[] = '网络类型：' . $data['Network Type'];
            $list[] = '国家：' . $data['Country'];
            $list[] = '状态：' . implode('、', $data['Status']);
            $list[] = '创建时间：' . $data['Creation Date'];
            $list[] = '更新时间：' . $data['Updated Date'];
            return $list;
        }

        return '';
    }
}
