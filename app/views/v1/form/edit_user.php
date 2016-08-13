<div class="row">
<div class="col-xs-12 table-responsive">
<!--FORM Edit-->
<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/user/edit_user">
<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
<input type="hidden" name="id" value="<?php echo $view_user->id;?>">

<div class="form-group">
  <label class="col-sm-2 control-label">Foto:</label>
  <div class="col-sm-10" >
  <?php if($foto){
	  ?>
	  <img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto;?>" style="width:200px; height:200px;">
	<input name="foto_old" type="hidden" value="<?php echo $foto;?>" >
	<?php
  }else{
	  ?>
	  <img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/user/blank.png">
	  <input name="foto_old" type="hidden" value="xxx.jpg" >
	  <?php
  }?>
  <input name="foto" type="file" required >
  </div>			  
</div>

<div class="form-group">	
  <label class="col-sm-2 control-label">Nama Lengkap:</label>
  <div class="col-sm-10" >
  <input  name="nama_lengkap" type="text" class="form-control" value="<?php echo $nama_pengguna;?>" required >
  </div>			  
</div>
<div class="form-group">	
  <label class="col-sm-2 control-label">No Telpon:</label>
  <div class="col-sm-10" >
  <input  name="no_tlp" type="text" class="form-control" value="<?php echo $no_tlp;?>" required >
  </div>			  
</div>
<div class="form-group">	
  <label class="col-sm-2 control-label">Email:</label>
  <div class="col-sm-10" >
  <input  name="email" type="text" class="form-control" value="<?php echo $email;?>" required >
  </div>			  
</div>
<div class="form-group">	
  <label class="col-sm-2 control-label">Alamat:</label>
  <div class="col-sm-10" >
  <textarea  name="alamat" type="text" class="form-control" required ><?php echo $alamat;?></textarea>
  </div>			  
</div>

</div>

<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
<div class="form-group">	
  <label class="col-sm-2 control-label">Username:</label>
  <div class="col-sm-10" >
  <input  name="username" type="text" class="form-control" value="<?php echo $view_user->username;?>" readonly >
  <p class="help-block">Maaf username tidak bisa diganti</p>
  </div>			  
</div>

<div class="form-group">	
  <label class="col-sm-2 control-label">Password:</label>
  <div class="col-sm-10" >
  <input  name="password" placeholder="Kosongkan jika tidak akan merubah password." type="text" class="form-control" value="" >
  <input  name="password_old" type="hidden"  class="form-control" value="<?php echo $view_user->password;?>"  >
  
  </div>			  
</div>



</div>

<div class="modal-footer">
<button type="submit" class="btn btn-primary" ><i class="fa fa-edit"></i> Edit</button>
<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
</div>
</form>
</div>
</div>
<!-- end form EDIT-->