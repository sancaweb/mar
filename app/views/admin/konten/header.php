<?php if(isset($alert)){
	echo $alert;
}?>


<?php $this->output('admin/form/input_header');?>

  <!-- View data -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Header Configuration</h3>
		  <a class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModalinput">
			<i class="fa fa-plus-square"></i> Tambah Image Header
			</a>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
		<table class="table table-bordered table-hover">
			<tr>
			  <th style="width: 10px">No</th>
			  <th style="width: 300px">Image Header</th>
			  <th style="width: 300px">Action</th>
			</tr>
			
			<?php if($viewall_header){
				$no=0;
				foreach($viewall_header as $data){
					$no++;
					?>
					<tr>
					<td><?php echo $no;?></td>
					<td><img class="img-responsive img-thumbnail" style="width:600px;" src="<?php echo $this->uri->baseUri;?>upload/header/<?php echo $data->image;?>"></td>
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
							<h4 class="modal-title" id="myModalLabel">Alert Hapus Image Header</h4>
						  </div>
						  <div class="modal-body">
						<div class="callout callout-danger">
						<h4>Apakah anda yakin ingin Menghapus Gambar ini?</h4>
						<p><img style="width:500px;" src="<?php echo $this->uri->baseUri;?>upload/header/<?php echo $data->image;?>"></p>
					  </div>					  
						  <div class="modal-footer">					
							<a href="<?php echo $this->uri->baseUri;?>index.php/admin/pengaturan/hapus_header/<?php echo base64_encode($data->id);?>" type="button" class="btn btn-danger">Hapus</a>	
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
								<h4 class="modal-title" id="myModalLabel">View Data Image Header </h4>
							  </div>
							  <div class="modal-body">
								<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="">
								<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
									
									
									<div class="col-md-6">					
									<div class="form-group">
									  <label>Gambar:</label>
									  <div class="input-group col-xs-12" >
									  <a href="<?php echo $this->uri->baseUri;?>upload/header/<?php echo $data->image;?>" target="_blank">
									  
									 <img class="img-responsive img-thumbnail" style="width:600px;" src="<?php echo $this->uri->baseUri;?>upload/header/<?php echo $data->image;?>">
									 </a>
									  </div>
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
								<h4 class="modal-title" id="myModalLabel">Edit Data Image Header</h4>
							  </div>
							  <div class="modal-body">
								<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/pengaturan/edit_header">
								<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
									<input type="hidden" name="id" value="<?php echo $data->id;?>" >
									
									<div class="col-md-6">					
									<div class="form-group">
									  <label>Gambar:</label>
									  <div class="input-group col-xs-12" >
									  <img class="img-responsive img-thumbnail" style="width:200px;" src="<?php echo $this->uri->baseUri;?>upload/header/<?php echo $data->image;?>" />
									  <input name="image" type="file" >
									  <input name="image_old" type="hidden" value="<?php echo $data->image;?>" required >
										<p class="help-block"> Ukuran yang dianjurkan 1600x780 Pixel (maximal 5MB)</p>
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
						<!-- END Modal Edit -->
					
					
					
					
					
					<?php
				}
			}else{
				?>
				<tr>
					<td colspan="6">Data Tidak ada </td>
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