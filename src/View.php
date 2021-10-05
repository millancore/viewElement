<?php

namespace Vx;

/**
 * View is a Facade
 */
final class View
{
    public static function __callStatic($name, $arguments)
    {
        $resolver = Resolver::getInstance();

        if(method_exists($resolver, $name)) {
            return $resolver->$name(... $arguments);
        }

    }
}
