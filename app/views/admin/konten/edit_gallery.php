<?php if(isset($alert)){
	echo $alert;
}?>

<!-- Kategori gambar -->
<div class="row">
	<div class="col-xs-12">
		<div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Edit Kategori: <?php echo $nama_kategori;?></h3>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
			<table class="table table-bordered table-hover">
			<tr>
				<th>Foto</th>
				<th>Keterangan</th>				
				<th>Action</th>				
			</tr>
			<?php if($viewall_kategori_by_id){
					?>
			<tr>
			<td> <?php
				if($viewall_kategori_by_id->image_kat){
					?>
					<a href="<?php echo $this->uri->baseUri;?>upload/gallery/kategori/<?php echo $viewall_kategori_by_id->image_kat;?>" data-lightbox="lightboxkat" data-title="<?php echo $viewall_kategori_by_id->keterangan;?>">
					<img style="width:100px;"class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/gallery/kategori/<?php echo $viewall_kategori_by_id->image_kat;?>">
					</a>
					<?php
				}else{
					?>
					<a href="<?php echo $this->uri->baseUri;?>upload/gallery/kategori/blank.jpg" data-lightbox="lightboxkat" data-title="<?php echo $viewall_kategori_by_id->keterangan;?>">
					<img style="width:100px;"class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/gallery/kategori/blank.jpg">
					</a>
					<?php
				}
			?>
                
			</td>
			<td><?php echo $viewall_kategori_by_id->keterangan;?></td>
			<td>
				<a class="btn btn-warning" type="button" data-toggle="modal" data-target="#myModaleditkat<?php echo $viewall_kategori_by_id->id;?>">
		  		<i class="fa fa-edit"></i> Edit Kategori
				</a>
				
			</td>
			</tr>
				<!-- MODAL edit kategori-->
				<div class="modal fade bs-example-modal-lg" id="myModaleditkat<?php echo $viewall_kategori_by_id->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Edit Kategori <?php echo $viewall_kategori_by_id->nama_kategori;?></h4>
					  </div>
					  <div class="modal-body">
					  <form id="form_kategori" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/gallery/pro_edit_kat/<?php echo base64_encode($viewall_kategori_by_id->id);?>">
						<input type="hidden" name="id" value="<?php echo $viewall_kategori_by_id->id;?>" />
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
							<div id="itemRows">
							
							<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Kategori:</label>
							  <div class="input-group col-xs-12" >
							  <input class="form-control" name="nama_kategori" type="text" value="<?php echo $viewall_kategori_by_id->nama_kategori;?>" required>
							  </div>
							</div>				  
							</div>
							
							<div class="col-md-6">					
							<div class="form-group">
							  <label>Foto:</label>
							  <div class="input-group col-xs-12" >
							  <a href="<?php echo $this->uri->baseUri;?>upload/gallery/kategori/<?php echo $viewall_kategori_by_id->image_kat;?>" data-lightbox="lightboxkat<?php echo $viewall_kategori_by_id->id;?>" data-title="<?php echo $viewall_kategori_by_id->keterangan;?>">
								<img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/gallery/kategori/<?php echo $viewall_kategori_by_id->image_kat;?>">
								</a>
							  <input name="image_kat" type="file">
							  <input name="image_katold" type="hidden" value="<?php echo $viewall_kategori_by_id->image_kat;?>" required>
							  </div>
							</div>				  
							</div>
							
							<div class="col-md-12 ">					
							<div class="form-group">
							  <label>Keterangan Singkat Foto:</label>
							  <div class="input-group col-xs-12" >
							  <textarea name="keterangan_foto" class="form-control" rows="3" > <?php echo $viewall_kategori_by_id->keterangan;?></textarea>
							  </div><!-- /.input group -->
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
				<!-- END Modal edit kategori-->
					<?php
			}else{
				?>
				<tr>
				<td colspan="3">Data tidak ada</td>
				</tr>
			<?php
			} ?>
			</table>
		
		</div>
		</div>
	</div>
</div>
<!-- END Kategori Gambar -->

  <!-- View data -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">View images for <?php echo $nama_kategori;?></h3>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
			<?php if($viewall_gallery){
				foreach($viewall_gallery as $gallery){
					?>
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">					
						<div class="thumbnail"> 
						<a href="<?php echo $this->uri->baseUri;?>upload/gallery/<?php echo $gallery->foto;?>" data-lightbox="lightbox" data-title="<?php echo $gallery->keterangan;?>">
						<img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/gallery/thumbs/<?php echo $gallery->foto;?>">
						</a>
							<div class="caption"> 
							
							<p><?php echo $gallery->keterangan;?></p>
								<p>
								<a class="btn btn-warning" type="button" data-toggle="modal" data-target="#myModaledit<?php echo $gallery->id;?>">
								<i class="fa fa-edit"></i> Edit
								</a>
								<a class="btn btn-danger" data-toggle="modal" data-target="#myModalconfirm<?php echo $gallery->id;?>" role="button"  >
								Hapus
								</a>
								</p>
							</div>
						</div>
					</div>
					<!-- Modal Confirm-->
					<div class="modal fade" id="myModalconfirm<?php echo $gallery->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog " role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Alert Hapus Foto</h4>
						  </div>
						  <div class="modal-body">
						<div class="callout callout-danger">
						<h4>Menghapus foto</h4>
						<p>Apakah anda yakin ingin menghapus foto dibawah ini ? </p>
						<p>
						<img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/gallery/thumbs/<?php echo $gallery->foto;?>">
						</p>
					  </div>					  
						  <div class="modal-footer">					
							<a href="<?php echo $this->uri->baseUri;?>index.php/admin/gallery/hapus_gallery/<?php echo base64_encode($gallery->id).'/'.base64_encode($gallery->kategori);?>" type="button" class="btn btn-danger">Hapus</a>	
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  </div>
						  </div>
						</div>
					  </div>
					</div>
					<!-- END Modal confirm -->
				<!-- MODAL edit gallery-->
				<div class="modal fade bs-example-modal-lg" id="myModaledit<?php echo $gallery->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Edit Gallery</h4>
					  </div>
					  <div class="modal-body">
					  <form id="form_kategori" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/gallery/pro_edit_gallery/<?php echo base64_encode($gallery->kategori);?>">
						<input type="hidden" name="id" value="<?php echo $gallery->id;?>" />
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
							<div id="itemRows">
							<div class="col-md-6">					
							<div class="form-group">
							  <label>Foto:</label>
							  <div class="input-group col-xs-12" >
							  <a href="<?php echo $this->uri->baseUri;?>upload/gallery/<?php echo $gallery->foto;?>" data-lightbox="lightbox<?php echo $gallery->id;?>" data-title="<?php echo $gallery->keterangan;?>">
								<img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/gallery/thumbs/<?php echo $gallery->foto;?>">
								</a>
							  <input name="foto" type="file" >
							  <input name="foto_old" type="hidden" value="<?php echo $gallery->foto;?>" >
							  </div>
							</div>				  
							</div>
							
							<div class="col-md-6 ">					
							<div class="form-group">
							  <label>Keterangan Singkat Foto:</label>
							  <div class="input-group col-xs-12" >
							  <textarea name="keterangan_foto" class="form-control" rows="3" > <?php echo $gallery->keterangan;?></textarea>
							  </div><!-- /.input group -->
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
				<!-- END Modal edit gallery-->
					<?php
				}
				
			}else{
				?>
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">					
				<div class="thumbnail"> 
				<a href="<?php echo $this->uri->baseUri;?>upload/gallery/blank.jpg" data-lightbox="lightbox" data-title="Tidak ada foto">
				<img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/gallery/thumbs/blank.jpg">
				</a>
					<div class="caption"> 
					
					<p>Foto Tidak ada ...</p>
					</div>
				</div>
			</div>
			<?php
			} ?>
			
		  
		</div><!-- /.box-body -->
		<div class="box-footer clearfix">
		</div>
	  </div><!-- /.box -->
	</div>
  </div>
  <!-- END View data -->