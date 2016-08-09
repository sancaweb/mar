<?php
namespace Modules\JUpload\Controllers;
use Resources;

class Basic extends Resources\Controller
{
    public function index()
    {
        $this->output('basic');
    }
    public function basic_plus()
    {
        $this->output('basic-plus');
    }
}
