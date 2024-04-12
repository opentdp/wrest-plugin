<?php

class Kuaidi
{
    public static function help()
    {
        return [
            'YT7458074012883' => '获取快递物流信息,暂不支持顺丰快递',
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

        //接口秘钥请前往https://api.linhun.vip/user/register.html注册获取
        $data = fetch('https://api.linhun.vip/api/express?apiKey=1222846592-6301392171f-ccbeddb919a&nu=' . $args);
        
        if($data['code'] == 200){
                $list = [];
                $list[] =  '快递公司：' . $data['jiancheng'];
                $list[] = '快递状态：' . $data['kdcode'];
                $list[] = '快递下单时间：' . $data['fstime'];
                $arrayLength = count($data['wuliu']);
                for($i = 0; $i < $arrayLength; $i++) {
                $list[] = '物流更新时间：' . $data['wuliu'][$i]['gtime'];
                $list[] = '物流更新内容：' . $data['wuliu'][$i]['gxbody'];
                }
                return implode("\n", $list);
            }
            if ($data['code'] != 200) {
                $list=[];
                $list[] = $data['msg'];
                
                return implode("\n",$list);
            }
        }
    }

