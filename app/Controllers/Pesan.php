<?php
namespace Controllers;
use Resources, Libraries, Models;

class Pesan extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->request = new Resources\Request;
		$this->home = new Models\Home;
		$this->produk = new Models\Produk;
		$this->kantor = new Models\Kantor;		
		$this->pesan = new Models\Pesan;		
		$this->kabar = new Models\Kabar;		
		$this->pengaturan = new Models\Pengaturan;		
		$this->readmore = new Libraries\Readmore;
		$this->randomstring = new Libraries\Randomstring;
    }
	
	public function index($page=1)
    {
		$this->redirect('kantor');
    }
	
	
	
	public function kirim_pesan()
    {
		$page=1;
        if($_POST){
			$kepada=$this->request->post('kepada');	
			$nama=$this->request->post('nama');	
			$pengirim=$this->request->post('pengirim');	
			$email=$this->request->post('email');
			$subjek=$this->request->post('subjek');
			$isi_pesan=$this->request->post('isi_pesan');
			$id_pesan='#'.$this->randomstring->randomstring(4).'-'.base64_encode(date('Ymd'));
			
						
			
			$data_pesan=array(
				'id_pesan'=>$id_pesan,
				'pengirim'=>$pengirim,
				'kepada'=>$kepada,
				'nama'=>$nama,
				'email'=>$email,
				'subjek'=>$subjek,
				'isi_pesan'=>$isi_pesan,
				'tgl_input'=>date('Y-m-d'),				
			);
			$this->pesan->input_pesan($data_pesan);
			
			$data['alert']='
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Terkirim ...</h4>
				<p>Terimakasih, Pesan anda telah terkirim. </p>
			</div>
			';
			$data['title'] = 'Our Office';
			$data['subtitle']= 'Halaman utama';
			$data['page']='contact';
			$data['konten']='konten/contact';
			$data['menu']='profile';
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();
			$data['img_header']=$this->pengaturan->viewall_header_rand();		
			$data['list_partner']=$this->pengaturan->viewall_partner();
			//end wajib
			
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
			
			$this->output(TEMPLATE.'index', $data);
		}else{
			$this->redirect('kantor');
		}
		
		
		
    }
}
