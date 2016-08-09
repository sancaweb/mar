<div class="middle-content">
	<div class="container">
	<?php if(isset($alert)){
		echo $alert;
	}?>

		<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
		<li role="presentation"><a href="#registrasi" aria-controls="pengguna" role="tab" data-toggle="tab">Data Pengguna</a></li>
		<li role="presentation"><a href="#pembayaran" aria-controls="pembayaran" role="tab" data-toggle="tab">Data Pembayaran</a></li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="profile">
		<?php $this->output(TEMPLATE.'form/edit_user');?>
		</div>
		<div role="tabpanel" class="tab-pane" id="registrasi"> ...</div>
		<div role="tabpanel" class="tab-pane" id="pembayaran">...</div>
	  </div>
	   
		
		
		
	</div> <!-- /.container -->
</div> <!-- /.middle-content -->