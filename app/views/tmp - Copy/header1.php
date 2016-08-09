<div class="body-nav body-nav-horizontal body-nav-fixed">
                        <div class="container">
                            <ul>
                                <li>
                                    <a href="<?php echo $this->uri->baseUri;?>">
                                        <i class="icon-dashboard icon-large"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->uri->baseUri;?>nasabah/input_form">
                                        <i class="icon-user icon-large"></i> Input Nasabah
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->uri->baseUri;?>pinjaman/input_cari">
                                        <i class="icon-tags icon-large"></i> Input Pinjaman
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->uri->baseUri;?>cicilan/input_cari">
                                        <i class="icon-calendar icon-large"></i> Input Cicilan
                                    </a>
                                </li>
								<li class="divider"></li>
                                <li>
                                    <a href="<?php echo $this->uri->baseUri;?>nasabah">
                                        <i class="icon-user icon-large"></i> View Nasabah
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->uri->baseUri;?>pinjaman">
                                        <i class="icon-tags icon-large"></i> View Pinjaman
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->uri->baseUri;?>cicilan">
                                        <i class="icon-calendar icon-large"></i> View Cicilan
                                    </a>
                                </li>
								<?php 
								if($this->session->getValue('code_grup')=='s_adm' )
									{
								?>
                                <li>
                                    <a href="<?php echo $this->uri->baseUri.'target';?>">
                                        <i class="icon-screenshot icon-large"></i> Target
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->uri->baseUri.'target/view_akumulasi';?>">
                                        <i class="icon-search icon-large"></i> View
                                    </a>
                                </li>
								<?php
								}
								?>
                                <li>
								<!--
                                <li>
                                    <a href="#">
                                        <i class="icon-calendar icon-large"></i> Schedule
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-map-marker icon-large"></i> Map It
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-tasks icon-large"></i> Widgets
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-cogs icon-large"></i> Settings
                                    </a>
                                </li>
                                    <a href="#">
                                        <i class="icon-bar-chart icon-large"></i> Charts
                                    </a>
                                </li>
								-->
                            </ul>
                        </div>
                    </div>