<?php
namespace Controllers;
use Resources, Libraries, Models;

class Kantor extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->home = new Models\Home;
		$this->produk = new Models\Produk;
		$this->kantor = new Models\Kantor;		
		$this->kabar = new Models\Kabar;		
		$this->user = new Models\User;		
		$this->pengaturan = new Models\Pengaturan;		
		$this->readmore = new Libraries\Readmore;
		$this->randomstring = new Libraries\Randomstring;
		
    }
	
	public function index($page=1)
    {        
		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 5;
		$total_kantor=$this->kantor->hitung_kantor();
		
				
		$data['viewall_kantor_page']=$this->kantor->viewall_kantor_page($page, $limit);
		$data['total_kantor'] = $total_kantor;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/kantor/index/%#%/',
			'total' => $total_kantor,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		$data['title'] = 'Our Office';
		$data['subtitle']= 'Halaman utama';
		$data['page']='contact';
		$data['konten']='konten/contact';
		$data['menu']='profile';
		$data['data_user_grup']=$this->user->viewall_admin_sadmin();
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['img_header']=$this->pengaturan->viewall_header_rand();		
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
		
        $this->output(TEMPLATE.'index', $data);
    }
	
	
	
}
