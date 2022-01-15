<div>
    <?php vxStart(__DIR__ . '/form.php', ['id' => 'items']) ?>
        <input type="text" value="user">
        <?php vxStart(__DIR__ . '/helper_select.php', ['id' => 'subitems']) ?>
            <option value="3">Tres</option>
            <option value="2">Dos</option>
            <option value="1">Uno</option>
        <?php vxEnd() ?>
         <input type="submit" value="send">
     <?php vxEnd() ?>
</div>