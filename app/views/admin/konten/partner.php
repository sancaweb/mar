<?php if(isset($alert)){
	echo $alert;
}?>


<?php $this->output('admin/form/input_partner');?>

  <!-- View data -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Data Partner</h3>
		  <a class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModalinput">
		  
			<i class="fa fa-plus-square"></i> Tambah Partner
			</a>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
		  <table class="table table-bordered table-hover">
		  <tr>
			<th>No</th>
			<th>Image</th>
			<th>Nama Partner</th>
			<th>Url</th>
			<th>Action</th>
		  </tr>
		  <?php if($viewall_partner){
			  $no=0;
			  foreach($viewall_partner as $partner){
				  $no++;
				  ?>
				  <tr>
					<td><?php echo $no;?></td>
					<td>
					<a href="<?php echo $this->uri->baseUri;?>upload/partner/<?php echo $partner->image;?>" data-lightbox="lightbox<?php echo $partner->id;?>" data-title="<?php echo $partner->nama_partner;?>">
						<img class="img-thumbnail" src="<?php echo $this->uri->baseUri;?>upload/partner/<?php echo $partner->image;?>" style="height: 200px; width:200px; display: block;" alt="100x200">
					</a>
					</td>
					<td>					
						<?php echo $partner->nama_partner;?>					
					</td>
					<td>
					<a href="<?php echo $partner->url;?>" target="_blank">
					<?php echo $partner->url;?>
					</a>
					</td>
					<td>						
						<a class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModaledit<?php echo $partner->id;?>">
						Edit</a>				
						<a class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModalconfirm<?php echo $partner->id;?>">
						Hapus</a>
						
					</td>
				  </tr>
				  
				  <!-- Modal Confirm-->
					<div class="modal fade" id="myModalconfirm<?php echo $partner->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog " role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Alert Hapus Partner</h4>
						  </div>
						  <div class="modal-body">
						<div class="callout callout-danger">
						<h4>Menghapus Partner <strong><?php echo $partner->nama_partner?></strong></h4>
						<p>Apakah anda yakin ingin menghapus data partner ini ? </p>
						<p>
						<img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/partner/<?php echo $partner->image;?>">
						</p>
					  </div>					  
						  <div class="modal-footer">					
							<a href="<?php echo $this->uri->baseUri;?>index.php/admin/pengaturan/hapus_partner/<?php echo base64_encode($partner->id);?>" type="button" class="btn btn-danger">Hapus</a>	
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  </div>
						  </div>
						</div>
					  </div>
					</div>
					<!-- END Modal confirm -->
				  
				<!-- MODAL edit partner-->
				<div class="modal fade bs-example-modal-lg" id="myModaledit<?php echo $partner->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Input Gallery</h4>
					  </div>
					  <div class="modal-body">
					  <form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/pengaturan/edit_partner">
						<input type="hidden" name="id" value="<?php echo $partner->id;?>">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
							<div id="itemRows_partner">
							<div class="col-md-12">					
							<div class="form-group">
							  <label>Image:</label>
							  <div class="input-group col-xs-12" >
							  <img src="<?php echo $this->uri->baseUri;?>upload/partner/<?php echo $partner->image;?>" alt="image partner" class="img-thumbnail img-responsive">
							  <input name="image" type="file" >
							  <input name="image_old" value="<?php echo $partner->image;?>" type="hidden" >
							  </div>
							</div>				  
							</div>
							
							<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Partner:</label>
							  <div class="input-group col-xs-12" >
							  <input name="nama_partner" type="text" class="form-control" value="<?php echo $partner->nama_partner;?>" required>
							  </div>
							</div>				  
							</div>
							
							<div class="col-md-6">					
							<div class="form-group">
							  <label>Url:</label>
							  <div class="input-group col-xs-12" >
							  <input name="url" type="text" value="<?php echo $partner->url;?>" class="form-control" required>
							  </div>
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
				<!-- END Modal Edit partner-->
				  <?php
			  }
		  }else{
			  ?>
			  <tr>
				<td colspan="5">Data partner tidak ada</td>
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