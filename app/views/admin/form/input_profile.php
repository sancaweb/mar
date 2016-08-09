<!-- MODAL INPUT -->
<div class="modal fade bs-example-modal-lg" id="myModalinput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Input Data Kantor</h4>
	  </div>
	  <div class="modal-body">
		<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/about/input_profile">
		<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Featured Image:</label>
			  <div class="input-group col-xs-12" >
			  <input type="file" name="image" required >
			  </div>
			</div>				  
			</div>
			
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Judul:</label>
			  <div class="input-group col-xs-12" >
			  <input class="form-control" name="judul" type="text" required >
			
			  </div>
			</div>				  
			</div>
			
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Featured Article:</label>
			  <div class="input-group col-xs-12" >
			  <div class="radio">
				<label>
				  <input name="featured" value="1" type="radio">
				  Jadikan artikel ini featured article.
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input name="featured" value="0" checked type="radio">
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
			  <textarea id="mytextarea2" class="form-control" name="keterangan"></textarea>
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