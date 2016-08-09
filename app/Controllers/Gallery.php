<?php
namespace Controllers;
use Resources, Libraries, Models;

class Gallery extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->home = new Models\Home;
		$this->gallery = new Models\Gallery;
		$this->pengaturan = new Models\Pengaturan;
		$this->kabar = new Models\Kabar;
		$this->produk = new Models\Produk;
		$this->request=new Resources\Request;
		$this->randomstring = new Libraries\Randomstring;
		$this->readmore = new Libraries\Readmore;
		$this->image = new Libraries\Image;		
		$this->upload = new Resources\Upload; 
		$this->image = new Resources\Image; 
    }
	
	public function index($page=1)
    {
        //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_kategori=$this->gallery->hitung_kategori();
		
				
		$data['viewall_kategori']=$this->gallery->viewall_kategori_page($page, $limit);
		$data['total_kategori'] = $total_kategori;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/gallery/index/%#%/',
			'total' => $total_kategori,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data Gallery';
		$data['subtitle']= 'List data Gallery';
		$data['konten']='konten/gallery';
		$data['menu']='gallery';
		$data['page']='gallery';
		$data['kategori_menu']=$this->gallery->viewall_kategori();
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();
		$data['kategori_kabar']=$this->kabar->viewall_kategori();		
		$data['img_header']=$this->pengaturan->viewall_header_rand();		
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
        $this->output(TEMPLATE.'index',$data);
    }
	
	public function view($kategori='',$page=1)
    {
		$kategori=base64_decode($kategori);
		$kategori2=base64_encode($kategori);
        //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 5;
		$total_gallery=$this->gallery->hitung_gallery_by_id($kategori);
		
				
		$data['viewall_gallery']=$this->gallery->viewall_gallery_page_by_kat($kategori,$page,$limit);
		$data['total_gallery'] = $total_gallery;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/gallery/view/'.$kategori2.'/%#%/',
			'total' => $total_gallery,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		
		$data['title'] = 'Data Gallery';
		$data['subtitle']= 'List data Gallery';
		$data['konten']='konten/view_gallery';
		$data['menu']='gallery';
		$data['page']='gallery';
		$data['kategori_menu']=$this->gallery->viewall_kategori();
		$data['nama_kategori']=$this->gallery->nama_kategori($kategori)->nama_kategori;
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();
		$data['kategori_kabar']=$this->kabar->viewall_kategori();		
		$data['img_header']=$this->pengaturan->viewall_header_rand();		
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
        $this->output(TEMPLATE.'index',$data);
    }
	
	
}
