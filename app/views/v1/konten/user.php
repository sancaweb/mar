<div class="middle-content">
	<div class="container">
	<?php if(isset($alert)){
		echo $alert;
	}?>

	<div class="row"><!-- first row -->
			
		<div class="col-md-3"><!-- first column -->
		
			<div class="widget-item">
			
				<h3 class="widget-title">Your Profile</h3>
				<a href="<?php echo $this->uri->baseUri;?>index.php/user">
				<div class="service-item">
					<div class="service-icon">
						<i class="fa fa-user"></i>
					</div> <!-- /.service-icon -->
				  <div class="service-content">					  
					<h4>Profile</h4>
					</div> 
					<!-- /.service-content -->
				</div> <!-- /.service-item -->
				</a>
				
				<a href="<?php echo $this->uri->baseUri;?>index.php/registrasi">
				<div class="service-item">
					<div class="service-icon">
						<i class="fa fa-users"></i>
					</div> <!-- /.service-icon -->
				  <div class="service-content">					  
					<h4>Data Registrasi</h4>
					</div> 
					<!-- /.service-content -->
				</div> <!-- /.service-item -->
				</a>
				
				<a href="<?php echo $this->uri->baseUri;?>index.php/pembayaran">
				<div class="service-item">
					<div class="service-icon">
						<i class="fa fa-money"></i>
					</div> <!-- /.service-icon -->
				  <div class="service-content">					  
					<h4>Data Pembayaran</h4>
					</div> 
					<!-- /.service-content -->
				</div> <!-- /.service-item -->
				</a>
				
				
				
				
			</div> <!-- /.widget-item -->
			
		</div> <!-- /.col-md-4 -->
		
		<div class="col-md-9"><!-- second column -->
			<div class="widget-item">
				<h3 class="widget-title"><?php echo $title;?></h3>
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
				}?>
			</div> <!-- /.widget-item -->
		</div> <!-- /.col-md-4 -->
		
		
		
		
	</div> <!-- /.row first -->
		
		
		
	</div> <!-- /.container -->
</div> <!-- /.middle-content -->