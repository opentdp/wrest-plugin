<?php
// 辅助函数
// create by wang@rehiy.com

define('IS_WREST', strpos($_SERVER['HTTP_USER_AGENT'], 'Wrest') !== false);

set_exception_handler(function ($e) {
    output($e->getMessage());
});

spl_autoload_register(function ($c) {
    $f = 'module/' . strtolower($c) . '.php';
    if (is_file($f)) {
        return include($f);
    }
    return false;
});

function input()
{
    $path = urldecode(explode('?', $_SERVER['REQUEST_URI'])[0]);
    $args = explode('/', trim($path, '/'), 2);
    empty($args[0]) && $args[0] = 'help';
    empty($args[1]) && $args[1] = '';
    array_walk($args, 'trim');
    return $args;
}

function output($data)
{
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: text/plain; charset=utf-8');
    exit(is_string($data) ? $data : implode("\n", $data));
}

function fetch($url)
{
    if (strpos($url, '/') === 0) {
        $url = 'https://api.rehi.org' . $url;
    }
    if ($body = file_get_contents($url)) {
        $json = json_decode($body, true);
        if ($json !== null && json_last_error() === JSON_ERROR_NONE) {
            return $json;
        }
    }
    return [];
}
