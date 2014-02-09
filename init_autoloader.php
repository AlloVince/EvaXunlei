<?php
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    $loader = include __DIR__ . '/vendor/autoload.php';
} else {
    throw new RuntimeException('Unable to find loader. Run `php composer.phar install` first.');
}

function p($r)
{
    echo sprintf("<pre>%s</pre>", var_export($r, true));
}
