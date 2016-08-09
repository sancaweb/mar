<div class="middle-content">
            <div class="container">
            
                <div class="row"><!-- first row -->
                
                	<div class="col-md-4"><!-- first column -->
                    
                        <div class="widget-item">
                        
                            <h3 class="widget-title">All About Us</h3>
							<?php 
								if($viewall_profile_page){
									foreach($viewall_profile_page as $data){
										?>
										<div class="service-item">
											<div class="service-icon">
												<i class="fa fa-trophy"></i>
											</div> <!-- /.service-icon -->
											<div class="service-content">
												<h4><a href="<?php echo $this->uri->baseUri;?>index.php/profile/view/<?php echo base64_encode($data->id);?>">
												<?php echo $data->judul;?>
												</a>
												</h4>
												<p><?php echo $this->readmore->readmore($this->image->del_img($data->keterangan),100); ?></p>
											
											</div> <!-- /.service-content -->
										</div> <!-- /.service-item -->
										<?php
									}
								}
							?>
                            <ul class="pagination pagination-sm no-margin pull-right">
								<?php if ($pageLinks): ?>
										
										<?php foreach ($pageLinks as $paging): ?>
											<?php echo '<li>'.$paging; ?></li>
											
										<?php endforeach; ?>
									
											<?php endif; ?>
							  </ul>
                        </div> <!-- /.widget-item -->
                        
                    </div> <!-- /.col-md-4 -->
                    
                    <div class="col-md-8"><!-- second column -->
                        <div class="widget-item">
						<?php
							if($featured){
								?>
								<div class="isi">
									<h3 class="widget-title"><?php echo $featured->judul?></h3>
									<div class="sample-thumb">
										<img style="height:300px;" src="<?php echo $this->uri->baseUri;?>upload/profile/<?php echo $featured->image;?>" alt="New Event" title="New Event">
									</div> <!-- /.sample-thumb -->
									<?php echo $featured->keterangan;?>
								</div>
								<?php
							}else{
								?>
								<h3 class="widget-title">Data tidak ditemukan</h3>
                            <div class="sample-thumb">
                                <img src="<?php echo $this->uri->baseUri;?>upload/profile/blank.jpg" alt="New Event" title="New Event">
                            </div> <!-- /.sample-thumb -->
                            <h4 class="consult-title">Error pengambilan data</h4>
                            <p>Pastikan data yang dimasukan sudah benar</p>
								<?php
							}
						?>
						
						</div> <!-- /.widget-item -->
                    </div> <!-- /.col-md-8 -->
                    
                    
                    
                </div> <!-- /.row first -->
                
                <div class="row"><!-- second row -->
                <?php if($viewall_profile_page){
					foreach($viewall_profile_page as $data2){
						?>
						<div class="col-md-4"><!-- first column -->
							<div class="widget-item">
							<a href="<?php echo $this->uri->baseUri.'index.php/profile/view/'.base64_encode($data2->id);?>">
								<h3 class="widget-title"><?php echo $data2->judul;?></h3></a>
								<div class="sample-thumb">
									<img style="height:200px;" src="<?php echo $this->uri->baseUri;?>upload/profile/<?php echo $data2->image;?>" alt="New Event" title="New Event">
								</div> <!-- /.sample-thumb -->
								<?php echo $this->readmore->readmore($this->image->del_img($data2->keterangan),100);?>
								
							</div> <!-- /.widget-item -->
						</div> <!-- /.col-md-4 -->
						<?php
					}
				}else{
					?>
					<div class="col-md-4"><!-- first column -->
						<div class="widget-item">
							<h3 class="widget-title">Data tidak ada</h3>
							<div class="sample-thumb">
								<img src="<?php echo $this->uri->baseUri;?>images/blank.jpg" alt="New Event" title="New Event">
							</div> <!-- /.sample-thumb -->
							<h4 class="consult-title">Donec auctor iaculis libero ut ullamcorper</h4>
							<p>Praesent ornare commodo tincidunt. Interdum et fames ac ante ipsum primis in faucibus. Aliquam justo lectus, fermentum vitae libero, tincidunt accumsan magns. <br><br>Vestibulum congue lorem odio, at sodales nisi luctus quis. Suspendisse suscipit ligula libero, id consectetur magna dictum sed.</p>
						</div> <!-- /.widget-item -->
					</div> <!-- /.col-md-4 -->
					<?php
				}?>
                	
                    
                    
                    
                </div> <!-- /.row second -->
                
            </div> <!-- /.container -->
        </div> <!-- /.middle-content -->