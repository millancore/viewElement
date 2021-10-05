<?php

use Vx\View;

test('Slot nested test', function () {

    $rendered = View::render(__DIR__ .'/Components/nested_list.php');

    expect($rendered)->toBe(file_get_contents(__DIR__. '/Html/nested_list_result.html'));
});