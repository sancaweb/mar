
        <div class="row">
            <div class="span8">
                <div class="box">
                    <div class="box-header">
                        <i class="icon-bookmark"></i>
                        <h5>Shortcuts</h5>
                    </div>
                    <div class="box-content">
                        <div class="btn-group-box">
                            <button class="btn"><i class="icon-dashboard icon-large"></i><br/>Dashboard</button>
                            <a href="<?php echo $this->uri->baseUri;?>user"><button class="btn"><i class="icon-user icon-large"></i><br/>
							Account</button></a>
                            <!--<button class="btn"><i class="icon-search icon-large"></i><br/>Search</button>
                            <button class="btn"><i class="icon-list-alt icon-large"></i><br/>Reports</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="span8">
			
                
            </div>
        </div>
		
        <div class="row">
            <div class="span8">
                <div class="box pattern pattern-sandstone">
                    <div class="box-header">
                        <i class="icon-list"></i>
                        <h5>10 Pinjaman terbaru</h5>
                        <button class="btn btn-box-right" data-toggle="collapse" data-target=".box-list">
                            <i class="icon-reorder"></i>
                        </button>
                    </div>
                    <div class="box-content box-list collapse in">
                        <ul>
						<?php if ($data_pinjaman){
							foreach($data_pinjaman as $data_pinjaman){
							?>
							<li>
                                <div>
                                    <a target="_blank" href="<?php echo $this->uri->baseUri.'pinjaman/view_detail/'.base64_encode($data_pinjaman->id_pinjaman);?>" class="news-item-title">Nama Nasabah: <?php echo $data_pinjaman->nama;?> </a>
                                    <p class="news-item-preview">Jumlah Pinjaman: <?php echo 'Rp. '.number_format($data_pinjaman->jumlah_pinjaman,0,'','.');?>, Tenor: <?php echo $data_pinjaman->tenor;?>X Cicilan, Cicilan perbulan: <?php echo 'Rp. '.number_format($data_pinjaman->cicilan,0,'','.');?></p>
									<p class="news-item-preview">Tanggal Pinjaman: <?php echo $data_pinjaman->tgl_pinjaman;?></p>
								</div>
                            </li>
							
							<?php
							}
						}?>
                            
                            
                        </ul>
                        
                        
                    </div>

                </div>
            </div>
            <div class="span8">
			<div class="box pattern pattern-sandstone">
                    <div class="box-header">
                        <i class="icon-list"></i>
                        <h5>10 Pembayaran terbaru</h5>
                        <button class="btn btn-box-right" data-toggle="collapse" data-target=".box-list2">
                            <i class="icon-reorder"></i>
                        </button>
                    </div>
                    <div class="box-content box-list2 collapse in" >
                        <ul>
							<?php if($data_cicilan){
							$i=0;
								foreach ($data_cicilan as $data_cicilan){
								$i++
								?>								
									<li>
										<div>
											<a target="_blank" href="<?php echo $this->uri->baseUri.'cicilan/history/'.base64_encode($data_cicilan->id_pinjaman);?>" class="news-item-title">Nama Nasabah: <?php echo $data_cicilan->nama;?></a>
											<p class="news-item-preview">Pembayaran: <?php echo 'Rp. '.number_format($data_cicilan->pembayaran,0,'','.');?>, Cicilan ke <?php echo $data_cicilan->cicilan_ke;?> dari <?php echo $this->pinjaman->detail($data_cicilan->id_pinjaman)->tenor;?>, Sisa saldo: <?php echo 'Rp. '.number_format($data_cicilan->saldo,0,'','.');?>.</p>
											<p class="news-item-preview">Tanggal Pembayaran: <?php echo $data_cicilan->tgl_cicilan;?></p>
										</div>
									</li>
								<?php
								}
							} ?>
                        </ul><!--
                        <div class="box-collapse">
                            <button class="btn btn-box" data-toggle="collapse" data-target=".more-list">
                                Show More
                            </button>
                        </div>
                        <ul class="more-list collapse out">
                            <li>
                                <div>
                                    <a href="#" class="news-item-title">Duis aute irure dolor in reprehenderit</a>
                                    <p class="news-item-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="#" class="news-item-title">Duis aute irure dolor in reprehenderit</a>
                                    <p class="news-item-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="#" class="news-item-title">Duis aute irure dolor in reprehenderit</a>
                                    <p class="news-item-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                </div>
                            </li>
                        </ul> -->
                    
                    </div><!--
                    <div class="box-footer">
					Footer
                    </div> -->
                </div>
            </div>
        </div>