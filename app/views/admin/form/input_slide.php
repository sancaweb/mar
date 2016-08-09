<!-- MODAL INPUT -->
<div class="modal fade bs-example-modal-lg" id="myModalinput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Input Data Slide</h4>
	  </div>
	  <div class="modal-body">
		<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/pengaturan/input_slide">
		<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
			
			
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Block Text:</label>
			  <div class="input-group col-xs-12" >
			  <input class="form-control" name="blok" type="text" required >
			
			  </div>
			</div>				  
			</div>
			
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Judul:</label>
			  <div class="input-group col-xs-12" >
			  <input class="form-control" name="title" type="text" required >			
			  </div>
			</div>				  
			</div>
			
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Link Text:</label>
			  <div class="input-group col-xs-12" >
			  <input class="form-control" name="url_text" placeholder="contoh: www.domain.com" type="text" required >			
			  </div>
			</div>				  
			</div>
			
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Link:</label>
			  <div class="input-group col-xs-12" >
			  <input class="form-control" name="url" placeholder="contoh: http://www.domain.com" type="text" required >			
			  </div>
			</div>				  
			</div>
			
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Gambar:</label>
			  <div class="input-group col-xs-12" >
			  <input name="image" type="file" required >
				<p class="help-block"> Ukuran yang dianjurkan 1600x780 Pixel (maximal 5MB)</p>
			  </div>
			</div>				  
			</div>
			
			<div class="col-md-12 ">					
			<div class="form-group">
			  <label>Keterangan Singkat:</label>
			  <div class="input-group col-xs-12" >
			  <div>
			  <textarea class="form-control" name="keterangan"></textarea>
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
<!-- END Modal INPUT -->