<?php
namespace Controllers\admin;
use Resources, Libraries, Models;

class Produk extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->home = new Models\Home;
		$this->request=new Resources\Request;
		$this->produk=new Models\Produk;
		$this->pesan=new Models\Pesan;
		$this->randomstring = new Libraries\Randomstring;
		$this->readmore = new Libraries\Readmore;
		$this->image = new Libraries\Image;
		$this->user= new Models\User;
    }
	
	public function index($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==1 ){
        //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_produk=$this->produk->hitung_produk();
		
				
		$data['viewall_produk']=$this->produk->viewall_produk_page($page, $limit);
		$data['total_produk'] = $total_produk;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/produk/index/%#%/',
			'total' => $total_produk,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		$kategori=$this->produk->viewall_kategori();
		
		$data['title'] = 'Data produk';
		$data['subtitle']= 'List data produk';
		$data['konten']='admin/konten/produk';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='produk';
		$data['page']='produk';
		$data['kategori']=$kategori;
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function pro_input_produk($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        if($_POST){
		$produk=$this->request->post('nama_produk');
        $warna=$this->request->post('warna');
		$keterangan=$this->request->post('keterangan');
		$kategori=$this->request->post('kategori');
		$harga=str_replace(",","",$this->request->post('harga'));
		$seat=str_replace(",","",$this->request->post('seat'));
		$tgl_input=date("Y-m-d");
		
		$data_produk=array(
			'nama_produk'=>ucfirst($produk),
			'warna'=>$warna,
			'kategori'=>$kategori,			
			'harga'=>$harga,			
			'seat'=>$seat,			
			'keterangan'=>$keterangan,
			'tgl_input'=>$tgl_input,
		);
		
		$this->produk->input_produk($data_produk);
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 10;
			$total_produk=$this->produk->hitung_produk();
			
					
			$data['viewall_produk']=$this->produk->viewall_produk_page($page, $limit);
			$data['total_produk'] = $total_produk;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/produk/index/%#%/',
				'total' => $total_produk,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
		$kategori=$this->produk->viewall_kategori();
		
		$data['kategori']=$kategori;	
		$data['title'] = 'Data produk';
		$data['subtitle']= 'List data produk';
		$data['konten']='admin/konten/produk';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='produk';
		$data['page']='produk';
		$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
			Anda berhasil input Data produk.
			</div>
		';
		

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
	
	public function pro_edit_produk($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
		$produk=$this->request->post('nama_produk');
        $warna=$this->request->post('warna');
		$kategori=$this->request->post('kategori');
		$harga=str_replace(",","",$this->request->post('harga'));		
		$seat=str_replace(",","",$this->request->post('seat'));		
		$keterangan=$this->request->post('keterangan');
		$id=$this->request->post('id');
		
		$data_produk=array(
			'nama_produk'=>ucfirst($produk),
			'warna'=>$warna,
			'kategori'=>$kategori,			
			'harga'=>$harga,			
			'seat'=>$seat,			
			'keterangan'=>$keterangan,			
		);
		
		
		$this->produk->edit_produk($data_produk,$id);
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 10;
			$total_produk=$this->produk->hitung_produk();
			
					
			$data['viewall_produk']=$this->produk->viewall_produk_page($page, $limit);
			$data['total_produk'] = $total_produk;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/produk/index/%#%/',
				'total' => $total_produk,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			
			$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
			Anda berhasil Edit Data produk.
			</div>
			';
			$kategori=$this->produk->viewall_kategori();
		
			$data['kategori']=$kategori;
			$data['title'] = 'Data produk';
			$data['subtitle']= 'List data produk';
			$data['konten']='admin/konten/produk';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='produk';
			$data['page']='produk';
			

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
	
	public function hapus_produk($id='',$page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($id==''){
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
		}else{
			$id=base64_decode($id);
			$this->produk->hapus_produk($id);
				
				//pagination
				$this->pagination = new Resources\Pagination();
				$page = (int) $page;
				$limit = 10;
				$total_produk=$this->produk->hitung_produk();
				
						
				$data['viewall_produk']=$this->produk->viewall_produk_page($page, $limit);
				$data['total_produk'] = $total_produk;
				$data['pageLinks'] = $this->pagination->setOption(
				array(
					'limit' => $limit,
					'base' => $this->uri->baseUri.'index.php/admin/produk/index/%#%/',
					'total' => $total_produk,	
					'current' => $page,
					)
							)->getUrl(); 
				
				$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
				// end pagination
				
				$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
				Anda berhasil hapus Data produk.
				</div>
				';
				$kategori=$this->produk->viewall_kategori();
				
				$data['kategori']=$kategori;
				$data['title'] = 'Data produk';
				$data['subtitle']= 'List data produk';
				$data['konten']='admin/konten/produk';
				$penerima=$this->session->getValue('user_id');
				$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
				$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
				$data['menu']='produk';
				$data['page']='produk';
				

				$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
		
    }
	
	////// KATEGORI
	
	public function kategori($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_kategori=$this->produk->hitung_kategori();
		
				
		$data['viewall_kategori']=$this->produk->viewall_kategori_page($page, $limit);
		$data['total_kategori'] = $total_kategori;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/produk/kategori/index/%#%/',
			'total' => $total_kategori,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		
		$data['title'] = 'Data Kategori';
		$data['subtitle']= 'List data kategori';
		$data['konten']='admin/konten/kategori';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='kategori';
		$data['page']='kategori';
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function pro_input_kategori($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        if($_POST){
		$nama_kategori=$this->request->post('nama_kategori');
        $warna=$this->request->post('warna');
		$keterangan=$this->request->post('keterangan');
		
		$data_kategori=array(
			'nama'=>ucfirst($nama_kategori),
			'warna'=>$warna,		
			'ket'=>$keterangan,			
		);
		
		$this->produk->input_kategori($data_kategori);
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 10;
			$total_kategori=$this->produk->hitung_kategori();
			
					
			$data['viewall_kategori']=$this->produk->viewall_kategori_page($page, $limit);
			$data['total_kategori'] = $total_kategori;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/produk/kategori/index/%#%/',
				'total' => $total_kategori,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			
		$data['title'] = 'Data Kategori';
		$data['subtitle']= 'List data kategori';
		$data['konten']='admin/konten/kategori';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='kategori';
		$data['page']='kategori';
		$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
			Anda berhasil input Data kategori.
			</div>
		';
		

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
	
	public function pro_edit_kategori($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
		$nama_kategori=$this->request->post('nama_kategori');
        $warna=$this->request->post('warna');
		$keterangan=$this->request->post('keterangan');
		$id=$this->request->post('id');
		
		$data_kategori=array(
			'nama'=>ucfirst($nama_kategori),
			'warna'=>$warna,		
			'ket'=>$keterangan,			
		);
		
		
		$this->produk->edit_kategori($data_kategori,$id);
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 10;
			$total_kategori=$this->produk->hitung_kategori();
			
					
			$data['viewall_kategori']=$this->produk->viewall_kategori_page($page, $limit);
			$data['total_kategori'] = $total_kategori;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/produk/kategori/index/%#%/',
				'total' => $total_kategori,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			
			$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
			Anda berhasil edit Data kategori.
			</div>
			';
		$data['title'] = 'Data kategori';
		$data['subtitle']= 'List data kategori';
		$data['konten']='admin/konten/kategori';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='kategori';
		$data['page']='kategori';
		

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
	
	public function hapus_kategori($id='',$page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($id==''){
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
		}else{
			$id=base64_decode($id);
			$this->produk->hapus_kategori($id);
				
				//pagination
				$this->pagination = new Resources\Pagination();
				$page = (int) $page;
				$limit = 10;
				$total_kategori=$this->produk->hitung_kategori();
				
						
				$data['viewall_kategori']=$this->produk->viewall_kategori_page($page, $limit);
				$data['total_kategori'] = $total_kategori;
				$data['pageLinks'] = $this->pagination->setOption(
				array(
					'limit' => $limit,
					'base' => $this->uri->baseUri.'index.php/admin/produk/kategori/index/%#%/',
					'total' => $total_kategori,	
					'current' => $page,
					)
							)->getUrl(); 
				
				$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
				// end pagination
				$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
				Anda berhasil Hapus Data kategori.
				</div>
				';
				$data['title'] = 'Data kategori';
				$data['subtitle']= 'List data kategori';
				$data['konten']='admin/konten/kategori';
				$penerima=$this->session->getValue('user_id');
				$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
				$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
				$data['menu']='kategori';
				$data['page']='kategori';
				

				$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
		
    }
}
