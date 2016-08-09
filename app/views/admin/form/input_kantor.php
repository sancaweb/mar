<!-- MODAL INPUT -->
<div class="modal fade bs-example-modal-lg" id="myModalinput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Input Data Kantor</h4>
	  </div>
	  <div class="modal-body">
		<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/about/input_kantor">
		<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Nama Kantor:</label>
			  <div class="input-group col-xs-12" >
			  <input type="text" name="nama_kantor" class="form-control" required >
			  </div>
			</div>				  
			</div>
			
			<div class="col-md-3">					
			<div class="form-group">
			  <label>No.tlp:</label>
			  <div class="input-group col-xs-12" >
			  <input class="form-control" name="tlp" type="text" id="telpon" placeholder="Telpon" minlength="5" data-validation-minlength-message="Isikan data yang benar, minimal 5 karakter" required >
			<span class="error" style="color: Red; display: none;">Hanya nomer yang di ijinkan.ex. 08xxxxxx</span>
			  </div>
			</div>				  
			</div>
			
			<div class="col-md-3">					
			<div class="form-group">
			  <label>Email:</label>
			  <div class="input-group col-xs-12" >
			  <input class="form-control" name="email" type="email" placeholder="email.domain.com" minlength="5" data-validation-minlength-message="Isikan data yang benar, minimal 5 karakter" required >
			  <span class="error" style="color: Red; display: none;">Format email: email.domain.com</span>
			  </div>
			</div>				  
			</div>
			
			
			<div class="col-md-12 ">					
			<div class="form-group">
			  <label>Alamat:</label>
			  <div class="input-group col-xs-12" >
			  <div>
			  <textarea class="form-control" name="alamat" required></textarea>
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