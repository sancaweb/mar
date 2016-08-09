<!-- MODAL INPUT kategori-->
<div class="modal fade bs-example-modal-lg" id="myModalinput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Input Gallery</h4>
	  </div>
	  <div class="modal-body">
	  <ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#new_kat" aria-controls="home" role="tab" data-toggle="tab">Kategori Baru</a></li>
		<li role="presentation"><a href="#old_kat" aria-controls="profile" role="tab" data-toggle="tab">Kategori Yang Sudah Ada</a></li>
		
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="new_kat">
			<form id="form_kategori" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/gallery/input_gallery">
				<input type="hidden" name="kat" value="yes" >
				<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
					
					<div class="col-md-6">					
						<div class="form-group">
						  <label>Nama Kategori:</label>
						  <div class="input-group col-xs-12" >
						  <input name="nama_kategori" type="text" class="form-control" required>
						  </div>
						</div>				  
						</div>
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Preview Image:</label>
						  <div class="input-group col-xs-12" >
						  <input name="image_kat" type="file" required>
						  </div>
						</div>				  
						</div>
						
						<div class="col-md-6 ">					
						<div class="form-group">
						  <label>Keterangan Singkat:</label>
						  <div class="input-group col-xs-12" >
						  <textarea name="keterangan" class="form-control" rows="3" > </textarea>
						  </div><!-- /.input group -->
						</div>					
						</div>
					
				</div>
				<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
					<div id="itemRows">
					<input type="hidden" name="pengulang[]" value="0">
					<div class="col-md-6">					
					<div class="form-group">
					  <label>Foto:</label>
					  <div class="input-group col-xs-12" >
					  <input name="foto0" type="file" required>
					  </div>
					</div>				  
					</div>
					
					<div class="col-md-6 ">					
					<div class="form-group">
					  <label>Keterangan Singkat Foto:</label>
					  <div class="input-group col-xs-12" >
					  <textarea name="keterangan_foto[]" class="form-control" rows="3" > </textarea>
					  </div><!-- /.input group -->
					</div>					
					</div>
					
					
					</div>
					
				</div>
				
			  <div class="modal-footer">
			  <a class="btn btn-success" id="add_item" ><i class="fa fa-plus"></i>&nbsp;Tambah Row</a>
				<input type="submit" class="btn btn btn-primary" value="Submit">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			  </div>
				
				</form>
		
		</div> <!-- END panel tab -->
		
		<div role="tabpanel" class="tab-pane" id="old_kat">
		<form id="form_kategori" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/gallery/input_gallery">
		<input type="hidden" name="kat" value="no" >
		<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
			<div class="col-md-6">					
				<div class="form-group">
				  <label>Kategori:</label>
				  <div class="input-group col-xs-12" >
				  <select name="kategori_id" class="form-control" >
				  <?php
					if($kategori_menu){
						foreach($kategori_menu as $kategori_menu){							
						?>						
						<option value="<?php echo $kategori_menu->id;?>"><?php echo $kategori_menu->nama_kategori;?></option>
						<?php
						}
					}else{
						?>
						
				  <option value="">Kategori belum ada ,,, </option>
						<?php
					}
				  ?>
				  </select>
				  </div>
				</div>				  
				</div>
			
		</div>
		<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
			<div id="itemRows2">
			<input type="hidden" name="pengulang[]" value="0">
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Foto:</label>
			  <div class="input-group col-xs-12" >
			  <input name="foto0" type="file" required>
			  </div>
			</div>				  
			</div>
			
			<div class="col-md-6 ">					
			<div class="form-group">
			  <label>Keterangan Singkat Foto:</label>
			  <div class="input-group col-xs-12" >
			  <textarea name="keterangan_foto[]" class="form-control" rows="3" > </textarea>
			  </div><!-- /.input group -->
			</div>					
			</div>
			
			
			</div>
			
		</div>
		
	  <div class="modal-footer">
	  <a class="btn btn-success" id="add_item2" ><i class="fa fa-plus"></i>&nbsp;Tambah Row</a>
		<input type="submit" class="btn btn btn-primary" value="Submit">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
		
		</form>
		
		</div> <!-- END TAB kedua -->
		
	  </div> <!-- END TAB CONTENT -->
		
		
	  </div>
	</div>
  </div>
</div>
<!-- END Modal INPUT Kategori-->