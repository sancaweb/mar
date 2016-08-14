<div class="middle-content">
<div class="container">

<ul class="nav nav-pills">
  <li role="presentation" <?php if(isset($page)){if($page=='user'){echo 'class="active"';}}?>>
	<a href="<?php echo $this->uri->baseUri;?>index.php/user">Profile</a>
  </li>
  <li role="presentation" <?php if(isset($page)){if($page=='registrasi'){echo 'class="active"';}}?>>
	<a href="<?php echo $this->uri->baseUri;?>index.php/registrasi">Data Registrasi</a>
  </li>
  <li role="presentation" <?php if(isset($page)){if($page=='pembayaran'){echo 'class="active"';}}?>>
	<a href="<?php echo $this->uri->baseUri;?>index.php/pembayaran">Data Pembayaran</a>
  </li>
  <li role="presentation" class="dropdown <?php if(isset($page)){if($page=='inbox' || $page=='sentitems' || $page=='view_pesan'){echo 'active';}}?>">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      Pesan <span data-toggle="tooltip" title="<?php echo $total_pesan_belum_terbaca;?> Pesan Belum dibaca" class="badge"><?php echo $total_pesan_belum_terbaca;?>&nbsp;<i class="fa fa-envelope-o"></i></span>
	  <span class="caret"></span>
    </a>
    <ul class="dropdown-menu ">
      <li role="presentation" <?php if(isset($page)){if($page=='inbox'){echo 'class="active"';}}?>>
		<a href="<?php echo $this->uri->baseUri;?>index.php/pesan">Inbox
		<span data-toggle="tooltip" title="<?php echo $total_pesan_belum_terbaca;?> Pesan Belum dibaca" class="badge"><?php echo $total_pesan_belum_terbaca;?>&nbsp;<i class="fa fa-envelope-o"></i></span>
		</a>
		  
	  </li>
      <li role="presentation" <?php if(isset($page)){if($page=='sentitems'){echo 'class="active"';}}?>>
		<a href="<?php echo $this->uri->baseUri;?>index.php/pesan/sentitems">Sent items
		
		</a>
		  
	  </li>
    </ul>
  </li>
</ul>

</div>
</div>

<div class="middle-content">
	<div class="container">
	<?php if(isset($alert)){
		echo $alert;
	}?>
	
		
	<?php if(isset($page)){
		if($page=='user'){
			$this->output(TEMPLATE.'form/edit_user');
		}
		if($page=='registrasi'){
			$this->output(TEMPLATE.'konten/registrasi');
		}
		if($page=='pembayaran'){
			$this->output(TEMPLATE.'konten/pembayaran');
		}
		if($page=='inbox' || $page=='sentitems'){
			$this->output(TEMPLATE.'konten/pesan');
		}
		if($page=='view_pesan'){
			$this->output(TEMPLATE.'konten/view_pesan');
		}
	}?>
		
		
		
	</div> <!-- /.container -->
</div> <!-- /.middle-content -->