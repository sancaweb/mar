		<?php if (isset($pesan)){
		echo $pesan;
	}?>
<form class="form-inline" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>nasabah/cari_nasabah">
  <input name="katakunci" type="text" placeholder="Kata Kunci">
  <select name="berdasarkan" required>
		  <option value="">-- Cari Berdasarkan --</option>
		  <option value="noreg">No. Registrasi Nasabah</option>
		  <option value="nama">Nama Nasabah</option>
		  <option value="noktp">Nomor KTP</option>
		</select>
  <button type="submit" class="btn"><i class="icon-search"></i> Cari Nasabah</button>
</form>

<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data Nasabah</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover ">
              <thead>
                <tr>
                  <th>#</th>
                  <th>No Registrasi</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Action</th>
                </tr>
              </thead>
			  <tfoot>
				<tr>
				<td colspan="2">TOTAL: <?php if (isset($total_nasabah)){echo $total_nasabah;}?></td>
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
			  <?php if ($viewall_nasabah){
			  $i=$no; 
				foreach ($viewall_nasabah as $viewall_nasabah){
				$i++;
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $viewall_nasabah->noreg;?></td>
                  <td><?php echo $viewall_nasabah->nama;?></td>
                  <td><?php echo $viewall_nasabah->dusun.',&nbsp;'.$viewall_nasabah->rtrw.',&nbsp;'.$viewall_nasabah->desa.',&nbsp;'.
						$viewall_nasabah->kec.',&nbsp;'.$viewall_nasabah->kab.',&nbsp;'.$viewall_nasabah->propinsi.'&nbsp;';?>
				  
				  </td>
                  <td>
					<a class="btn btn-primary" target="_blank" href="<?php echo $this->uri->baseUri;?>nasabah/view_detail/<?php echo base64_encode($viewall_nasabah->noreg);?>">
                    <i class="icon-zoom-in"></i> View Detail 
                    </a>
					<?php
					if($this->session->getValue('code_grup')=='s_adm' )
						{
					?>
					<a class="btn btn-primary" href="<?php echo $this->uri->baseUri;?>nasabah/edit_form/<?php echo base64_encode($viewall_nasabah->noreg);?>">
                    <i class="icon-pencil"></i> Edit 
                    </a>
					<?php }?>
				  </td>
                </tr>
				<?php
				}
			  }?>
              </tbody>
            </table>
			</div>
			</div>