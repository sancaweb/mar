		<?php if (isset($pesan)){
		echo $pesan;
	}?>
<form class="form-inline" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>tabungan/cari_tabungan">
  <input name="katakunci" type="text" placeholder="Kata Kunci">
  <select name="berdasarkan" >
		  <option value="">-- Cari Berdasarkan --</option>
		  <option value="nasabah.noreg">No. Registrasi Nasabah</option>
		  <option value="nasabah.nama">Nama Nasabah</option>
		</select>
  <button type="submit" class="btn"><i class="icon-search"></i> Cari simpanan</button>
</form>

<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data Tabungan</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover table-border">
              <thead>
                <tr>
                  <th>#</th>
                  <th>No Registrasi</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Total Tabungan</th>
                  <th>Action</th>
                </tr>
              </thead>
			  <tfoot>
				<tr>
				<td colspan="2">TOTAL: <?php if (isset($total_tabungan)){echo $total_tabungan;}?></td>
				<td></td>				
				<td colspan="3">
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
			  <?php if ($viewall_tabungan){
			  $i=$no; 
				foreach ($viewall_tabungan as $viewall_tabungan){
				$i++;
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $viewall_tabungan->noreg;?></td>
                  <td><?php echo $viewall_tabungan->nama;?></td>
                  <td><?php echo $viewall_tabungan->dusun.', &nbsp;'.$viewall_tabungan->rtrw.', &nbsp;'.
						$viewall_tabungan->desa.', &nbsp;'.$viewall_tabungan->kec.', &nbsp;'.
						$viewall_tabungan->kab.', &nbsp;'.$viewall_tabungan->propinsi.', &nbsp;.'
				  ;?></td>
                  <td><?php echo 'Rp. '.number_format($viewall_tabungan->saldo,0,'','.');?>
				  </td>
                  <td>
					<a class="btn btn-primary" href="<?php echo $this->uri->baseUri;?>tabungan/view_detail/<?php echo base64_encode($viewall_tabungan->noreg);?>">
                    <i class="icon-zoom-in"></i> View Detail 
                    </a>
				  </td>
                </tr>
				<?php
				}
			  }?>
              </tbody>
            </table>
			</div>
			</div>