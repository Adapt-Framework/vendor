<?php

defined('ADAPT_STARTED') or die;

function vendor_autoloader($class){
    print $class;
    die();
    /* Get a reference to adapt */
    $adapt = $GLOBALS['adapt'];
    
    /* Get the namespace and class name */
    $namespaces = explode("\\", $class);
    $class_name = array_pop($namespaces);
    
    $registered_namespaces = $adapt->store('adapt.namespaces');
    
    print_r($registered_namespace);
}

?>