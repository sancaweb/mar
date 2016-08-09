<?php
namespace Controllers;
use Resources, Models, Libraries;

class Error extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->produk = new Models\Produk;
		$this->kabar = new Models\Kabar;	
		$this->pengaturan = new Models\Pengaturan;
    }
	
	public function index($page=1)
    {
		$data['title'] = 'Error ...';
			$data['subtitle']= 'error';
			$data["page"]='error';
			$data['konten']='konten/error';
			$data['menu']='error';
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();
			$data['img_header']=$this->pengaturan->viewall_header_rand();
			$data['list_partner']=$this->pengaturan->viewall_partner();		
			// END wajib
			
			$data['alert']='
				<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Error ...!</h4>
				Halaman yang anda tuju salah.		
				</div>
				<a href="'.$this->uri->baseUri.'" type="button" class="btn btn-primary btn-lg btn-block">Back to Home</a>
				';
			
			$this->output(TEMPLATE.'index', $data);
    }
}
