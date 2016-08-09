<!-- MODAL INPUT -->
<div class="modal fade bs-example-modal-lg" id="myModalinput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Input Kabar</h4>
	  </div>
	  <div class="modal-body">
		<form id="form_kabar" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/kabar/pro_input_kabar">
		<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
		<div class="col-md-6">					
		<div class="form-group">
		  <label>Judul:</label>
		  <div class="input-group col-xs-12" >
		  <input name="judul" type="text" class="form-control" value="" required>
		  </div>
		</div>				  
		</div>
		
		<div class="col-md-6 ">					
		<div class="form-group">
		  <label>Kategori kabar</label>
		  
		  <div class="input-group col-xs-12">
		  <select class="form-control" name="kategori" required>
		  <?php
			if($kategori){
				foreach($kategori as $kategori){
					?>
					<option value="<?php echo $kategori->id;?>"><?php echo $kategori->nama_kategori;?></option>
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
		
		
		<div class="col-md-12 ">					
		<div class="form-group">
		  <label>Keterangan:</label>
		  <div class="input-group col-xs-12" >
		  <textarea id="mytextarea" name="keterangan" class="form-control" rows="3" > </textarea>
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
<!-- END Modal INPUT -->