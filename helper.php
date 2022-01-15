<?php

if(!function_exists('vxSlot')) {
    function vxSlot()
    {
       return Vx\View::slot();
    }
}

if (!function_exists('vxStart')) {

    function vxStart(string $path, array $params)
    {
        Vx\View::start($path, $params);
    }
}

if (!function_exists('vxEnd')) {

    function vxEnd()
    {
        Vx\View::end();
    }
}