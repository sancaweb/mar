<?php
namespace Modules\JUpload\Controllers;
use Resources;
use Modules\JUpload\Libraries;

class Upload extends Resources\Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // lokasi folder tempat file foto disave
        $this->folder = 'upload/tes/';
        
        if( ! is_dir($this->folder) ) {
            
            //mkdir($this->folder);
            chmod($this->folder, 0777);
        }
        
        // konfigurasi untuk proses upload, termasuk format file apa saja yang diizinkan
        $this->option = [
            'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
            'upload_dir'        => dirname($_SERVER['SCRIPT_FILENAME']).'/'.$this->folder,
            'upload_url'        => '/'.$this->folder,
            'image_versions'    => []
        ];
    }
    
    public function index()
    {
        if( $_SERVER['REQUEST_METHOD'] != 'POST' )
            throw new Resources\HttpException('File not found!');
        
        $files = (new Libraries\UploadHandler($this->option, false))->post(false);
        
        $this->outputJSON($files);
    }
}
