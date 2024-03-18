<?php

$models = [
    '天气' => 'weather',
    '历史价格' => 'price',
    '端口扫描' => 'port',
];

$model = $models[$model] ?? $model;
