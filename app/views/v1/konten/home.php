<div class="container">
            <div class="row">
                <div class="our-listing owl-carousel">
				<?php if($produk){
					foreach($produk as $data){
						?>
						<div class="list-item">
                        <div class="list-thumb">
                            <div class="title">
                                <h4><?php echo $data->nama_produk;?></h4>
                            </div>
                            <img src="<?php echo $this->image->ambil_gambar($data->keterangan);?>" alt="<?php echo $data->nama_produk;?>">
                        </div> <!-- /.list-thumb -->
                        <div class="list-content">
                            <h5><?php echo $data->nama_produk;?></h5>
                            <span><p>Available Seat : <?php echo $data->seat;?></p>
								<p>Harga: <?php echo 'Rp. '.number_format($data->harga,0,'','.');?></p>
								</span>
                            <a href="#" data-toggle="modal" data-target="#myModalview<?php echo $data->id;?>" class="price-btn"> View Detail</a>
                            <a href="#" data-toggle="modal" data-target="#myModalinput<?php echo $data->id;?>" class="price-btn"> Daftar Sekarang</a>
                        </div> <!-- /.list-content -->
                    </div> <!-- /.list-item -->
						
						
						<?php
					}
				}else{
					?>
					<div class="list-item">
                        <div class="list-thumb">
                            <div class="title">
                                <h4>Tidak ada produk</h4>
                            </div>
                            <img src="<?php echo $this->image->ambil_gambar($data->keterangan);?>" alt="<?php echo $data->nama_produk;?>">
                        </div> <!-- /.list-thumb -->
                        <div class="list-content">
                            <h5><?php echo $data->nama_produk;?></h5>
                            <span><p>Available Seat : <?php echo $data->seat;?></p>
								<p>Harga: <?php echo 'Rp. '.number_format($data->harga,0,'','.');?></p>
								</span>
                            <a href="#" data-toggle="modal" data-target="#myModalview<?php echo $data->id;?>" class="price-btn"> View Detail</a>
                            <a href="#" data-toggle="modal" data-target="#myModalinput<?php echo $data->id;?>" class="price-btn"> Daftar Sekarang</a>
                        </div> <!-- /.list-content -->
                    </div> <!-- /.list-item -->
					<?php
				}?>
                    
                    
                </div> <!-- /.our-listing -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
		<?php if($produk){
			foreach($produk as $data2){
				?>
				<!-- Modal View-->
				<div class="modal fade bs-example-modal-lg" id="myModalview<?php echo $data2->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">View Produk <?php echo $data2->nama_produk;?></h4>
					  </div>
					  <div class="modal-body">
						<!--FORM View-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="#">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
												
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Nama produk:</label>
						  <div class="input-group col-xs-12" >
						  <input readonly name="nama_produk" type="text" class="form-control" value="<?php echo $data2->nama_produk;?>" >
						  </div>
						</div>				  
						</div>
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Kategori:</label>
						  <div class="input-group col-xs-12" >
						  <input readonly name="nama_produk" type="text" class="form-control" value="<?php echo $this->produk->nama_kategori($data2->kategori)->nama;?>" >
						  </div>
						</div>				  
						</div>
						
						<div class="col-md-6 ">					
						<div class="form-group">
						  <label>Warna produk (untuk keperluan report graph):</label>
						  
						  <div class="input-group my-colorpicker">
						  <input readonly type="text" name="warna" value="<?php echo $data2->warna;?>" class="form-control" />                      
						  
						  <div class="input-group-addon">
							<i></i>
						  </div>
						</div>
						  </div><!-- /.input group -->
						</div>
						<div class="col-md-3 ">					
						<div class="form-group">
						  <label>Harga:</label>
						  
						  <div class="input-group">
						  <input type="text" name="harga" value="<?php echo number_format($data2->harga,0,'','.');?>" class="form-control" readonly />                      
						  
						</div>
						  </div><!-- /.input group -->
						</div>
						
						<div class="col-md-3 ">					
						<div class="form-group">
						  <label>Jumlah Seat:</label>
						  
						  <div class="input-group">
						  <input type="text" name="seat" value="<?php echo $data2->seat;?>" class="form-control" readonly />                      
						  
						</div>
						  </div><!-- /.input group -->
						</div>
						
						<div class="col-md-12 ">					
						<div class="form-group">
						  <label>Keterangan:</label>
						  <div class="input-group col-xs-12" >
						  <div>
						  <?php echo $data2->keterangan;?>
						  </div>
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
				
				<!-- MODAL INPUT -->
				<div class="modal fade bs-example-modal-lg" id="myModalinput<?php echo $data2->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Registrasi Online <?php echo $data2->nama_produk.' (Rp. '.number_format($data2->harga,0,'','.').' )';?></h4>
					  </div>
					  <div class="modal-body">
					  <?php
						if($log=='yes'){
							echo $alert;
							$biaya=$this->produk->harga_by_id($data2->id)->harga;
							?>
							<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/registrasi/registrasi">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
						<?php if(isset($data_penerima_voucher)){
								$potongan=$this->voucher->potongan_by_id($data_penerima_voucher->id_voucher)->potongan;
								$nama_penerima=$this->user->view_nama_lengkap($data_penerima_voucher->user_id)->nama_lengkap;
								?>
								<input name="id_penerima" type="text" class="form-control" value="<?php echo $data_penerima_voucher->id;?>" readonly>
													
								<div class="col-md-6">					
									<div class="form-group">
									  <label>Nama Penerima Voucher:</label>
									  <div class="input-group col-xs-12" >
									  <input name="nama_penerima" type="text" class="form-control" value="<?php echo $nama_penerima;?>" readonly>
									  </div>
									</div>				  
									</div>
								
							<?php
							}else{
										$potongan='0';
							}?>
														
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Potongan:</label>
							  <div class="input-group col-xs-12" >
							  <input name="potongan2" type="text" class="form-control" value="<?php echo 'Rp. '.number_format($potongan,0,'','.');?>" readonly>
							  <input name="potongan" type="hidden" class="form-control" value="<?php echo $potongan;?>" readonly>
							  </div>
							</div>				  
							</div>
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Jenis Perjalanan:</label>
							  <div class="input-group col-xs-12" >
							  <input name="nama_jamaah" type="text" class="form-control" value="<?php echo $data2->nama_produk;?>" readonly>
							  <input name="id_produk" type="hidden" class="form-control" value="<?php echo $data2->id;?>" readonly>
							  </div>
							</div>
							</div>
							<input name="harga_produk" type="hidden" class="form-control" value="<?php echo $biaya;?>" readonly>
							<?php if($potongan=='0'){
								  ?>
									<div class="col-md-6">					
										<div class="form-group">
										<label>Biaya:</label>
										<div class="input-group col-xs-12" >
										<input name="biaya2" type="text" class="form-control" value="<?php echo 'Rp. '.number_format($biaya,0,'','.');?>" readonly>
										<input name="biaya" type="hidden" class="form-control" value="<?php echo $biaya;?>" readonly>
										</div>
										</div>
									</div>
								  <?php
							  }else{
								  $biaya_potongan=$biaya - $potongan;
								  ?>
								<div class="col-md-3">					
									<div class="form-group">
									<label>Biaya:</label>
									<div class="input-group col-xs-12" >
									<input name="biaya2" type="text" class="form-control" value="<?php echo 'Rp. '.number_format($biaya,0,'','.');?>" style="text-decoration:line-through;" readonly>
									<input name="biaya" type="hidden" class="form-control" value="<?php echo $biaya_potongan;?>" readonly>
									</div>
									</div>
								</div>
								<div class="col-md-3">					
									<div class="form-group">
									<label></label>
									<div class="input-group col-xs-12" >
									<input name="biaya2" type="text" class="form-control" value="<?php echo 'Rp. '.number_format($biaya_potongan,0,'','.');?>" readonly>
									</div>
									</div>
								</div>
								  <?php
							  }?>
							
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Jamaah:</label>
							  <div class="input-group col-xs-12" >
							  <input name="nama_jamaah" type="text" class="form-control" value="" required>
							  </div>
							</div>
							</div>
							
							
						<div class="col-md-6">
							<div class="form-group">
							  <label>No Tlp Jamaah:</label>
							  <div class="input-group col-xs-12" >
							  <input name="tlp_jamaah" type="text" class="form-control" value="" required>
							  </div>
							</div>				  
							</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Pembayaran Awal:</label>
							  <div class="input-group col-xs-12" id="pembayaran">
							  <input id="pembayaran" name="pembayaran" type="text" class="form-control" value="" placeholder="Pembayaran awal yang akan di transfer (Rp.)" required>
							  </div>
							</div>				  
							</div>								
							
							<div class="col-md-12 ">					
							<div class="form-group">
							  <label>Alamat:</label>
							  <div class="input-group col-xs-12" >
							  <textarea name="alamat" class="form-control" rows="3" > </textarea>
							  </div><!-- /.input group -->
							</div>					
							</div>
						</div>
						
						
					  <div class="modal-footer">
						<input type="submit" class="btn btn btn-primary" value="Submit">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					  </div>
						
						</form>
							<?php
						}else{
							?>
							<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Error Login</h4>
							<p>Harap login terlebih dahulu sebelum melakukan pendaftaran umroh secara online. </p>
							<p>Silahkan klik tombol dibawah ini untuk Login.</p>
							</div>
							<a href="<?php echo $this->uri->baseUri;?>index.php/login/" type="button" class="btn btn-primary btn-lg btn-block">Login</a>
							<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  </div>
							<?php
						}
					  ?>
						
						
					  </div>
					</div>
				  </div>
				</div>
				<!-- END Modal INPUT -->
				<?php
			}
		}?>
		<div class="middle-content"></div>