<?php

class Help
{
    public static function simple($name)
    {
        if ($name && preg_match('/^\w+$/i', $name)) {
            $class = ucfirst($name);
            return $class::help(1);
        }

        $list = [];
        $mask = __DIR__ . '/*.php';
        foreach (glob($mask) as $file) {
            $name = str_replace('.php', '', basename($file));
            $class = ucfirst($name);
            if (method_exists($class, 'help')) {
                foreach ($class::help() as $k => $v) {
                    $list[] =  "【/api {$name} {$k}】{$v}";
                }
            }
        }
        return implode("\n", $list);
    }
}
