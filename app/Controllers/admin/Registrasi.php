<?php
namespace Controllers\admin;
use Resources, Models, Libraries;

class Registrasi extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->request=new Resources\Request;
		$this->home = new Models\Home;
		$this->produk = new Models\Produk;
		$this->kabar = new Models\Produk;
		$this->pesan = new Models\Pesan;
		$this->rekanan = new Models\Rekanan;
		$this->image = new Libraries\Image;		
		$this->readmore = new Libraries\Readmore;
		$this->registrasi = new Models\Registrasi;
		$this->randomstring = new Libraries\Randomstring;
		$this->voucher = new Models\Voucher;
		$this->pengaturan = new Models\Pengaturan;
		$this->pembayaran = new Models\Pembayaran;
		$this->user=new Models\User;
    }
	
	public function index($page=1)
    {
		if($this->session->getValue('user_level') ==1 || $this->session->getValue('user_level') ==2 || $this->session->getValue('user_level') ==3){
		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_registrasi=$this->registrasi->hitung_registrasi();
		if($this->session->getValue('user_level')==3){
			$user_id=$this->session->getValue('user_id');
			$id_rekanan=$this->rekanan->view_id_rekanan($user_id)->id_rekanan;
			
			$data['viewall_registrasi']=$this->registrasi->viewall_registrasi_id_rekanan($id_rekanan,$page,$limit);
		}else{
			$data['viewall_registrasi']=$this->registrasi->viewall_registrasi($page,$limit);
		}
		
		
		$data['total_registrasi'] = $total_registrasi;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/registrasi/index/%#%/',
			'total' => $total_registrasi,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'List Registrasi';
		$data['subtitle']= 'Halaman utama';
		$data["page"]='registrasi';
		$data['konten']='admin/konten/registrasi';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='register';

        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function edit_registrasi(){
		
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
		$id=$this->request->post('id');
		$nama_jamaah=$this->request->post('nama_jamaah');
		$tlp_jamaah=$this->request->post('tlp_jamaah');
		$alamat=$this->request->post('alamat');
		
		
		$data_registrasi=array(
			'nama_jamaah'=>$nama_jamaah,
			'tlp_jamaah'=>$tlp_jamaah,
			'alamat'=>$alamat
		);
		
			$this->registrasi->edit_registrasi($data_registrasi,$id);
		
		
		
		
		$data['title'] = 'Berhasil Registrasi';
		$data['subtitle']= 'Halaman utama';
		$data["page"]='registrasi';
		$data['konten']='admin/konten/error';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='register';
		
		$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Edit Registrasi Berhasil</h4>
			Selamat anda berhasil edit data registrasi Umroh.		
			</div>
			<a href="'.$this->uri->baseUri.'index.php/admin/registrasi/" type="button" class="btn btn-primary btn-lg btn-block">Data Registrasi</a>
			';
		
		$this->output('admin/index', $data);
		}else{
			$data['alert']='
				<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Error ...!1</h4>
				Halaman yang anda tuju salah.		
				</div>
				<a href="'.$this->uri->baseUri.'index.php/admin/" type="button" class="btn btn-primary btn-lg btn-block">Back to Home</a>
				';
			
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
	}
}
