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
		
				<table class="table table-bordered table-hover table-responsive">
				<tr>
				  <th>No</th>
				  <th>Id Registrasi</th>
				  <th>Transfer Ke</th>
				  <th>Nama Bank Pengirim</th>
				  <th>Nama Pemilik Rekening</th>			  
				  <th>Jumlah yang di transfer</th>			  
				  <th>Keterangan</th>
				  <th>Action</th>
				</tr>
			<?php if($viewall_pembayaran){
				$no=$no;
				foreach($viewall_pembayaran as $data){
					$no++;
					
					$id_produk=$this->registrasi->id_produk_by_id_register($data->id_register)->id_produk;
					$nama_produk=$this->produk->view_nama_produk_by_id($id_produk)->nama_produk;
					
					$bank_tujuan=$this->pengaturan->rekening_by_id($data->rekening_tujuan)->nama_bank;
					$pemilik_bank_tujuan=$this->pengaturan->rekening_by_id($data->rekening_tujuan)->nama_pemilik;
					$norek_tujuan=$this->pengaturan->rekening_by_id($data->rekening_tujuan)->norek;
					$rekening_tujuan=$bank_tujuan.', '.$pemilik_bank_tujuan.', '.$norek_tujuan;
					
					$potongan=$this->registrasi->potongan_by_id_register($data->id_register)->potongan;					
					$harga=$this->registrasi->harga_produk_by_id_register($data->id_register)->harga_produk;					
					$biaya=$this->registrasi->biaya_by_id_register($data->id_register)->biaya;
					$pembayaran=$this->registrasi->pembayaran_by_id_register($data->id_register)->pembayaran;
					$nama_jamaah=$this->registrasi->nama_jamaah_by_id_register($data->id_register)->nama_jamaah;
					$bank_pengirim=$this->pengaturan->nama_bank_by_id($data->bank_pengirim)->nama_bank;
					
			?>
				
				<tr>
				<td> <?php echo $no;?> </td>
				<td> <?php echo $data->id_register;?> </td>
				<td> <?php echo $rekening_tujuan;?> </td>
				<td><?php echo $bank_pengirim; ?></td>
				<td> <?php echo $data->pemilik_bank;?> </td>
				<td><?php echo 'Rp. '.number_format($data->jml_pembayaran,0,'','.'); ?></td>
				<td><?php echo $data->keterangan; ?></td>				
				<td>
					
					<a class="btn btn-app" data-toggle="modal" data-target="#myModal<?php echo $data->id;?>">
					<i class="fa fa-edit"></i> Edit Data
					</a>
				</td>
				</tr>
				<!-- MODAL edit pembayaran -->
				<div class="modal fade bs-example-modal-lg" id="myModal<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Edit Data Konfirmasi Pembayaran dengan ID Register <strong><?php echo $data->id_register;?></strong></h4>
					  </div>
					  <div class="modal-body">
					  <div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Perhatian ..!!</h4>
						<p>Hasil editan akan terlihat oleh Jamaah, Pastikan data yang di rubah sudah benar.</p>
						</div>
						<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/pembayaran/edit_konfirmasi">
						
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
							<input type="hidden" name="id" class="form-control" value="<?php echo $data->id;?>" readonly>
							<input type="hidden" name="id_produk" class="form-control" value="<?php echo $id_produk;?>" readonly>
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Nama Produk:</label>
						  <div class="input-group col-xs-12" >
						  <input type="text" class="form-control" value="<?php echo $nama_produk;?>" readonly>
						  </div>
						</div>				  
						</div>
						<?php if($potongan=='0'){
							?>
							<div class="col-md-6">					
						<div class="form-group">
						  <label>Harga:</label>
						  <div class="input-group col-xs-12" >
						  <input type="text" class="form-control" value="<?php echo number_format($harga,0,'','.');?>" readonly>
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
							  <input type="text" class="form-control" value="<?php echo number_format($harga,0,'','.');?>" readonly>
							  </div>
							</div>				  
							</div>
							<div class="col-md-3">					
							<div class="form-group">
							  <label>Potongan:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="<?php echo number_format($potongan,0,'','.');?>" readonly>
							  </div>
							</div>				  
							</div>
							<?php
						}?>
						<div class="col-md-6">					
							<div class="form-group">
							<label>Total Budget:</label>
								<div class="input-group col-xs-12" >
									<input type="text" class="form-control" value="<?php echo number_format($biaya,0,'','.');?>" readonly>
								</div>
							</div>				  
						</div>
						<div class="col-md-6">					
							<div class="form-group">
							<label>Pembayaran awal yang harus dilakukan:</label>
								<div class="input-group col-xs-12" >
									<input type="text" class="form-control" value="<?php echo number_format($pembayaran,0,'','.');?>" readonly>
								</div>
							</div>				  
						</div>
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Jamaah:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="<?php echo $nama_jamaah;?>" readonly>
							  <p class="help-block">Hanya bisa di edit pada halaman list registrasi</p>
							  </div>
							</div>				  
							</div>
							
							
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Keterangan</label>
							  <div class="input-group col-xs-12" >
							  <textarea class="form-control" readonly><?php echo $data->keterangan;?></textarea>							  
							  </div>
							</div>				  
							</div>
							
							
						</div>
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
						<div class="col-md-6">					
							<div class="form-group">
							<label>Rekening Tujuan:</label>
								<div class="input-group col-xs-12" >
									<input type="text" class="form-control" value="<?php echo $rekening_tujuan;?>" readonly>
								</div>
							</div>				  
						</div>

						<div class="col-md-6">					
							<div class="form-group">
							<label>Nama Bank Pengirim:</label>
								<div class="input-group col-xs-12" >
									<input type="text" class="form-control" value="<?php echo $bank_pengirim;?>" readonly>
								</div>
							</div>				  
						</div>

						<div class="col-md-6">					
							<div class="form-group">
							<label>Nama Pemilik Rekening:</label>
								<div class="input-group col-xs-12" >
									<input type="text" class="form-control" value="<?php echo $data->pemilik_bank;?>" readonly>
								</div>
							</div>				  
						</div>

						<div class="col-md-6">					
							<div class="form-group">
							<label>Nomer Rekening Pengirim:</label>
								<div class="input-group col-xs-12" >
									<input type="text" class="form-control" value="<?php echo $data->norek_pengirim;?>" readonly>
								</div>
							</div>				  
						</div>

						<div class="col-md-6">					
							<div class="form-group">
							<label>Jumlah yang di transfer:</label>
								<div class="input-group col-xs-12" >
									<input type="text" class="form-control" value="<?php echo number_format($data->jml_pembayaran,0,'','.');?>" readonly>
								</div>
							</div>				  
						</div>

						<div class="col-md-6">					
							<div class="form-group">
							<label>Tanggal transfer:</label>
								<div class="input-group col-xs-12" >
									<input type="text" class="form-control" value="<?php echo $data->tgl_transfer;?>" readonly>
								</div>
							</div>				  
						</div>
						
						<div class="col-md-6">					
							<div class="form-group">
							<label>Bukti Pembayaran:</label>
								<div class="input-group col-xs-12" >
								<?php if($data->bukti){
								  ?>
									<a href="<?php echo $this->uri->baseUri."upload/".$data->bukti;?>" target="_blank"><img src="<?php echo $this->uri->baseUri."upload/".$data->bukti;?>" class="img-responsive img-thumbnail" width="200px"></a>
									<?php
								  }else{
								  ?>
									 <a href="<?php echo $this->uri->baseUri."upload/blank.png";?>" target="_blank"><img src="<?php echo $this->uri->baseUri."upload/blank.png";?>" class="img-responsive img-thumbnail" width="200px"></a>
								  <?php
								  }?>
									<p class="help-block">Bukti Pembayaran Jamaah</p>
								</div>
							</div>
							
						</div>
						
						<div class="col-md-6">					
							<div class="form-group">
							<label>Status Pembayaran:</label>
								<div class="input-group col-xs-12" >
									<select class="form-control" name="status">
									<option value="0" <?php if($data->status=='0'){echo 'selected';}?>>Pembayaran Belum Diterima</option>
									<option value="1" <?php if($data->status=='1'){echo 'selected';}?>>Pembayaran Berhasil Diterima</option>
									</select>									
								</div>
							</div>				  
						</div>
						
						<div class="col-md-12">					
							<div class="form-group">
							<label>Keterangan:</label>
								<div class="input-group col-xs-12" >
									<textarea class="form-control" name="keterangan"><?php echo $data->keterangan;?></textarea>
									<p class="help-block">Ubah keterangan ini untuk memberikan pesan kepada jamaah. Bisa berupa status pembayaran</p>
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