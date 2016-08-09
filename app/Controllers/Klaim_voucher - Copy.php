<?php
namespace Controllers;
use Resources, Libraries, Models;

class Klaim_voucher extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->request=new Resources\Request;
		$this->voucher=new Models\Voucher;
		$this->rekanan=new Models\Rekanan;
		$this->user=new Models\admin\User;
		$this->produk=new Models\Produk;
		
		$this->image = new Libraries\Image;
		$this->readmore = new Libraries\Readmore;
		$this->randomstring = new Libraries\Randomstring;
    }
	
	public function index()
    {
		$data['title'] = 'Klaim Voucher';
		$data['konten']='admin/konten/klaim_voucher';
		$data['menu']='klaim_voucher';
		$data['page']='klaim_voucher';
		
		$this->output('admin/index',$data);
    }
	
	public function cek_voucher(){
		$no_voucher=trim($this->request->post('no_voucher'));
		
		$cek_voucher=$this->voucher->cek_voucher($no_voucher);
		
		$cek_penerima_voucher=$this->voucher->cek_penerima_voucher($no_voucher);
		$cek_user_byvoucher=$this->user->cek_user_byvoucher($no_voucher);
		
		if($cek_voucher==''){
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Gagal ...</h4>
			Maaf, voucher yang anda masukan tidak cocok. Pastikan anda memasukan nomer voucher dengan benar.
			</div>
			';
			$data['konten']='konten/klaim_voucher';
		}else{
			if($cek_voucher->status=="1"){
				if($cek_penerima_voucher){
				// voucher ada, teraktifasi dan sudah ter-registrasi
					
				$data['data_user']=$cek_user_byvoucher;
				$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Selamat... </h4>
				<p>Voucher yang anda masukan benar dan anda sudah terdaftar sebagai penerima voucher.</p>
				<p>Silahkan lengkapi data penerima voucher <strong>'.$no_voucher.'</strong> dibawah ini, jika masih terdapat kesalahan ...!</p>
				Info username dan password :<br/>
				<ul>
				<li>Informasi username dan password, terdapat pada voucher anda!</li>
				<li>Untuk merubah username dan password, silahkan login terlebih dahulu.</li>
				</ul>
				
				</div>
				';
				
				$data['konten']='form/form_penerima';
				$data['action_form']=$this->uri->baseUri.'index.php/admin/klaim_voucher/pro_edit_penerima';
				$data['data_penerima_voucher']=$cek_penerima_voucher;
				
			}else{
				$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Selamat... </h4>
				Voucher yang anda masukan benar. Silahkan lengkapi data penerima voucher <strong>'.$cek_voucher->no_voucher.'</strong> dibawah ini ...!
				Info username dan password :<br/>
				<ul>
				<li>Informasi username dan password, terdapat pada voucher anda!</li>
				<li>Untuk merubah username dan password, silahkan login terlebih dahulu.</li>
				</ul>
				</div>
				';
				
				$data['konten']='admin/form/form_penerima';
				$data['action_form']=$this->uri->baseUri.'index.php/admin/klaim_voucher/pro_input_penerima';
			}
			}else{
				// voucher ada tapi belum di aktifasi
				$data['alert']='
				<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Gagal ...</h4>
				Maaf, voucher yang anda masukan belum di aktifasi. Harap menghubungi sumber voucher.
				</div>
				';
				$data['konten']='admin/konten/klaim_voucher';
			}
		}
		
		$data['no_voucher'] = $no_voucher;
		$data['id_rekanan'] = $this->voucher->id_rekanan($no_voucher);
		$data['potongan'] = $this->voucher->potongan($no_voucher);
		$data['title'] = 'Data Penerima Voucher';
		$data['menu']='klaim_voucher';
		$data['page']='cek_voucher';
		
		$this->output('index',$data);
	}
	
	public function pro_input_penerima(){
		
		$nama_penerima=ucwords($this->request->post('nama_penerima'));
		$no_tlp=$this->request->post('no_tlp');
		$id_rekanan=$this->request->post('id_rekanan');
		$no_voucher=trim($this->request->post('no_voucher'));
		$email=$this->request->post('email');		
		
		$username=strtolower(trim($this->request->post('username')));
		$password=md5($this->request->post('password'));
		$password2=md5($this->request->post('password2'));
		
		if($password != $password2){
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i> Gagal ...</h4>
			Maaf, password pertama dan password kedua harus sama.
			</div>
			';
			
			$data['title'] = 'Data Penerima Voucher';
			$data['no_voucher'] = $no_voucher;
			$data['id_rekanan'] = $this->voucher->id_rekanan($no_voucher);
			$data['potongan'] = $this->voucher->potongan($no_voucher);
			$data['menu']='voucher';
			$data['page']='cek_voucher';
			$data['konten']='admin/form/form_penerima';
			$data['action_form']=$this->uri->baseUri.'index.php/admin/klaim_voucher/pro_input_penerima';
			$this->output('admin/index',$data);
		}else{
			$cek_user=$this->user->cek_username($username);
			if($cek_user){
				
				
				$data['alert']='
				<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>	<i class="icon fa fa-check"></i> Gagal ...</h4>
				Maaf, username yang anda masukkan sudah ada, silahkan masukan username yang lain.
				</div>
				';
				
				$data['title'] = 'Data Penerima Voucher';
				$data['no_voucher'] = $no_voucher;
				$data['id_rekanan'] = $this->voucher->id_rekanan($no_voucher);
				$data['potongan'] = $this->voucher->potongan($no_voucher);
				$data['menu']='voucher';
				$data['page']='cek_voucher';
				$data['konten']='admin/form/form_penerima';
				$data['action_form']=$this->uri->baseUri.'index.php/admin/klaim_voucher/pro_input_penerima';
				$this->output('admin/index',$data);
			}else{
				//kondisi true
				$cek_penerima_voucher=$this->voucher->cek_penerima_voucher($no_voucher);
				if($cek_penerima_voucher){
					$this->redirect('admin/klaim_voucher/');
				}else{
					$data_penerima=array(
					'nama_penerima'=>$nama_penerima,
					'no_tlp'=>$no_tlp,
					'id_rekanan'=>$id_rekanan,
					'no_voucher'=>$no_voucher,
					'email'=>$email,				
					);		
					$this->voucher->input_penerima_voucher($data_penerima);
					
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Selamat... </h4>
						<p>Terimakasih, data anda sudah kami simpan untuk keperluan verifikasi pemberian diskon Umroh.</p>
						<p>Selanjutnya, silahkan memilih produk Umroh dibawah ini.</p>
						</div>
						';
					
					$data['title'] = 'Data Penerima Voucher';
					$data['no_voucher'] = $no_voucher;
					$data['potongan'] = $this->voucher->potongan($no_voucher);
					$data['menu']='voucher';
					$data['page']='cek_voucher';
					$data['konten']='admin/konten/pilih_produk';
					$this->output('admin/index',$data);
			
			
				}
				
			
			
			
			}
			
		}
		
	}
	
	public function pilih_produk(){
		$data['data_produk']=$this->produk->viewall_produk();
		$data['title'] = 'Pemilihan produk mariumroh.com';
		$data['menu']='klaim_voucher';
		$data['page']='cek_voucher';
		$data['konten']='admin/konten/pilih_produk';
		
		$this->output('admin/index',$data);
	}
	
	public function pro_order_produk(){
		$data['data_produk']=$this->produk->viewall_produk();
		$data['title'] = 'Berhasil order';
		$data['menu']='klaim_voucher';
		$data['page']='cek_voucher';
		$data['konten']='admin/konten/home';
		$data['alert']='
		<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-check"></i> Selamat... </h4>
		<p>Terimakasih, registrasi umroh anda sudah kami terima.</p>
		<p>Kami akan segera melakukan pendataan, untuk proses selanjutnya, kami persilahkan untuk mendatangi kantor kami di :</p>
		<p>Jl. Panatayuda No.xx </p>
		</div>
		';
		
		$this->output('admin/index',$data);
	}
	
	
}
