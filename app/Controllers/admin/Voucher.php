<?php
namespace Controllers\admin;
use Resources, Libraries, Models;

class Voucher extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->request=new Resources\Request;
		$this->voucher=new Models\Voucher;
		$this->rekanan=new Models\Rekanan;
		$this->pesan=new Models\Pesan;
		$this->user=new Models\User;
		$this->randomstring = new Libraries\Randomstring;
		$this->readmore = new Libraries\Readmore;
    }
	
	public function index($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2 || $this->session->getValue('user_level')==3){
		
        //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_voucher=$this->voucher->hitung_voucher();
		if($this->session->getValue('user_level')==3){
			$user_id=$this->session->getValue('user_id');
			$id_rekanan=$this->rekanan->view_id_rekanan($user_id)->id_rekanan;
			$data['viewall_voucher']=$this->voucher->viewall_voucher_page_id_rekanan($id_rekanan,$page, $limit);
		}else{
			$data['viewall_voucher']=$this->voucher->viewall_voucher_page($page, $limit);
		}
				
		
		$data['total_voucher'] = $total_voucher;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/voucher/index/%#%/',
			'total' => $total_voucher,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data voucher';
		$data['subtitle']= 'List data voucher';
		$data['konten']='admin/konten/voucher';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='voucher';
		$data['page']='voucher';
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function generate_voucher()
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		$data['rekanan']=$this->rekanan->viewall_rekanan();
		$data['title'] = 'Generate voucher';
		$data['subtitle']= 'Generate voucher';
		$data['konten']='admin/konten/generate_voucher';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='generate_voucher';
		$data['page']='voucher';
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function pro_generate_voucher($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        if($_POST){
		$rekanan=$this->request->post('rekanan');
		$id_rekanan=$rekanan;
		$potongan=$this->request->post('potongan');
		$jumlah=$this->request->post('jumlah');	
		$nama_rekanan=$this->rekanan->view_nama_rekanan_by_id($id_rekanan);	
		
		//generate no_voucher
		$no_cetak=$this->voucher->no_cetak_akhir();
		$tgl_cetak=date("Ymd");
		if($no_cetak){
			$no_cetak=$no_cetak->no_cetak+1;
		}else{
			$no_cetak=1;
		}
		$id_cetak=$tgl_cetak.$no_cetak;
		$no1=$this->randomstring->randomstring(4);
		$no2=$this->randomstring->randomstring(4); 
		
		$no_voucher=$id_rekanan.'-'.$id_cetak.'-'.$no1.'-'.$no2;
		
		//end generate no_voucher
		
		
		$data['title'] = 'Generate voucher';
		$data['subtitle']= 'Generate voucher';
		$data['konten']='admin/konten/generate_voucher';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='generate_voucher';
		$data['page']='pro_generate_voucher';
		
		$data['no_voucher']=$no_voucher;
		$data['id_rekanan']=$id_rekanan;
		$data['nama_rekanan']=$nama_rekanan;
		$data['potongan']=$potongan;
		$data['no_cetak']=$no_cetak;
		$data['jumlah']=$jumlah;
		$data['rekanan']=$this->rekanan->viewall_rekanan();
        $this->output('admin/index', $data);
		}else{
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
    }
	
	public function save_and_print(){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		
		if($_POST){
		$id_rekanan=$this->request->post('id_rekanan');
		$no_voucher=$this->request->post('no_voucher');
		$no_cetak=$this->request->post('no_cetak');
		$jumlah=$this->request->post('jumlah');
		
		
		$potongan=str_replace(",","",$this->request->post('potongan'));
		$tgl_cetak=date("Y-m-d");
		$jenis_rekanan=$this->rekanan->jenis_rekanan($id_rekanan)->jenis;
		
			if($jenis_rekanan=='rekanan'){
				$data_voucher=array(
					'id_rekanan'=>$id_rekanan,
					'no_voucher'=>$no_voucher,	
					'no_cetak'=>$no_cetak,
					'potongan'=>$potongan,
					'jumlah'=>$jumlah,
					'tgl_cetak'=>$tgl_cetak,
				);
				
			$this->voucher->input_voucher($data_voucher);
			
			$id_voucher=$this->voucher->id_voucher($no_voucher)->id;
			
				for ($x = 0; $x < $jumlah; $x++) {
					
						
				$username=$this->randomstring->randomstring(4).$id_voucher;				
				$password=md5("123456");
				
				$data_user=array(
					'username'=>$username,
					'password'=>$password,
					'tgl_register'=>$tgl_cetak,				
				);
				
				$ambil_userid=$this->user->input_user($data_user);				
				//input pengguna
					$data_pengguna=array(
							'user_id'=>$ambil_userid,
							'tgl_input'=>date("Y-m-d"),
					);
					$this->user->input_pengguna($data_pengguna);
					
				$data_penerima=array(
					'user_id'=>$ambil_userid,
					'id_rekanan'=>$id_rekanan,
					'id_voucher'=>$id_voucher,
					'status'=>'',
					'tgl_terima'=>$tgl_cetak,
					'editor'=>$this->session->getValue('username'),
					'change_date'=>date("Y-m-d"),
				);
			
				$this->voucher->input_penerima_voucher($data_penerima);
				
					
			} //end loops
			//Endo first kondisi jenis rekanan
			}else{
				$data_voucher=array(
					'id_rekanan'=>$id_rekanan,
					'no_voucher'=>$no_voucher,	
					'no_cetak'=>$no_cetak,
					'potongan'=>$potongan,
					'jumlah'=>$jumlah,
					'tgl_cetak'=>$tgl_cetak,
				);
				
				$this->voucher->input_voucher($data_voucher);
				
				$id_voucher=$this->voucher->id_voucher($no_voucher)->id;
			}
			
		
		$nama_rekanan=$this->rekanan->view_nama_rekanan_by_id($id_rekanan);
		
		
		$data['nama_rekanan']=$nama_rekanan;
		$data['title']='Print voucher';
		$data['potongan']=$this->request->post('potongan');
		$data['no_voucher']=$no_voucher;
		
		$data['menu']='generate_voucher';
		$data['page']='pro_generate_voucher';
		
        $this->output('admin/konten/prin_voucher', $data);
		}else{
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
	}
	
	///////////////////////////////////////////////////
		
	public function cari_voucher(){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		
        if($_POST){
		$no_voucher=$this->request->post('no_voucher');
		
		$hasil_cari=$this->voucher->cari_voucher($no_voucher);
		
		$data['title'] = 'Data voucher';
		$data['subtitle']= 'List data voucher';
		$data['konten']='admin/konten/voucher';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='voucher';
		$data['page']='cari_voucher';
		$data['viewall_voucher']=$hasil_cari;
		$data['total_voucher'] = $this->voucher->hasil_cari_voucher($no_voucher);
        $this->output('admin/index', $data);
		}else{
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
	}
	
	
	
	public function penerima_voucher($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2 || $this->session->getValue('user_level')==3){
		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		
		
		if($this->session->getValue('user_level')==3){
			$user_id=$this->session->getValue('user_id');
			$id_rekanan=$this->rekanan->view_id_rekanan($user_id)->id_rekanan;
			$data['penerima_voucher']=$this->voucher->view_penerima_voucher_by_id_rekanan($id_rekanan,$page, $limit);
		
			$total_penerima_voucher=$this->voucher->hitung_penerima_voucher_by_id_rekanan($id_rekanan);
		}else{
			$data['penerima_voucher']=$this->voucher->view_penerima_voucher($page, $limit);
			$total_penerima_voucher=$this->voucher->hitung_penerima_voucher();
		}
		
		$data['total_penerima_voucher'] = $total_penerima_voucher;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/voucher/penerima_voucher/%#%/',
			'total' => $total_penerima_voucher,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data Penerima Voucher';
		$data['subtitle']= 'List data Penerima Voucher';
		$data['konten']='admin/konten/penerima_voucher';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='penerima_voucher';
		$data['page']='penerima_voucher';
		
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
	}
	
	public function cari_penerima(){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2 || $this->session->getValue('user_level')==3){
		
		if($_POST){
			
			$berdasarkan=TRIM($this->request->post('berdasarkan'));
			$kata_kunci=$this->request->post('kata_kunci');
			
			if($berdasarkan=='id_rekanan' || $berdasarkan=='nama_penerima' || $berdasarkan=='tgl_terima'){
				if($this->session->getValue('user_level')==3){
					$user_id=$this->session->getValue('user_id');
					$id_rekanan=$this->rekanan->view_id_rekanan($user_id)->id_rekanan;
					$data['penerima_voucher']=$this->voucher->search_penerima_by_id_rekanan($berdasarkan,$kata_kunci,$id_rekanan);
					$data['total_penerima_voucher'] = $this->voucher->hitung_search_penerima_by_id_rekanan($berdasarkan,$kata_kunci,$id_rekanan);
				}else{
					$data['penerima_voucher']=$this->voucher->search_penerima($berdasarkan,$kata_kunci);
					$data['total_penerima_voucher'] = $this->voucher->hitung_search_penerima($berdasarkan,$kata_kunci);
				}
			
			}elseif($berdasarkan=='no_voucher'){
				$berdasarkan='id_voucher';
				$no_voucher=$kata_kunci;
				$id_voucher=$this->voucher->id_voucher($no_voucher)->id;
				$kata_kunci=$id_voucher;
				if($this->session->getValue('user_level')==3){
					$user_id=$this->session->getValue('user_id');
					$id_rekanan=$this->rekanan->view_id_rekanan($user_id)->id_rekanan;
					$data['penerima_voucher']=$this->voucher->search_penerima_by_id_rekanan($berdasarkan,$kata_kunci,$id_rekanan);
					$data['total_penerima_voucher'] = $this->voucher->hitung_search_penerima_by_id_rekanan($berdasarkan,$kata_kunci,$id_rekanan);
				}else{
					$data['penerima_voucher']=$this->voucher->search_penerima($berdasarkan,$kata_kunci);
					$data['total_penerima_voucher'] = $this->voucher->hitung_search_penerima($berdasarkan,$kata_kunci);
				}
				
			}elseif($berdasarkan=='rekanan.nama_rekanan'){
				if($this->session->getValue('user_level')==3){
					$data['alert']='
					<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Perhatian ...</h4>
					
					<p>Maaf, Anda tidak bisa melihat data dari rekanan yang lain.</p>					
					<p>Data yang muncul hanya yang berkaitan dengan anda.</p>					
					
					</div>
					';
					$user_id=$this->session->getValue('user_id');
					$id_rekanan=$this->rekanan->view_id_rekanan($user_id)->id_rekanan;
					$data['penerima_voucher']=$this->voucher->view_penerima_voucher_by_id_rekanan_nopage($id_rekanan);
					$data['total_penerima_voucher'] = $this->voucher->hitung_penerima_voucher_by_id_rekanan($id_rekanan);
				}else{
					$data['penerima_voucher']=$this->voucher->view_penerima_by_nama_rekanan($berdasarkan,$kata_kunci);
					$data['total_penerima_voucher'] = $this->voucher->hitung_penerima_by_nama_rekanan($berdasarkan,$kata_kunci);
				}
			}elseif($berdasarkan=='username'){
				$berdasarkan='user_id';
				$username=$kata_kunci;
				$user_id=$this->user->ambil_userid($username)->id;
				$kata_kunci=$user_id;
				if($this->session->getValue('user_level')==3){
					$user_id=$this->session->getValue('user_id');
					$id_rekanan=$this->rekanan->view_id_rekanan($user_id)->id_rekanan;
					$data['penerima_voucher']=$this->voucher->search_penerima_by_id_rekanan($berdasarkan,$kata_kunci,$id_rekanan);
					$data['total_penerima_voucher'] = $this->voucher->hitung_search_penerima_by_id_rekanan($berdasarkan,$kata_kunci,$id_rekanan);
				}else{
					$data['penerima_voucher']=$this->voucher->search_penerima($berdasarkan,$kata_kunci);
					$data['total_penerima_voucher'] = $this->voucher->hitung_search_penerima($berdasarkan,$kata_kunci);
				}
			}
			
			$data['title'] = 'Data Penerima Voucher';
			$data['subtitle']= 'List data Penerima Voucher';
			$data['konten']='admin/konten/penerima_voucher';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='penerima_voucher';
			$data['page']='penerima_voucher';
			
			$this->output('admin/index', $data);
		}else{
			$this->redirect('admin/voucher/penerima_voucher');
		}
		
		}else{
			$this->redirect('login');
		}
	}
	
	public function input_penerima($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
			
		$nama_penerima=ucwords($this->request->post('nama_penerima'));
		$no_tlp=$this->request->post('no_tlp');
		$alamat=$this->request->post('alamat');
		$email=$this->request->post('email');
		$nama_lengkap=$this->request->post('nama_lengkap');
		$username=$this->request->post('username');
		$id_rekanan=$this->request->post('id_rekanan');
		$id_voucher=$this->request->post('id_voucher');
		
		$id=$this->request->post('id');
		//input user
		
		$password=$this->request->post('password');
		
		if($password==''){
			$password=md5("123456");
		}else{
			$password=$password;
		}
		
		$data_user=array(
			'username'=>$username,
			'password'=>$password,
			'tgl_register'=>date("Y-m-d"),				
		);
		
		$ambil_userid=$this->user->input_user($data_user);	
		
		//input pengguna
			$data_pengguna=array(
				'nama_lengkap'=>$nama_lengkap,
				'no_tlp'=>$no_tlp,
				'email'=>$email,
				'alamat'=>$alamat,
				'user_id'=>$ambil_userid,
				'tgl_input'=>date("Y-m-d"),
			);
			$this->user->input_pengguna($data_pengguna);
			
		//input data_penerima
		$data_penerima=array(
			'user_id'=>$ambil_userid,
			'id_rekanan'=>$id_rekanan,
			'id_voucher'=>$id_voucher,
			'nama_penerima'=>$nama_penerima,
			'no_tlp'=>$no_tlp,
			'email'=>$email,
			'alamat'=>$alamat,
			'status'=>'',
			'tgl_terima'=>date("Y-m-d"),
			'editor'=>$this->session->getValue('username'),
			'change_date'=>date("Y-m-d"),

		);
	
		$this->voucher->input_penerima_voucher($data_penerima);
				
		
		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_penerima_voucher=$this->voucher->hitung_penerima_voucher();
		
				
		$data['penerima_voucher']=$this->voucher->view_penerima_voucher($page, $limit);
		$data['total_penerima_voucher'] = $total_penerima_voucher;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/voucher/penerima_voucher/%#%/',
			'total' => $total_penerima_voucher,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		$data['alert']='
		<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-check"></i> Sukses</h4>
		Selamat, Anda berhasil Input/Edit data Penerima Voucher.
		<p>Silahkan cek halaman <a href="'.$this->uri->baseUri.'index.php/admin/voucher">Data Voucher</a> Apakah masih ada voucher yang perlu di input data penerima voucher?</p>
		
		<p>Atau Edit kembali data Penerima voucher melalui tombol yang ada pada data dibawah ini!</p>
		</div>
		';
		$data['title'] = 'Data Penerima Voucher';
		$data['subtitle']= 'List data Penerima Voucher';
		$data['konten']='admin/konten/penerima_voucher';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='penerima_voucher';
		$data['page']='penerima_voucher';
		
        $this->output('admin/index', $data);
		}else{
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
		
	}
	
	public function edit_penerima($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2 || $this->session->getValue('user_level')==3){
		if($_POST){
			
		$nama_penerima=ucwords($this->request->post('nama_penerima'));
		$no_tlp=$this->request->post('no_tlp');
		$alamat=$this->request->post('alamat');
		$email=$this->request->post('email');
		
		$id=$this->request->post('id');
			
		//edit data_penerima
		$data_penerima=array(
			'nama_penerima'=>$nama_penerima,
			'no_tlp'=>$no_tlp,
			'email'=>$email,
			'alamat'=>$alamat,
			'editor'=>$this->session->getValue('username'),
			'change_date'=>date("Y-m-d"),
		);
	
		$this->voucher->edit_penerima_voucher($data_penerima,$id);
				
		
		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_penerima_voucher=$this->voucher->hitung_penerima_voucher();
		
				
		$data['penerima_voucher']=$this->voucher->view_penerima_voucher($page, $limit);
		$data['total_penerima_voucher'] = $total_penerima_voucher;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/voucher/penerima_voucher/%#%/',
			'total' => $total_penerima_voucher,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		$data['alert']='
		<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-check"></i> Sukses</h4>
		Selamat, Anda berhasil Input/Edit data Penerima Voucher.
		<p>Silahkan cek halaman <a href="'.$this->uri->baseUri.'index.php/admin/voucher">Data Voucher</a> Apakah masih ada voucher yang perlu di input data penerima voucher?</p>
		
		<p>Atau Edit kembali data Penerima voucher melalui tombol yang ada pada data dibawah ini!</p>
		</div>
		';
		$data['title'] = 'Data Penerima Voucher';
		$data['subtitle']= 'List data Penerima Voucher';
		$data['konten']='admin/konten/penerima_voucher';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='penerima_voucher';
		$data['page']='penerima_voucher';
		
        $this->output('admin/index', $data);
		}else{
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
		
	}
	
	public function activate($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
		
		$id=$this->request->post('id');
		$username=$this->request->post('username');
		$no_voucher=$this->request->post('no_voucher');
		//input data_penerima
		$data_penerima=array(
			'aktif'=>1,
			'editor'=>$this->session->getValue('username'),
			'change_date'=>date("Y-m-d"),
		);
	
		$this->voucher->edit_penerima_voucher($data_penerima,$id);
				
		
		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_penerima_voucher=$this->voucher->hitung_penerima_voucher();
		
				
		$data['penerima_voucher']=$this->voucher->view_penerima_voucher($page, $limit);
		$data['total_penerima_voucher'] = $total_penerima_voucher;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/voucher/penerima_voucher/%#%/',
			'total' => $total_penerima_voucher,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		$data['alert']='
		<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-check"></i> Sukses ..!!</h4>
		<p>Selamat, Anda berhasil Akatifasi Voucher dengan No Voucher: '.$no_voucher.'</p>
		<p>Dengan Username: '.$username.'</p>
		<p>Silahkan cek halaman <a href="'.$this->uri->baseUri.'index.php/admin/voucher">Data Voucher</a> Apakah masih ada voucher yang perlu di input data penerima voucher?</p>
		
		<p>Atau Edit kembali data Penerima voucher melalui tombol yang ada pada data dibawah ini!</p>
		</div>
		';
		$data['title'] = 'Data Penerima Voucher';
		$data['subtitle']= 'List data Penerima Voucher';
		$data['konten']='admin/konten/penerima_voucher';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='penerima_voucher';
		$data['page']='penerima_voucher';
		
        $this->output('admin/index', $data);
		}else{
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
		
	}
	
}
