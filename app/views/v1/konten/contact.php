<div class="contact-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-6 map-wrapper">
						
						<div class="widget-item">
                        
                            <h3 class="widget-title">Our Location</h3>
                            <?php if($viewall_kantor_page){
								foreach($viewall_kantor_page as $data){
									?>
									<div class="service-item">
										<div class="service-icon">
											<i class="fa fa-phone"></i>
										</div> <!-- /.service-icon -->
										<div class="service-content">										  
										  <div class="contact-infos">
										  <h4><?php echo $data->nama_kantor;?></h4>
												<ul>
													<li><?php echo $data->alamat;?></li>
													<li>Tel: <?php echo $data->tlp;?></li>
													<li>Email: <a href="mailto:<?php echo $data->email;?>"><?php echo $data->email;?></a></li>
												</ul>
											</div> 
										</div>
										<!-- /.service-content -->
									</div> <!-- /.service-item -->
									
									<?php
								}
							}?>
							<ul class="pagination pagination-sm no-margin pull-right">
							<?php if ($pageLinks): ?>
									
									<?php foreach ($pageLinks as $paging): ?>
										<?php echo '<li>'.$paging; ?></li>
										
									<?php endforeach; ?>
								
										<?php endif; ?>
						  </ul>
                            
                        </div> <!-- /.widget-item -->
					
                    </div>
                    <div class="col-md-5 col-sm-6">
                        <h3 class="widget-title">Contact Us</h3>
						<?php
							if(isset($alert)){
								echo $alert;
							}
						?>
                        <div class="contact-form">
                            <form name="contactform" data-toggle="validator" enctype="multipart/form-data" role="form" id="contactform" action="<?php echo $this->uri->baseUri;?>index.php/pesan/kirim_pesan" method="post">
                                
								<p>
                                    <select data-placeholder="Penerima Pesan (bisa lebih dari satu)." style="width:350px;" multiple id="dropdown-ajax" class="form-control chosen-select" name="penerima[]" required>
					
									<?php foreach($data_user_grup as $data_user_grup){						
										?>
										<optgroup class="optionGroup" label="User Level : <?php echo $data_user_grup->ket;?>">
										<?php $user_level=$data_user_grup->level;
											$data_user=$this->user->viewall_username_and_id($user_level);
											if($data_user){
												foreach($data_user as $data_user){				
													$user_id=$data_user->id;
													$username=$data_user->username;
													$data_pengguna=$this->user->view_nama_lengkap($user_id);
													if($this->session->getValue('user_id') == $user_id){
														
													}else{
														
														if($data_pengguna->nama_lengkap != ''){
															$nama='Nama Pengguna: '.$data_pengguna->nama_lengkap;
														}else{
															$nama='Username: '.$username;
														}
														?>
														<option value="<?php echo $user_id;?>"><?php echo $nama;?></option>
														<?php
													}
													
												}
											}
											
										?>
										</optgroup>
										<?php
									}?>
								</select>									
                                </p>
								
								<?php
									$user_id=$this->session->getValue('user_id');			
									$nama_and_email=$this->user->view_nama_email($user_id);
									if($nama_and_email){
										$nama=$nama_and_email->nama_lengkap;
										$email=$nama_and_email->email;
									}else{
										$nama='';
										$email='';
										
									}
								?>
								
								<input name="pengirim" type="hidden" id="name" value="<?php echo $this->session->getValue('user_id');?>" readonly>
								<input name="posisi_form" type="hidden" id="name" value="luar" readonly>
								<p>
                                    <input name="nama" type="text" id="name" placeholder="Your Name" value="<?php echo $nama;?>" required>
                                    
                                </p>
                                <p>
                                    <input name="email" type="text" id="email" placeholder="Your Email" value="<?php echo $email;?>" required> 
                                </p>
                                <p>
                                    <input name="subjek" type="text" id="subject" placeholder="Subject" required> 
                                </p>
                                <p>
                                    <textarea name="isi_pesan" id="message" placeholder="Message"></textarea>    
                                </p>
                                <input type="submit" class="mainBtn" id="submit" value="Send Message">
                            </form>
                        </div> <!-- /.contact-form -->
                    </div>
                </div>
            </div>
        </div>