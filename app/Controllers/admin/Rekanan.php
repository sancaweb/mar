<?php
namespace Controllers\admin;
use Resources, Libraries, Models;

class Rekanan extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->home = new Models\Home;
		$this->user = new Models\User;
		$this->pesan = new Models\Pesan;
		$this->request=new Resources\Request;
		$this->rekanan=new Models\Rekanan;
		$this->pembayaran=new Models\Pembayaran;
		$this->registrasi=new Models\Registrasi;
		$this->randomstring = new Libraries\Randomstring;
		$this->readmore = new Libraries\Readmore;
		
    }
	
	public function index($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_rekanan=$this->rekanan->hitung_rekanan();
		
				
		$data['viewall_rekanan']=$this->rekanan->viewall_rekanan_page($page, $limit);
		$data['total_rekanan'] = $total_rekanan;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/rekanan/index/%#%/',
			'total' => $total_rekanan,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data Rekanan';
		$data['subtitle']= 'List data Rekanan';
		$data['konten']='admin/konten/rekanan';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='rekanan';
		$data['page']='rekanan';
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function pro_input_rekanan($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        if($_POST){
		$rekanan=$this->request->post('rekanan');
        $alamat=$this->request->post('alamat');
        $warna=$this->request->post('warna');
        $jenis=$this->request->post('jenis');
		$pengulang=$this->request->post('pengulang');
		
		
		$i=0;
			foreach($pengulang as $pengulang){
				$random=$this->randomstring->randomstring(2);
				$total_rekanan=$this->rekanan->hitung_rekanan()+1;
				
				$lengthtotal_rekanan=strlen($total_rekanan);
				if ($lengthtotal_rekanan < 2){
					$total_rekanan='0'.$total_rekanan;
				}else{
					$total_rekanan=$total_rekanan;
				}
				
				//input user
				$data_user=array(
					'username'=>$total_rekanan.date("ymd"),
					'password'=>md5('123456'),
					'user_level'=>3,
					'tgl_register'=>date("Y-m-d"),				
				);
				
				$ambil_userid=$this->user->input_user($data_user);	
				
				//input rekanan
				$data_rekanan=array(
					'nama_rekanan'=>ucwords($rekanan[$i]),
					'user_id'=>$ambil_userid,
					'warna'=>$warna[$i],
					'jenis'=>$jenis[$i],
					'id_rekanan'=>$total_rekanan.date("ymd"),					
				);
				
				$this->rekanan->input_rekanan($data_rekanan);
				
				//input pengguna
					$data_pengguna=array(
							'user_id'=>$ambil_userid,
							'alamat'=>ucwords($alamat[$i]),
							'tgl_input'=>date("Y-m-d"),
					);
					$this->user->input_pengguna($data_pengguna);
				
				
				$i++;
			}
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 10;
			$total_rekanan=$this->rekanan->hitung_rekanan();
			
					
			$data['viewall_rekanan']=$this->rekanan->viewall_rekanan_page($page, $limit);
			$data['total_rekanan'] = $total_rekanan;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/rekanan/index/%#%/',
				'total' => $total_rekanan,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			
		$data['title'] = 'Data Rekanan';
		$data['subtitle']= 'List data Rekanan';
		$data['konten']='admin/konten/rekanan';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='rekanan';
		$data['page']='rekanan';
		$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
			Anda berhasil input Data Rekanan.
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
	
	public function pro_edit_rekanan($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        if($_POST){
		$rekanan=$this->request->post('rekanan');
        $alamat=$this->request->post('alamat');
        $warna=$this->request->post('warna');
        $jenis=$this->request->post('jenis');
		$user_id=$this->request->post('user_id');
		$id=$this->request->post('id');
		
		$data_rekanan=array(
			'nama_rekanan'=>ucwords($rekanan),
			'user_id'=>$user_id,
			'warna'=>$warna,
			'jenis'=>$jenis,					
		);
		
		$this->rekanan->edit_rekanan($data_rekanan,$id);
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 10;
			$total_rekanan=$this->rekanan->hitung_rekanan();
			
					
			$data['viewall_rekanan']=$this->rekanan->viewall_rekanan_page($page, $limit);
			$data['total_rekanan'] = $total_rekanan;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/rekanan/index/%#%/',
				'total' => $total_rekanan,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			
		$data['title'] = 'Data Rekanan';
		$data['subtitle']= 'List data Rekanan';
		$data['konten']='admin/konten/rekanan';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='rekanan';
		$data['page']='rekanan';
		

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
	
	// public function hapus_rekanan($id='',$page=1)
    // {
		// if($id==''){
			// $data['alert']='
				// <div class="alert alert-danger alert-dismissable">
				// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				// <h4><i class="icon fa fa-check"></i> Error ...!1</h4>
				// Halaman yang anda tuju salah.		
				// </div>
				// <a href="'.$this->uri->baseUri.'index.php/admin/" type="button" class="btn btn-primary btn-lg btn-block">Back to Home</a>
				// ';
			
			// $this->output('admin/index', $data);
		// }else{
			// $id=base64_decode($id);
			// $this->rekanan->hapus_rekanan($id);
				
				//pagination //
				// $this->pagination = new Resources\Pagination();
				// $page = (int) $page;
				// $limit = 10;
				// $total_rekanan=$this->rekanan->hitung_rekanan();
				
						
				// $data['viewall_rekanan']=$this->rekanan->viewall_rekanan_page($page, $limit);
				// $data['total_rekanan'] = $total_rekanan;
				// $data['pageLinks'] = $this->pagination->setOption(
				// array(
					// 'limit' => $limit,
					// 'base' => $this->uri->baseUri.'index.php/admin/rekanan/index/%#%/',
					// 'total' => $total_rekanan,	
					// 'current' => $page,
					// )
							// )->getUrl(); 
				
				// $data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
				//end pagination//
				
			// $data['title'] = 'Data Rekanan';
			// $data['subtitle']= 'List data Rekanan';
			// $data['konten']='admin/konten/rekanan';
			// $data['menu']='rekanan';
			// $data['page']='rekanan';
			

			// $this->output('admin/index', $data);
		// }
		
    // }
}
