<?php

namespace adapt\vendor{
    
    defined('ADAPT_STARTED') or die();
    
    class bundle_vendor extends \adapt\bundle {
        
        public function __construct($data){
            parent::__construct('vendor', $data);
        }
        
        public function boot(){
            if (parent::boot()){
                require(ADAPT_PATH . "{$this->name}/{$this->name}-{$this->version}/libraries/vendor_autoloader.php");
                spl_autoload_register('vendor_autoloader');
                return true;
            }
            
            return false;
        }
    }
    
}

?>