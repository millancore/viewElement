<?php

test('Test templates with config settings', function () {

    \Vx\Resolver::getInstance()->config(new \Vx\Config([
           'viewDir' => __DIR__ . DIRECTORY_SEPARATOR  . 'Components',
           'extension' => false
    ]));

    $rendered = \Vx\View::render(__DIR__ .'/Components/config_nested_list.php');

    expect($rendered)->toBe(file_get_contents(__DIR__. '/Html/nested_list_result.html'));
});
