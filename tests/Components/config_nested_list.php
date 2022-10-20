<?php VxStart('list', [ 'id' => 'list']) ?>
    <li>Test parent list</li>
    <?php VxStart('list', ['id' => 'sublist']) ?>
        <li>Test Child List</li>
        <li>Test Child List</li>
    <?php VxEnd(); ?>
    <li>Test Parent End</li>
<?php VxEnd(); ?>
