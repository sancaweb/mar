<?php
namespace Controllers;
use Resources, Libraries, Models;

class Profile extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->home = new Models\Home;
		$this->produk = new Models\Produk;
		$this->kabar = new Models\Kabar;
		$this->profile = new Models\Profile;		
		$this->image = new Libraries\Image;
		$this->readmore = new Libraries\Readmore;
		$this->pengaturan = new Models\Pengaturan;
    }
	
	public function index($page=1)
    {
        
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 5;
		$total_profile=$this->profile->hitung_profile();
		
				
		$data['viewall_profile_page']=$this->profile->viewall_profile_page($page, $limit);
		$data['total_profile'] = $total_profile;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/profile/index/%#%/',
			'total' => $total_profile,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		$data['title'] = 'Profile';
		$data['subtitle']= 'Halaman utama';
		$data['page']='about';
		$data['konten']='konten/profile';
		$data['menu']='profile';
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['featured']=$this->profile->view_featured();
		$data['img_header']=$this->pengaturan->viewall_header_rand();
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
        $this->output(TEMPLATE.'index', $data);
    }
	
	public function view($id='')
    {
		$id=base64_decode($id);
		$page=1;
        
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 5;
		$total_profile=$this->profile->hitung_profile();
		
				
		$data['viewall_profile_page']=$this->profile->viewall_profile_page($page, $limit);
		$data['total_profile'] = $total_profile;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/profile/index/%#%/',
			'total' => $total_profile,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		$data['title'] = 'Profile';
		$data['subtitle']= 'Halaman utama';
		$data['page']='about';
		$data['konten']='konten/profile';
		$data['menu']='profile';
		// wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['featured']=$this->profile->view_profile_by_id($id);
		$data['img_header']=$this->pengaturan->viewall_header_rand();
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
        $this->output(TEMPLATE.'index', $data);
    }
	
	
	public function legalitas()
    {
        $data['title'] = 'Home';
		$data['subtitle']= 'Halaman utama';
		$data['page']='about';
		$data['konten']='konten/legalitas';
		$data['menu']='profile';
		

        $this->output(TEMPLATE.'index', $data);
    }
}
