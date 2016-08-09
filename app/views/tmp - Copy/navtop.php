<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php echo $this->uri->baseUri;?>" class="brand"><i class="icon-leaf">Koperasi simpan pinjam</i></a>
                    <div id="app-nav-top-bar" class="nav-collapse">
					
                        <ul class="nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Simpanan
                                        <b class="caret hidden-phone"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?php echo $this->uri->baseUri;?>simpanan/ambil_simpanan"><i class="icon-hand-right"></i>&nbsp;Ambil Simpanan</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->uri->baseUri;?>simpanan"><i class="icon-hand-right"></i>&nbsp;View Simpanan</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Tabungan
                                        <b class="caret hidden-phone"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?php echo $this->uri->baseUri;?>tabungan/input_cari"><i class="icon-hand-right"></i>&nbsp;Input Tabungan</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->uri->baseUri;?>tabungan/ambil_cari"><i class="icon-hand-right"></i>&nbsp;Ambil Tabungan</a>
                                        </li>
										<li class="divider"></li>
                                        <li>
                                            <a href="<?php echo $this->uri->baseUri;?>tabungan"><i class="icon-hand-right"></i>&nbsp;View Tabungan</a>
                                        </li>
										
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Kas
                                        <b class="caret hidden-phone"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?php echo $this->uri->baseUri;?>kas/input_form"><i class="icon-hand-right"></i>&nbsp;Input Kas</a>
                                        </li>
										<li class="divider"></li>
                                        <li>
                                            <a href="<?php echo $this->uri->baseUri;?>kas"><i class="icon-hand-right"></i>&nbsp;View Kas</a>
                                        </li>
										
                                    </ul>
                                </li>
                            
                        </ul>
                        <ul class="nav pull-right">
						<?php if($this->session->getValue('code_grup')=='adm' || $this->session->getValue('code_grup')=='s_adm' )
								{?>
							<li>
							<strong>
							<?php echo $this->session->getValue('nama').'('.$this->session->getValue('grup').')';?></strong>
							</li>
                            <li>
							<a href="<?php echo $this->uri->baseUri;?>login/logout">Logout</a>
                            </li>
                            <?php }else{
							?>
							<li>
							<a href="<?php echo $this->uri->baseUri;?>login">Login</a>
                            </li>
							<?php
							}?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>