<?php
namespace Controllers\admin;
use Resources, Libraries, Models;

class Pesan extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->user = new Models\User;
		$this->kabar = new Models\Kabar;
		$this->pesan = new Models\Pesan;
		$this->readmore = new Libraries\Readmore;
		$this->request = new Resources\Request;
		
    }
	
	public function index($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2 || $this->session->getValue('user_level')==3){
		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		
		$kepada=$this->session->getValue('user_id');
		$data['data_pesan']=$this->pesan->viewall_pesan_page_by_kepada($page, $limit,$kepada);
	
		$total_pesan=$this->pesan->hitung_pesan_by_kepada($kepada);
		
		
		$data['total_pesan'] = $total_pesan;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/pesan/index/%#%/',
			'total' => $total_pesan,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data Pesan';
		$data['subtitle']= 'List data Pesan';
		$data['konten']='admin/konten/pesan';
		$kepada=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
		$data['menu']='pesan';
		$data['page']='inbox';
		
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
	}
	public function sentitems($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2 || $this->session->getValue('user_level')==3){
		
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
		    'base' => $this->uri->baseUri.'index.php/admin/pesan/sentitems/%#%/',
			'total' => $total_pesan_sentitems,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data Pesan';
		$data['subtitle']= 'List data Pesan';
		$data['konten']='admin/konten/pesan';
		$kepada=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
		$data['menu']='pesan';
		$data['page']='sentitems';
		
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
	}
	
	
	
	public function view_pesan($id_pesan='',$id=''){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2 || $this->session->getValue('user_level')==3){		
		$cek_id_pesan=$this->pesan->cek_id_pesan(base64_decode($id_pesan));
		$cek_id=$this->pesan->cek_id(base64_decode($id));
		if($cek_id_pesan AND $cek_id){
			$id=base64_decode($id);
			$id_pesan=base64_decode($id_pesan);
			//edit status pesan (sudah terbaca)
			$data_pesan=array(
				'status'=>1,
			);
			$this->pesan->edit_pesan($data_pesan,$id);
			
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
			$data['konten']='admin/konten/view_pesan';
			$data['menu']='pesan';
			$data['page']='pesan';
			$kepada=$this->session->getValue('user_id');
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$this->output('admin/index', $data);
		}else{
			$this->redirect('admin/pesan');
		}
		}else{
			$this->redirect('login');
		}
	}
		
	public function balas_pesan()
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2 || $this->session->getValue('user_level')==3){
        if($_POST){
			$kepada=$this->request->post('kepada');
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
				'kepada'=>$kepada,
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
			$data['konten']='admin/konten/view_pesan';
			$data['menu']='pesan';
			$data['page']='pesan';
			$kepada=$this->session->getValue('user_id');
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);			
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$this->output('admin/index', $data);
		}else{
			$this->redirect('admin/pesan');
		}
		
		}else{
			$this->redirect('admin/pesan');
		}
		
		}else{
			$this->redirect('login');
		}
		
    }
	
	
	
	
}