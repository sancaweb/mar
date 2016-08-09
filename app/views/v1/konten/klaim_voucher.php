<div class="middle-content">
            <div class="container">
			
            <?php if(isset($alert)){
				echo $alert;
			}
			?>
                
            </div> <!-- /.container -->
</div> <!-- /.middle-content -->
<?php if(isset($page)){
	if($page=='sukses_klaim'){
		
	}else{
		?>
<div class="go-act">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			
			<span class="price_klaim">Silahkan Masukkan Nomer Voucher yang anda miliki !</span>
			<div class="act-btn">
				<div class="inner">
					<div class="price">
						Discount
					</div> <!-- /.price -->
					<div class="title">
					<span>
					<form class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/klaim_voucher/cek_voucher">
					  <div class="form-group form-group-lg">
					  <div class="col-sm-10">
						<input type="text" name="no_voucher" class="form-control input-lg" id="exampleInputName2" placeholder="XXXXXXXX-XXXX-XXXX-XXXX">
					  </div>
					  </div>
					</span>
					</div>
				</div> <!-- /.inner -->
					<button type="submit" class="link">
					<i class="fa fa-angle-right"></i>
					</button>
					
					</form>
			</div>
			
			</div> <!-- /.col-md-8 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</div> <!-- /.go-act -->
		
		<?php
	}
	
}?>
