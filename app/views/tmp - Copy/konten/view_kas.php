		<?php if (isset($pesan)){
		echo $pesan;
	}?>
	
<div class="box">
     <div class="box-header">
     <i class="icon-search icon-large"></i>
     <h5>Pencarian kas berdasarkan tanggal</h5>
                            
    </div>
	<div class="box-content box-table">
	<br/>
	<form class="form-inline" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>kas/cari_kas">
  <input name="waktu_awal" type="text" placeholder="Waktu Awal" id="datepicker">
  <span>Sampai -></span>
  <input name="waktu_akhir" type="text" placeholder="Waktu Akhir" id="datepicker2">
  <button type="submit" class="btn"><i class="icon-search"></i> Cari Kas</button>
</form>
	</div>
</div>

<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data Kas <?php if (isset($waktu_awal,$waktu_akhir)){echo 'Dari Tanggal '.$waktu_awal.' Sampai '.$waktu_akhir;}else{echo 'Bulan : '.$bulan.', Tahun : '.$tahun;}?></h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Uraian</th>
                  <th>Debet</th>
                  <th>Kredit</th>
                  <th>Petugas</th>
				  <?php
					if($this->session->getValue('code_grup')=='s_adm' )
					{
				  ?>
                  <th>Action</th>
				  <?php } ?>
                </tr>
              </thead>
			  <tfoot>
			  <tr>
			  <td colspan="3">
				<div class="alert alert-block alert-info">
				<p>Total Input: <strong><?php echo $total_kas;?></strong>
				</p>
				</div>
			  
			  </td>
			  <td>			  
				<div class="alert alert-block alert-info">
				<p>
			  <?php echo 'Total Debet: <strong>Rp. '.number_format($total_debet,0,'','.').'</strong>';?>
			  
				</p>
				</div></td>
			  <td>
				<div class="alert alert-block alert-info">
				<p>
			  <?php echo 'Total Kredit: <strong>Rp. '.number_format($total_kredit,0,'','.').'</strong>';?>
				</p>
				</div>
			  </td>
			  <td colspan="2">
				<div class="alert alert-block alert-info">
				<p>
			  <?php echo 'Total Saldo: <strong>Rp. '.number_format($saldo,0,'','.').'</strong>';?>
				</p>
				</div>
			  </td>
			  </tr>
				<tr>				
				<td colspan="6">
				<div class="pagination">
				   <ul>
					<?php if ($pageLinks): ?>
				
                <?php foreach ($pageLinks as $paging): ?>
                    <?php echo '<li>'.$paging; ?></li>
					
                <?php endforeach; ?>
            
					<?php endif; ?>
					</ul>
					</div>
				</td>							
				
				</tr>
			  </tfoot>
              <tbody>
			  <?php 
			  if($data_kas){
			  $i=$no;
			  foreach ($data_kas as $data_kas){
			  $i++;
				?>				
			  <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $data_kas->tgl;?></td>
                  <td><?php echo $data_kas->uraian;?></td>
                  <td><?php echo 'Rp. '.number_format($data_kas->debet,0,'','.');?></td>
                  <td><?php echo 'Rp. '.number_format($data_kas->kredit,0,'','.');?></td>
                  <td><?php echo $data_kas->petugas;?></td>
				  <?php
				  if($this->session->getValue('code_grup')=='s_adm' )
					{
				  ?>
                  <td>				  
					<a class="btn btn-primary" href="<?php echo $this->uri->baseUri.'kas/edit_form/'.base64_encode($data_kas->id);?>">
                    <i class="icon-pencil"></i> Edit Kas 
                    </a>
					<a class="btn btn-primary" href="<?php echo $this->uri->baseUri.'kas/delete/'.base64_encode($data_kas->id);?>">
                    <i class="icon-remove"></i> Delete Kas 
                    </a>
				  </td>
				  <?php
					}
				  ?>
				  
                </tr>
				<?php
			  }}?>
              </tbody>
            </table>
			</div>
			</div>