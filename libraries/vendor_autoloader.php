<?php

defined('ADAPT_STARTED') or die;

function vendor_autoloader($class){
    /* Get a reference to adapt */
    $adapt = $GLOBALS['adapt'];
    
    /* Get the namespace and class name */
    $namespaces = explode("\\", $class);
    $class_name = array_pop($namespaces);
    $class_namespace = "\\" . implode("\\", $namespaces);
    
    
    
    $registered_namespaces = $adapt->store('adapt.namespaces');
    
    foreach($registered_namespaces as $namespace => $bundle){
        if (($namespace == $class_namespace) || (strlen($class_namespace) > strlen($namespace) && substr($class_namespace, 0, strlen($namespace)) == $namespace)){
            $namespaces = array_reverse($namespaces);
            array_pop($namespaces);
            $namespaces = array_reverse($namespaces);
            $class_path = implode("/", $namespaces);
            $path = ADAPT_PATH . "{$bundle['bundle_name']}/{$bundle['bundle_name']}-{$bundle['bundle_version']}/src/" . $class_path . "/{$class_name}.php";
            
            if (file_exists($path)){
                require_once($path);
                return true;
            }
            
        }
    }
    
    return false;
}

?>