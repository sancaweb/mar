<form class="form-inline" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>pinjaman/hasil_cari">
  <input name="katakunci" type="text" placeholder="Kata Kunci">
  <select name="berdasarkan" >
		  <option value="">-- Cari Berdasarkan --</option>
		  <option value="nasabah.noreg">No. Registrasi Nasabah</option>
		  <option value="nasabah.nama">Nama Nasabah</option>
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
				<td colspan="5">TOTAL: <strong><?php if (isset($total_cari)){echo $total_cari;}?></strong></td>
				</tr>
			  </tfoot>
              <tbody>
			  
			  <?php if ($hasil_cari){
			   $i=0;
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
					<a class="btn btn-primary" href="<?php echo $this->uri->baseUri;?>pinjaman/cari_pinjaman/<?php echo base64_encode($hasil_cari->noreg);?>">
                    <i class="icon-zoom-in"></i> View Pinjaman 
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
			<?php }?>