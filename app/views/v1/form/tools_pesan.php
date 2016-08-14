
		<a class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModalExcel">
		<i class="fa fa-file-excel-o"></i> Export To Excel
		</a>
				
		<a class="btn btn-danger btn-flat" data-toggle="modal" data-target="#myModalSearch">
		<i class="fa fa-search"></i> Search
		</a>		
		<a data-toggle="modal" data-target="#myModalInput" class="btn btn-warning btn-flat" >
		<i class="fa fa-pencil-square-o"></i> Pesan Baru
		</a>
<!-- Modal Pesan Baru-->
<div class="modal fade" id="myModalInput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Kirim Pesan Baru</h4>
	  </div>
	  <div class="modal-body">
		  <form id="form_kabar" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/pesan/kirim_pesan">
			<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
			
			
			<div class="col-md-12 ">
			<div class="form-group">
			  <label>Penerima</label>
			  <div class="input-group col-xs-12">
				<select data-placeholder="Penerima Pesan bisa lebih dari satu. Ketik untuk mencari pengirim secara otomatis." style="width:350px;" multiple id="dropdown-ajax" class="form-control chosen-select" name="penerima[]" required>
					
					<?php foreach($data_user_grup as $data_user_grup){						
						?>
						<optgroup class="optionGroup" label="User Level : <?php echo $data_user_grup->ket;?>">
						<?php $user_level=$data_user_grup->level;
							$data_user=$this->user->viewall_username_and_id($user_level);
							if($data_user){
								foreach($data_user as $data_user){				
									$user_id=$data_user->id;
									$username=$data_user->username;
									$data_pengguna=$this->user->view_nama_lengkap($user_id);
									if($this->session->getValue('user_id') == $user_id){
										
									}else{
										
										if($data_pengguna->nama_lengkap != ''){
											$nama='Nama Pengguna: '.$data_pengguna->nama_lengkap;
										}else{
											$nama='Username: '.$username;
										}
										?>
										<option value="<?php echo $user_id;?>"><?php echo $nama;?></option>
										<?php
									}
									
								}
							}
							
						?>
						</optgroup>
						<?php
					}?>
				</select>
			  
			</div>
			  </div><!-- /.input group -->
			</div>
			<?php
				$user_id=$this->session->getValue('user_id');			
				$nama_and_email=$this->user->view_nama_email($user_id);
				if($nama_and_email){
					$nama=$nama_and_email->nama_lengkap;
					$email=$nama_and_email->email;
				}else{
					$nama='';
					$email='';
					
				}
			?>
			<input name="pengirim" type="hidden" id="name" value="<?php echo $this->session->getValue('user_id');?>" readonly>
			<input name="posisi_form" type="hidden" id="name" value="dalam" readonly>
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Nama:</label>
			  <div class="input-group col-xs-12">
			  <input name="nama" type="text" class="form-control" value="<?php echo $nama;?>" required>
			  </div>
			</div>				  
			</div>
			
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Email:</label>
			  <div class="input-group col-xs-12">
			  <input name="email" type="text" class="form-control" value="<?php echo $email;?>" required>
			  </div>
			</div>				  
			</div>
			
			<div class="col-md-12">					
			<div class="form-group">
			  <label>Subjek:</label>
			  <div class="input-group col-xs-12">
			  <input name="subjek" type="text" class="form-control" value="" required>
			  </div>
			</div>				  
			</div>
			
			
			<div class="col-md-12 ">					
			<div class="form-group">
			  <label>Keterangan:</label>
			  <div class="input-group col-xs-12" >
			  <textarea id="isi_pesan" name="isi_pesan" class="form-control" rows="3" > </textarea>
			  </div><!-- /.input group -->
			</div>					
			</div>
				
			</div>
			
			
		  <div class="modal-footer">
			<input type="submit" class="btn btn btn-primary" value="Submit">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
			
			</form>
	  </div>
	</div>
  </div>
</div>
<!-- END Modal Pesan Baru -->

<!-- Modal Search-->
<div class="modal fade" id="myModalSearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Pencarian data Penerima Voucher</h4>
	  </div>
	  <div class="modal-body">
	  
		<form class="form-inline" method="post" data-toggle="validator" enctype="multipart/form-data" role="form" action="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/cari_penerima">
		  <div class="form-group">
			<select name="berdasarkan" class="form-control" required>
				<option value="">Cari Berdasarkan </option>
				<option value="id_rekanan">ID Rekanan</option>
				<option value="no_voucher">No Voucher</option>
				<option value="rekanan.nama_rekanan">Nama Rekanan</option>
				<option value="nama_penerima">Nama Penerima</option>
				<option value="username">Username</option>
				
			</select>
		  </div>
		  <div class="form-group">
			<input type="text" name="kata_kunci" class="form-control" placeholder="Kata Kunci" required>
		  </div>
		  
	  <div class="modal-footer">
		  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>Search</button>	  
		<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
	  </div>
		</form>
	  </div>
	</div>
  </div>
</div>
<!-- END Modal Search -->

<!-- Modal Excel-->
<div class="modal fade" id="myModalExcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Export Data to Excel</h4>
	  </div>
	  <div class="modal-body">
	  <div class="row" >
		<div class="col-md-6">
		<a class="btn btn-primary btn-flat" href="<?php echo $this->uri->baseUri;?>index.php/admin/excel/penerima_voucher">
		<i class="fa fa-file-excel-o"></i> Export All Data To Excel
		</a>
		</div>
		<div class="col-md-6">
		
		<div class="input-group">
		  <button class="btn btn-default pull-right" id="daterange-btn">
			<i class="fa fa-calendar"></i> Berdasarkan Rentang Waktu
			<i class="fa fa-caret-down"></i>
		  </button>
		</div>
		</div>
		</div>
		<hr>
		<div class="row">
		<div class="col-md-12">
		
		<form class="form-inline" method="post" data-toggle="validator" enctype="multipart/form-data" role="form" action="<?php echo $this->uri->baseUri;?>index.php/admin/excel/penerima_voucher">
		  
			  <div class="form-group">
				<label class="sr-only" for="dari_tgl">Dari</label>
				<input type="text" name="dari_tgl" class="form-control" id="dari_tgl" readonly>
			  </div>
			  <div class="form-group">
				<label class="sr-only" for="exampleInputPassword3">Ke</label>
				<input type="text" name="ke_tgl" class="form-control" id="ke_tgl" readonly>
			  </div>
			  <button type="submit" class="btn btn-default"><i class="fa fa-file-excel-o"></i> Export Now</button>
			</form>
		</div>
		
	  </div>
	  <div class="modal-footer">		   
		<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
	  </div>
	</div>
  </div>
</div>
<!-- END Modal Excel -->