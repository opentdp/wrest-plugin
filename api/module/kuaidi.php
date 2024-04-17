<?php

class Kuaidi
{
    public static function help()
    {
        return [
            'YT7458074012883' => '获取快递物流信息,已支持顺丰快递查询(SF12312123 1234)',
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
        
        if (strpos($args, "SF") !== false) {
               $args = explode(" ", $args);
            $data = fetch('https://api.songzixian.com/api/express-tracking?dataSource=nationwide_express&trackingNumber=' . $args[0].'&phoneLast4='.$args[1]);
            if($data['code'] == 200){
                $list = [];
                $list[] = '快递单号：' . $data['data']['trackingNumber'];
                $list[] = '快递公司：' . $data['data']['courierName'];
                $list[] = '快递状态：' . $data['data']['deliveryStatus'];
                $list[] = '更新时间：' . $data['data']['latestUpdateTime'];
                $list[] = '最新信息：' . $data['data']['trackingDetails'][0]['description'];
                return implode("\n",$list);
            }else {
                $list = [];
                $list[] = '查询顺丰快递必须要寄/收件人手机号码后四位,格式:顺丰快递单号 手机号码后四位 (SF12312123 1234)';
                return implode("\n",$list);
            
            
            }
            
        }else {
                $data = fetch('https://api.songzixian.com/api/express-tracking?dataSource=nationwide_express&trackingNumber=' . $args);
            if($data['code'] == 200){
                $list = [];
                $list[] = '快递单号：' . $data['data']['trackingNumber'];
                $list[] = '快递公司：' . $data['data']['courierName'];
                $list[] = '快递状态：' . $data['data']['deliveryStatus'];
                $list[] = '更新时间：' . $data['data']['latestUpdateTime'];
                $list[] = '最新信息：' . $data['data']['trackingDetails'][0]['description'];
                return implode("\n",$list);
            }
        }
    }
}
