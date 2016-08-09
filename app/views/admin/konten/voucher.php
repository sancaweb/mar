<?php if(isset($alert)){
	echo $alert;
}
?>
<div class="row">
	<div class="col-md-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Data Voucher</h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>			
			<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		  </div>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
		  <?php if(isset($page)){
			  if($page=='cari_voucher'){
				  $this->output('admin/konten/cari_voucher');
			  }else{
				  ?>
				<table class="table table-bordered table-hover">
			<tr>
			  <th >No</th>
			  <th >ID Rekanan</th>
			  <th >Nama Rekanan</th>
			  <th >Jenis Rekanan</th>
			  <th >Voucher</th>
			  <th >Jumlah Voucher</th>
			  <th >Jumlah Penerima</th>
			  <th >Activated</th>
			  <th >Action</th>
			</tr>
			<?php if($viewall_voucher){
				$no=$no;
				foreach($viewall_voucher as $data){
					$no++;
					$nama_rekanan= $this->rekanan->view_nama_rekanan_by_id($data->id_rekanan)->nama_rekanan;					
					$aktif_voucher=$this->voucher->aktif_voucher($data->id);
					$jenis_rekanan=$this->rekanan->jenis_rekanan($data->id_rekanan)->jenis;
					$jumlah_penerima=$this->voucher->hitung_penerima_by_id_voucher($data->id);
				?>
				
				<tr>
				<td> <?php echo $no;?> </td>
				<td> <?php echo $data->id_rekanan;?> </td>
				<td> <?php echo $nama_rekanan;?> </td>
				<td> <?php echo ucwords($jenis_rekanan);?> </td>
				<td> <?php echo $data->no_voucher.'<br/>(Rp. '.number_format($data->potongan,0,'','.').')';?> </td>
				
				<td><?php echo $data->jumlah;?> </td>
				<td><?php echo $jumlah_penerima;?> </td>
				<td><?php echo $aktif_voucher;?> 
				</td>
				
				<td>
				<?php
				if($jenis_rekanan == 'rekanan'){
					if($jumlah_penerima < $data->jumlah){
					?>
					<a class="btn btn-app" data-toggle="modal" data-target="#myModalinput<?php echo $data->id;?>">
					<i class="fa fa-edit"></i> Input Penerima
					</a>
					<?php
					}else{
						if($aktif_voucher < $data->jumlah){
							
						?>
						<a class="btn btn-app" href="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/penerima_voucher">
						<i class="fa fa-edit"></i> Klik Untuk Aktifasi Penerima Voucher
						</a>
						<?php
						}else{
							
						}
					}
				}else{
				}?>
				</td>
				</tr>
				<!-- MODAL input penerima tombol input penerima -->
				<div class="modal fade bs-example-modal-lg" id="myModalinput<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Input Data Penerima Voucher <strong><?php echo $data->no_voucher;?></strong></h4>
					  </div>
					  <div class="modal-body">
					  <div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Perhatian ..!!</h4>
						Jangan lupa mengaktifkan penerima voucher ini di halaman <a href="<?php $this->uri->baseUri;?>index.php/admin/voucher/penerima_voucher" target="_blank">Penerima Voucher</a>.
						<p>Nama Rekanan: <strong><?php echo $nama_rekanan;?></strong></p>
						</div>
						<form id="form_penerima_voucher" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/input_penerima">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
							<input type="hidden" name="id_rekanan" class="form-control" value="<?php echo $data->id_rekanan;?>" readonly>
							<input type="hidden" name="id_voucher" class="form-control" value="<?php echo $data->id;?>" readonly>
							
						<input type="hidden" class="form-control" value="<?php echo $nama_rekanan;?>" readonly>
						
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Penerima<sup>*</sup>:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" name="nama_penerima" class="form-control" Placeholder="Nama Penerima" required>
							  <p class="help-block">Nama Penerima Voucher (wajib)</p>
							  </div>
							</div>				  
							</div>	
						<div class="col-md-6">					
							<div class="form-group">
							  <label>No Tlp/ HP<sup>*</sup>:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" name="no_tlp" class="form-control" Placeholder="08xxxxxxxx" required>
							  <p class="help-block">No Telpon atau Handphone (wajib)</p>
							  </div>
							</div>				  
							</div>	
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Alamat</label>
							  <div class="input-group col-xs-12" >
							  <textarea class="form-control" name="alamat"></textarea>
							  <p class="help-block">Alamat Penerima</p>
							  </div>
							</div>				  
							</div>	
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Email</label>
							  <div class="input-group col-xs-12" >
							  <input type="email" name="email" class="form-control" >
							  <p class="help-block">Email penerima (Jika ada)</p>
							  </div>
							</div>				  
							</div>
							<div class="clearfix"></div>
							<div class="col-md-12">	
							<legend>Login Akun</legend>
							</div>
								<div class="col-md-6">					
								<div class="form-group">
								  <label>Nama User</label>
								  <div class="input-group col-xs-12" >
								  <input name="nama_lengkap" type="text" class="form-control" value="" required>
								  <p class="help-block">Nama Pengguna User</p>
								  </div>
								</div>				  
								</div>
								<div class="col-md-6">					
								<div class="form-group">
								  <label>Username</label>
								  <div class="input-group col-xs-12" >
								  <input type="text" name="username" class="form-control" value="<?php echo $this->randomstring->randomstring(4).$data->id;?>" readonly>
								  <p class="help-block">Username ini otomatis dan tidak bisa dirubah </p>
								  </div>
								</div>				  
								</div>
								<div class="col-md-6">					
								<div class="form-group">
								  <label>Password (Default:123456)</label>
								  <div class="input-group col-xs-12" >
								  <input type="password" name="password" class="form-control" >
								  <p class="help-block">Kosongkan Password jika tidak akan melakukan penggantian password</p>
								  </div>
								</div>				  
								</div>
							<div class="clearfix"></div>
							
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
				<!-- END Modal input penerima -->
				<?php
				}
			}else{
				?>
				
				<tr>
				<td colspan="5">Data tidak ada</td>
				</tr>
				<?php
				
			}
			
			?>
			
		  </table>
		  <div class="box-footer clearfix">
		  <ul class="pagination pagination-sm no-margin pull-right">
			<?php if ($pageLinks): ?>
					
					<?php foreach ($pageLinks as $paging): ?>
						<?php echo '<li>'.$paging; ?></li>
						
					<?php endforeach; ?>
				
						<?php endif; ?>
		  </ul>
		</div> 
				  <?php
			  }
		  }?>
		
		
		 
		</div><!-- ./box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
</div>