<?php
namespace Controllers;
use Resources, Models, Libraries;

class Kabar extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->request=new Resources\Request;
		$this->home = new Models\Home;
		$this->produk = new Models\Produk;
		$this->kabar = new Models\Kabar;
		$this->voucher = new Models\Voucher;
		$this->pengaturan = new Models\Pengaturan;
		$this->image = new Libraries\Image;		
		$this->readmore = new Libraries\Readmore;
    }
	
	public function index($page=1)
    {
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 6;
		$total_kabar=$this->kabar->hitung_kabar();
		
				
		$data['viewall_kabar']=$this->kabar->viewall_kabar_page($page, $limit);
		$data['total_kabar'] = $total_kabar;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/kabar/index/%#%/',
			'total' => $total_kabar,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		
		$data['title'] = 'Kabar Mariumroh';
		$data['subtitle']= 'Halaman utama';
		$data["page"]='kabar';
		$data['konten']='konten/kabar';
		$data['menu']='kabar';		
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();
		$data['img_header']=$this->pengaturan->viewall_header_rand();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();		
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
		
		$this->output(TEMPLATE.'index', $data);
		
    }
	
	public function view($kat_id=1,$id=1){
		$kat_id=base64_decode($kat_id);
		$id=base64_decode($id);
		if($id!=''){			
			$data['single_kabar']=$this->kabar->single_kabar($kat_id,$id);
		}else{
			$id_akhir=$this->kabar->id_akhir_by_kat($kat_id)->id;
			$data['single_kabar']=$this->kabar->single_kabar($kat_id,$id_akhir);
		}
		
		$data['title'] = 'Kabar Mariumroh';
		$data['subtitle']= 'Halaman utama';
		$data["page"]='kabar';
		$data['konten']='konten/single_kabar';
		$data['menu']='kabar';	
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();
		$data['img_header']=$this->pengaturan->viewall_header_rand();		
		$data['list_partner']=$this->pengaturan->viewall_partner();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		//end wajib
		$data['view_kabar']=$this->kabar->viewall_kabar_by_kat($kat_id,5);
		$data['nama_kategori']=$this->kabar->nama_kategori($kat_id);
		$this->output(TEMPLATE.'index', $data);
		
		
	}
	
}
