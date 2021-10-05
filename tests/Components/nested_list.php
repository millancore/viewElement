<?php Vx\View::start( __DIR__.'/list.php', [ 'id' => 'list']) ?>
    <li>Test parent list</li>
    <?php Vx\View::start(__DIR__.'/list.php', ['id' => 'sublist']) ?>
        <li>Test Child List</li>
        <li>Test Child List</li>
    <?php Vx\View::end(); ?>
    <li>Test Parent End</li>
<?php Vx\View::end(); ?>
