<?php if(isset($alert)){
	echo $alert;
}?>


<?php $this->output('admin/form/input_produk');?>

  <!-- View data -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">List data produk</h3>
		  <a class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModalinput">
			<i class="fa fa-plus-square"></i> Tambah Produk
			</a>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
		  <table class="table table-bordered table-hover">
			<tr>
			  <th style="width: 10px">No</th>
			  <th style="width: 200px">Produk</th>
			  <th >Keterangan</th>
			  <th style="width: 300px">Action</th>
			</tr>
			<?php if ($viewall_produk){
				$no=$no;
				foreach($viewall_produk as $data){
					$no++;
					?>
					<tr>
			  <td><?php echo $no;?></td>
			  <td><?php echo $data->nama_produk; ?></td>
			  <td><?php echo $this->image->del_img($this->readmore->readmore($data->keterangan,500)).' ... '; ?></td>
			  <td><a class="btn btn-app" data-toggle="modal" data-target="#myModalview<?php echo $data->id;?>">
				<i class="fa fa-tv"></i> View
				</a><a class="btn btn-app" data-toggle="modal" data-target="#myModal<?php echo $data->id;?>">
				<i class="fa fa-edit"></i> Edit
				</a><a class="btn btn-app" data-toggle="modal" data-target="#myModalconfirm<?php echo $data->id;?>">
				<i class="fa fa-trash"></i> Hapus
				</a>
				</td>
			</tr>

				<!-- Modal Confirm-->
				<div class="modal fade" id="myModalconfirm<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog " role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Alert Hapus produk</h4>
					  </div>
					  <div class="modal-body">
					<div class="callout callout-danger">
                    <h4>Menghapus data <?php echo $data->nama_produk;?></h4>
                    <p>Apakah anda yakin ingin menghapus data <strong><?php echo $data->nama_produk;?></strong> ?</p>
                  </div>					  
					  <div class="modal-footer">					
						<a href="<?php echo $this->uri->baseUri;?>admin/produk/hapus_produk/<?php echo base64_encode($data->id);?>" type="button" class="btn btn-danger">Hapus</a>	
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
						<h4 class="modal-title" id="myModalLabel">View Produk <?php echo $data->nama_produk;?></h4>
					  </div>
					  <div class="modal-body">
						<!--FORM View-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="#">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
						<input type="hidden" name="id" value="<?php echo $data->id;?>">
						
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Nama produk:</label>
						  <div class="input-group col-xs-12" >
						  <input readonly name="nama_produk" type="text" class="form-control" value="<?php echo $data->nama_produk;?>" >
						  </div>
						</div>				  
						</div>
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Kategori:</label>
						  <div class="input-group col-xs-12" >
						  <input readonly name="nama_produk" type="text" class="form-control" value="<?php echo $this->produk->nama_kategori($data->kategori)->nama;?>" >
						  </div>
						</div>				  
						</div>
						
						<div class="col-md-6 ">					
						<div class="form-group">
						  <label>Warna produk (untuk keperluan report graph):</label>
						  
						  <div class="input-group my-colorpicker">
						  <input readonly type="text" name="warna" value="<?php echo $data->warna;?>" class="form-control" />                      
						  
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
						  <input type="text" name="harga" value="<?php echo number_format($data->harga,0,'','.');?>" class="form-control" readonly />                      
						  
						</div>
						  </div><!-- /.input group -->
						</div>
						
						<div class="col-md-3 ">					
						<div class="form-group">
						  <label>Jumlah Seat:</label>
						  
						  <div class="input-group">
						  <input type="text" name="seat" value="<?php echo $data->seat;?>" class="form-control" readonly />                      
						  
						</div>
						  </div><!-- /.input group -->
						</div>
						
						<div class="col-md-12 ">					
						<div class="form-group">
						  <label>Keterangan:</label>
						  <div class="input-group col-xs-12" >
						  <div>
						  <?php echo $data->keterangan;?>
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
				
				<!-- Modal Edit-->
				<div class="modal fade bs-example-modal-lg" id="myModal<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Edit produk</h4>
					  </div>
					  <div class="modal-body">
						<!--FORM Edit-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/produk/pro_edit_produk">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
						<input type="hidden" name="id" value="<?php echo $data->id;?>">
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Nama produk:</label>
						  <div class="input-group col-xs-12" >
						  <input name="nama_produk" type="text" class="form-control" value="<?php echo $data->nama_produk;?>" required>
						  </div>
						</div>				  
						</div>
						<div class="col-md-6 ">					
						<div class="form-group">
						  <label>Kategori Produk</label>
						  
						  <div class="input-group col-xs-12">
						  <select class="form-control" name="kategori" required>
						  <?php
							if($kategori){
								foreach($kategori as $kategori2){
									?>
									<option value="<?php echo $kategori2->id;?>" <?php if($kategori2->id == $data->kategori){echo 'selected';}?>><?php echo $kategori2->nama;?></option>
									<?php
								}
							}else{
								?>
								<option value=''>tidak ada data. Input Kategori dulu</option>
								<?php
							}
						  ?>
						  </select>
						  
						  
						</div>
						  </div><!-- /.input group -->
						</div>
						<div class="col-md-6 ">					
						<div class="form-group">
						  <label>Warna produk (untuk keperluan report graph):</label>
						  
						  <div class="input-group my-colorpicker">
						  <input type="text" name="warna" value="<?php echo $data->warna;?>" class="form-control" required/>                      
						  
						  <div class="input-group-addon">
							<i></i>
						  </div>
						</div>
						  </div><!-- /.input group -->
						</div>
						<div class="col-md-3 ">					
						<div class="form-group">
						  <label>Harga:</label>
						  
						  <div class="input-group" id="div_harga2">
						  <input type="text" name="harga" id="harga2" value="<?php echo number_format($data->harga,0,'',',');?>" class="form-control" required/>                      
						  
						</div>
						  </div><!-- /.input group -->
						</div>
						
						<div class="col-md-3 ">					
						<div class="form-group">
						  <label>Jumlah Seat:</label>
						  
						  <div class="input-group">
						  <input type="text" name="seat" value="<?php echo $data->seat;?>" class="form-control" required/>                      
						  
						</div>
						  </div><!-- /.input group -->
						</div>
						
						<div class="col-md-12 ">					
						<div class="form-group">
						  <label>Keterangan:</label>
						  <div class="input-group col-xs-12" >
						  <textarea id="mytextarea2" name="keterangan" class="form-control" rows="3" > <?php echo $data->keterangan;?></textarea>
						  </div><!-- /.input group -->
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
				}
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