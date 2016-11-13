<?php

namespace adapt\vendor{
    
    defined('ADAPT_STARTED') or die();
    
    class bundle_vendor extends \adapt\bundle {
        
        public function __construct($data){
            parent::__construct('vendor', $data);
        }
        
        public function boot(){
            if (parent::boot()){
                
                spl_autoload_register(
                    function($class){
                        /* Get a reference to adapt */
                        $adapt = $GLOBALS['adapt'];
                        
                        /* Get the namespace and class name */
                        $namespaces = explode("\\", $class);
                        $class_name = array_pop($namespaces);
                        
                        $registered_namespaces = $adapt->store('adapt.namespaces');
                        
                        print_r($registered_namespace);
                    }
                );
                
                return true;
            }
            
            return false;
        }
    }
    
}

?>