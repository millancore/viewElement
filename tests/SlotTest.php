<?php

use Vx\View;

test('Slot nested test', function () {

    $rendered = View::render(__DIR__ .'/Components/nested_list.php');

    expect($rendered)->toBe(file_get_contents(__DIR__. '/Html/nested_list_result.html'));
});

test("Render component using helper functions", function () {

    $rendered = View::render(__DIR__ . '/Components/helper_component.php');

    expect($rendered)->toBe(file_get_contents(__DIR__ . '/Html/form_helper_result.html'));

});