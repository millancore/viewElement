<div>
    <?php Vx\View::start('form.php', ['id' => 'items']) ?>
        <input type="text" value="user">
        <?php Vx\View::start('select.php', ['id' => 'subitems']) ?>
            <option value="3">Tres</option>
            <option value="2">Dos</option>
            <option value="1">Uno</option>
        <?php \Vx\View::end() ?>
         <input type="submit" value="send">
     <?php \Vx\View::end() ?>
</div>