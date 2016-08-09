<?php if(isset($alert)){
	echo $alert;
}?>

  <!-- View data -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">List data User</h3>
		  <?php
			if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		  ?>
		  <a class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModalinput">
			<i class="fa fa-user-plus"></i> Tambah User
			</a>
			<?php $this->output('admin/form/input_user');?>
			<?php } ?>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
		  <table class="table table-bordered table-hover">
			<tr>
			  <th style="width: 10px">No</th>
			  <th style="width: 200px">Username</th>
			  <th style="width: 200px">Nama</th>
			  <th style="width: 200px">User Level</th>
			  <th style="width: 300px">Action</th>
			</tr>
			<?php if ($viewall_page){
				$no=$no;
				foreach($viewall_page as $data){
					if($data->user_level=='1' || $data->username=='sanca'){
						
					}else{
					$no++;
					
					$cek_user_level=$this->user->cek_user_level($data->username,$data->password)->user_level;
					$ambil_user_level=$this->user->ambil_user_level($cek_user_level)->ket;
					$data_pengguna=$this->user->viewall_pengguna_by_user_id($data->id);
					if($data_pengguna){
						$nama_pengguna=$data_pengguna->nama_lengkap;
						$no_tlp=$data_pengguna->no_tlp;
						$email=$data_pengguna->email;
						$alamat=$data_pengguna->alamat;						
						$foto=$data_pengguna->foto;
					}else{
						$nama_pengguna='';
						$no_tlp='';
						$email='';
						$alamat='';						
						$foto='';
					}
					?>
					<tr>
			  <td><?php echo $no;?></td>
			  <td><?php echo $data->username; ?></td>
			  <td><?php echo $nama_pengguna; ?></td>
			  <td><?php echo $ambil_user_level; ?></td>
			  
			  <td><a class="btn btn-app" data-toggle="modal" data-target="#myModalview<?php echo $data->id;?>">
				<i class="fa fa-tv"></i> View
				</a><a class="btn btn-app" data-toggle="modal" data-target="#myModal<?php echo $data->id;?>">
				<i class="fa fa-edit"></i> Edit
				</a>
				<?php 
					if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
				?>
				<a class="btn btn-app" data-toggle="modal" data-target="#myModalconfirm<?php echo $data->id;?>">
				<i class="fa fa-trash"></i> Hapus
				</a>
					<?php }?>
				</td>
			</tr>

				<!-- Modal Confirm-->
				<div class="modal fade" id="myModalconfirm<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog " role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Alert Hapus User</h4>
					  </div>
					  <div class="modal-body">
					<div class="callout callout-danger">
                    <h4>Menghapus User <?php echo $nama_pengguna;?>. Dengan Username: <?php echo $data->username;?></h4>
                    <p>Apakah anda yakin ingin menghapus Akun dengan nama <strong><?php echo $nama_pengguna;?>, Dan Usename <?php echo $data->username;?></strong> ?</p>
                  </div>					  
					  <div class="modal-footer">					
						<a href="<?php echo $this->uri->baseUri;?>admin/user/hapus_user/<?php echo base64_encode($data->id);?>" type="button" class="btn btn-danger">Hapus</a>	
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
					  </div>
					</div>
				  </div>
				</div>
				<!-- END Modal confirm -->
				
				<!-- Modal View-->
				<div class="modal fade bs-example-modal-lg" id="myModalview<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">View User <?php echo $nama_pengguna;?> dengan username: <?php echo $data->username;?></h4>
					  </div>
					  <div class="modal-body">
						<!--FORM View-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="#">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
						
							<div class="form-group">	
							  <label class="col-sm-2 control-label">Username:</label>
							  <div class="col-sm-10" >
							  <input type="text" class="form-control" value="<?php echo $data->username;?>" readonly >
							  </div>			  
							</div>
							
							<div class="form-group">	
							  <label class="col-sm-2 control-label">Password:</label>
							  <div class="col-sm-10" >
							  <input type="text" class="form-control" value="xxxxx" readonly>
							  </div>			  
							</div>
							
							
							<div class="form-group">	
							  <label class="col-sm-2 control-label">User Level:</label>
							  <div class="col-sm-10" >							  
							  <input type="text" class="form-control" value="<?php echo $ambil_user_level;?>" readonly>							  
							  </div>			  
							</div>	
							
						</div>
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
							
							<div class="form-group">
							  <label class="col-sm-2 control-label">Foto:</label>
							  <div class="col-sm-10" >
							  <?php if($foto){
								  ?>
								  <img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto;?>" style="width:200px; height:200px;">
								
								<?php
							  }else{
								  ?>
								  <img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/user/blank.png">
								
								  <?php
							  }?>
							  </div>			  
							</div>
							
							<div class="form-group">	
							  <label class="col-sm-2 control-label">Nama Lengkap:</label>
							  <div class="col-sm-10" >
							  <input type="text" class="form-control" value="<?php echo $nama_pengguna;?>" readonly >
							  </div>			  
							</div>
							
							<div class="form-group">	
							  <label class="col-sm-2 control-label">No Telpon:</label>
							  <div class="col-sm-10" >
							  <input type="text" class="form-control" value="<?php echo $no_tlp;?>" readonly >
							  </div>			  
							</div>
							<div class="form-group">	
							  <label class="col-sm-2 control-label">Email:</label>
							  <div class="col-sm-10" >
							  <input type="text" class="form-control" value="<?php echo $email;?>" readonly >
							  </div>			  
							</div>
							<div class="form-group">	
							  <label class="col-sm-2 control-label">Alamat:</label>
							  <div class="col-sm-10" >
							  <textarea type="text" class="form-control" readonly ><?php echo $alamat;?></textarea>
							  </div>			  
							</div>
						
						</div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
						</form>
						<!-- end form View-->
					  </div>
					</div>
				  </div>
				</div>
				<!-- END Modal View-->
				
				<!-- Modal Edit-->
				<div class="modal fade bs-example-modal-lg" id="myModal<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Edit User</h4>
					  </div>
					  <div class="modal-body">
						<!--FORM Edit-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/user/edit_user">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;padding:5px;">	
						<input type="hidden" name="id" value="<?php echo $data->id;?>">
						
						<div class="form-group">	
						  <label class="col-sm-2 control-label">Username:</label>
						  <div class="col-sm-10" >
						  <input name="username" type="text" class="form-control" value="<?php echo $data->username;?>"  readonly >
							<p class="help-block">Maaf username tidak bisa diganti</p>
						 </div>			  
						</div>
						
						<div class="form-group">	
						  <label class="col-sm-2 control-label">Password:</label>
						  <div class="col-sm-10" >
						  <input  name="password" type="text" class="form-control" value="" >
						  Kosongkan jika tidak akan merubah password
						  </div>			  
						</div>
						<?php
							if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
						  ?>
						<div class="form-group">	
						  <label class="col-sm-2 control-label">User Level:</label>
						  <div class="col-sm-10" >
						  
						  <select name="user_level" class="form-control" required>
						  <?php if($user_level){
							  foreach($user_level as $user_level2){
								  ?>
									<option value="<?php echo $user_level2->level;?>"><?php echo $user_level2->ket;?></option>
								  <?php
							  }
						  }else{
							  ?>
							  <option value="">Input User Grup Terlebih dahulu</option>
							  <?php
						  }
							  
						  ?>
						  </select>
						  </div>			  
						</div>
							<?php }?>
						</div>
						
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;padding:5px;">	
						
						<div class="form-group">
						  <label class="col-sm-2 control-label">Foto:</label>
						  <div class="col-sm-10" >
						  <?php if($foto){
							  ?>
							  <img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto;?>" style="width:200px; height:200px;">
							<input name="foto_old" type="hidden" value="<?php echo $foto;?>" >
							<?php
						  }else{
							  ?>
							  <img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/user/blank.png">
							  <input name="foto_old" type="hidden" value="xxx.jpg" >
							  <?php
						  }?>
						  <input name="foto" type="file" >
						  </div>			  
						</div>
						
						<div class="form-group">	
						  <label class="col-sm-2 control-label">Nama Lengkap:</label>
						  <div class="col-sm-10" >
						  <input  name="nama_lengkap" type="text" class="form-control" value="<?php echo $nama_pengguna;?>" required >
						  </div>			  
						</div>
						<div class="form-group">	
						  <label class="col-sm-2 control-label">No Telpon:</label>
						  <div class="col-sm-10" >
						  <input  name="no_tlp" type="text" class="form-control" value="<?php echo $no_tlp;?>" required >
						  </div>			  
						</div>
						<div class="form-group">	
						  <label class="col-sm-2 control-label">Email:</label>
						  <div class="col-sm-10" >
						  <input  name="email" type="text" class="form-control" value="<?php echo $email;?>" required >
						  </div>			  
						</div>
						<div class="form-group">	
						  <label class="col-sm-2 control-label">Alamat:</label>
						  <div class="col-sm-10" >
						  <textarea  name="alamat" type="text" class="form-control" required ><?php echo $alamat;?></textarea>
						  </div>			  
						</div>
						
						</div>
					  <div class="modal-footer">
						<input type="submit" class="btn btn btn-primary" value="Save changes">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
						</form>
						<!-- end form EDIT-->
					  </div>
					</div>
				  </div>
				</div>
				<!-- END Modal -->
					<?php
					}//if username sanca
				}//end foreach
			}else{
				?>
				<tr>
			  <td colspan="5">Data tidak ada</td>
			</tr>
				
				<?php
			}?>
		  </table>
		</div><!-- /.box-body -->
		<div class="box-footer clearfix">
		  <ul class="pagination pagination-sm no-margin pull-right">
			<?php if ($pageLinks): ?>
					
					<?php foreach ($pageLinks as $paging): ?>
						<?php echo '<li>'.$paging; ?></li>
						
					<?php endforeach; ?>
				
						<?php endif; ?>
		  </ul>
		</div>
	  </div><!-- /.box -->
	</div>
  </div>
  <!-- END View data -->