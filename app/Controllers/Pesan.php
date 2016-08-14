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
		$this->user = new Models\User;		
		$this->kabar = new Models\Kabar;		
		$this->pengaturan = new Models\Pengaturan;		
		$this->readmore = new Libraries\Readmore;
		$this->randomstring = new Libraries\Randomstring;
    }
	
	public function index($page=1){
		if($this->session->getValue('username')){
		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		
		$penerima=$this->session->getValue('user_id');
		$data['data_pesan']=$this->pesan->viewall_pesan_page_by_penerima($page, $limit,$penerima);
	
		$total_pesan=$this->pesan->hitung_pesan_by_penerima($penerima);
		
		
		$data['total_pesan'] = $total_pesan;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/pesan/index/%#%/',
			'total' => $total_pesan,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data Pesan Inbox';
		$data['subtitle']= 'List data Pesan';
		$data['konten']='konten/user';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='pesan';
		$data['page']='inbox';
		$data['data_user_grup']=$this->user->viewall_admin_sadmin();
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['img_header']=$this->pengaturan->viewall_header_rand();		
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
		
        $this->output(TEMPLATE.'index', $data);
		}else{
			$this->redirect('login');
		}
	}
	
	public function sentitems($page=1){
		if($this->session->getValue('username')){
		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		
		$pengirim=$this->session->getValue('user_id');
		$data['data_sentitems']=$this->pesan->viewall_pesan_page_by_pengirim($page, $limit,$pengirim);
	
		$total_pesan_sentitems=$this->pesan->hitung_pesan_by_pengirim($pengirim);
		
		
		$data['total_pesan_sentitems'] = $total_pesan_sentitems;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/pesan/sentitems/%#%/',
			'total' => $total_pesan_sentitems,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data Pesan Terkirim';
		$data['subtitle']= 'List data Pesan Terkirim';
		$data['konten']='konten/user';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='pesan';
		$data['page']='sentitems';
		$data['data_user_grup']=$this->user->viewall_admin_sadmin();
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['img_header']=$this->pengaturan->viewall_header_rand();		
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
        $this->output(TEMPLATE.'index', $data);
		}else{
			$this->redirect('login');
		}
	}
	
	
	public function view_pesan($id_pesan='',$id=''){
		if($this->session->getValue('username')){
		$cek_id_pesan=$this->pesan->cek_id_pesan(base64_decode($id_pesan));
		$cek_id=$this->pesan->cek_id(base64_decode($id));
		if($cek_id_pesan AND $cek_id){
			$id=base64_decode($id);
			$id_pesan=base64_decode($id_pesan);
			$view_pengirim=$this->pesan->view_pengirim($id);
			if($view_pengirim->pengirim == $this->session->getValue('user_id')){
				
			}else{
				//edit status pesan (sudah terbaca)
				$data_pesan=array(
					'status'=>1,
				);
				$this->pesan->edit_pesan($data_pesan,$id);
			}
			
			
			$datapengguna=$this->user->view_nama_email($this->session->getValue('user_id'));
			$user_level=$this->user->ambil_user_level($this->session->getValue('user_level'))->ket;
			if($datapengguna){
				$nama=$datapengguna->nama_lengkap.'('.$user_level.')';
				$email=$datapengguna->email;
			}else{
				$nama=$this->user->ambil_username($this->session->getValue('user_id'))->username.'('.$user_level.')';
				$email='';
			}
			$data['data_pesan']=$this->pesan->view_by_id_pesan($id_pesan);
			$data['total_pesan']=$this->pesan->hitung_pesan_by_id_pesan($id_pesan);
			$data['id_pesan']=$id_pesan;
			$data['data_balas_pesan']=$this->pesan->view_by_id($id);
			$data['nama']=$nama;
			$data['email']=$email;
			$data['title'] = 'View Pesan';
			$data['subtitle']= 'View Detail Pesan';
			$data['konten']='konten/user';
			$data['menu']='pesan';
			$data['page']='view_pesan';
			$penerima=$this->session->getValue('user_id');
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();
			$data['img_header']=$this->pengaturan->viewall_header_rand();		
			$data['list_partner']=$this->pengaturan->viewall_partner();
			//end wajib
			
			$this->output(TEMPLATE.'index', $data);
		}else{
			$this->redirect('pesan');
		}
		}else{
			$this->redirect('login');
		}
	}
		
	public function balas_pesan()
    {
		if($this->session->getValue('username')){
        if($_POST){
			$penerima=$this->request->post('penerima');
			$id_pesan=$this->request->post('id_pesan');
			$pengirim=$this->request->post('pengirim');
			$nama=$this->request->post('nama');
			$email=$this->request->post('email');
			$subjek=$this->request->post('subjek');
			$isi_pesan=$this->request->post('isi_pesan');
			$id=$this->request->post('id');
			
			$data_pesan=array(
				'id_pesan'=>$id_pesan,
				'pengirim'=>$pengirim,
				'penerima'=>$penerima,
				'nama'=>$nama,
				'email'=>$email,
				'subjek'=>$subjek,
				'isi_pesan'=>$isi_pesan,
				'tgl_input'=>date('Y-m-d'),				
			);
			$this->pesan->input_pesan($data_pesan);
			
			
			//view 
			$cek_id_pesan=$this->pesan->cek_id_pesan($id_pesan);
		$cek_id=$this->pesan->cek_id($id);
		if($cek_id_pesan AND $cek_id){
			$id=$id;
			$id_pesan=$id_pesan;
			
			$datapengguna=$this->user->view_nama_email($this->session->getValue('user_id'));
			$user_level=$this->user->ambil_user_level($this->session->getValue('user_level'))->ket;
			if($datapengguna){
				$nama=$datapengguna->nama_lengkap.'('.$user_level.')';
				$email=$datapengguna->email;
			}else{
				$nama=$this->user->ambil_username($this->session->getValue('user_id'))->username.'('.$user_level.')';
				$email='';
			}
			$data['data_pesan']=$this->pesan->view_by_id_pesan($id_pesan);
			$data['total_pesan']=$this->pesan->hitung_pesan_by_id_pesan($id_pesan);
			$data['id_pesan']=$id_pesan;
			$data['data_balas_pesan']=$this->pesan->view_by_id($id);
			$data['nama']=$nama;
			$data['email']=$email;
			$data['title'] = 'View Pesan';
			$data['subtitle']= 'View Detail Pesan';
			$data['konten']='konten/user';
			$data['menu']='pesan';
			$data['page']='view_pesan';
			$penerima=$this->session->getValue('user_id');
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);			
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();
			$data['img_header']=$this->pengaturan->viewall_header_rand();		
			$data['list_partner']=$this->pengaturan->viewall_partner();
			//end wajib
			$this->output(TEMPLATE.'index', $data);
		}else{
			$this->redirect('pesan');
		}
		
		}else{
			$this->redirect('pesan');
		}
		
		}else{
			$this->redirect('login');
		}
		
    }
	
	
	public function kirim_pesan()
    {
		$page=1;
        if($_POST){
			$penerima=$this->request->post('penerima');	
			$nama=$this->request->post('nama');	
			$pengirim=$this->request->post('pengirim');	
			$email=$this->request->post('email');
			$subjek=$this->request->post('subjek');
			$isi_pesan=$this->request->post('isi_pesan');
			$posisi_form=$this->request->post('posisi_form');
			$id_pesan='#'.$this->randomstring->randomstring(4).'-'.base64_encode(date('Ymd'));
			
			foreach($penerima as $penerima){
				$data_pesan=array(
				'id_pesan'=>$id_pesan,
				'pengirim'=>$pengirim,
				'penerima'=>$penerima,
				'nama'=>$nama,
				'email'=>$email,
				'subjek'=>$subjek,
				'isi_pesan'=>$isi_pesan,
				'tgl_input'=>date('Y-m-d'),				
			);
			$this->pesan->input_pesan($data_pesan);
			}
			
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();
			$data['img_header']=$this->pengaturan->viewall_header_rand();		
			$data['list_partner']=$this->pengaturan->viewall_partner();
			//end wajib
			
			if($posisi_form == 'dalam'){
				//pagination
				$this->pagination = new Resources\Pagination();
				$page = (int) $page;
				$limit = 10;
				
				$pengirim=$this->session->getValue('user_id');
				$data['data_sentitems']=$this->pesan->viewall_pesan_page_by_pengirim($page, $limit,$pengirim);
			
				$total_pesan_sentitems=$this->pesan->hitung_pesan_by_pengirim($pengirim);
				
				
				$data['total_pesan_sentitems'] = $total_pesan_sentitems;
				$data['pageLinks'] = $this->pagination->setOption(
				array(
					'limit' => $limit,
					'base' => $this->uri->baseUri.'index.php/pesan/sentitems/%#%/',
					'total' => $total_pesan_sentitems,	
					'current' => $page,
					)
							)->getUrl(); 
				
				$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
				// end pagination
				
				$data['title'] = 'Data Pesan Terkirim';
				$data['subtitle']= 'List data Pesan Terkirim';
				$data['konten']='konten/user';
				$penerima=$this->session->getValue('user_id');
				$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
				$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
				$data['menu']='pesan';
				$data['page']='sentitems';
				$data['data_user_grup']=$this->user->viewall_admin_sadmin();
				 $data['alert']='
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Terkirim ...</h4>
						<p>Terimakasih, Pesan anda telah terkirim. </p>
					</div>
					';
				$this->output(TEMPLATE.'index', $data);
			}else{
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
				$data['alert']='
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Terkirim ...</h4>
						<p>Terimakasih, Pesan anda telah terkirim. </p>
					</div>
					';
				
				$this->output(TEMPLATE.'index', $data);
			}
			
		}else{
			$this->redirect('kantor');
		}
    }
}
