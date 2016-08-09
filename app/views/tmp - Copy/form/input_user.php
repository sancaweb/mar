<!-- MODAL -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Input User</h3>
  </div>
  <div class="modal-body">
	<?php if($this->session->getValue('code_grup')=='s_adm' ){?>
    <form class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri.'user/input_user';?>">
	<div class="control-group">
    <label class="control-label" for="nama">Nama</label>
    <div class="controls">
      <input name="nama" type="text" id="nama" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="username">Username</label>
    <div class="controls">
      <input name="username" type="text" id="username" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="password">Password</label>
    <div class="controls">
      <input name="password" type="text" id="password" required>
    </div>
  </div>
	<div class="control-group">
		<label class="control-label" for="grup">Grup</label>
    <div class="controls">
      <select name="grup" id="grup" required>
		<option value="adm" selected>Admin</option>
		<option value="s_adm" selected>Super Admin</option>
		</select>
    </div>
	</div>
	<?php }else{
	?>
	<div class="alert alert-block alert-danger">
            <p>
             Maaf,yang berhak input User hanyalah Super Admin.
            </p>
            </div>
	<?php
	}?>
  </div>
  <div class="modal-footer">
  <button data-dismiss="modal" aria-hidden="true" type="button" class="btn btn-danger" ><i class="icon-backward"></i> Cancel</button>
  <button type="submit" class="btn btn-primary" >Simpan <i class="icon-envelope icon-large"></i></button>
    
  </div>
  </form>
  
</div>
<!-- END MODAL -->