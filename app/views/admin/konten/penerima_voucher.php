<?php if(isset($alert)){
	echo $alert;
}
?>
<div class="row">
	<div class="col-md-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Tools</h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>			
			<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		  </div>
		</div><!-- /.box-header -->
		<div class="box-body">	
		<?php $this->output('admin/form/tools_penerima');?>
		
		
		</div>
	</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Data Penerima Voucher</h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>			
			<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		  </div>
		</div><!-- /.box-header -->
		<div class="box-body">
				<table class="table table-bordered table-hover">
			<tr>
			  <th >No</th>
			  <th >Nama Rekanan</th>
			  <th >Nama Penerima</th>
			  <th >No Voucher</th>
			  <th >Activated</th>
			  <th >Action</th>
			</tr>
				<?php if($penerima_voucher){
					if(isset($no)){
						$no=$no;
					}else{
						$no=0;
					}
					
					foreach($penerima_voucher as $data){
						$no++;
						$nama_rekanan=$this->rekanan->view_nama_rekanan_by_id($data->id_rekanan)->nama_rekanan;
						$no_voucher=$this->voucher->view_no_voucher($data->id_voucher)->no_voucher;
						$potongan=$this->voucher->potongan($no_voucher)->potongan;						
						$username=$this->user->ambil_username($data->user_id)->username;
						$nama_pengguna=$this->user->view_nama_lengkap($data->user_id)->nama_lengkap;
						?>
						<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $nama_rekanan;?></td>
						<td><?php echo $data->nama_penerima;?></td>
						<td><?php echo $no_voucher;?></td>					
						
						
						<td><?php 
						if($data->aktif=='1'){
							echo '<p style="color:green;">Activated</p>';
						}elseif($data->aktif=='0'){
							?>
							<a class="btn btn-danger" data-toggle="modal" data-target="#myModalactivate<?php echo $data->id;?>">
							<i class="fa fa-exclamation-triangle"></i> Activate First !!!
							<p>Klik untuk aktifasi Voucher</p>
							</a>
							<?php
						}else{
							echo 'Belum ada keterangan';
						}?></td>
						
						<td>
						<a class="btn btn-app" data-toggle="modal" data-target="#myModalview<?php echo $data->id;?>">
							<i class="fa fa-tv"></i> Detail Penerima
							</a>
						<a class="btn btn-app" data-toggle="modal" data-target="#myModaledit<?php echo $data->id;?>">
							<i class="fa fa-edit"></i> Edit Penerima
							</a>
							
						<a class="btn btn-app" data-toggle="modal" data-target="#myModalconfirm<?php echo $data->id;?>">
							<i class="fa fa-trash"></i> Hapus Penerima
							</a>
						</td>
						</tr>
						<!-- Modal Confirm Activate-->
					<div class="modal fade" id="myModalactivate<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog " role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Aktifasi Voucher dan Penerima</h4>
						  </div>
						  <div class="modal-body">
						<div class="callout callout-warning">
						<h4>Anda akan melakukan aktifasi voucher : <br/><?php echo $no_voucher;?> </h4>
						<h4>Untuk Username : <?php echo $username;?> </h4>
						<p></p>
					  </div>	
						<form method="post" action="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/activate">
						<input type="hidden" name="id" value="<?php echo $data->id;?>"/>
						<input type="hidden" name="username" value="<?php echo $username;?>"/>
						<input type="hidden" name="no_voucher" value="<?php echo $no_voucher;?>"/>
						  <div class="modal-footer">
							<button type="submit" class="btn btn-primary" ><i class="fa fa-edit"></i> Activate now !!!</button>
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
						  </div>
						  
						</form>
						  </div>
						</div>
					  </div>
					</div>
					<!-- END Modal confirm Activate -->
						<!-- Modal Confirm-->
					<div class="modal fade" id="myModalconfirm<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog " role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Alert Hapus Penerima Voucher</h4>
						  </div>
						  <div class="modal-body">
						<div class="callout callout-danger">
						<h4>Menghapus data </h4>
						<p>Fiture menghapus data penerima Voucher masih di non aktifkan.</p>
					  </div>					  
						  <div class="modal-footer">					
							<a href="#" type="button" class="btn btn-danger disabled"><i class="fa fa-trash"></i> Hapus</a>	
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
						  </div>
						  </div>
						</div>
					  </div>
					</div>
					<!-- END Modal confirm -->
						<!-- MODAL View penerima -->
				<div class="modal fade bs-example-modal-lg" id="myModalview<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">View Detail Penerima Voucher <strong><?php echo $no_voucher;?></strong></h4>
					  </div>
					  <div class="modal-body">
						
					  <form class="form-horizontal">
						<div class="form-group">
							<label for="input_id_rekanan" class="col-sm-2 control-label">ID Rekanan</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="input_id_rekanan" value="<?php echo $data->id_rekanan;?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="input_no_voucher" class="col-sm-2 control-label">No_voucher</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="input_no_voucher" value="<?php echo $no_voucher.' (Rp. '.number_format($potongan,0,'','.').')';?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="input_nama_rekanan" class="col-sm-2 control-label">Nama Rekanan</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="input_nama_rekanan" value="<?php echo $nama_rekanan;?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="input_penerima" class="col-sm-2 control-label">Nama Penerima</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="input_penerima" value="<?php echo $data->nama_penerima;?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="input_tlp" class="col-sm-2 control-label">Nomer Telpon</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="input_tlp" value="<?php echo $data->no_tlp;?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="input_email" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="input_email" value="<?php echo $data->email;?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="input_alamat" class="col-sm-2 control-label">Alamat</label>
							<div class="col-sm-10">
							  <textarea class="form-control" id="input_alamat" readonly><?php echo $data->alamat;?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="input_username" class="col-sm-2 control-label">Username</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="input_username" value="<?php echo $username;?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="input_tgl_terima" class="col-sm-2 control-label">Tanggal Terima Voucher</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="input_tgl_terima" value="<?php echo $data->tgl_terima;?>" readonly>
							</div>
						</div>
					  </form>
						<div class="clearfix"></div>
						
					  </div>
					  
					  <div class="modal-footer">
						<a class="btn btn-app" data-dismiss="modal">
							<i class="fa fa-close"></i> Close
							</a>
					  </div>
					  
					</div>
					
				  </div>
				</div>
				<!-- END Modal view penerima -->
				
						<!-- MODAL Edit penerima -->
				<div class="modal fade bs-example-modal-lg" id="myModaledit<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Edit Data Penerima Voucher <strong><?php echo $no_voucher;?></strong></h4>
					  </div>
					  <div class="modal-body">
					  
					  <div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Perhatian ..!!</h4>
						Sebelum klik tombol "Edit", pastikan anda memasukan data dengan benar..!
						</div>
						<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/edit_penerima">
						
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
							
							<input type="hidden" name="id" class="form-control" value="<?php echo $data->id;?>" readonly>
						
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Rekanan (ID Rekanan):</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="<?php echo $nama_rekanan.' ('.$data->id_rekanan.')';?>" readonly>
							 
							  </div>
							</div>				  
							</div>
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Nomer Voucher (Potongan):</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="<?php echo $no_voucher.' (Rp. '.number_format($potongan,0,'','.').')';?>" readonly>
							  
							  </div>
							</div>				  
							</div>
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Penerima<sup>*</sup>:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" name="nama_penerima" class="form-control" value="<?php echo $data->nama_penerima;?>" required>
							  <p class="help-block">Nama Penerima Voucher (wajib ada)</p>
							  </div>
							</div>				  
							</div>	
						<div class="col-md-6">					
							<div class="form-group">
							  <label>No Tlp/ HP<sup>*</sup>:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" name="no_tlp" class="form-control" value="<?php echo $data->no_tlp;?>" required>
							  <p class="help-block">No Telpon atau Handphone (wajib)</p>
							  </div>
							</div>				  
							</div>	
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Alamat</label>
							  <div class="input-group col-xs-12" >
							  <textarea class="form-control" name="alamat"><?php echo $data->alamat;?></textarea>
							  <p class="help-block">Alamat Penerima</p>
							  </div>
							</div>				  
							</div>	
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Email</label>
							  <div class="input-group col-xs-12" >
							  <input type="email" name="email" class="form-control" value="<?php echo $data->email;?>">
							  <p class="help-block">Email penerima (Jika ada)</p>
							  </div>
							</div>				  
							</div>
						
						<div class="clearfix"></div>
						<div class="col-md-12">	
						
						<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Perhatian ..!!</h4>
						<p>Login Akun ( Hanya bisa diganti di halaman Manage User oleh Username bersangkutan atau oleh Admin WEB. )</p>
						</div>
						</div>
							<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama User</label>
							  <div class="input-group col-xs-12" >
							  <?php if($nama_pengguna){
								  ?>
								  <input type="text" class="form-control" value="<?php echo $nama_pengguna;?>" readonly>
									<p class="help-block">Nama Pengguna hanya bisa diganti di halaman Manage User</p>
								  <?php
							  }else{
								  ?>
								  <input type="text" class="form-control" placeholder="Nama Pengguna Kosong" readonly>
									<p class="help-block">Nama Pengguna hanya bisa diganti di halaman Manage User</p>
								  <?php
							  }?>
							  
							  </div>
							</div>				  
							</div>
							<div class="col-md-6">					
							<div class="form-group">
							  <label>Username</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="<?php echo $username;?>" readonly>
							  <p class="help-block">Maaf username tidak bisa diganti</p>
							  </div>
							</div>				  
							</div>
						<div class="clearfix"></div>
							
						</div>
						
						
					  <div class="modal-footer">
						<button type="submit" class="btn btn-primary" ><i class="fa fa-edit"></i> Edit</button>
						<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
					  </div>
						
						</form>
						
					  </div>
					</div>
				  </div>
				</div>
				<!-- END Modal edit penerima -->

						<?php
					}
				}else{
					?>
					
				<tr>
				<td colspan="6">Data tidak ada</td>
				</tr>
					<?php
				}?>
		  </table>
		  <div class="box-footer clearfix">
		  <?php echo 'Total Penerima Voucher: '.$total_penerima_voucher.' Penerima';?>
		  <ul class="pagination pagination-sm no-margin pull-right">
		  <?php if(isset($pageLinks)){
			  ?>
			<?php if ($pageLinks): ?>
					
					<?php foreach ($pageLinks as $paging): ?>
						<?php echo '<li>'.$paging; ?></li>
						
					<?php endforeach; ?>
				
						<?php endif; ?>
			<?php  } ?>
		  </ul>
		</div> 
		
		
		 
		</div><!-- ./box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
</div>