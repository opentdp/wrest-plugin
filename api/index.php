<?php

require 'args.php';
require 'basic.php';

// 获取参数

list($model, $args) = input();
require 'alias.php';

// 加载模块

if (method_exists($model, 'simple')) {
    $data = $model::simple($args, $model);
    output(empty($data) ? '数据获取失败' : $data);
}

// 模块不存在

output('接口不存在');
