<?php

function controllerAutoLoad($classname){
    include 'controllers/' . $classname . '.php';
}

spl_autoload_register('controllerAutoLoad');