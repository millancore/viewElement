<?php

use Vx\View;
use Vx\Resolver;

test('Test buffer level when use Start', function () {

    View::Start(__DIR__ .'/Components/list.php');
    View::Start(__DIR__ .'/Components/list.php');

    expect(ob_get_level())->toBe(3);
    Resolver::getInstance()->cleanStack(1);
});

test('Exception when use End without Start previously', function () {
    Vx\View::End();
})->throws(
    \Vx\Exception\ComponentException::class,
    'Component no found, Make sure to Initialize the component with View::Start'
);

test('Exception when not found template path on view::render', function () {
   Vx\View::Start('no_found_template.php');
})->throws(
    Vx\Exception\TemplateNotFoundException::class,
    'Template not found: no_found_template.php'
);
