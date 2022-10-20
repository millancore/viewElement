
# ViewElement

This is a library for creating modular views in PHP, without configuration or dependencies.

- Slot
- Render
- Filters

# Install

```bash 
 composer require millancore/view-element
```

## Slot
You can create a template without defining the template body, it is passed by the view that will use it.

You can also make use of the helper functions `vxSlot()`, `vxStart(...)`, `vxEnd()`, which will make it easier for you to define components with fewer lines of code.

#### template_list.php
```php

<ul id="<?= $id ?? '' ?>">
    <?= \Vx\View::slot() ?>
</ul>
```

#### view.php
```php
<?php Vx\View::start('template_list.php', [ 'id' => 'list']) ?>
    <li>Test parent element</li>
    <?php Vx\View::start('template_list.php', ['id' => 'sublist']) ?>
        <li>Test Child element</li>
        <li>Test Child element</li>
    <?php Vx\View::end(); ?>
    <li>Test Parent element</li>
<?php Vx\View::end(); ?>
```

#### or using helpers functions
```php
<?php VxStart('template_list.php', [ 'id' => 'list']) ?>
    <li>Test parent element</li>
    <?php VxStart('template_list.php', ['id' => 'sublist']) ?>
        <li>Test Child element</li>
        <li>Test Child element</li>
    <?php VxEnd(); ?>
    <li>Test Parent element</li>
<?php VxEnd(); ?>
```

#### Html
```html
<ul id="list">
    <li>Test parent element</li>
    <ul id="sublist">
        <li>Test Child element</li>
        <li>Test Child element</li>
    </ul>
    <li>Test Parent element</li>
</ul>
```

## Config (optional)

This will allow you to define a path where all the views will be
and not have to type `.php` as it will be added automatically.

##### bootstrap.php
```php
$viewResolver = Vx\Resolver::getInstance();

$viewResolver->config(new Vx\Config([
     'viewDir' => __DIR__ . DIRECTORY_SEPARATOR  . 'views',
     'extension' => false
]));

```

## Filters

the filters are very simple, they allow you to add registering methods that modify.

##### bootstrap.php
```php
$viewResolver = Vx\Resolver::getInstance();

$viewResolver->addFilter('upper', fn($string) => strtoupper($string));
```

#### Use them
```php
<h1> <?= VxFilter('mi name', 'upper') ?> </h1> <!-- MI NAME -->
```