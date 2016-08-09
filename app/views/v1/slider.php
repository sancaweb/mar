<div class="flexslider">
	<ul class="slides">
	
		<li>
			<div class="overlay"></div>
			<img src="<?php echo $this->uri->baseUri.STYLE;?>images/templatemo_slide_3.jpg" alt="Special 3">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<div class="flex-caption visible-lg">
							<span class="price">Silahkan masukan kode Voucher anda !</span>
							<span class="price">Insert your voucher number !</span>
							<h3 class="title">  </h3>
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
						</div>
					</div>
				</div>
			</div>
		</li>
		<?php if($slider){
			foreach($slider as $data){
				?>
				<li>
					<div class="overlay"></div>
					<img src="<?php echo $this->uri->baseUri;?>upload/slider/<?php echo $data->image;?>" alt="Special 1">
					<div class="container">
						<div class="row">
							<div class="col-md-5 col-lg-4">
								<div class="flex-caption visible-lg">
									<span class="price"><?php echo $data->blok;?></span>
									<h3 class="title"><?php echo $data->title;?></h3>
									<p><?php echo $data->keterangan;?></p>
									<a href="<?php echo $data->url;?>" class="slider-btn"><?php echo $data->url_text;?></a>
								</div>
							</div>
						</div>
					</div>
				</li>
				
				
				<?php
			}
		}?>
	</ul>
</div>