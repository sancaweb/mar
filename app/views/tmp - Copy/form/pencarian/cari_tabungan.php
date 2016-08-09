<form class="form-inline" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>tabungan/hasil_cari">
  <input name="page" type="hidden" value="<?php echo $page;?>">
  <input name="katakunci" type="text" placeholder="Kata Kunci">
  <select name="berdasarkan" >
		  <option value="">-- Cari Berdasarkan --</option>
		  <option value="noreg">No. Registrasi Nasabah</option>
		  <option value="nama">Nama Nasabah</option>
		  <!-- <option value="pinjaman.id_pinjaman">ID Pinjaman</option> -->
		</select>
  <button type="submit" class="btn"><i class="icon-search"></i> Search</button>
</form>

<?php if (isset($hasil_cari)){?>
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
				<td colspan="2">TOTAL: <?php if (isset($total_cari)){echo $total_cari;}?></td>
				<td></td>				
				<td colspan="4">
				
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
			  
			  <?php if ($hasil_cari){
			   $i=$no;
				 foreach ($hasil_cari as $hasil_cari){
				 $i++;
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $hasil_cari->noreg;?></td>
                  <td><?php echo $hasil_cari->nama;?></td>
                  <td><?php echo $hasil_cari->dusun.', &nbsp;'.$hasil_cari->rtrw.', &nbsp;'.$hasil_cari->desa.', &nbsp;'.
						$hasil_cari->kec.', &nbsp;'.$hasil_cari->kab.', &nbsp;'.$hasil_cari->propinsi.'.';?>
				  
				  </td>
                  <td>
				  <?php 
					if ($page == 'input'){
					?>
					<a class="btn btn-primary" href="<?php echo $this->uri->baseUri;?>tabungan/input_form/<?php echo base64_encode($hasil_cari->noreg);?>">
                    <i class="icon-zoom-in"></i> View / Input Tabungan 
                    </a>
					<?php					
					}elseif($page == 'ambil'){
					?>
					<a class="btn btn-primary" href="<?php echo $this->uri->baseUri;?>tabungan/ambil_form/<?php echo base64_encode($hasil_cari->noreg);?>">
                    <i class="icon-zoom-in"></i> View / Ambil Tabungan 
                    </a>
					<?php
					}
				  ?>
					
					
				  </td>
                </tr>
				<?php
				 }
			   }?>
              </tbody>
            </table>
			</div>
			</div>
			<?php }?>