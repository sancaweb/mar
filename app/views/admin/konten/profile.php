<?php if(isset($alert)){
	echo $alert;
}?>


<?php $this->output('admin/form/input_profile');?>

  <!-- View data -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">List Data Informasi Profile</h3>
		  <a class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModalinput">
			<i class="fa fa-plus-square"></i> Tambah Informasi
			</a>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
		  <table class="table table-bordered table-hover">
			<tr>
			  <th style="width: 10px">No</th>
			  <th style="width: 200px">Image</th>
			  <th style="width: 200px">Judul</th>
			  <th style="width: 200px">Featured</th>
			  <th style="width: 300px">Action</th>
			</tr>
			<?php if ($viewall_profile_page){
				$no=$no;
				foreach($viewall_profile_page as $data){
					$no++;
					?>
					<tr>
			  <td><?php echo $no;?></td>
			  <td><a href="<?php echo $this->uri->baseUri.'upload/profile/'.$data->image; ?>" target="_blank">
			  <img src="<?php echo $this->uri->baseUri.'upload/profile/'.$data->image; ?>" style="width:50px" alt="Gambar"/>
			  </a>
			  </td>
			  <td><?php echo $data->judul; ?></td>
			  <td>
			  <?php 
				if($data->featured==1){
					echo '<i class="fa fa-star" aria-hidden="true"></i> Default Profile';
				}else{
					echo '---';
				}
				?></td>
			  <td><a class="btn btn-app" data-toggle="modal" data-target="#myModalview<?php echo $data->id;?>">
				<i class="fa fa-tv"></i> View
				</a>
				<a class="btn btn-app" data-toggle="modal" data-target="#myModal<?php echo $data->id;?>">
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
						<h4 class="modal-title" id="myModalLabel">Alert Hapus Profile</h4>
					  </div>
					  <div class="modal-body">
					<div class="callout callout-danger">
                    <h4>Menghapus data <?php echo $data->judul;?></h4>
                    <p>Apakah anda yakin ingin menghapus data <strong><?php echo $data->judul;?></strong> ?</p>
                  </div>					  
					  <div class="modal-footer">					
						<a href="<?php echo $this->uri->baseUri;?>index.php/admin/about/hapus_profile/<?php echo base64_encode($data->id);?>" type="button" class="btn btn-danger">Hapus</a>	
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
						<h4 class="modal-title" id="myModalLabel">View Profile <?php echo $data->judul;?></h4>
					  </div>
					  <div class="modal-body">
						<!--FORM View-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="#">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
											
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Featured Image:</label>
						  <div class="input-group col-xs-12" >
						  <img src="<?php echo $this->uri->baseUri.'upload/profile/'.$data->image; ?>" style="width:200px" alt="Image Profile"/>
						  </div>
						</div>				  
						</div>
						
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Judul:</label>
						  <div class="input-group col-xs-12" >
						  <input readonly type="text" class="form-control" value="<?php echo $data->judul;?>" >
						  </div>
						</div>				  
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
						<h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
					  </div>
					  <div class="modal-body">
						<!--FORM Edit-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/about/edit_profile">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
						<input type="hidden" name="id" value="<?php echo $data->id;?>">
						
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Featured Image:</label>
						  <div class="input-group col-xs-12" >
						  <img src="<?php echo $this->uri->baseUri.'upload/profile/'.$data->image; ?>" style="width:200px" alt="Image Profile"/>
						  <input type="file" name="image" >
						  <input type="hidden" name="image_old" value="<?php echo $data->image; ?>">
						  </div>
						</div>				  
						</div>
						
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Judul:</label>
						  <div class="input-group col-xs-12" >
						  <input type="text" name="judul" class="form-control" value="<?php echo $data->judul;?>" required >
						  </div>
						</div>				  
						</div>
						
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Featured Article:</label>
						  <div class="input-group col-xs-12" >
						  <div class="radio">
							<label>
							  <input name="featured" value="1" type="radio" <?php if($data->featured==1){echo 'checked';}?>>
							  Jadikan artikel ini featured article.
							</label>
						  </div>
						  <div class="radio">
							<label>
							  <input name="featured" value="0" type="radio" <?php if($data->featured==0){echo 'checked';}?>>
							  <p style="color:red;">Jangan jadikan artikel ini featured article.</p>
							</label>
						  </div>
						
						  </div>
						</div>				  
						</div>
						
						
						<div class="col-md-12 ">					
						<div class="form-group">
						  <label>Keterangan:</label>
						  <div class="input-group col-xs-12" >
						  <div>
						  <textarea id="mytextarea" class="form-control" name="keterangan" required><?php echo $data->keterangan;?></textarea>
						  </div>
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