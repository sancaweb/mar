
	<!-- View data -->
  <div class="row">
	<div class="col-xs-12 table-responsive">
	<?php if(isset($alert)){
				echo $alert;
			}
			?>
		  <table class="table table-bordered table-hover">
			<tr>
			  <th>No</th>
			  <th>Nama Jamaah</th>
			  <th>Produk</th>
			  <th>Harga</th>
			  <th>Status</th>
			  <th>Action</th>
			</tr>
			<?php if ($viewall_registrasi_user_id){
				$no=$no;
				foreach($viewall_registrasi_user_id as $data){
					$no++;
					$nama_produk=$this->produk->view_nama_produk_by_id($data->id_produk)->nama_produk;
					$status=$this->pembayaran->cek_pembayaran_id_register($data->id_register);
					if($status){
						$status=$status->keterangan;
						$konf='1';
					}else{
						$status='<p style="color:red;">Belum ada konfirmasi pembayaran</p>';
						$konf='0';
					}
					?>
					<tr>
			  <td><?php echo $no;?></td>
			  <td><?php echo $data->nama_jamaah; ?></td>
			  <td><?php echo $nama_produk; ?></td>
			  <td><?php echo 'Rp. '.number_format($data->harga_produk,0,'','.'); ?></td>
			  <td><?php echo $status; ?></td>
			  <td><a class="btn btn-primary" data-toggle="modal" data-target="#myModalview<?php echo $data->id;?>">
				<i class="fa fa-camera"></i> View
				</a>
				<?php if($konf=='1'){
					
				}else{
					?>					
					<a class="btn btn-primary" data-toggle="modal" data-target="#myModaledit<?php echo $data->id;?>">
					<i class="fa fa-pencil-square-o"></i> Konfirmasi Pembayaran
					</a>
					<?php
				}?>
				</td>
			</tr>
				
				<!-- Modal View-->
				<div class="modal fade bs-example-modal-lg" id="myModalview<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Detail data registrasi dengan id register : <?php echo $data->id_register;?></h4>
					  </div>
					  <div class="modal-body">
						<!--FORM View-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="#">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
						
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
						  <label>Nama Jamaah:</label>
						  <div class="input-group col-xs-12" >
						  <input type="text" class="form-control" value="<?php echo $data->nama_jamaah;?>" readonly>
						  </div>
						</div>				  
						</div>
						<div class="col-md-6 ">					
						<div class="form-group">
						  <label>Alamat:</label>
						  <div class="input-group col-xs-12" >
						  <textarea name="alamat" class="form-control" rows="3" readonly><?php echo $data->alamat;?> </textarea>
						  </div><!-- /.input group -->
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
				
				<!-- Modal konfirmasi pembayaran-->
				<div class="modal fade bs-example-modal-lg" id="myModaledit<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Konfirmasi pembayaran dengan id register: <?php echo $data->id_register;?></h4>
					  </div>
					  <div class="modal-body">
					  <div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> PERHATIAN ...!</h4>
						<p>Sebelum melakukan konfirmasi pembayaran, pastikan anda sudah melakukan transfer ke salah satu rekening kami sebesar
						jumlah yang sudah anda isikan saat registrasi, yaitu sebesar <?php echo 'Rp. '.number_format($data->pembayaran,0,'','.')?>.</p>
						<p>Keterlambatan proses konfirmasi pembayaran yang diakibatkan oleh kesalahan dalam proses pembayaran, bukan tanggung jawab kami.</p>
						</div>
						<!--FORM konfirmasi pembayaran-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/pembayaran/konfirmasi">
						
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
						<input type="hidden" name="id_produk" value="<?php echo $data->id_produk;?>">
						<input type="hidden" name="id_register" value="<?php echo $data->id_register;?>">
							<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Produk:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="<?php echo $nama_produk;?>" readonly>
							  </div>
							</div>				  
							</div>
							<div class="col-md-6">					
							<div class="form-group">
							  <label>Budget:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="<?php echo number_format($data->harga_produk,0,'','.');?>" readonly>
							  </div>
							</div>				  
							</div>
							
							<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Jamaah:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="<?php echo $data->nama_jamaah;?>" readonly>
							  </div>
							</div>				  
							</div>
							<div class="col-md-6 ">					
							<div class="form-group">
							  <label>Transfer ke rekening:</label>
							  <div class="input-group col-xs-12" >
							  <select class="form-control " name="rekening_tujuan" required>
							  <?php if($rekening_tujuan){
								  foreach ($rekening_tujuan as $rekening_tujuan){
									  ?>
									  <option value="<?php echo $rekening_tujuan->id;?>"><?php echo $rekening_tujuan->nama_bank.' / '.$rekening_tujuan->nama_pemilik.' / '.$rekening_tujuan->norek;?></option>
									  <?php
								  }
							  }?>
							  </select>
							  
							  </div><!-- /.input group -->
							</div>					
							</div>
							
							<div class="col-md-6 ">					
							<div class="form-group">
							  <label>Nama Bank Pengirim:</label>
							  <div class="input-group col-xs-12" >
							  <select class="form-control " name="bank_pengirim" required>
							  <?php if($viewall_bank){
								  foreach ($viewall_bank as $viewall_bank){
									  ?>
									  <option value="<?php echo $viewall_bank->id;?>"><?php echo $viewall_bank->nama_bank;?></option>
									  <?php
								  }
							  }?>
							  </select>
							  
							  </div><!-- /.input group -->
							</div>					
							</div>
								
							
							<div class="col-md-6">					
							<div class="form-group">
							  <label>Nomer Rekening Pengirim:</label>
							  <div class="input-group col-xs-12" >
							  <input name="norek_pengirim" type="text" class="form-control" value="" required >
							  </div>
							</div>				  
							</div>						
							
							<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Pemilik Rekening:</label>
							  <div class="input-group col-xs-12" >
							  <input name="pemilik_bank" type="text" class="form-control" value="" required >
							  </div>
							</div>				  
							</div>
							
							<div class="col-md-6 ">					
							<div class="form-group">
							  <label>Jumlah Transfer (Rupiah):</label>
							  <div class="input-group col-xs-12" id="pembayaran">
							  <input name="jml_pembayaran" id="pembayaran" type="text" class="form-control" value="" required >
							  <p class="help-block">Minimal pembayaran <?php echo number_format($data->pembayaran,0,'','.');?></p>
							  </div><!-- /.input group -->
							</div>					
							</div>
							
							<div class="col-md-2 ">					
							<div class="form-group">
							  <label>Tanggal Transfer:</label>
							  <div class="input-group col-xs-12" id="pembayaran">
							  <select class="form-control " name="tgl_transfer" required>
							  <option value="">Tanggal</option>
							  <?php
								$tahun = date('Y'); //Mengambil tahun saat ini
								$bulan = date('m'); //Mengambil bulan saat ini
								$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
								for ($i=1; $i < $tanggal+1; $i++) {
								  echo '<option value="'.$i.'">'.$i.'</option>';
								}
							  ?>							  
							  </select>
							  </div><!-- /.input group -->
							  </div>
							  </div>
							  <div class="col-md-2 ">					
							<div class="form-group">
							  <label></label>
							  <div class="input-group col-xs-12" id="pembayaran">
							  <select class="form-control " name="bln_transfer" required>
							  <option value="">Bulan</option>
							  <option value="01">Januari</option>
							  <option value="02">Februari</option>
							  <option value="03">Maret</option>
							  <option value="04">April</option>
							  <option value="05">Mei</option>
							  <option value="06">Juni</option>
							  <option value="07">Juli</option>
							  <option value="08">Agustus</option>
							  <option value="09">September</option>
							  <option value="10">Oktober</option>
							  <option value="11">Nopember</option>
							  <option value="12">Desember</option>
							  </select>
							  </div><!-- /.input group -->
							  </div>
							  </div>
							  <div class="col-md-2 ">
							<div class="form-group">
							  <label></label>
							  <div class="input-group col-xs-12" id="pembayaran">
							  <select class="form-control " name="thn_transfer" required>
							  <option value="">Tahun</option>
							  <?php
							  for ($i=0; $i < 2; $i++) {
								  $tahun=$tahun - $i;
								  echo '
									<option value="'.$tahun.'">'.$tahun.'</option>
								  ';
							  }
							  ?>
							  
							  </select>
							  </div><!-- /.input group -->
							</div>					
							</div>
							
							
							<div class="col-md-6 ">					
							<div class="form-group">
							  <label>Bukti Transfer:</label>
							  <div class="input-group col-xs-12" >
							  <input name="bukti" type="file" required >
							  <p class="help-block">Bukti berupa file gambar (gif,jpg,png,jpeg) maksimal 5Mb.</p>
							  </div><!-- /.input group -->
							</div>					
							</div>
							
						</div>
						
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="submit" class="btn btn btn-primary" value="Save changes">
					  </div>
						</form>
						<!-- end form konfirmasi pembayaran-->
					  </div>
					</div>
				  </div>
				</div>
				<!-- END Modal -->
					<?php
				}
			}else{
				?>
				<tr>
			  <td colspan="5">Data tidak ada</td>
			</tr>
				
				<?php
			}?>
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
  <!-- END View data -->
		
