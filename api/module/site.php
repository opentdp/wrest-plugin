<?php

class Site
{
    public static function help()
    {
        return [
            'qq.com' => '查询站点信息',
        ];
    }

    public static function simple($args)
    {
        if (empty($args)) {
            return '参数错误';
        }

        $data = fetch('/site/' . $args);
        if (empty($data['domain_registrar'])) {
            return null;
        }

        $list = [];
        if (!empty($data['domain_registrar'])) {
            $list[] = '注册商：' . $data['domain_registrar'];
        }
        if (!empty($data['domain_expired'])) {
            $list[] = '是否过期：' . ($data['domain_expired'] ? '是' : '否');
        }
        if (!empty($data['domain_status'])) {
            $list[] = '域名状态：' . implode('、', $data['domain_status']);
        }
        if (!empty($data['authoritative_dns'])) {
            $list[] = '权威DNS：' . implode('、', $data['authoritative_dns']);
        }
        if (!empty($data['authoritative_dns_resolve'])) {
            $list[] = '权威DNS解析：';
            foreach ($data['authoritative_dns_resolve'] as $item) {
                $list[] = "    {$item['type']}/{$item['ttl']}：" . implode('、', $item['value']);
            }
        }
        if (!empty($data['recursive_dns_resolve'])) {
            $list[] = '递归DNS解析：';
            foreach ($data['recursive_dns_resolve'] as $item) {
                $list[] = "    {$item['type']}/{$item['ttl']}：" . implode('、', $item['value']);
            }
        }
        if (!empty($data['ttl'])) {
            $list[] = 'TTL：' . $data['ttl'];
        }
        if (!empty($data['icp_black'])) {
            $list[] = 'ICP 黑名单：' . ($data['icp_black'] ? '是' : '否');
        }
        if (!empty($data['icp_number'])) {
            $list[] = 'ICP 备案号：' . $data['icp_number'];
        }
        if (!empty($data['miit_black'])) {
            $list[] = 'MIIT 黑名单：' . ($data['miit_black'] ? '是' : '否');
        }
        if (!empty($data['http_status'])) {
            $list[] = 'HTTP 状态：' . $data['http_status'];
        }
        if (!empty($data['ping_status'])) {
            $list[] = 'PING 状态：' . $data['ping_status'];
        }

        return implode("\n", $list);
    }
}
