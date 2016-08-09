<?php
namespace Controllers\admin;
use Resources, Libraries, Models;

class Kabar extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->home = new Models\Home;
		$this->request=new Resources\Request;
		$this->kabar=new Models\Kabar;
		$this->pesan=new Models\Pesan;		
		$this->user=new Models\User;
		$this->randomstring = new Libraries\Randomstring;
		$this->readmore = new Libraries\Readmore;
		$this->image = new Libraries\Image;
    }
	
	public function index($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_kabar=$this->kabar->hitung_kabar();
		
				
		$data['viewall_kabar']=$this->kabar->viewall_kabar_page($page, $limit);
		$data['total_kabar'] = $total_kabar;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/kabar/index/%#%/',
			'total' => $total_kabar,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		$kategori=$this->kabar->viewall_kategori();
		
		$data['title'] = 'Data kabar';
		$data['subtitle']= 'List data kabar';
		$data['konten']='admin/konten/kabar';
		$kepada=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
		$data['menu']='kabar';
		$data['page']='kabar';
		$data['kategori']=$kategori;
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function pro_input_kabar($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        if($_POST){
		$judul=ucwords($this->request->post('judul'));
		$keterangan=$this->request->post('keterangan');
		$kategori=$this->request->post('kategori');
		$tgl_input=date("Y-m-d");
		
		$data_kabar=array(
			'judul'=>$judul,
			'kategori'=>$kategori,
			'keterangan'=>$keterangan,
			'tgl_input'=>$tgl_input,
		);
		
		$this->kabar->input_kabar($data_kabar);
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 10;
			$total_kabar=$this->kabar->hitung_kabar();
			
					
			$data['viewall_kabar']=$this->kabar->viewall_kabar_page($page, $limit);
			$data['total_kabar'] = $total_kabar;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/kabar/index/%#%/',
				'total' => $total_kabar,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
		$kategori=$this->kabar->viewall_kategori();
		
		$data['kategori']=$kategori;	
		$data['title'] = 'Data Kabar';
		$data['subtitle']= 'List data kabar';
		$data['konten']='admin/konten/kabar';
		$kepada=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
		$data['menu']='kabar';
		$data['page']='kabar';
		$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
			Anda berhasil input Data kabar.
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
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
    }
	
	public function pro_edit_kabar($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
		$judul=$this->request->post('judul');
		$kategori=$this->request->post('kategori');	
		$keterangan=$this->request->post('keterangan');
		$id=$this->request->post('id');
		
		$data_kabar=array(
			'judul'=>ucfirst($judul),
			'kategori'=>$kategori,	
			'keterangan'=>$keterangan,			
		);
		
		
		$this->kabar->edit_kabar($data_kabar,$id);
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 10;
			$total_kabar=$this->kabar->hitung_kabar();
			
					
			$data['viewall_kabar']=$this->kabar->viewall_kabar_page($page, $limit);
			$data['total_kabar'] = $total_kabar;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/kabar/index/%#%/',
				'total' => $total_kabar,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			
			$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
			Anda berhasil Edit Data kabar.
			</div>
			';
			$kategori=$this->kabar->viewall_kategori();
		
			$data['kategori']=$kategori;
			$data['title'] = 'Data kabar';
			$data['subtitle']= 'List data kabar';
			$data['konten']='admin/konten/kabar';
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='kabar';
			$data['page']='kabar';
			

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
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
			
    }
	
	public function hapus_kabar($id='')
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')){
		
		$page=1;
		$id=base64_decode($id);
		$this->kabar->hapus_kabar($id);
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 10;
			$total_kabar=$this->kabar->hitung_kabar();
			
					
			$data['viewall_kabar']=$this->kabar->viewall_kabar_page($page, $limit);
			$data['total_kabar'] = $total_kabar;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/kabar/index/%#%/',
				'total' => $total_kabar,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			
			$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
			Anda berhasil hapus Data kabar.
			</div>
			';
			$kategori=$this->kabar->viewall_kategori();
			
			$data['kategori']=$kategori;
			$data['title'] = 'Data kabar';
			$data['subtitle']= 'List data kabar';
			$data['konten']='admin/konten/kabar';
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='kabar';
			$data['page']='kabar';
			

			$this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	////// KATEGORI
	
	public function kategori($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue==2){
        //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_kategori=$this->kabar->hitung_kategori();
		
				
		$data['viewall_kategori']=$this->kabar->viewall_kategori_page($page, $limit);
		$data['total_kategori'] = $total_kategori;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/kabar/kategori/index/%#%/',
			'total' => $total_kategori,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		
		$data['title'] = 'Data Kategori';
		$data['subtitle']= 'List data kategori';
		$data['konten']='admin/konten/kategori_kabar';
		$kepada=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
		$data['menu']='kategori_kabar';
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
			'nama_kategori'=>ucwords($nama_kategori),	
			'keterangan'=>$keterangan,			
		);
		
		$this->kabar->input_kategori($data_kategori);
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 10;
			$total_kategori=$this->kabar->hitung_kategori();
			
					
			$data['viewall_kategori']=$this->kabar->viewall_kategori_page($page, $limit);
			$data['total_kategori'] = $total_kategori;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/kabar/kategori/index/%#%/',
				'total' => $total_kategori,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			
		$data['title'] = 'Data Kategori';
		$data['subtitle']= 'List data kategori';
		$data['konten']='admin/konten/kategori_kabar';
		$kepada=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
		$data['menu']='kategori_kabar';
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
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
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
		$keterangan=$this->request->post('keterangan');
		$id=$this->request->post('id');
		
		$data_kategori=array(
			'nama_kategori'=>ucfirst($nama_kategori),	
			'keterangan'=>$keterangan,			
		);
		
		
		$this->kabar->edit_kategori($data_kategori,$id);
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 10;
			$total_kategori=$this->kabar->hitung_kategori();
			
					
			$data['viewall_kategori']=$this->kabar->viewall_kategori_page($page, $limit);
			$data['total_kategori'] = $total_kategori;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/kabar/kategori/index/%#%/',
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
		$data['konten']='admin/konten/kategori_kabar';
		$kepada=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
		$data['menu']='kategori_kabar';
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
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='kategori_kabar';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
    }
	
	public function hapus_kategori($id='',$page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')){
		$id=base64_decode($id);
		$this->kabar->hapus_kategori($id);
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 10;
			$total_kategori=$this->kabar->hitung_kategori();
			
					
			$data['viewall_kategori']=$this->kabar->viewall_kategori_page($page, $limit);
			$data['total_kategori'] = $total_kategori;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/kabar/kategori/index/%#%/',
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
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='kategori_kabar';
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
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='kategori_kabar';
			$this->output('admin/index', $data);
		}
    }
}
