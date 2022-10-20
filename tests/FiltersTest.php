<?php


test('register and use filter', function (){

   $resolver = \Vx\Resolver::getInstance();
   $resolver->config(null);

   $resolver->addFilter('upper', fn($string) => strtoupper($string));

   $var = "mi name";
   expect(\Vx\View::Filter($var, 'upper'))->toBe('MI NAME');
});
