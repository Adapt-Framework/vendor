<?php

namespace adapt\vendor{
    
    defined('ADAPT_STARTED') or die();
    
    class bundle_vendor extends \adapt\bundle {
        
        public function __construct($data){
            parent::__construct('vendor', $data);
            $this->register_config_handler('vendor', 'load_paths', 'process_path_tag');
        }
        
        public function boot(){
            if (parent::boot()){
                require_once(ADAPT_PATH . "{$this->name}/{$this->name}-{$this->version}/libraries/vendor_autoloader.php");
                spl_autoload_register('vendor_autoloader');
                return true;
            }
            
            return false;
        }
        
        public function process_path_tag($bundle, $tag_data){
            if ($bundle instanceof \adapt\bundle && $tag_data instanceof \adapt\xml){
                $auto_load_paths = $tag_data->get();
                $paths = $this->cache->get('vendor/bundle_load_path');
                foreach ($auto_load_paths as $load_path){
                    if($load_path instanceof \adapt\xml && $load_path->tag == "path"){
                        $namespace = $bundle->namespace;
                        $paths[$namespace]['paths'][] = $load_path->get(0);
                    }
                }
                $this->cache->set('vendor/bundle_load_path',json_encode($paths),(60 * 60 * 24 * 365));
            }
        }
    }
    
}

?>