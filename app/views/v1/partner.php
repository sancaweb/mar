<div class="partner-list">
            <div class="container">
                <div class="row">
				<?php if($list_partner){
					foreach ($list_partner as $list_partner){
						?>
						<div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="partner-item">
						<a href="<?php echo $list_partner->url;?>" target="_blank">
                            <img class="img-thumbnail" style="width:142px;" src="<?php echo $this->uri->baseUri;?>upload/partner/<?php echo $list_partner->image;?>" alt="<?php echo $list_partner->nama_partner;?>" title="<?php echo $list_partner->nama_partner;?>">
                        </a>
						</div> <!-- /.partner-item -->
						</div> <!-- /.col-md-2 -->
						<?php
					}
				}else{
					?>
					<div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="partner-item">
                            <img src="<?php echo $this->uri->baseUri;?>upload/partner/blank.jpg" alt="Gambar tidak ditemukan">
                        </div> <!-- /.partner-item -->
                    </div> <!-- /.col-md-2 -->
					<?php
				}?>
                    
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div>