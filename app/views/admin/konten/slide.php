<?php if(isset($alert)){
	echo $alert;
}?>


<?php $this->output('admin/form/input_slide');?>

  <!-- View data -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Slide Configuration</h3>
		  <a class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModalinput">
			<i class="fa fa-plus-square"></i> Tambah Slide
			</a>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
		<table class="table table-bordered table-hover">
			<tr>
			  <th style="width: 10px">No</th>
			  <th style="width: 100px">Blok</th>
			  <th style="width: 100px">Judul</th>
			  <th style="width: 400px">Keterangan</th>
			  <th style="width: 300px">Action</th>
			</tr>
			
			<?php if($viewall_slide){
				$no=0;
				foreach($viewall_slide as $data){
					$no++;
					?>
					<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $data->blok;?></td>
					<td><?php echo $data->title;?></td>
					<td><?php echo $data->keterangan;?></td>
					<td> 
						<a class="btn btn-app" data-toggle="modal" data-target="#myModalview<?php echo $data->id;?>">
						<i class="fa fa-tv"></i> View
						</a>
						<a class="btn btn-app" data-toggle="modal" data-target="#myModaledit<?php echo $data->id;?>">
						<i class="fa fa-edit"></i> Edit
						</a>
						<a class="btn btn-app" data-toggle="modal" data-target="#myModalconfirm<?php echo $data->id;?>">
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
							<h4 class="modal-title" id="myModalLabel">Alert Hapus Slide</h4>
						  </div>
						  <div class="modal-body">
						<div class="callout callout-danger">
						<h4>Menghapus Slide <?php echo $data->title;?></h4>
						<p>Apakah anda yakin ingin menghapus Slide <strong><?php echo $data->title;?></strong> ?</p>
					  </div>					  
						  <div class="modal-footer">					
							<a href="<?php echo $this->uri->baseUri;?>index.php/admin/pengaturan/hapus_slide/<?php echo base64_encode($data->id);?>" type="button" class="btn btn-danger">Hapus</a>	
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  </div>
						  </div>
						</div>
					  </div>
					</div>
					<!-- END Modal confirm -->
					<!-- MODAL View -->
						<div class="modal fade bs-example-modal-lg" id="myModalview<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Edit Data Slide</h4>
							  </div>
							  <div class="modal-body">
								<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="#">
								<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
									
									
									<div class="col-md-6">					
									<div class="form-group">
									  <label>Block Text:</label>
									  <div class="input-group col-xs-12" >
									  <input class="form-control" name="blok" type="text" value="<?php echo $data->blok;?>" readonly >
									
									  </div>
									</div>				  
									</div>
									
									<div class="col-md-6">					
									<div class="form-group">
									  <label>Judul:</label>
									  <div class="input-group col-xs-12" >
									  <input class="form-control" type="text" value="<?php echo $data->title;?>" readonly >			
									  </div>
									</div>				  
									</div>
									
									<div class="col-md-6">					
									<div class="form-group">
									  <label>Link Text:</label>
									  <div class="input-group col-xs-12" >
									  <input class="form-control" value="<?php echo $data->url_text;?>" type="text" readonly >			
									  </div>
									</div>				  
									</div>
									
									<div class="col-md-6">					
									<div class="form-group">
									  <label>Link:</label>
									  <div class="input-group col-xs-12" >
									  <input class="form-control" value="<?php echo $data->url;?>" type="text" readonly >			
									  </div>
									</div>				  
									</div>
									
									<div class="col-md-6">					
									<div class="form-group">
									  <label>Gambar:</label>
									  <div class="input-group col-xs-12" >
									  <a href="<?php echo $this->uri->baseUri;?>upload/slider/<?php echo $data->image;?>" target="_blank">
									  <img class="img-responsive img-thumbnail" style="width:200px;" src="<?php echo $this->uri->baseUri;?>upload/slider/<?php echo $data->image;?>" />
									 </a>
									  </div>
									</div>				  
									</div>
									
									<div class="col-md-12 ">					
									<div class="form-group">
									  <label>Keterangan Singkat:</label>
									  <div class="input-group col-xs-12" >
									  <div>
									  <?php echo $data->keterangan;?>
									  </div>
									  </div><!-- /.input group -->
									</div>					
									</div>
								
								</div>
								
								
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							  </div>
								
								</form>
								
							  </div>
							</div>
						  </div>
						</div>
						<!-- END Modal view -->
					
					
					<!-- MODAL EDIT -->
						<div class="modal fade bs-example-modal-lg" id="myModaledit<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Edit Data Slide</h4>
							  </div>
							  <div class="modal-body">
								<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/pengaturan/edit_slide">
								<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
									<input type="hidden" name="id" value="<?php echo $data->id;?>" >
									
									<div class="col-md-6">					
									<div class="form-group">
									  <label>Block Text:</label>
									  <div class="input-group col-xs-12" >
									  <input class="form-control" name="blok" type="text" value="<?php echo $data->blok;?>" required >
									
									  </div>
									</div>				  
									</div>
									
									<div class="col-md-6">					
									<div class="form-group">
									  <label>Judul:</label>
									  <div class="input-group col-xs-12" >
									  <input class="form-control" name="title" type="text" value="<?php echo $data->title;?>" required >			
									  </div>
									</div>				  
									</div>
									
									<div class="col-md-6">					
									<div class="form-group">
									  <label>Link Text:</label>
									  <div class="input-group col-xs-12" >
									  <input class="form-control" name="url_text" value="<?php echo $data->url_text;?>" type="text" required >			
									  </div>
									</div>				  
									</div>
									
									<div class="col-md-6">					
									<div class="form-group">
									  <label>Link:</label>
									  <div class="input-group col-xs-12" >
									  <input class="form-control" name="url" value="<?php echo $data->url;?>" type="text" required >			
									  </div>
									</div>				  
									</div>
									
									<div class="col-md-6">					
									<div class="form-group">
									  <label>Gambar:</label>
									  <div class="input-group col-xs-12" >
									  <img style="width:200px;" src="<?php echo $this->uri->baseUri;?>upload/slider/<?php echo $data->image;?>" />
									  <input name="image" type="file" >
									  <input name="image_old" type="hidden" value="<?php echo $data->image;?>" required >
										<p class="help-block"> Ukuran yang dianjurkan 1600x780 Pixel (maximal 5MB)</p>
									  </div>
									</div>				  
									</div>
									
									<div class="col-md-12 ">					
									<div class="form-group">
									  <label>Keterangan:</label>
									  <div class="input-group col-xs-12" >
									  <div>
									  <textarea id="mytextarea2" class="form-control" name="keterangan"><?php echo $data->keterangan;?></textarea>
									  </div>
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
						<!-- END Modal Edit -->
					
					
					
					
					
					<?php
				}
			}else{
				?>
				<tr>
					<td colspan="6">Data Tidak ada</td>
				</tr>
				<?php
			}?>
			  
		</table>
		</div><!-- /.box-body -->
		<div class="box-footer clearfix">
		
		</div>
	  </div><!-- /.box -->
	</div>
  </div>
  <!-- END View data -->