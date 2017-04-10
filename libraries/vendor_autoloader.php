<?php

defined('ADAPT_STARTED') or die;

function vendor_autoloader($class){
    /* Get a reference to adapt */
    $adapt = $GLOBALS['adapt'];
    
    /* Get the namespace and class name */
    $namespaces = explode("\\", $class);
    $class_name = array_pop($namespaces);
    $class_namespace = "\\" . implode("\\", $namespaces);
    $path_class_namespace = str_replace("\\", "/", $class_namespace);
    
    $registered_namespaces = $adapt->store('adapt.namespaces');
    $registered_loadpaths = json_decode($adapt->cache->get('vendor/bundle_load_path'),true);
    foreach($registered_namespaces as $namespace => $bundle){
        if (($namespace == $class_namespace) || (strlen($class_namespace) > strlen($namespace) && substr($class_namespace, 0, strlen($namespace)) == $namespace)){
            $namespaces = array_reverse($namespaces);
            if (count($namespaces) >= 1) array_pop($namespaces);
            $namespaces = array_reverse($namespaces);
            if(is_array($registered_loadpaths) && isset($registered_loadpaths[$namespace]) && is_array($registered_loadpaths[$namespace]) && isset($registered_loadpaths[$namespace]['paths'])){
                foreach($registered_loadpaths[$namespace]['paths'] as $load_path){
                    $path = ADAPT_PATH . "{$bundle['bundle_name']}/{$bundle['bundle_name']}-{$bundle['bundle_version']}/" . $load_path . "{$class_name}.php";
//                    print "does file exists path: {$path} \n";
                    if (file_exists($path)){
//                        print "file exists path: {$path} \n";
                        require_once($path);
                        return true;
                    }
                }
            }else{
                $class_path = $path_class_namespace;
                $class_path .= '/';
                $path = ADAPT_PATH . "{$bundle['bundle_name']}/{$bundle['bundle_name']}-{$bundle['bundle_version']}/src/" . $class_path . "{$class_name}.php";
                
                if (file_exists($path)){
                    require_once($path);
                    return true;
                }
            }
        }
    }
    
    return false;
}
