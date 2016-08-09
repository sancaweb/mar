
<div class="middle-content">
            <div class="container">
                <div class="row">				
                    <div class="col-md-8">
                        <div class="widget-item">
							<div class="isi">
							
									<h3 class="widget-title"><?php echo $single_kabar->judul;?></h3>
									<?php echo $single_kabar->keterangan;?>
								
								
							</div>
                        </div> <!-- /.widget-item -->
                    </div> <!-- /.col-md-8 -->
					
                    <div class="col-md-4">
                        <div class="widget-item">
                            <h3 class="widget-title"><?php echo $nama_kategori->nama_kategori.' Terbaru';?></h3>
							<?php if($view_kabar){
								foreach($view_kabar as $data){
									$nama_kategori=$this->kabar->nama_kategori($data->kategori)->nama_kategori;
									$tgl=date('d',strtotime($data->tgl_input));
									$bulan=date('M',strtotime($data->tgl_input));
									
									?>
									<div class="post-small">
										<div class="post-date">
											<span class="time"><?php echo $tgl;?></span>
											<span><?php echo $bulan;?></span>
										</div> <!-- /.post-thumb -->
										<div class="post-content">
											<h4><a href="<?php echo $this->uri->baseUri.'index.php/kabar/view/'.base64_encode($data->kategori).'/'.base64_encode($data->id).'/'.$data->judul;?>">
											<?php echo $data->judul;?></a></h4>
											<span>Kategori: <?php echo $nama_kategori;?></span>
											<?php echo $this->readmore->readmore($this->image->del_img($data->keterangan),250);?>
											<p><a href="<?php echo $this->uri->baseUri.'index.php/kabar/view/'.base64_encode($data->kategori).'/'.base64_encode($data->id).'/'.$data->judul;?>">Readmore ...</a></p>
											
										</div> <!-- /.post-content -->
									</div> <!-- /.post-small -->
									<?php
								}
							}else{
								
							}?>
							
                        </div> <!-- /.widget-item -->
                    </div> <!-- /.col-md-4 -->
					
					
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.middle-content -->