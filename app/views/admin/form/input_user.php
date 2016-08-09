<!-- MODAL INPUT -->
<div class="modal fade bs-example-modal-lg" id="myModalinput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Input User</h4>
	  </div>
	  <div class="modal-body">
	  
		<form class="form-horizontal" id="form_user" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/user/input_user">
			<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;padding:5px;">	
				
			<div class="form-group">	
			  <label class="col-sm-2 control-label">Username:</label>
			  <div class="col-sm-10" >
			  <input  name="username" type="text" class="form-control" required >
			  </div>			  
			</div>
			
			<div class="form-group">	
			  <label class="col-sm-2 control-label">Password:</label>
			  <div class="col-sm-10" >
			  <input  name="password" type="text" class="form-control" required >
			  </div>			  
			</div>
			
			
			<div class="form-group">	
			  <label class="col-sm-2 control-label">User Level:</label>
			  <div class="col-sm-10" >
			  <select name="user_level" class="form-control" required>
			  <?php if($user_level){
				  foreach($user_level as $user_level){
					  ?>
						<option value="<?php echo $user_level->level;?>"><?php echo $user_level->ket;?></option>
					  <?php
				  }
			  }else{
				  ?>
				  <option value="">Input User Grup Terlebih dahulu</option>
				  <?php
			  }
				  
			  ?>
			  </select>
			  
			  </div>			  
			</div>
			
			</div><!-- END ROW STYLE -->
			<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;padding:5px;">	
			
			<div class="form-group">	
			  <label class="col-sm-2 control-label">Nama Lengkap:</label>
			  <div class="col-sm-10" >
			  <input  name="nama_lengkap" type="text" class="form-control" required >
			  </div>			  
			</div>
			<div class="form-group">	
			  <label class="col-sm-2 control-label">No Telpon:</label>
			  <div class="col-sm-10" >
			  <input  name="no_tlp" type="text" class="form-control" required >
			  </div>			  
			</div>
			<div class="form-group">	
			  <label class="col-sm-2 control-label">Email:</label>
			  <div class="col-sm-10" >
			  <input  name="email" type="text" class="form-control" required >
			  </div>			  
			</div>
			<div class="form-group">	
			  <label class="col-sm-2 control-label">Alamat:</label>
			  <div class="col-sm-10" >
			  <textarea  name="alamat" type="text" class="form-control" required ></textarea>
			  </div>			  
			</div>
			
			<div class="form-group">	
			  <label class="col-sm-2 control-label">Foto:</label>
			  <div class="col-sm-10" >
			  <input  name="foto" type="file" required >
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