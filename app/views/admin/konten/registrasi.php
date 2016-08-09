<?php if(isset($alert)){
	echo $alert;
}
?>
<div class="row">
	<div class="col-md-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Data Register</h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>			
			<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		  </div>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
		
				<table class="table table-bordered table-hover">
			<tr>
			  <th >No</th>
			  <th >ID Register</th>
			  <th >Nama Jamaah</th>
			  <th >Produk</th>
			  <th >Harga</th>
			  <th >Status Pembayaran</th>
			  <th >Action</th>
			</tr>
			<?php if($viewall_registrasi){
				$no=$no;
				foreach($viewall_registrasi as $data){
					$no++;
					$nama_produk=$this->produk->view_nama_produk_by_id($data->id_produk)->nama_produk;
					$status=$this->pembayaran->cek_pembayaran_id_register($data->id_register);
					if($status){
						$ket_stat=0;
						$status=$status->keterangan;
					}else{
						$status='Belum ada pembayaran';
						$ket_stat=1;
					}
				?>
				
				<tr>
				<td> <?php echo $no;?> </td>
				<td> <?php echo $data->id_register;?> </td>
				<td> <?php echo $data->nama_jamaah;?> </td>
				<td> <?php echo $nama_produk;?> </td>
				<td> <?php echo 'Rp. '.number_format($data->harga_produk,0,'','.');?> </td>				
				<td><?php
					if($ket_stat==1){
						echo '<p style="color:red;">'.$status.'<p>';
					}else{
						echo '<p style="color:green;">'.$status.'<p>';
					}
					?> </td>
				</td>
				
				<td>			
					<?php if($this->session->getValue('user_level') ==1 || $this->session->getValue('user_level') ==2){?>
					<a class="btn btn-app" data-toggle="modal" data-target="#myModal<?php echo $data->id;?>">
					<i class="fa fa-edit"></i> Edit Data
					</a>
					<?php } ?>
				</td>
				</tr>
				<!-- MODAL edit penerima -->
				<div class="modal fade bs-example-modal-lg" id="myModal<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Edit Data Registrai Online dengan ID <strong><?php echo $data->id_register;?></strong></h4>
					  </div>
					  <div class="modal-body">
					  <div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Perhatian ..!!</h4>
						<p>Hasil editan akan terlihat oleh Jamaah, Pastikan data yang di rubah sudah benar.</p>
						</div>
						<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/registrasi/edit_registrasi">
						
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
							<input type="hidden" name="id" class="form-control" value="<?php echo $data->id;?>" readonly>
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Nama Produk:</label>
						  <div class="input-group col-xs-12" >
						  <input type="text" class="form-control" value="<?php echo $nama_produk;?>" readonly>
						  </div>
						</div>				  
						</div>
						<?php if($data->potongan=='0'){
							?>
							<div class="col-md-6">					
						<div class="form-group">
						  <label>Harga:</label>
						  <div class="input-group col-xs-12" >
						  <input type="text" class="form-control" value="<?php echo number_format($data->harga_produk,0,'','.');?>" readonly>
						  </div>
						</div>				  
						</div>
						
							<?php
						}else{
							?>
							<div class="col-md-3">					
							<div class="form-group">
							  <label>Harga:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="<?php echo number_format($data->harga_produk,0,'','.');?>" readonly>
							  </div>
							</div>				  
							</div>
							<div class="col-md-3">					
							<div class="form-group">
							  <label>Potongan:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="<?php echo number_format($data->potongan,0,'','.');?>" readonly>
							  </div>
							</div>				  
							</div>
							<?php
						}?>
						
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Total Budget:</label>
						  <div class="input-group col-xs-12" >
						  <input type="text" class="form-control" value="<?php echo number_format($data->biaya,0,'','.');?>" readonly>
						  </div>
						</div>				  
						</div>
						
						
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Pembayaran awal yang harus dilakukan:</label>
						  <div class="input-group col-xs-12" >
						  <input type="text" class="form-control" value="<?php echo number_format($data->pembayaran,0,'','.');?>" readonly>
						  </div>
						</div>				  
						</div>
						
						
						
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Jamaah<sup>*</sup>:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" name="nama_jamaah" class="form-control" value="<?php echo $data->nama_jamaah;?>" required>
							  <p class="help-block">Nama Jamaah</p>
							  </div>
							</div>				  
							</div>	
							
						<div class="col-md-6">					
							<div class="form-group">
							  <label>No Tlp/ HP<sup>*</sup>:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" name="tlp_jamaah" class="form-control" value="<?php echo $data->tlp_jamaah;?>" required>
							  <p class="help-block">No Telpon atau Handphone </p>
							  </div>
							</div>				  
							</div>	
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Alamat</label>
							  <div class="input-group col-xs-12" >
							  <textarea class="form-control" name="alamat" required><?php echo $data->alamat;?></textarea>
							  <p class="help-block">Alamat Jamaah</p>
							  </div>
							</div>				  
							</div>
							
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Keterangan</label>
							  <div class="input-group col-xs-12" >
							  <textarea class="form-control" readonly><?php echo $status;?></textarea>
							  <p class="help-block">Keterangan Jamaah hanya bisa di edit di halaman Data Konfirmasi Pembayaran.</p>
							  </div>
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
		
		
		 
		</div><!-- ./box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
</div>