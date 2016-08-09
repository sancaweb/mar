<?php
namespace Modules\JUpload\Controllers;
use Resources;

/**
 * This is a helpper to load assets dynamicly
 * For better performance you can move all asset files to public folder
 */
class Assets extends Resources\Controller
{
    public function alias($folder = false, $file = false)
    {
        $args = func_get_args();
        
        if( empty($args) )
            throw new Resources\HttpException('File not found!');
        
        $path   = dirname(dirname(__FILE__)).'/assets/'.implode('/', $args);
        $expires= 31536000; // 1 year
        
        if( ! file_exists($path) )
            throw new Resources\HttpException('File not found!');
        
        switch($folder) {
            case 'css':
                header('Content-Type: text/css; charset=UTF-8');
                break;
            case 'js':
                header('Content-Type: application/x-javascript; charset=UTF-8');
                break;
            case 'img':
                header('Content-type: image/gif');
                break;
            default:
                header('Content-Type: text/plain');
                break;
        }
        
        header('Expires: ' . gmdate( "D, d M Y H:i:s", time() + $expires ) . ' GMT');
        header("Cache-Control: public, max-age=$expires");
        
        readfile($path);
    }
}

