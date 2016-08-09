
<div class="middle-content">
            <div class="container">
                <div class="row">				
                    <div class="col-md-8">
                        <div class="widget-item">
							<div class="isi">
								<h3 class="widget-title"><?php echo $view_produk->nama_produk;?></h3>
								<?php echo $view_produk->keterangan;?>
								
							</div>
							<p><a href="#" data-toggle="modal" data-target="#myModalinput" type="button" class="btn btn-primary btn-lg btn-block">Klik Registrasi</a></p>
                        </div> <!-- /.widget-item -->
                    </div> <!-- /.col-md-8 -->
					<!-- MODAL INPUT -->
				<div class="modal fade bs-example-modal-lg" id="myModalinput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Registrasi Online <?php echo $view_produk->nama_produk.' (Rp. '.number_format($view_produk->harga,0,'','.').' )';?></h4>
					  </div>
					  <div class="modal-body">
					  <?php
						if($log=='yes'){
							echo $alert;
							$biaya=$this->produk->harga_by_id($view_produk->id)->harga;
							?>
							<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/registrasi/registrasi">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
						<?php if(isset($data_penerima_voucher)){
								$potongan=$this->voucher->potongan_by_id($data_penerima_voucher->id_voucher)->potongan;
								?>
								<input name="id_penerima" type="text" class="form-control" value="<?php echo $data_penerima_voucher->id;?>" readonly>
													
								<div class="col-md-6">					
									<div class="form-group">
									  <label>Nama Penerima Voucher:</label>
									  <div class="input-group col-xs-12" >
									  <input name="nama_penerima" type="text" class="form-control" value="<?php echo $data_penerima_voucher->nama_penerima;?>" readonly>
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
							  <input name="nama_jamaah" type="text" class="form-control" value="<?php echo $view_produk->nama_produk;?>" readonly>
							  <input name="id_produk" type="hidden" class="form-control" value="<?php echo $view_produk->id;?>" readonly>
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
							<p>Harap login terlebih dahulu sebelum melakukan pendaftaran secara online. </p>
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
				
                    <div class="col-md-4">
                        <div class="widget-item">
                            <h3 class="widget-title">Our Services</h3>
							<?php if($all_produk){
								foreach($all_produk as $data){
									$nama_kategori=$this->produk->nama_kategori($data->kategori)->nama;
									$tgl=date('d',strtotime($data->tgl_input));;
									$bulan=date('M',strtotime($data->tgl_input));
									
									?>
									<div class="post-small">
										<div class="post-date">
											<span class="time"><?php echo $tgl;?></span>
											<span><?php echo $bulan;?></span>
										</div> <!-- /.post-thumb -->
										<div class="post-content">
											<h4><a href="<?php echo $this->uri->baseUri.'index.php/produk/view/'.$data->id.'/'.$data->nama_produk;?>">
											<?php echo $data->nama_produk;?></a></h4>
											<span>Kategori: <?php echo $nama_kategori;?></span>
											<?php echo $this->image->del_img($this->readmore->readmore($data->keterangan,250));?>
											<p><a href="<?php echo $this->uri->baseUri.'index.php/produk/view/'.$data->id.'/'.$data->nama_produk;?>">Readmore ...</a></p>
											
										</div> <!-- /.post-content -->
									</div> <!-- /.post-small -->
									<?php
								}
							}else{
								
							}?>
							
                        </div> <!-- /.widget-item -->
                    </div> <!-- /.col-md-4 -->
					
					
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.middle-content -->