		<?php if (isset($pesan)){
		echo $pesan;
	}?>
<form class="form-inline" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri.'simpanan/cari_simpanan';?>">
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
     <h5>Data Simpanan</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover ">
              <thead>
                <tr>
                  <th>#</th>
                  <th>No Registrasi</th>
                  <th>Nama</th>
                  <th>Total Simpanan</th>
                  <th>Action</th>
                </tr>
              </thead>
			  <tfoot>
				<tr>
				<td colspan="2">TOTAL: <strong><?php if (isset($total_simpanan)){echo $total_simpanan;}?></strong></td>
				
				<td colspan="2">
				<?php echo 'Seluruh Simpanan Nasabah: <strong>Rp. '.number_format($rupiah_simpanan_all,0,'','.').'</strong>';?>
				</td>
				<td colspan="1"></td>
				</tr>
			  </tfoot>
              <tbody>
			  <?php if ($viewall_simpanan){
			  $i=0; 
				foreach ($viewall_simpanan as $viewall_simpanan){
				$total_pinjaman=$this->pinjaman->total_pinjaman_noreg($viewall_simpanan->noreg);
				$i++;
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $viewall_simpanan->noreg;?></td>
                  <td><?php echo $viewall_simpanan->nama;?></td>
                  <td><?php echo 'Rp. '.number_format($viewall_simpanan->saldo,0,'','.').' ('.$total_pinjaman.' x pinjaman)';?>
				  </td>
                  <td>
					<a class="btn btn-primary" target="_blank" href="<?php echo $this->uri->baseUri;?>simpanan/view_detail/<?php echo base64_encode($viewall_simpanan->noreg);?>">
                    <i class="icon-zoom-in"></i> View Detail Simpanan 
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