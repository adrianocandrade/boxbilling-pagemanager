<?php


namespace Box\Mod\Paginas\Api;

class Guest extends \Api_Abstract
{    
    
    public function get_opinie($data)
    {
        $readme = file_get_contents(BB_PATH_MODS . '/mod_example/README.md');
        return $readme;
    }
    
}