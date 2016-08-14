<?php
namespace Controllers\admin;
use Resources, Models, Libraries;

class Pembayaran extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->request=new Resources\Request;
		$this->home = new Models\Home;
		$this->produk = new Models\Produk;
		$this->pesan = new Models\Pesan;
		$this->rekanan = new Models\Rekanan;
		$this->user = new Models\User;
		$this->image = new Libraries\Image;		
		$this->readmore = new Libraries\Readmore;
		$this->registrasi = new Models\registrasi;
		$this->randomstring = new Libraries\Randomstring;
		$this->pengaturan = new Models\Pengaturan;
		$this->pembayaran = new Models\Pembayaran;
    }
	
	public function index($page=1)
    {
		if($this->session->getValue('user_level') ==1 || $this->session->getValue('user_level') ==2 || $this->session->getValue('user_level') ==3){		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_pembayaran=$this->pembayaran->hitung_pembayaran();
		
		if($this->session->getValue('user_level')==3){
			$user_id=$this->session->getValue('user_id');
			$id_rekanan=$this->rekanan->view_id_rekanan($user_id)->id_rekanan;			
			
			$data['viewall_pembayaran']=$this->pembayaran->viewall_pembayaran_by_id_rekanan($id_rekanan,$page,$limit);
		}else{
			$data['viewall_pembayaran']=$this->pembayaran->viewall_pembayaran($page,$limit);
		}
		
		
		$data['total_pembayaran'] = $total_pembayaran;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/pembayaran/index/%#%/',
			'total' => $total_pembayaran,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Pembayaran';
		$data['subtitle']= 'Halaman utama';
		$data["page"]='pembayaran';
		$data['konten']='admin/konten/pembayaran';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='pembayaran';

        $this->output('admin/index', $data);
		}else{
			$this->redirect('error');
		}
    }
	
	public function edit_konfirmasi(){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		
		if($_POST){
		$id=$this->request->post('id');
		$keterangan=$this->request->post('keterangan');
		$status=$this->request->post('status');
		
		
		
		$data_pembayaran=array(
			'keterangan'=>$keterangan,
			'status'=>$status,
		);
		//edit pembayaran
		$this->pembayaran->edit_pembayaran($data_pembayaran,$id);
		
		if($status=='1'){
			$id_produk=$this->request->post('id_produk');
			$seat=$this->produk->view_seat_by_id($id_produk)->seat;
			$jml_seat=$seat - 1;
			
			$data_produk=array(
				'seat'=>$jml_seat,
			);
			
			$this->produk->edit_produk($data_produk,$id_produk);
			
			$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Konfirmasi Berhasil</h4>
			Selamat anda berhasil Melakukan Edit Konfirmasi Pembayaran. 
			<p>Dengan ini, jamaah sudah berhak mendapatkan satu seat pemberangkatan.</p>
			
			<p>Cek kembali halaman pembayaran untuk melihat status pembayaran!</p>
			
			</div>
			<a href="'.$this->uri->baseUri.'index.php/admin/pembayaran" type="button" class="btn btn-primary btn-lg btn-block">Halaman Pembayaran</a>
			';
			
		}else{
			$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Pembayaran masih bermasalah</h4>
			<p>Jamaah masih belum berhak mendapatkan seat dikarenakan masih ada permasalahan dalam proses pembayaran.</p>
			
			<p>Cek kembali halaman pembayaran untuk melihat status pembayaran!</p>
			
			</div>
			<a href="'.$this->uri->baseUri.'index.php/admin/pembayaran" type="button" class="btn btn-primary btn-lg btn-block">Halaman Pembayaran</a>
			';
		}
		
		
		$data['title'] = 'Sukses konfirmasi';
		$data['subtitle']= 'Halaman utama';
		$data["page"]='pembayaran';
		$data['konten']='admin/konten/error';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='pembayaran';
		$this->output('admin/index', $data);
		}else{
			$this->redirect('error');
		}
		}else{
			$this->redirect('login');
		}
	}
}
